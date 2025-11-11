<?php
session_start();
require_once __DIR__ . '/dbcon.php';

$id_no   = trim($_POST['id_no'] ?? '');
$book_id = intval($_POST['book_id'] ?? 0);
$borrow_date = $_POST['borrow_date'] ?? '';
$return_date = $_POST['return_date'] ?? '';

if ($id_no === '' || $book_id === 0 || $borrow_date === '' || $return_date === '') {
    $_SESSION['alert'] = 'Missing data.';
    header('Location: /MBClib/admin/transaction');
    exit;
}

$borrow_dt = new DateTime($borrow_date);
$return_dt = new DateTime($return_date);
if ($return_dt <= $borrow_dt) {
    $_SESSION['alert'] = 'Return date must be after borrow date.';
    header('Location: /MBClib/admin/transaction');
    exit;
}

try {
    // Verify student exists
    $u = $con->prepare("SELECT id_no FROM users WHERE id_no = ?");
    $u->bind_param('s', $id_no);
    $u->execute();
    if ($u->get_result()->num_rows === 0) {
        $_SESSION['alert'] = 'Student not found.';
        header('Location: /MBClib/admin/transaction');
        exit;
    }

    // Check if book is available (not borrowed)
    $b = $con->prepare("SELECT is_borrowed FROM books WHERE book_id = ?");
    $b->bind_param('i', $book_id);
    $b->execute();
    $br = $b->get_result()->fetch_assoc();
    if (!$br || $br['is_borrowed'] == 1) {
        $_SESSION['alert'] = 'Book is already borrowed.';
        header('Location: /MBClib/admin/transaction');
        exit;
    }

    // Insert into transactions
    $t = $con->prepare("INSERT INTO transactions (id_no, book_id, date_borrowed, date_return_expected, status) VALUES (?, ?, ?, ?, 'borrowed')");
    $t->bind_param('siss', $id_no, $book_id, $borrow_date, $return_date);
    $t->execute();

    // Update books: set borrowed and date
    $u2 = $con->prepare("UPDATE books SET is_borrowed = 1, date_borrowed = NOW() WHERE book_id = ?");
    $u2->bind_param('i', $book_id);
    $u2->execute();

    $_SESSION['alert'] = 'Borrow recorded.';
} catch (Exception $e) {
    $_SESSION['alert'] = 'Error processing borrow.';
}
header('Location: /MBClib/admin/transaction');
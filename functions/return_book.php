<?php
session_start();
require_once __DIR__ . '/dbcon.php';

$book_id = intval($_POST['book_id'] ?? 0);

if ($book_id === 0) {
    $_SESSION['alert'] = 'Missing book ID.';
    header('Location: /MBClib/admin/transaction');
    exit;
}

try {
    // Find the transaction for this book
    $t = $con->prepare("SELECT transaction_id FROM transactions WHERE book_id = ? AND status = 'borrowed' LIMIT 1");
    $t->bind_param('i', $book_id);
    $t->execute();
    $tr = $t->get_result()->fetch_assoc();
    if (!$tr) {
        $_SESSION['alert'] = 'No active borrow record for this book.';
        header('Location: /MBClib/admin/transaction');
        exit;
    }

    // Update transaction: set returned
    $u = $con->prepare("UPDATE transactions SET date_returned = NOW(), status = 'returned', overdue_days = GREATEST(0, DATEDIFF(NOW(), date_return_expected)) WHERE transaction_id = ?");
    $u->bind_param('i', $tr['transaction_id']);
    $u->execute();

    // Update books: set available
    $b = $con->prepare("UPDATE books SET is_borrowed = 0, date_borrowed = NULL WHERE book_id = ?");
    $b->bind_param('i', $book_id);
    $b->execute();

    $_SESSION['alert'] = 'Return recorded.';
} catch (Exception $e) {
    $_SESSION['alert'] = 'Error processing return.';
}
header('Location: /MBClib/admin/transaction');
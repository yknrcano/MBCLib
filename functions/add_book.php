<?php
session_start();
require_once __DIR__ . '/dbcon.php';
require_once __DIR__ . '/../phpqrcode/qrlib.php';

$isbn = trim($_POST['ISBN'] ?? '');
$title = trim($_POST['Title'] ?? '');
$author = trim($_POST['Author'] ?? '');
$date_published = $_POST['Date_published'] ?? '';
$quantity = max(1, intval($_POST['Quantity'] ?? 1));

if ($isbn && $title && $author && $date_published && $quantity > 0) {
    $successCount = 0;
    for ($i = 0; $i < $quantity; $i++) {
        $sql = "INSERT INTO books (ISBN, Title, Author, Date_published) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $isbn, $title, $author, $date_published);
        if (mysqli_stmt_execute($stmt)) {
            $book_id = mysqli_insert_id($con);

            $qr_content = "BookID:$book_id;ISBN:$isbn;Title:$title";
            $qr_folder = __DIR__ . '/../assets/qrcodes/';
            if (!is_dir($qr_folder)) {
                mkdir($qr_folder, 0777, true);
            }
            $qr_filename = $qr_folder . "book_" . $book_id . ".png";
            QRcode::png($qr_content, $qr_filename, QR_ECLEVEL_L, 4);

            $qr_db_path = "assets/qrcodes/book_" . $book_id . ".png";
            $update_sql = "UPDATE books SET qr_code = ? WHERE book_id = ?";
            $update_stmt = mysqli_prepare($con, $update_sql);
            mysqli_stmt_bind_param($update_stmt, "si", $qr_db_path, $book_id);
            mysqli_stmt_execute($update_stmt);
            mysqli_stmt_close($update_stmt);

            $successCount++;
        }
        mysqli_stmt_close($stmt);
    }
    $_SESSION['alert'] = "$successCount book(s) added successfully with QR codes!";
} else {
    $_SESSION['alert'] = "All fields are required.";
}

header("Location: ../admin/manage.php");
exit;
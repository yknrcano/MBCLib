<?php
session_start();
require_once __DIR__ . '/dbcon.php';

$book_id = intval($_POST['book_id'] ?? 0);

if ($book_id > 0) {
    $sql = "SELECT qr_code FROM books WHERE book_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $book_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $qr_code_path);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($qr_code_path) {
        $file = __DIR__ . '/../assets/qrcodes/' . $qr_code_path;
        if (file_exists($file)) {
            unlink($file);
        }
    }

    $del_sql = "DELETE FROM books WHERE book_id = ?";
    $del_stmt = mysqli_prepare($con, $del_sql);
    mysqli_stmt_bind_param($del_stmt, "i", $book_id);
    mysqli_stmt_execute($del_stmt);
    mysqli_stmt_close($del_stmt);

    $_SESSION['alert'] = "Book deleted successfully.";
} else {
    $_SESSION['alert'] = "Invalid book ID.";
}

header("Location: ../admin/manage.php");
exit;
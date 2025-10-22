<?php
session_start();
require_once __DIR__ . '/dbcon.php';

$isbn = $_POST['isbn'] ?? '';

if ($isbn) {
    $sql = "SELECT qr_code FROM books WHERE ISBN = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $isbn);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        if (!empty($row['qr_code'])) {
            $file = __DIR__ . '/../assets/qrcodes/' . $row['qr_code'];
            if (file_exists($file)) {
                unlink($file);
            }
        }
        if (!empty($row['book_cover'])) {
            $cover_file = __DIR__ . '/../assets/book_cover/' . $row['book_cover'];
            if (file_exists($cover_file)) {
                unlink($cover_file);
            }
        }
    }
    mysqli_stmt_close($stmt);

    $del_sql = "DELETE FROM books WHERE ISBN = ?";
    $del_stmt = mysqli_prepare($con, $del_sql);
    mysqli_stmt_bind_param($del_stmt, "s", $isbn);
    mysqli_stmt_execute($del_stmt);
    mysqli_stmt_close($del_stmt);

    $_SESSION['alert'] = "All books with ISBN $isbn deleted successfully.";
} else {
    $_SESSION['alert'] = "Invalid ISBN.";
}

header("Location: ../admin/manage.php");
exit;
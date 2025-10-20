<?php
session_start();
require_once __DIR__ . '/dbcon.php';

$book_id = $_POST['book_id'] ?? '';

if ($book_id) {
    $sql = "DELETE FROM books WHERE book_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $book_id);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['alert'] = "Book ID $book_id has been deleted.";
    } else {
        $_SESSION['alert'] = "Failed to delete Book ID $book_id.";
    }
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['alert'] = "No Book ID provided.";
}

header("Location: ../admin/manage.php");
exit;
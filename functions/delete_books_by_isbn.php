<?php
session_start();
require_once __DIR__ . '/dbcon.php';

$isbn = $_POST['isbn'] ?? '';

if ($isbn) {
    $sql = "DELETE FROM books WHERE ISBN = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $isbn);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['alert'] = "All books with ISBN $isbn have been deleted.";
    } else {
        $_SESSION['alert'] = "Failed to delete books with ISBN $isbn.";
    }
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['alert'] = "No ISBN provided.";
}

header("Location: ../admin/manage.php");
exit;
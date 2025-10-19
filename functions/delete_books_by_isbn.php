<?php
require_once __DIR__ . '/dbcon.php';
$isbn = $_POST['isbn'] ?? '';
if ($isbn) {
    $sql = "DELETE FROM books WHERE ISBN = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $isbn);
    mysqli_stmt_execute($stmt);
}
header('Location: ../admin/manage');
exit;
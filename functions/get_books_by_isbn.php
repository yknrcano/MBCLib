<?php
require_once __DIR__ . '/dbcon.php';
$isbn = $_GET['isbn'] ?? '';
$books = [];
if ($isbn) {
    $sql = "SELECT book_id, is_borrowed FROM books WHERE ISBN = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $isbn);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $row['is_borrowed'] = $row['is_borrowed'] ? 'True' : 'False';
        $books[] = $row;
    }
}
header('Content-Type: application/json');
echo json_encode($books);
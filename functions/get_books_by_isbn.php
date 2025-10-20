<?php
require_once __DIR__ . '/dbcon.php';
$isbn = $_GET['isbn'] ?? '';
$books = [];
if ($isbn) {
    $sql = "SELECT b.book_id, b.is_borrowed, u.firstname AS reader_name
            FROM books b
            LEFT JOIN users u ON b.Reader_id = u.user_id
            WHERE b.ISBN = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $isbn);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $row['is_borrowed'] = $row['is_borrowed'] ? 'True' : 'False';
        $row['reader_name'] = $row['reader_name'] ?? 'None';
        $books[] = $row;
    }
}
header('Content-Type: application/json');
echo json_encode($books);
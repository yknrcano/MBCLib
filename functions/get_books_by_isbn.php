<?php
require_once __DIR__ . '/dbcon.php';

$isbn = $_GET['isbn'] ?? '';
if (!$isbn) {
    echo json_encode([]);
    exit;
}

$query = "
    SELECT 
        b.book_id, 
        b.is_borrowed, 
        COALESCE(u.firstname, 'None') AS borrower_name
    FROM books b
    LEFT JOIN transactions t ON b.book_id = t.book_id AND t.status = 'borrowed'
    LEFT JOIN users u ON t.id_no = u.id_no
    WHERE b.ISBN = ?
";

$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, 's', $isbn);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$books = [];
while ($row = mysqli_fetch_assoc($result)) {
    $books[] = $row;
}

echo json_encode($books);
?>
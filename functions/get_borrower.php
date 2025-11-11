<?php
require_once __DIR__ . '/dbcon.php';

$book_id = intval($_GET['book_id'] ?? 0);
if (!$book_id) {
    echo json_encode(['student_number' => 'Unknown']);
    exit;
}

try {
    $query = "
        SELECT t.id_no AS student_number
        FROM transactions t
        WHERE t.book_id = ? AND t.status = 'borrowed'
        LIMIT 1
    ";

    $stmt = mysqli_prepare($con, $query);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmt, 'i', $book_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    echo json_encode(['student_number' => $row['student_number'] ?? 'Unknown']);
} catch (Exception $e) {
    error_log('get_borrower.php error: ' . $e->getMessage());
    echo json_encode(['student_number' => 'Error']);
}
?>
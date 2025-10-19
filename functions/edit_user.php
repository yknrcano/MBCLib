<?php
session_start();
require_once __DIR__ . '/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? '';
    $status = $_POST['status'] ?? '';

    $status_value = ($status === 'true') ? 1 : 0;

   if ($user_id !== '') {
        $sql = "UPDATE users SET status = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($con, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ii", $status_value, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $_SESSION['alert'] = 'User status updated successfully!';
        } else {
            $_SESSION['alert'] = 'Failed to update user status.';
        }
    } else {
        $_SESSION['alert'] = 'Invalid user ID.';
    }
}

header("Location: ../admin/user_management");
exit;
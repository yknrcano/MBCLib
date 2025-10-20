<?php
session_start();
require_once __DIR__ . '/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);

    // Optional: Add a check to prevent deleting yourself or certain users

    $delete_sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($con, $delete_sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['alert'] = "User deleted successfully.";
    } else {
        $_SESSION['alert'] = "Failed to delete user.";
    }
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['alert'] = "Invalid request.";
}

header("Location: ../admin/user_management");
exit();
?>
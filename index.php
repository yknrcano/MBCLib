<?php
// Get requested URL
$url = $_GET['url'] ?? 'home';

// Simple routing
switch ($url) {
    case 'home':
        require 'pages/home.php';
        break;

    default:
        http_response_code(404);
        require 'pages/404.php';
        break;
}
?>

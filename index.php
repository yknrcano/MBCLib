<?php
// Get requested URL
$url = $_GET['url'] ?? 'home';

// Simple routing
switch ($url) {
    case 'home':
        require 'pages/home.php';
        break;
    case 'contact':
        require 'pages/contact.php';
        break;
    case 'aboutlist/history':
        require 'pages/aboutlist/history.php';
        break;
    case 'aboutlist/mission':
        require 'pages/aboutlist/mission.php';
        break;
    case 'aboutlist/goals':
        require 'pages/aboutlist/goals.php';
        break;
    case 'aboutlist/values':
        require 'pages/aboutlist/values.php';
        break;
    default:
        http_response_code(404);
        require 'pages/404.php';
        break;
}
?>

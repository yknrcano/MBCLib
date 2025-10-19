<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require_once __DIR__ . '/../../functions/dbcon.php';
    $modal_error = $_SESSION['modal_error'] ?? '';
    $modal_show = $_SESSION['modal_show'] ?? '';
    unset($_SESSION['modal_error'], $_SESSION['modal_show']);

    $user_name = '';
    if (isset($_SESSION['auth_user']['firstname'])) {
        $user_name = trim($_SESSION['auth_user']['firstname']);
    }
    
    if ($user_name === '') {
        $user_name = 'Guest';
    }
    error_log('[home.php] SESSION=' . print_r($_SESSION, true) . ' user_name=' . $user_name);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="../../css/style.css">
    <title>Marie-Bernarde College</title>
</head>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-content">
            <div class="spinner"></div>
            <img src="../../assets/MBC-Logo.png" alt="Logo" class="spinner-logo">
        </div>
    </div>

    <nav class="navbar sticky-top navbar-expand-xl navbar-all">
        <div class="container-fluid navbar-inner">
            <img height="73" id="logo" src="../../assets/MBC-Logo.png" alt="Logo" class="d-inline-block align-text-center">
            <a class="navbar-brand text-white fs-3" href="home">
                Marie-Bernarde College Library
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navItems">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white active" aria-current="page" href="home">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            About
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/MBCLib/student/aboutlist/history">History</a></li>
                            <li><a class="dropdown-item" href="/MBCLib/student/aboutlist/mission">Mission & Vision</a></li>
                            <li><a class="dropdown-item" href="/MBCLib/student/aboutlist/goals">Goals & Objectives</a></li>
                            <li><a class="dropdown-item" href="#">Core Values</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/MBClib/student/contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fa-solid fa-book"></i>
                        </a>
                    </li>
                    <li class="nav-item position-relative" id="notif-bell">
                        <a class="nav-link text-white" href="#" id="notifBellBtn">
                            <i class="fa-solid fa-bell"></i>
                        </a>
                        <div class="notif-dropdown shadow" id="notifDropdownMenu">
                            <div class="dropdown-item-text p-3">No new notifications</div>
                            <!-- Adding more notif -->
                        </div>
                    </li>
                    <li class="nav-item position-relative" id="user-menu">
                        <a class="nav-link text-white" href="#" id="userMenuBtn">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <div class="user-dropdown shadow" id="userDropdownMenu">
                            <i class="fa-regular fa-circle-user"><span class="ms-2"><?= htmlspecialchars($user_name) ?></span></i>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../../functions/logout.php">Logout</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="admission-banner">
        <h1>Core Values</h1>
        <img src="../../assets/bg3-small.png" alt="background">
    </div>

    <div class="mini-nav">
        <i class="fa-solid fa-house"></i>
        <a href="home">Home</a> /
        <h3>About</h3> /
        <h3>Core Values</h3>
    </div>

    <div class="about-section">
        <div class="about-title">
            <h2>Our Core Values</h2>
        </div>
        <div class="about-content">
            <ul class="core-values-list">
                <li><span>Faith, Integrity, and Character</span> – Rooted in strong moral values, we uphold integrity, ethical leadership, and responsibility, shaping individuals with a deep sense of purpose and service.</li>
                <li><span>Excellence in Education</span> – We are committed to progressive and research-driven education, fostering critical thinking, academic rigor, and a culture of lifelong learning to prepare students for global challenges.</li>
                <li><span>Innovation and Leadership</span> – We cultivate forward-thinking leaders who embrace creativity, adaptability, and entrepreneurial spirit, driving meaningful change in their professions and communities.</li>
                <li><span>Global Competency and Readiness</span> – Through international partnerships and collaborations, we equip students with cross-cultural awareness, global perspectives, and the skills needed to thrive in an interconnected world.</li>
                <li><span>Professional and Personal Growth</span> – We emphasize continuous professional development, mentoring students to become competent, ethical, and skilled professionals in their chosen fields.</li>
                <li><span>Holistic and Inclusive Education</span> – We nurture the mind, body, and spirit, promoting an inclusive and student-centered learning environment that values diversity, well-being, and personal fulfillment.</li>
                <li><span>Community Engagement and Service</span> – Inspired by our commitment to social responsibility, we encourage students to be active agents of change, dedicating their knowledge and skills to the betterment of society.</li>
            </ul>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer-top">
      <h2><img id="logo-footer" src="../../assets/MBC-Logo.png" alt="Logo" height="70">
        Marie-Bernarde College</h2>
    </div>
    <footer class="footer">
        <div class="footer-conts">
            <h4>Address</h4>
            <li><a href="https://www.google.com/maps/place/1116+Quirino+Hwy,+Novaliches,+Quezon+City,+Metro+Manila/@14.6984901,121.0334042,17z/data=!3m1!4b1!4m6!3m5!1s0x3397b12780c1bf9b:0x5c3f787264d9df67!8m2!3d14.6984901!4d121.0334042!16s%2Fg%2F11np7t3j8n?entry=ttu" target="_blank"><i class="fa-solid fa-location-dot"></i> 603 R&J Bldg, Quirino Highway, Novaliches, Quezon City, 1116.</a></li>
            <div class="footer-icons">
            <a href=""><i class="fa-brands fa-whatsapp"></i></a>
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-facebook-messenger"></i></a>
            </div>
        </div>

      <div class="footer-conts">
        <h4>Contacts</h4>
        <li><a href=""><i class="fa-solid fa-phone"></i> (02) 7216-4377</a></li>
        <li><a href=""><i class="fa-solid fa-phone"></i> (02) 8543-8751</a></li>
        <li><a href=""><i class="fa-solid fa-mobile-screen"></i> (+63) 917-124-8176</a></li>
      </div>

      <div class="footer-conts">
        <h4>Email</h4>
        <li><a href=""><i class="fa-regular fa-envelope"></i> registrar@mariebernardecollege.edu.ph</a></li>
        <li><a href=""><i class="fa-regular fa-envelope"></i> admin@mariebernardecollege.edu.ph</a></li>
      </div>
    </footer>
    <div class="copyright">
      <p>© 2021 All rights reserved marie - bernarde college inc.</p>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/374eee3e25.js" crossorigin="anonymous"></script>
    <script src="../../js/navbar-scroll.js"></script>
</body>
</html>
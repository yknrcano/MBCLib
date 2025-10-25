<?php
    session_start();
    $modal_error = $_SESSION['modal_error'] ?? '';
    $modal_show = $_SESSION['modal_show'] ?? '';
    unset($_SESSION['modal_error'], $_SESSION['modal_show']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
    <title>Marie-Bernarde College</title>
</head>
<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-content">
            <div class="spinner"></div>
            <img src="assets/MBC-Logo.png" alt="Logo" class="spinner-logo">
        </div>
    </div>

    <?php if (isset($_SESSION['message'])): ?>
        <div id="topAlert" class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <nav class="navbar sticky-top navbar-expand-xl navbar-home">
        <div class="container-fluid navbar-inner">
            <img height="73" id="logo" src="assets/MBC-Logo.png" alt="Logo" class="d-inline-block align-text-center">
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
                            <li><a class="dropdown-item" href="?url=aboutlist/history">History</a></li>
                            <li><a class="dropdown-item" href="?url=aboutlist/mission">Mission & Vision</a></li>
                            <li><a class="dropdown-item" href="?url=aboutlist/goals">Goals & Objectives</a></li>
                            <li><a class="dropdown-item" href="?url=aboutlist/values">Core Values</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class=" enroll-btn" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
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

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="functions/auth.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">User Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-logo">
                            <img src="assets/MBC-Logo.png" alt="Logo" height="200">
                        </div>
                        <div class="mb-3 position-relative">
                            <span class="input-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input type="email" name="email" class="form-control ps-5" id="loginEmail" placeholder="Email address" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <span class="input-icon">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" name="password" class="form-control ps-5" id="loginPassword" placeholder="Password" required>
                            <span class="password-toggle" style="cursor:pointer;" onclick="togglePassword('loginPassword', 'togglePasswordIcon')">
                                <i id="togglePasswordIcon" class="fa-regular fa-eye-slash"></i>
                            </span>
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary w-100" name="login-btn">Login</button>
                            <div class="btn-row">
                                <a class="overlay-btn" href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">Register</a>
                                <a class="overlay-btn" href="#" data-bs-toggle="modal" data-bs-target="#forgotModal" data-bs-dismiss="modal">Forgot Password?</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Registration Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-warning alert-dismissible fade show m-3" role="alert">
                <?= htmlspecialchars($_SESSION['message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <div class="modal-dialog modal-dialog-centered modal-lg-custom">
            <div class="modal-content">
                <form action="functions/auth.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">Register</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 position-relative">
                            <input type="text" name="id_no" class="form-control" placeholder="ID Number" oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="tel" name="phone" class="form-control" placeholder="Contact Number" required
                                maxlength="11" pattern="[0-9]{11}" inputmode="numeric"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,11);">
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="email" name="email" class="form-control" placeholder="Email address" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="password" name="password" class="form-control" id="registerPassword" placeholder="Password" required>
                            <span class="password-toggle" style="cursor:pointer;" onclick="togglePassword('registerPassword', 'registerPasswordIcon')">
                                <i id="togglePasswordIcon" class="fa-regular fa-eye-slash"></i>
                            </span>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="password" class="form-control" name="Rpassword" id="registerConfirmPassword" placeholder="Confirm Password" required>
                            <span class="password-toggle" style="cursor:pointer;" onclick="togglePassword('registerConfirmPassword', 'registerConfirmPasswordIcon')">
                                <i id="togglePasswordIcon" class="fa-regular fa-eye-slash"></i>
                            </span>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name="regis-btn">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotModal" tabindex="-1" aria-labelledby="forgotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg-custom">
            <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotModalLabel">Forgot Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 position-relative">
                        <span class="input-icon"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" class="form-control ps-5" placeholder="Enter your email" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
    <div class="bg-banner">
        <div class="header">
            <h5>Welcome to</h5>
            <div class="title-log">
                <h4>MARIE-BERNARDE <br> COLLEGE LIBRARY</h4> 
            </div>
        </div>
    </div>

    <div class="spacer"></div>

    <!-- enroll banner -->
    <div class="enroll-banner">

    </div>

    <div class="school-details">
        <span>What's New?</span>
        <svg class="school-details-icon" width="25" height="25" viewBox="0 0 25 25" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.60846 6.59467C6.31556 6.30178 5.84069 6.30178 5.54779 6.59467C5.2549 6.88756 5.2549 7.36244 5.54779 7.65533L11.7978 13.9053C12.0907 14.1982 12.5656 14.1982 12.8585 13.9053L19.1085 7.65533C19.4013 7.36244 19.4013 6.88756 19.1085 6.59467C18.8156 6.30178 18.3407 6.30178 18.0478 6.59467L12.3281 12.3143L6.60846 6.59467Z" fill="#323544"/>
        </svg>
        <div class="school-details-content">
            <div class="school-details-content-txt">
                <h2>Marie-Bernarde College</h2>
                <p>Established on September 20, 2002, Marie-Bernarde College Inc. (MBC) was founded by a visionary group of nursing educators, esteemed medical practitioners, and experts in business and education. From its inception, MBC has been dedicated to providing an exceptional, globally competitive healthcare education. The college's early years were marked by a dynamic start and a commitment to growth, beginning with the introduction of a comprehensive 6-month Caregiver Course. This course, expertly designed and programmed by trusted professionals, set the foundation for MBC's reputation for excellence in healthcare education.
                </p>
            </div>
            <img src="assets/bgmidwife.jpg" alt="" height="350">
        </div>  
    </div>

    <div class="programs">
        <h2>Program Offerings</h2>
        <p>Marie-Bernarde College Inc. proudly offers a wide range of accredited programs in healthcare, business, education, and technology, designed to equip students with the skills and knowledge needed for global competitiveness.</p>

        <div class="program-list" mask>
            <div class="program-box">
                <div class="let-program">
                    <h2>LET Program</h2>
                    <i class="fa-solid fa-award"></i>
                    <p>Our Licensure Examination for Teachers (LET) program is designed to prepare aspiring educators for the challenges of the teaching profession.</p>
                </div>
            </div>

            <div class="program-box">
                <div class="midwifery">
                    <h2>Midwifery</h2>
                    <i class="fa-solid fa-person-pregnant"></i>
                    <p>Our midwifery program trains students to provide comprehensive care to childbearing women and their families.</p>
                </div>
            </div>

            <div class="program-box">
                <div class="secondary-educ">
                    <h2>Secondary Education</h2>
                    <i class="fa-solid fa-book"></i>
                    <p>Our secondary education program prepares students to become effective educators in middle and high school settings.</p>
                </div>
            </div>

            <div class="program-box">
                <div class="business-ad">
                    <h2>Business Administration</h2>
                    <i class="fa-solid fa-building"></i>
                    <p>Our business administration program provides students with a strong foundation in business principles and practices.</p>
                </div>
            </div>

            <div class="program-box">
                <div class="nursing">
                    <h2>Nursing</h2>
                    <i class="fa-solid fa-stethoscope"></i>
                    <p>Our nursing program is designed to equip students with the necessary skills and knowledge to excel in the healthcare field.</p>
                </div>  
            </div>

            <div class="program-box">
                <div class="enroll-now">
                    <h2>Enroll Now</h2>
                    <i class="fa-solid fa-person"></i>
                    <p>Join us today and take the first step towards a rewarding career!</p>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <div class="footer-top">
      <h2><img id="logo-footer" src="assets/MBC-Logo.png" alt="Logo" height="70">
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
    <script src="js/navbar-scroll.js"></script>


    <?php if ($modal_show): ?>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modal = new bootstrap.Modal(document.getElementById('<?= $modal_show ?>'));
            modal.show();
        });
        </script>
    <?php endif; ?>
</body>
</html>
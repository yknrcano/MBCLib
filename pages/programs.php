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

    <nav class="navbar sticky-top navbar-expand-xl navbar-all">
        <div class="container-fluid navbar-inner">
            <img height="73" id="logo" src="assets/MBC-Logo.png" alt="Logo" class="d-inline-block align-text-center">
            <a class="navbar-brand text-white fs-3" href="home">
                Marie-Bernarde College
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navItems">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white active" aria-current="page" href="home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="admissions">Admissions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="programs">Programs</a>
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
                        <a class=" enroll-btn" href="">Enroll now</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="admission-banner">
        <h1>Programs</h1>
        <img src="assets/bg3-small.png" alt="background">
    </div>

    <div class="mini-nav">
        <i class="fa-solid fa-house"></i>
        <a href="home">Home</a> /
        <h3>Programs</h3>
    </div>

    <div class="program-list-grid">
        <a href="?url=nursing" class="program-card nursing">
            <h2>Nursing</h2>
            <i class="fa-solid fa-stethoscope"></i>
            <p>Our nursing program is designed to equip students with the necessary skills and knowledge to excel in the healthcare field.</p>
        </a>
        <a href="?url=midwifery" class="program-card midwifery">
            <h2>Midwifery</h2>
            <i class="fa-solid fa-person-pregnant"></i>
            <p>Our midwifery program trains students to provide comprehensive care to childbearing women and their families.</p>
        </a>
        <a href="?url=business" class="program-card business-ad">
            <h2>Business Administration</h2>
            <i class="fa-solid fa-building"></i>
            <p>Our business administration program provides students with a strong foundation in business principles and practices.</p>
        </a>
        <a href="?url=let" class="program-card let-program">
            <h2>LET Program</h2>
            <i class="fa-solid fa-award"></i>
            <p>Our Licensure Examination for Teachers (LET) program is designed to prepare aspiring educators for the challenges of the teaching profession.</p>
        </a>
        <a href="?url=seduc" class="program-card secondary-educ">
            <h2>Secondary Education</h2>
            <i class="fa-solid fa-book"></i>
            <p>Our secondary education program prepares students to become effective educators in middle and high school settings.</p>
        </a>
        <a href="admissions" class="program-card enroll-now">
            <h2>Enroll Now!</h2>
            <i class="fa-solid fa-arrow-right"></i>
        </a>
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
</body>
</html>
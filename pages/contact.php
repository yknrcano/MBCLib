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

    <div class="admission-banner">
        <h1>Contanct us</h1>
        <img src="assets/bg3-small.png" alt="background">
    </div>

    <div class="mini-nav">
        <i class="fa-solid fa-house"></i>
        <a href="home">Home</a> /
        <h3>Contact</h3>
    </div>
    
    <div class="contact-content">
      <div class="cont-title">
        <h1>Contact Information</h1>
        <div class="box"></div>
      </div>

      <div class="cont-contacts">
        <div class="contact-icons">
          <i class="fa-solid fa-location-dot"></i>
          <p>603 R&J Bldg, Quirino Highway, Novaliches, Quezon City, 1116.</p>
        </div>

        <div class="contact-icons">
          <i class="fa-solid fa-phone"></i>
          <p>(02) 7216-4377</p>
          <p>(02) 8543-8751</p>
          <p>(+63) 917-124-8176</p>
        </div>

        <div class="contact-icons">
          <i class="fa-solid fa-envelope"></i>
          <p>registrar@mariebernardecollege.edu.ph</p>
          <p>admin@mariebernardecollege.edu.ph</p>
        </div>
      </div>

      <div class="cont-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7718.379032698983!2d121.02982624492748!3d14.701872170782059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b129010376a9%3A0x68b54be5ae5c5251!2sR%20%26%20J%20Building!5e0!3m2!1sen!2sph!4v1707924193275!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>      
      </div>

      <div class="cont-form">
        <form action="send.php" method="POST">
          <input type="text" name="name" placeholder="Enter your Name" required>
          <input type="email" name="email" placeholder="Enter your Email Address" required>
          <input type="text" name="subject" placeholder="Enter your Subject" required>
          <textarea rows="8" name="message" placeholder="Message" required></textarea>
          <button type="submit" name="send" class="cont-btn">Send Message</button>
        </form>
      </div>
    </div>

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
                            <input type="text" name="id_number" class="form-control" placeholder="ID Number" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="text" name="phone" class="form-control" placeholder="Contact Number" required>
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
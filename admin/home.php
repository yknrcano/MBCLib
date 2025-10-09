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
    <link rel="stylesheet" href="../css/style.css">
    <title>Marie-Bernarde College</title>
</head>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-content">
            <div class="spinner"></div>
            <img src="../assets/MBC-Logo.png" alt="Logo" class="spinner-logo">
        </div>
    </div>


    <div class="sidebar-wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <header>
                <a href="#"> <img src="../assets/MBC-Logo.png" height="45" alt=""> Library Admin</a>
            </header>
            <ul class="nav">
                <li>
                    <a href="#">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#">
                        Shortcuts 
                    </a>
                </li>
                <li>
                    <a href="#">
                        Overview
                    </a>
                </li>
                <li>
                    <a href="#">
                        Events
                    </a>
                </li>
                <li>
                    <a href="#">
                        About
                    </a>
                </li>
                <li>
                    <a href="#">
                        Services
                    </a>
                </li>
                <li>
                    <a href="#">
                        Contact
                    </a>
                </li>
            </ul>
            <div class="sidebar-bottom">
                <form action="../functions/logout.php" method="post">
                    <button type="submit" class="btn btn-warning w-100">Logout</button>
                </form>
            </div>
        </div>
        <!-- Content -->
        <div class="content">
            <div class="dashboard-grid">
                <div class="dashboard-analytics">
                    <!-- Replace with your analytics graph/chart -->
                    <h4>Book Borrowing Analytics</h4>
                    <canvas id="analyticsChart" height="100"></canvas>
                </div>
                <div class="dashboard-box total-borrowed">
                    <h5>Total Borrowed Books</h5>
                    <span id="totalBorrowed">0</span>
                </div>
                <div class="dashboard-box overdue-books">
                    <h5>Overdue Borrowed Books</h5>
                    <span id="overdueBooks">0</span>
                </div>
                <div class="dashboard-box total-books">
                    <h5>Total Books</h5>
                    <span id="totalBooks">0</span>
                </div>
            </div>
        </div>
    </div>


 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/374eee3e25.js" crossorigin="anonymous"></script>
    <script src="../js/navbar-scroll.js"></script>


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
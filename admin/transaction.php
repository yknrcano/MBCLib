<?php

    session_start();
    require_once __DIR__ . '/../functions/dbcon.php';

    $modal_error = $_SESSION['modal_error'] ?? '';
    $modal_show = $_SESSION['modal_show'] ?? '';
    unset($_SESSION['modal_error'], $_SESSION['modal_show']);

    $isbn = $_GET['isbn'] ?? '';
    $isbn = mysqli_real_escape_string($con, $isbn);

    $query = "SELECT title, author FROM books WHERE isbn = '$isbn' LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode([
            'title' => $row['title'],
            'author' => $row['author']
        ]);
    } else {
        echo json_encode([]);
    }

    $alert = $_SESSION['alert'] ?? '';
    unset($_SESSION['alert']);
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
                <a href="#"><img src="../assets/MBC-Logo.png" height="42" alt=""> <span>Library Admin</span></a>
            </header>
            <ul class="nav">
                <li>
                    <a href="#">
                        Dashboard
                    </a>
                </li>
                <li class="has-submenu">
                    <a href="#" id="libraryToggle">
                        Library System
                    </a>
                    <ul class="sidebar-submenu" id="librarySubmenu">
                        <li><a href="/MBClib/admin/transaction">Transaction</a></li>
                        <li><a href="/MBClib/admin/history">History</a></li>
                        <li><a href="/MBClib/admin/manage">Manage Books</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/MBClib/admin/user_management">
                        User Management
                    </a>
                </li>
            </ul>
            <div class="sidebar-bottom">
                <form action="../functions/logout.php" method="post">
                    <button type="submit" class="sidebar-btn w-100">Logout</button>
                </form>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <?php if ($alert): ?>
                <div id="topAlert" class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <?= htmlspecialchars($alert) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="transaction-container">
                <div class="transaction-header">
                    <h2>Transaction Management</h2>
                </div>
                <div class="transaction-content d-flex justify-content-between align-items-center my-5" style="gap: 2rem;"">
                    <div class="borrow-content flex-fill">
                        <button type="button" class="btn btn-primary btn-lg w-100 py-4" 
                        data-bs-toggle="modal" 
                        data-bs-target="#borrowBookModal"
                        >
                            Borrow Book
                        </button>
                    </div>
                    <div class="return-content flex-fill">
                        <button type="button" class="btn btn-success btn-lg w-100 py-4">Return Book</button>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Borrow Book Modal -->
        <div class="modal fade" id="borrowBookModal" tabindex="-1" aria-labelledby="borrowBookModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="../functions/borrow_book.php" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="borrowBookModalLabel">Borrow Book</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <div class="mb-3">
                                <label for="id_no" class="form-label">Student Number</label>
                                <input type="text" class="form-control" id="id_no" name="id_no" required>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-secondary w-100" id="scanQrBtn" data-bs-toggle="modal" data-bs-target="#qrScanModal">
                                    <i class="fa fa-qrcode"></i> Scan Book QR
                                </button>
                            </div>
                            <div id="bookDetailsSection" style="display:none;">
                                <div class="mb-3">
                                    <label class="form-label">Book Name</label>
                                    <input type="text" class="form-control" id="book_name" name="book_name" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Author</label>
                                    <input type="text" class="form-control" id="book_author" name="book_author" readonly>
                                </div>
                                <input type="hidden" id="book_id" name="book_id">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Borrow</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- QR Scan Modal -->
        <div class="modal fade" id="qrScanModal" tabindex="-1" aria-labelledby="qrScanModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Scan Book QR Code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- QR code scanner will appear here -->
                        <div id="qr-reader" style="width:100%"></div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

 
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
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
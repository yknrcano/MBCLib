<?php
session_start();
require_once __DIR__ . '/../functions/dbcon.php';

$alert = $_SESSION['alert'] ?? '';
unset($_SESSION['alert']);

$modal_error = $_SESSION['modal_error'] ?? '';
$modal_show = $_SESSION['modal_show'] ?? '';
unset($_SESSION['modal_error'], $_SESSION['modal_show']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_no   = trim($_POST['id_no'] ?? '');
    $book_id = intval($_POST['book_id'] ?? 0);
    $borrow_date = $_POST['borrow_date'] ?? '';
    $return_date = $_POST['return_date'] ?? '';

    if ($id_no === '' || $book_id === 0 || $borrow_date === '' || $return_date === '') {
        $_SESSION['alert'] = 'Missing data.';
        header('Location: /MBClib/admin/transaction');
        exit;
    }

    $borrow_dt = new DateTime($borrow_date);
    $return_dt = new DateTime($return_date);
    if ($return_dt <= $borrow_dt) {
        $_SESSION['alert'] = 'Return date must be after borrow date.';
        header('Location: /MBClib/admin/transaction');
        exit;
    }

    try {
        // Optional: verify student exists
        $u = $con->prepare("SELECT id_no FROM users WHERE id_no = ?");
        $u->bind_param('s', $id_no);
        $u->execute();
        if ($u->get_result()->num_rows === 0) {
            $_SESSION['alert'] = 'Student not found.';
            header('Location: /MBClib/admin/transaction');
            exit;
        }

        // Optional: check availability
        $b = $con->prepare("SELECT available_copies FROM books WHERE book_id = ?");
        $b->bind_param('i', $book_id);
        $b->execute();
        $br = $b->get_result()->fetch_assoc();
        if (!$br || $br['available_copies'] <= 0) {
            $_SESSION['alert'] = 'Book not available.';
            header('Location: /MBClib/admin/transaction');
            exit;
        }

        // Insert transaction
        $t = $con->prepare("INSERT INTO borrow_transactions (id_no, book_id, borrow_date, return_date, status) VALUES (?, ?, ?, ?, 'borrowed')");
        $t->bind_param('siss', $id_no, $book_id, $borrow_date, $return_date);
        $t->execute();

        // Decrement available copies
        $u2 = $con->prepare("UPDATE books SET available_copies = available_copies - 1 WHERE book_id = ?");
        $u2->bind_param('i', $book_id);
        $u2->execute();

        $_SESSION['alert'] = 'Borrow recorded.';
    } catch (Exception $e) {
        $_SESSION['alert'] = 'Error processing borrow.';
    }
    header('Location: /MBClib/admin/transaction');
    exit;
}

// Rest of the file (HTML) remains the same
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
                    <a href="/MBClib/admin/home">
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

            <div class="grid-parent">
                <div class="transaction-container div1">
                    <div class="transaction-header">
                        <h2>Transaction Management</h2>
                    </div>
                    <div class="transaction-content d-flex justify-content-between align-items-center my-5" style="gap: 2rem;">
                        <div class="borrow-content flex-fill">
                            <button type="button" class="btn btn-primary btn-lg w-100 py-4" 
                            data-bs-toggle="modal" 
                            data-bs-target="#borrowBookModal"
                            >
                                Borrow Book
                            </button>
                        </div>
                        <div class="return-content flex-fill">
                            <button type="button" class="btn btn-success btn-lg w-100 py-4" 
                            data-bs-toggle="modal" 
                            data-bs-target="#returnBookModal"
                            >
                                Return Book
                            </button>
                        </div>
                    </div>
                </div>

                <div class="div2">
                    <h3>Recent Borrows</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Student Number</th>
                                <th>Book ID</th>
                                <th>Borrow Date</th>
                                <th>Expected Return</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $borrowQuery = "SELECT id_no, book_id, date_borrowed, date_return_expected FROM transactions WHERE status = 'borrowed' ORDER BY date_borrowed DESC LIMIT 10";
                            $borrowResult = mysqli_query($con, $borrowQuery);
                            while ($row = mysqli_fetch_assoc($borrowResult)) {
                                echo "<tr>
                                    <td>{$row['id_no']}</td>
                                    <td>{$row['book_id']}</td>
                                    <td>{$row['date_borrowed']}</td>
                                    <td>{$row['date_return_expected']}</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="div3">
                    <h3>Recent Returns</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Student Number</th>
                                <th>Book ID</th>
                                <th>Borrow Date</th>
                                <th>Return Date</th>
                                <th>Overdue Days</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $returnQuery = "SELECT id_no, book_id, date_borrowed, date_returned, overdue_days FROM transactions WHERE status = 'returned' ORDER BY date_returned DESC LIMIT 10";
                            $returnResult = mysqli_query($con, $returnQuery);
                            while ($row = mysqli_fetch_assoc($returnResult)) {
                                echo "<tr>
                                    <td>{$row['id_no']}</td>
                                    <td>{$row['book_id']}</td>
                                    <td>{$row['date_borrowed']}</td>
                                    <td>{$row['date_returned']}</td>
                                    <td>{$row['overdue_days']}</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>



        

        
        
        
        <!-- Borrow Book Modal -->
        <div class="modal fade" id="borrowBookModal" tabindex="-1" aria-labelledby="borrowBookModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="borrowForm" action="../functions/borrow_book.php" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="borrowBookModalLabel">Borrow Book</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3" id="scanSection">
                                <button type="button" class="btn btn-outline-secondary w-100" id="scanQrBtn" data-bs-toggle="modal" data-bs-target="#qrScanModal">
                                    <i class="fa fa-qrcode"></i> Scan Book QR
                                </button>
                            </div>
                            <div id="bookDetailsSection" style="display:none;">
                                <div class="d-flex align-items-start gap-4">
                                    <!-- Book Cover Section -->
                                    <div style="width:360px;">
                                        <img id="bookCover" src="" alt="Book Cover" class="img-thumbnail w-100" style="height:460px; object-fit:cover;">
                                    </div>
                                    <!-- Form Fields Section -->
                                    <div class="flex-grow-1">
                                        <div class="mb-3">
                                            <label class="form-label">ISBN</label>
                                            <input type="text" class="form-control" id="ISBN" name="ISBN" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Book Title</label>
                                            <input type="text" class="form-control" id="Title" name="Title" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Author</label>
                                            <input type="text" class="form-control" id="Author" name="Author" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_no" class="form-label">Student Number</label>
                                            <input type="text" class="form-control" id="id_no" name="id_no" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Borrow Date</label>
                                            <input type="datetime-local" class="form-control" id="borrow_date" name="borrow_date" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="return_date" class="form-label">Return Date</label>
                                            <input type="date" class="form-control" id="return_date" name="return_date" required>
                                        </div>
                                        <input type="hidden" id="book_id" name="book_id">
                                        <input type="hidden" id="scan_code" name="scan_code">
                                    </div>
                                </div>
                                <div class="modal-footer mt-3">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" id="borrowSubmitBtn" disabled>Borrow</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Return Book Modal -->
        <div class="modal fade" id="returnBookModal" tabindex="-1" aria-labelledby="returnBookModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="returnForm" action="../functions/return_book.php" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="returnBookModalLabel">Return Book</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3" id="returnScanSection">
                                <button type="button" class="btn btn-outline-secondary w-100" id="returnScanQrBtn" data-bs-toggle="modal" data-bs-target="#qrScanModal" onclick="setScanMode('return')">
                                    <i class="fa fa-qrcode"></i> Scan Book QR
                                </button>
                            </div>
                            <div id="returnBookDetailsSection" style="display:none;">
                                <div class="d-flex align-items-start gap-4">
                                    <!-- Book Cover Section -->
                                    <div style="width:360px;">
                                        <img id="returnBookCover" src="" alt="Book Cover" class="img-thumbnail w-100" style="height:460px; object-fit:cover;">
                                    </div>
                                    <!-- Form Fields Section -->
                                    <div class="flex-grow-1">
                                        <div class="mb-3">
                                            <label class="form-label">ISBN</label>
                                            <input type="text" class="form-control" id="returnISBN" name="ISBN" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Book Title</label>
                                            <input type="text" class="form-control" id="returnTitle" name="Title" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Author</label>
                                            <input type="text" class="form-control" id="returnAuthor" name="Author" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Student Number</label>
                                            <input type="text" class="form-control" id="returnStudentNumber" name="student_number" readonly>
                                        </div>
                                        <input type="hidden" id="return_book_id" name="book_id">
                                        <input type="hidden" id="return_scan_code" name="scan_code">
                                    </div>
                                </div>
                                <div class="modal-footer mt-3">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success" id="returnSubmitBtn" disabled>Return</button>
                                </div>
                            </div>
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
    <script src="../js/qr-reader.js"></script>


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
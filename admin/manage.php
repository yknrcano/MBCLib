<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    require_once __DIR__ . '/../functions/dbcon.php';
    $modal_error = $_SESSION['modal_error'] ?? '';
    $modal_show = $_SESSION['modal_show'] ?? '';
    unset($_SESSION['modal_error'], $_SESSION['modal_show']);


    $search = $_GET['search'] ?? '';
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;

    if ($search !== '') {
    $search_sql = "%" . mysqli_real_escape_string($con, $search) . "%";
    $count_sql = "SELECT COUNT(DISTINCT ISBN) FROM books WHERE ISBN LIKE ? OR Title LIKE ? OR Author LIKE ?";
    $stmt = mysqli_prepare($con, $count_sql);
    mysqli_stmt_bind_param($stmt, "sss", $search_sql, $search_sql, $search_sql);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $total_books);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $sql = "SELECT ISBN, Title, Author, Date_published, COUNT(*) AS stocks,
            SUM(CASE WHEN is_borrowed = 0 OR is_borrowed IS NULL THEN 1 ELSE 0 END) AS available_stocks
            FROM books
            " . ($search !== '' ? "WHERE ISBN LIKE ? OR Title LIKE ? OR Author LIKE ?" : "") . "
            GROUP BY ISBN, Title, Author, Date_published
            LIMIT ? OFFSET ?";
    $stmt = mysqli_prepare($con, $sql);

    mysqli_stmt_bind_param($stmt, "sssii", $search_sql, $search_sql, $search_sql, $limit, $offset);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    } else {
        $count_sql = "SELECT COUNT(DISTINCT ISBN) FROM books";
        $count_result = mysqli_query($con, $count_sql);
        $total_books = mysqli_fetch_row($count_result)[0];

        $sql = "SELECT ISBN, Title, Author, Date_published, COUNT(*) AS stocks,
            SUM(CASE WHEN is_borrowed = 0 OR is_borrowed IS NULL THEN 1 ELSE 0 END) AS available_stocks
            FROM books
            GROUP BY ISBN, Title, Author, Date_published
            LIMIT $limit OFFSET $offset";
        $result = mysqli_query($con, $sql);
    }

    $books = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $row['status'] = ($row['available_stocks'] == 0) ? 'Not Available' : 'Available';
            $books[] = $row;
        }
    }

    $total_pages = ceil($total_books / $limit);

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
                <li class="has-submenu open">
                    <a href="#" id="libraryToggle">
                        Library System
                    </a>
                    <ul class="sidebar-submenu" id="librarySubmenu">
                        <li><a href="/MBClib/admin/transaction">Transaction</a></li>
                        <li><a href="/MBClib/admin/borrowed">Borrowed</a></li>
                        <li><a href="#" class="active">Manage Books</a></li>
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
            <div class="manage-book-container">
                <h2>Manage Books</h2>
                <div class="book-list">
                    <div class="d-flex justify-content-end mb-3">
                        <form method="get" class="d-flex align-items-center" style="max-width:400px;">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search by ISBN, Title, Author" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                            <button type="submit" class="btn btn-primary search-btn">Search</button>
                        </form>
                    </div>
                    <table class="table table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ISBN</th>
                                <th>Title of the Book</th>
                                <th>Author</th>
                                <th>Date Published</th>
                                <th>Status</th>
                                <th>Stocks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($books as $book): ?>
                            <tr>
                                <td><?= htmlspecialchars($book['ISBN']) ?></td>
                                <td><?= htmlspecialchars($book['Title']) ?></td>
                                <td><?= htmlspecialchars($book['Author']) ?></td>
                                <td><?= htmlspecialchars($book['Date_published']) ?></td>
                                <td><?= htmlspecialchars($book['status']) ?></td>
                                <td><?= htmlspecialchars($book['available_stocks']) ?>/<?= htmlspecialchars($book['stocks']) ?></td>         
                                <td>
                                    <div class="d-flex gap-2 justify-content-center align-items-center action-btn-group">
                                        <button class="btn btn-square btn-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewBookModal"
                                            data-isbn="<?= htmlspecialchars($book['ISBN']) ?>"
                                        ><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn btn-square btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editBookModal"
                                            data-isbn="<?= htmlspecialchars($book['ISBN']) ?>"
                                            data-title="<?= htmlspecialchars($book['Title']) ?>"
                                            data-author="<?= htmlspecialchars($book['Author']) ?>"
                                            data-date="<?= htmlspecialchars($book['Date_published']) ?>"
                                        ><i class="fa-solid fa-pencil"></i></button>
                                        <form method="post" action="../functions/delete_books_by_isbn.php" onsubmit="return confirm('Delete ALL books with this ISBN?');">
                                            <input type="hidden" name="isbn" value="<?= htmlspecialchars($book['ISBN']) ?>">
                                            <button type="submit" class="btn btn-square btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <nav aria-label="Book table pagination">
                        <ul class="pagination justify-content-end mt-4">
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>"><i class="fa-solid fa-arrow-left"></i></a>
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>"><i class="fa-solid fa-arrow-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- View Book Modal -->
        <div class="modal fade" id="viewBookModal" tabindex="-1" aria-labelledby="viewBookModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="viewBookModalLabel">Books for ISBN: <span id="viewModalIsbn"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Book ID</th>
                      <th>Borrowed</th>
                      <th>Borrower</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody id="viewBookModalBody">
                    <!-- Filled by JS -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Edit Book Modal -->
        <div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form id="editBookForm" method="post" action="../functions/edit_book_by_isbn.php">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editBookModalLabel">Edit Book Info (All with ISBN: <span id="editModalIsbn"></span>)</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="isbn" id="editBookIsbn">
                  <div class="mb-3">
                    <label class="form-label">Title:</label>
                    <input type="text" class="form-control" name="title" id="editBookTitle" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Author:</label>
                    <input type="text" class="form-control" name="author" id="editBookAuthor" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Date Published:</label>
                    <input type="date" class="form-control" name="date_published" id="editBookDate" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save changes</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
              </div>
            </form>
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
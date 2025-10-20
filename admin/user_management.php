<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    require_once __DIR__ . '/../functions/dbcon.php';
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

    $search = $_GET['search'] ?? '';
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;

    if ($search !== '') {
        $search_sql = "%" . mysqli_real_escape_string($con, $search) . "%";
        $count_sql = "SELECT COUNT(*) FROM users WHERE CONCAT(firstname, ' ', lastname) LIKE ? OR email LIKE ?";
        $stmt = mysqli_prepare($con, $count_sql);
        mysqli_stmt_bind_param($stmt, "ss", $search_sql, $search_sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $total_users);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $sql = "SELECT * FROM users WHERE CONCAT(firstname, ' ', lastname) LIKE ? OR email LIKE ? LIMIT ? OFFSET ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssii", $search_sql, $search_sql, $limit, $offset);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        $count_sql = "SELECT COUNT(*) FROM users";
        $count_result = mysqli_query($con, $count_sql);
        $total_users = mysqli_fetch_row($count_result)[0];

        $sql = "SELECT * FROM users LIMIT $limit OFFSET $offset";
        $result = mysqli_query($con, $sql);
    }

    $users = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }

    $total_pages = ceil($total_users / $limit);

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
                        <li><a href="/MBClib/admin/manage" >Manage Books</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="active">
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

            <div class="manage-user-container">
                <h2>Manage users</h2>
                <div class="user-list">
                    <div class="d-flex justify-content-end mb-3">
                        <form method="get" class="d-flex align-items-center" style="max-width:400px;">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search by name or email" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                            <button type="submit" class="btn btn-primary search-btn">Search</button>
                        </form>
                    </div>
                    <table class="table table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Verification</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['user_id']) ?></td>
                                <td><?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td>
                                    <span class="badge <?= ($user['status'] == '1' || $user['status'] === 1) ? 'bg-success' : 'bg-danger' ?>">
                                        <?= ($user['status'] == '1' || $user['status'] === 1) ? 'Verified' : 'Not Verified' ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-square btn-primary"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editUserModal"
                                    data-user-id="<?= htmlspecialchars($user['user_id']) ?>"
                                    data-user-name="<?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?>"
                                    data-user-email="<?= htmlspecialchars($user['email']) ?>"
                                    data-user-status="<?= htmlspecialchars($user['status']) ?>"
                                    ><i class="fa-solid fa-pencil"></i></button>
                                    <button class="btn btn-square btn-danger"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteUserModal"
                                    data-user-id="<?= htmlspecialchars($user['user_id']) ?>"
                                    ><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <nav aria-label="User table pagination">
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

        <!-- Edit User Modal -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="editUserForm" method="post" action="../functions/edit_user.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel">Edit User Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="user_id" id="editUserId">
                            <div class="mb-3">
                                <label class="form-label">Name:</label>
                                <div id="editUserName" class="form-control-plaintext"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <div id="editUserEmail" class="form-control-plaintext"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status:</label><br>
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="statusTrue" value="true">
                                <label class="form-check-label" for="statusTrue">Verify</label>
                                </div>
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="statusFalse" value="false">
                                <label class="form-check-label" for="statusFalse">Unverify</label>
                                </div>
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
        
        <!-- Delete User Modal -->
        <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form id="deleteUserForm" method="post" action="delete_user.php">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="user_id" id="deleteUserId">
                  <p>Are you sure you want to delete this user?</p>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="confirmDeleteCheckbox">
                    <label class="form-check-label" for="confirmDeleteCheckbox">
                      I confirm the deletion of this user.
                    </label>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger" id="deleteUserBtn" disabled>Delete</button>
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
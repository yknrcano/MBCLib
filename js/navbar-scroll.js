window.addEventListener('DOMContentLoaded', function() {
  var navbar = document.querySelector('.navbar');
  function onScroll() {
    if (window.scrollY > 30) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  }
  window.addEventListener('scroll', onScroll);
  onScroll();
});

function togglePassword(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        passwordInput.type = "password";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}

window.addEventListener("load", function() {
    const preloader = document.getElementById("preloader");
    preloader.style.opacity = "0";
    setTimeout(() => {
        preloader.style.display = "none";
    }, 400);
});

document.addEventListener('DOMContentLoaded', function() {
    const bellBtn = document.getElementById('notifBellBtn');
    const dropdown = document.getElementById('notifDropdownMenu');

    bellBtn.addEventListener('click', function(e) {
        e.preventDefault();
        dropdown.style.display = (dropdown.style.display === 'none' || dropdown.style.display === '') ? 'block' : 'none';
    });

    document.addEventListener('click', function(e) {
        if (!document.getElementById('notif-bell').contains(e.target)) {
            dropdown.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const userBtn = document.getElementById('userMenuBtn');
    const userDropdown = document.getElementById('userDropdownMenu');

    userBtn.addEventListener('click', function(e) {
        e.preventDefault();
        userDropdown.style.display = (userDropdown.style.display === 'none' || userDropdown.style.display === '') ? 'block' : 'none';
    });

    document.addEventListener('click', function(e) {
        if (!document.getElementById('user-menu').contains(e.target)) {
            userDropdown.style.display = 'none';
        }
    });
});

// Admin submenu toggle
document.addEventListener("DOMContentLoaded", function() {
    var toggle = document.getElementById('libraryToggle');
    var parent = toggle.closest('.has-submenu');
    toggle.addEventListener('click', function(e) {
        e.preventDefault();
        parent.classList.toggle('open');
    });
});

// Edit user verification
document.addEventListener('DOMContentLoaded', function() {
    var editUserModal = document.getElementById('editUserModal');
    editUserModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        document.getElementById('editUserId').value = button.getAttribute('data-user-id');
        document.getElementById('editUserName').textContent = button.getAttribute('data-user-name');
        document.getElementById('editUserEmail').textContent = button.getAttribute('data-user-email');
        var status = button.getAttribute('data-user-status');
        document.getElementById('statusTrue').checked = (status === 'true' || status === '1');
        document.getElementById('statusFalse').checked = (status === 'false' || status === '0');
    });

    var deleteUserModal = document.getElementById('deleteUserModal');
    deleteUserModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        document.getElementById('deleteUserId').value = button.getAttribute('data-user-id');
    });
});

// Auto-dismiss alert after 3 seconds
document.addEventListener("DOMContentLoaded", function() {
    var alertBox = document.getElementById('topAlert');
    if (alertBox) {
        setTimeout(function() {
            var bsAlert = bootstrap.Alert.getOrCreateInstance(alertBox);
            bsAlert.close();
        }, 3000);
    }
});

// Delete user confirmation
document.addEventListener('DOMContentLoaded', function() {
    var checkbox = document.getElementById('confirmDeleteCheckbox');
    var deleteBtn = document.getElementById('deleteUserBtn');
    if (checkbox && deleteBtn) {
        checkbox.addEventListener('change', function() {
            deleteBtn.disabled = !checkbox.checked;
        });
    }
    
    // reset
    var deleteUserModal = document.getElementById('deleteUserModal');
    deleteUserModal.addEventListener('show.bs.modal', function () {
        checkbox.checked = false;
        deleteBtn.disabled = true;
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var editBookModal = document.getElementById('editBookModal');
    editBookModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var isbn = button.getAttribute('data-isbn');
        document.getElementById('modalIsbn').textContent = isbn;

        // AJAX to fetch all book_ids for this ISBN
        fetch('../functions/get_books_by_isbn.php?isbn=' + encodeURIComponent(isbn))
            .then(response => response.json())
            .then(data => {
                var tbody = document.getElementById('editBookModalBody');
                tbody.innerHTML = '';
                data.forEach(function(book) {
                    tbody.innerHTML += `
                        <tr>
                            <td>${book.book_id}</td>
                            <td>${book.borrowed ? 'True' : 'False'}</td>
                            <td>
                                <form method="post" action="../functions/delete_book.php" onsubmit="return confirm('Delete this book?');">
                                    <input type="hidden" name="book_id" value="${book.book_id}">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    `;
                });
            });
    });
});
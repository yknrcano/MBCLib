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
        document.getElementById('editUserStudentNumber').textContent = button.getAttribute('data-id-no');
        document.getElementById('editUserId').value = button.getAttribute('data-user-id');
        document.getElementById('editUserName').textContent = button.getAttribute('data-user-name');
        document.getElementById('editUserEmail').textContent = button.getAttribute('data-user-email');
        document.getElementById('editUserContact').textContent = button.getAttribute('data-user-contact');
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
    // View Modal
    var viewBookModal = document.getElementById('viewBookModal');
    viewBookModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var isbn = button.getAttribute('data-isbn');
        document.getElementById('viewModalIsbn').textContent = isbn;

        fetch('../functions/get_books_by_isbn.php?isbn=' + encodeURIComponent(isbn))
            .then(response => response.json())
            .then(data => {
                var tbody = document.getElementById('viewBookModalBody');
                tbody.innerHTML = '';
                if (data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="4">No books found for this ISBN.</td></tr>';
                } else {
                    data.forEach(function(book) {
                        tbody.innerHTML += `
                            <tr>
                                <td>${book.book_id}</td>
                                <td>
                                    <span class="badge ${book.is_borrowed == 1 ? 'bg-danger' : 'bg-success'}">
                                        ${book.is_borrowed == 1 ? 'No' : 'Yes'}
                                    </span>
                                </td>
                                <td>${book.borrower_name ? book.borrower_name : 'None'}</td>
                                <td>
                                    <button class="btn btn-sm btn-secondary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#qrCodeModal"
                                        data-book-id="${book.book_id}"
                                        data-qr-code="${book.qr_code ? book.qr_code : ''}"
                                    ><i class="fa-solid fa-qrcode"></i></button>
                                    <button class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteSingleBookModal"
                                        data-book-id="${book.book_id}"
                                    ><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        `;
                    });
                }
            });
    });

    // Edit BookModal
    var editBookModal = document.getElementById('editBookModal');
    editBookModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var cover = button.getAttribute('data-cover');
        var coverPreview = document.getElementById('editBookCoverPreview');
        if (cover) {
            coverPreview.src = '../assets/book_cover/' + cover;
        } else {
            coverPreview.src = '../assets/book_cover/default.png';
        }
        document.getElementById('editBookTitle').value = button.getAttribute('data-title');
        document.getElementById('editBookAuthor').value = button.getAttribute('data-author');
        document.getElementById('editBookDate').value = button.getAttribute('data-date');
        document.getElementById('editBookIsbn').value = button.getAttribute('data-isbn');
        document.getElementById('editModalIsbn').textContent = button.getAttribute('data-isbn');
    });

    // Delete All Books Modal
    var deleteBookModal = document.getElementById('deleteBookModal');
    var deleteBookCheckbox = document.getElementById('confirmDeleteBookCheckbox');
    var deleteBookBtn = document.getElementById('deleteBookBtn');
    deleteBookModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        document.getElementById('deleteBookIsbn').value = button.getAttribute('data-isbn');
        deleteBookCheckbox.checked = false;
        deleteBookBtn.disabled = true;
    });
    if (deleteBookCheckbox && deleteBookBtn) {
        deleteBookCheckbox.addEventListener('change', function() {
            deleteBookBtn.disabled = !deleteBookCheckbox.checked;
        });
    }

    // Delete Single Book Modal
    var deleteSingleBookModal = document.getElementById('deleteSingleBookModal');
    var deleteSingleBookCheckbox = document.getElementById('confirmDeleteSingleBookCheckbox');
    var deleteSingleBookBtn = document.getElementById('deleteSingleBookBtn');
    deleteSingleBookModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        document.getElementById('deleteSingleBookId').value = button.getAttribute('data-book-id');
        deleteSingleBookCheckbox.checked = false;
        deleteSingleBookBtn.disabled = true;
    });
    if (deleteSingleBookCheckbox && deleteSingleBookBtn) {
        deleteSingleBookCheckbox.addEventListener('change', function() {
            deleteSingleBookBtn.disabled = !deleteSingleBookCheckbox.checked;
        });
    }

    var qrCodeModal = document.getElementById('qrCodeModal');
    qrCodeModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var qrCode = button.getAttribute('data-qr-code');
        var img = document.getElementById('qrCodeImage');
        var notFound = document.getElementById('qrCodeNotFound');
        if (qrCode) {
            // Prepend the correct folder path
            img.src = '../assets/qrcodes/' + qrCode;
            img.style.display = '';
            notFound.style.display = 'none';
        } else {
            img.src = '';
            img.style.display = 'none';
            notFound.style.display = '';
        }
    });

    const qtyInput = document.getElementById('addQuantity');
    document.getElementById('incrementQty').addEventListener('click', function() {
        qtyInput.value = parseInt(qtyInput.value) + 1;
    });
    document.getElementById('decrementQty').addEventListener('click', function() {
        if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
        }
    });
});

document.getElementById('editBookCover').addEventListener('change', function(e) {
    const [file] = e.target.files;
    if (file) {
        document.getElementById('editBookCoverPreview').src = URL.createObjectURL(file);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('fetchBookBtn').addEventListener('click', function() {
        const isbn = document.getElementById('addISBN').value.trim();
        if (!isbn) return;

        fetch(`https://openlibrary.org/api/books?bibkeys=ISBN:${isbn}&format=json&jscmd=data`)
            .then(response => response.json())
            .then(data => {
                const bookData = data[`ISBN:${isbn}`];
                if (bookData) {
                    document.getElementById('addTitle').value = bookData.title || '';
                    document.getElementById('addAuthor').value = bookData.authors && bookData.authors.length > 0 ? bookData.authors[0].name : '';
                    if (bookData.publish_date) {
                        // Try to convert publish_date to yyyy-mm-dd
                        const date = new Date(bookData.publish_date);
                        if (!isNaN(date)) {
                            document.getElementById('addDatePublished').value = date.toISOString().slice(0,10);
                        }
                    }
                    // COVER FETCH 
                    let coverUrl = '';
                    if (bookData.cover && bookData.cover.large) {
                        coverUrl = bookData.cover.large;
                    } else if (bookData.cover && bookData.cover.medium) {
                        coverUrl = bookData.cover.medium;
                    } else if (bookData.cover && bookData.cover.small) {
                        coverUrl = bookData.cover.small;
                    }
                    document.getElementById('coverUrl').value = coverUrl;
                    const preview = document.getElementById('coverPreview');
                    if (coverUrl) {
                        preview.src = coverUrl;
                        preview.style.display = '';
                    } else {
                        preview.src = '';
                        preview.style.display = 'none';
                    }
                } else {
                    alert('Book not found for this ISBN.');
                    document.getElementById('coverPreview').style.display = 'none';
                    document.getElementById('coverUrl').value = '';
                }
            })
            .catch(() => {
                alert('Failed to fetch book info.');
                document.getElementById('coverPreview').style.display = 'none';
                document.getElementById('coverUrl').value = '';
            });
    });

    document.getElementById('addISBN').addEventListener('blur', function() {
        document.getElementById('fetchBookBtn').click();
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const isbnInput = document.getElementById('book_id');
    const bookNameInput = document.getElementById('book_name');
    const bookAuthorInput = document.getElementById('book_author');
    let fetchTimeout = null;

    isbnInput.addEventListener('input', function() {
        clearTimeout(fetchTimeout);
        const isbn = isbnInput.value.trim();
        if (!isbn) {
            bookNameInput.value = '';
            bookAuthorInput.value = '';
            return;
        }
        // Debounce to avoid too many requests
        fetchTimeout = setTimeout(() => {
            fetch(`../functions/get_book_by_isbn.php?isbn=${encodeURIComponent(isbn)}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.title) {
                        bookNameInput.value = data.title;
                        bookAuthorInput.value = data.author;
                    } else {
                        bookNameInput.value = '';
                        bookAuthorInput.value = '';
                    }
                })
                .catch(() => {
                    bookNameInput.value = '';
                    bookAuthorInput.value = '';
                });
        }, 300); // 300ms debounce
    });
});


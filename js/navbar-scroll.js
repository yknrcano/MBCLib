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

document.addEventListener("DOMContentLoaded", function() {
    var toggle = document.getElementById('libraryToggle');
    var parent = toggle.closest('.has-submenu');
    toggle.addEventListener('click', function(e) {
        e.preventDefault();
        parent.classList.toggle('open');
    });
});

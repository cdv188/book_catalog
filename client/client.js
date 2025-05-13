

$(document).ready(function() {
    $('#getName').on('keyup', function() {
        var getName = $(this).val();

        if (getName !== "") {
            $.ajax({
                url: 'server/live-search.php',
                method: 'POST',
                data: {
                    searchQuery: getName
                },
                success: function(response) {
                    $('#searchResultClient').html(response);
                }
            });
        } else {
            $('#searchResultClient').html("");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle-client");
    const sidebar = document.querySelector(".sidebarclient");

    menuToggle.addEventListener("click", function () {
        sidebar.classList.toggle("active"); // Toggle Sidebar
    });
});



function validateForm() {
    let isValid = true;

    // Get form fields
    const username = document.getElementById("reg-username").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("reg-password").value.trim();
    const confirmPassword = document.getElementById("confirm-password").value.trim();

    // Get error message elements
    const usernameError = document.getElementById("username-error");
    const emailError = document.getElementById("email-error");
    const passwordStrength = document.getElementById("password-strength");
    const passwordError = document.getElementById("password-error");

    // Clear previous error messages
    usernameError.textContent = "";
    emailError.textContent = "";
    passwordStrength.textContent = "";
    passwordError.textContent = "";

    // Validate username
    if (username === "") {
        usernameError.textContent = "Username is required.";
        isValid = false;
    } else if (username.length < 3) {
        usernameError.textContent = "Username must be at least 3 characters long.";
        isValid = false;
    }

    // Validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "") {
        emailError.textContent = "Email is required.";
        isValid = false;
    } else if (!emailRegex.test(email)) {
        emailError.textContent = "Please enter a valid email address.";
        isValid = false;
    }

    // Validate password
    if (password === "") {
        passwordStrength.textContent = "Password is required.";
        isValid = false;
    } else if (password.length < 6) {
        passwordStrength.textContent = "Password must be at least 6 characters long.";
        isValid = false;
    }

    // Validate confirm password
    if (confirmPassword === "") {
        passwordError.textContent = "Please confirm your password.";
        isValid = false;
    } else if (password !== confirmPassword) {
        passwordError.textContent = "Passwords do not match.";
        isValid = false;
    }

    return isValid; // Prevent form submission if validation fails
}


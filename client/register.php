
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/style.css">
</head>

<body class="client">
    <div class="auth-page">
        <div class="auth-container">
            <h2>Register</h2>
            <form id="register-form" method="post" action="server/process-register.php" onsubmit="return validateForm()">
                <!-- Username Field -->
                <label for="reg-username">Username:</label>
                <input type="text" id="reg-username" name="username">
                <div id="username-error" class="error-message"></div>

                <!-- Email Field -->
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <div id="email-error" class="error-message"></div>

                <!-- Password Field -->
                <label for="reg-password">Password:</label>
                <input type="password" id="reg-password" name="password">
                <div id="password-strength" class="error-message"></div>

                <!-- Confirm Password -->
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" name="password2" id="confirm-password">
                <div id="password-error" class="error-message"></div>

                <button type="submit" name="addUser">Register</button>
            </form>
            <p class="register">Already have an account? <a href="../index.php">Login here</a></p>
        </div>
    </div>
    <script defer src="client.js"></script>
</body>

</html>
<?php
$error = $_GET['error'] ?? null;
if (isset($_GET['success'])) {
    echo '<div id="successMessage" class="success-box">Registered</div>';
    echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    let msg = document.getElementById("successMessage");
                    if (msg) {
                        setTimeout(() => {
                            msg.style.opacity = "0";
                            setTimeout(() => msg.remove(), 500);
                        }, 1000);
                    }
                });
              </script>';

    echo '<script>
              setTimeout(() => {
                  window.history.replaceState({}, document.title, window.location.pathname);
              }, 1500);
            </script>';
} else if (isset($_GET['error']) || $error  === "failed") {
    echo '<div id="successMessage" class="failed-box">Failed to Register</div>';
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            let msg = document.getElementById("successMessage");
            if (msg) {
                setTimeout(() => {
                    msg.style.opacity = "0";
                    setTimeout(() => msg.remove(), 500);
                }, 1000);
            }
        });
        </script>';

    echo '<script>
    setTimeout(() => {
        window.history.replaceState({}, document.title, window.location.pathname);
    }, 1500);
    </script>';
} else if (isset($_GET['error']) || $error === "email_exists") {
    echo '<div id="successMessage" class="failed-box">Account Already Exist</div>';
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            let msg = document.getElementById("successMessage");
            if (msg) {
                setTimeout(() => {
                    msg.style.opacity = "0";
                    setTimeout(() => msg.remove(), 500);
                }, 1000);
            }
        });
        </script>';

    echo '<script>
    setTimeout(() => {
        window.history.replaceState({}, document.title, window.location.pathname);
    }, 1500);
    </script>';
} else if (isset($_GET['error']) || $error === "empty_fields") {
    echo '<div id="successMessage" class="failed-box">Please fill all fields</div>';
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            let msg = document.getElementById("successMessage");
            if (msg) {
                setTimeout(() => {
                    msg.style.opacity = "0";
                    setTimeout(() => msg.remove(), 500);
                }, 1000);
            }
        });
        </script>';

    echo '<script>
    setTimeout(() => {
        window.history.replaceState({}, document.title, window.location.pathname);
    }, 1500);
    </script>';
}
?>
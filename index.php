<?php

session_start();
$message = "";
if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials') {
    $message = "Invalid username or password. Please try again.";
} else {
    $error = null;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style/style.css">
</head>

<body class="client">
    <div class="auth-page">
        <div class="auth-container">
            <h2>Login</h2>
            <form id="login-form" action="process-login.php" method="POST">
                <div class="error-message" id="error-message">
                    <?php if ($message): ?>
                        <p><?php echo ($message); ?></p>
                    <?php endif; ?>
                </div>
                <input type="text" id="username" placeholder="Username" name="username">
                <input type="password" id="password" placeholder="Password" name="password">
                <button type="submit" name="submit">Login</button>
            </form>
            <p class="register">Don't have an account? <a href="client/register.php">Register here</a></p>
        </div>
    </div>
    <script defer src="/client/client.js"></script>
</body>

</html>
<?php
if (isset($_GET['status'])) {
    echo '<div id="successMessage" class="failed-box">Account Banned</div>';
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
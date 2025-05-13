<?php


session_start();
include "../conn.php";

//Validates if the user is login
if (!isset($_SESSION['user_id']) && $_SESSION['role'] !== 'client') {
    header("Location: ../index.php");
    exit();
}
$book = new Book();
$fetchUser = $book->getUserById($_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="client.js"></script>
</head>

<body class="client">
    <div class="sidebarclient">
        <a href="./catalog.php"><img src="../img/logo.png" class="logo" alt="logo"></a>
        <nav>
            <a href="catalog.php">📚 Library</a>
            <a href="my-list.php">📂 My List</a>
            <a href="account.php">👤 Account</a>
            <a href="../logout.php">🚪 Logout</a>
        </nav>
    </div>

    <div class="main-content">
        <button class="menu-toggle-client">&#9776;</button>
        <header class="client">
            <input type="text" class="search-bar-client" id="getName" placeholder="🔍 Start Searching...">
            <ul id="searchResultClient"></ul>
            <div class="user-info"><a href="catalog.php">👤 <?php echo ucfirst($_SESSION['username']) ?>'s Library</a></div>
        </header>
        <div class="">
            <form method="post" action="server/process-user.php" class="account-container">
                <h2>Account Details</h2>

                <?php foreach ($fetchUser as $user) : ?>

                    <input type='hidden' value='<?= $user['user_id'] ?>' name='userId'>

                    <label>Username:</lable>
                        <input type='text' value='<?= $user['username'] ?>' name='username'>

                        <label>Email:</lable>
                            <input type='email' value='<?= $user['email'] ?>' name='email'>

                            <label>Password:</lable>
                                <input type='password' value='<?= $user['password'] ?>' name='pass'>

                            <?php endforeach; ?>

                            <button class="clien-edit-user" href="" name="save-changes">Save Changes</button>
            </form>
        </div>

    </div>

    <footer id="footer">
        <label>&copy; 2025 Chester Don Valencerina | Bryden Dupuis</label>
        <a href="https://www.linkedin.com/" target="_blank"><img src="../img/linkedin icon.png" alt="linkedin"></a>
        <a href="https://discord.com/" target="_blank"><img src="../img/discord icon.png" alt="discord"></a>
        <a href="https://github.com/" target="_blank"><img src="../img/github icon.png" alt="github"></a>
    </footer>

    <script src="script.js"></script>
</body>

</html>
<?php
if (isset($_GET['success'])) {
    echo '<div id="successMessage" class="success-box">Successfully Updated</div>';
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
} else if (isset($_GET['failed'])) {
    echo '<div id="successMessage" class="failed-box">Failed to Update</div>';
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
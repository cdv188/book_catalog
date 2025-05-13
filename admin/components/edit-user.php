<?php

session_start();
include "../../conn.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit();
}
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../index.php");
    exit();
}

$userId = $_SESSION['userId'];
$book = new Book();

$fecthUser = $book->getUserById($userId);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="shortcut icon" href="../../img/logo.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="../script.js"></script>
</head>

<body class="admin">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div>
            <div class="sidebar-header">
                <a href="../index.php"><img src="../../img/logo.png" class="logo" alt=""></a>
            </div>
            <nav>
                <ul>
                    <li><a href="../index.php">Dashboard</a></li>
                    <li><a href="books.php">Books</a></li>
                    <li class="active"><a href="user.php">Users</a></li>
                </ul>
            </nav>
        </div>
        <div class="sidebar-footer">
            <ul>
                <li><a href="../../logout.php">Logout</a></li>
            </ul>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main>
        <!-- HEADER -->
        <header class="admin">
            <button class="menu-toggle">&#9776;</button>
            <div class="search-bar-admin">
                <input type="text" placeholder="Search" id="Name" class="search-bar" />
                <ul id="searchResult"></ul>
            </div>
            <div class="links">
                <a href="addBook.php" class="btn new-task">+ New Book</a>
            </div>
        </header>

        <!-- DASHBOARD CONTENT -->
        <section class="user-dashboard">
            <div class="user-widget">
                <form method="post" action="../server/user-permission.php" class="edit-user-widget">
                    <div class="user-form">
                        <h2>User</h2>
                        <ul class="users">
                            <?php foreach ($fecthUser as $user) : ?>
                                <li>
                                    <input type='hidden' value='<?= $user['user_id'] ?>' name='userId'>

                                    <label>Username:</lable>
                                        <input type='text' value='<?= $user['username'] ?>' name='username'>

                                        <label>Email:</lable>
                                            <input type='email' value='<?= $user['email'] ?>' name='email'>

                                            <label>Password:</lable>
                                                <input type='password' value='<?= $user['password'] ?>' name='pass'>
                                </li>
                            <?php endforeach; ?>

                            <button class="add-widget" href="" name="save-changes">Save Changes</button>
                            <button class='user-btn block' name='delete'><img src="../img/delete.png" alt=""></button>
                        </ul>
                    </div>
                </form>
            </div>
            <footer class="widget edit-footer-widget">
                <label>&copy; 2025 Chester Don Valencerina | Bryden Dupuis</label>
                <a href="https://www.linkedin.com/" target="_blank"><img src="../../img/linkedin icon.png" alt="linkedin"></a>
                <a href="https://discord.com/" target="_blank"><img src="../../img/discord icon.png" alt="discord"></a>
                <a href="https://github.com/" target="_blank"><img src="../../img/github icon.png" alt="github"></a>
            </footer>
        </section>
    </main>
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
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
$book = new Book();
$message = "";
$roles = $book->getRole();
$statuses = $book->getStatus();
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
                <a class="btn new-task" href="#">+ New Book</a>
                <a href="" class="profile-link"><img src="img/profile.png" alt="" class="profile"></a>
            </div>
        </header>

        <section class="dashboard-books ">
            <!-- Add User -->
            <div class="widget books-widget">
                <h2>Add User</h2>
                <div class=" addbook-dash">
                    <form action="../server/add-user.php" method="post" enctype="multipart/form-data" class="book-edit">
                        <div class="inputs">
                            <label>Username:</label> <input type="text" name="username" required>
                            <label>Password:</label> <input type="password" name="password" required>

                            <label>Email:</label> <input type="text" name="email" required>

                            <select name="role" required>
                                <option value="">Select Role</option>
                                <?php foreach ($roles as $role) : ?>
                                    <option value="<?= $role['role']; ?>">
                                        <?= $role['role']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select><br><br>

                            <select name="status" required>
                                <option value="">Select Status</option>
                                <?php foreach ($statuses as $status) : ?>
                                    <option value="<?= $status['status']; ?>">
                                        <?= $status['status']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select><br><br>
                            <button class="add-widget" type="submit" name="addUser">Add Book</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </main>
</body>

</html>
<?php
if (isset($_GET['success'])) {
    echo '<div id="successMessage" class="success-box">Successfully Added</div>';
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
    echo '<div id="successMessage" class="failed-box">Failed to Add</div>';
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
} else if (isset($_GET['error'])) {
    echo '<div id="successMessage" class="failed-box">Email Already taken</div>';
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
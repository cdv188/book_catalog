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

$sortBy = isset($_GET['sortBy']) && in_array($_GET['sortBy'], ['username', 'registration_date', 'role', 'status'])
    ? $_GET['sortBy'] : 'username';

$order = (isset($_GET['order']) && $_GET['order'] === 'asc') ? 'ASC' : 'DESC';
$fecthUser = $book->getUser($sortBy, $order);
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
                    <li class="active"><a href="#">Users</a></li>
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
            <div>
                <form method="post" action="../server/user-permission.php" class="widget user-widget">
                    <h2>Users</h2>
                    <div class="table-container">
                        <table class="users">
                            <thead>
                                <tr>
                                    <th>
                                        <button type="button" class="filter" onclick="window.location.href='user.php?sortBy=username&order=asc'">
                                            <img src="../img/up.png" alt="">
                                        </button>
                                        Username
                                        <button type="button" class="filter" onclick="window.location.href='user.php?sortBy=username&order=desc'">
                                            <img src="../img/down.png" alt="">
                                        </button>
                                    </th>
                                    <th class="date">
                                        <button type="button" class="filter" onclick="window.location.href='user.php?sortBy=registration_date&order=asc'">
                                            <img src="../img/up.png" alt="">
                                        </button>
                                        Date
                                        <button type="button" class="filter" onclick="window.location.href='user.php?sortBy=registration_date&order=desc'">
                                            <img src="../img/down.png" alt="">
                                        </button>
                                    </th>
                                    <th>
                                        <button type="button" class="filter" onclick="window.location.href='user.php?sortBy=role&order=asc'">
                                            <img src="../img/up.png" alt="">
                                        </button>
                                        Role
                                        <button type="button" class="filter" onclick="window.location.href='user.php?sortBy=role&order=desc'">
                                            <img src="../img/down.png" alt="">
                                        </button>
                                    </th>
                                    <th>
                                        <button type="button" class="filter" onclick="window.location.href='user.php?sortBy=status&order=asc'">
                                            <img src="../img/up.png" alt="">
                                        </button>
                                        Status
                                        <button type="button" class="filter" onclick="window.location.href='user.php?sortBy=status&order=desc'">
                                            <img src="../img/down.png" alt="">
                                        </button>
                                    </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($fecthUser as $user): ?>
                                    <tr>
                                        <td>
                                            <a href='../server/set-session.php?userId=<?= $user['user_id'] ?>' class='user'>
                                                <?= $user['username'] ?>
                                                <img src="../img/edit.png" alt="" class="edit-icon">
                                            </a>
                                        </td>
                                        <td class="date"><?= $user['registration_date'] ?></td>
                                        <td>
                                            <?php if ($user['role'] == 'admin') {
                                                echo "<span style='color: red;'>{$user['role']}</span>";
                                            } else {
                                                echo $user['role'];
                                            } ?>
                                        </td>
                                        <td><?= $user['status'] ?></td>
                                        <td>
                                            <form method="post" action="../server/user-permission.php">
                                                <input type="hidden" name="userId" value="<?= $user['user_id'] ?>">
                                                <button class="add-widget" name="unblock">Change Status</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="add-user"><a class="add-widget" href="addUser.php">Add New User</a></div>
                </form>
            </div>

            <footer class="widget footer-widget">
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

if (isset($_GET['delete'])) {
    echo '<div id="successMessage" class="success-box">Successfully Deleted</div>';
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

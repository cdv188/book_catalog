<?php

session_start();

include "../conn.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$book = new book();

$fetchBooks = $book->getAllBooks();
$fetchUser = $book->getUser();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="script.js"></script>
</head>

<body class="admin">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div>
            <div class="sidebar-header">
                <a href="./index.php"><img src="../img/logo.png" class="logo" alt=""></a>
            </div>
            <nav>
                <ul>
                    <li class="active"><a href="#">Dashboard</a></li>
                    <li><a href="components/books.php">Books</a></li>
                    <li><a href="components/User.php">Users</a></li>
                </ul>
            </nav>
        </div>
        <div class="sidebar-footer">
            <ul>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main>
        <!-- HEADER -->
        <header class="admin">
            <button class="menu-toggle">&#9776;</button>
            <div class="search-bar-admin">
                <input type="text" placeholder="Search" id="getName" class="search-bar" />
                <ul id="searchResult"></ul>
            </div>

            <div class="links">
                <a class="btn new-task" href="components/addBook.php">+ New Book</a>
                <a href="" class="profile-link"><img src="img/profile.png" alt="" class="profile"></a>
            </div>
        </header>

        <!-- DASHBOARD CONTENT -->
        <section class="dashboard">
            <!-- Users -->
            <div class="widget tasks-widget">
                <h2>Users</h2>
                <ul class="users">
                    <?php foreach ($fetchUser as $user):
                        if ($user['role'] == 'client') {
                    ?>
                            <li>
                                <a href='server/set-session.php?userId=<?= $user['user_id'] ?>' class='edit-user'>
                                    <?= $user['username'] ?>
                                    <img src="img/edit.png" alt="" class="edit-icon">
                                </a>
                                <span>
                                    <?= $user['registration_date'] ?>
                                </span>
                            </li>
                    <?php }
                    endforeach; ?>
                    <a class="add-widget" href="components/user.php">See More</a>
                </ul>
            </div>

            <!-- Listed Books -->
            <div class="widget-list-book comments-widget">
                <h2>Listed Books</h2>
                <ul>
                    <?php
                    $count = 1;
                    foreach ($fetchBooks as $b): ?>
                        <li>
                            <a href='server/set-session.php?bookId=<?= $b['book_id'] ?>' class='edit-user'>
                                <?= $b['title'] ?>
                                <img src="img/edit.png" alt="edit" class="edit-icon">
                            </a>
                            <span>
                                <?= $b['author'] ?>
                            </span>
                        </li>
                    <?php $count++;
                    endforeach; ?>
                </ul>
                <a class="add-widget" href="components/books.php">See More</a>
            </div>

            <!-- Banned Users -->
            <div class="widget tracking-widget">
                <h2>Banned Users</h2>
                <ul>
                    <?php foreach ($fetchUser as $user):
                        if ($user['status'] == 'suspended') {
                    ?>
                            <li>
                                <a href='server/set-session.php?userId=<?= $user['user_id'] ?>' class='edit-user'>
                                    <?= $user['username'] ?>
                                    <img src="img/edit.png" alt="edit" class="edit-icon">
                                </a>
                                <span>
                                    <?= $user['status'] ?>
                                </span>
                            </li>
                    <?php }
                    endforeach; ?>
                </ul>
                <a class="add-widget" href="components/user.php">See More</a>
            </div>
            <footer class="widget footer-widget">
                <label>&copy; 2025 Chester Don Valencerina | Bryden Dupuis</label>
                <a href="https://www.linkedin.com/" target="_blank"><img src="../img/linkedin icon.png" alt="linkedin"></a>
                <a href="https://discord.com/" target="_blank"><img src="../img/discord icon.png" alt="discord"></a>
                <a href="https://github.com/" target="_blank"><img src="../img/github icon.png" alt="github"></a>
            </footer>
        </section>
    </main>
</body>

</html>
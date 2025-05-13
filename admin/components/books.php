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
$book = new book();

$order = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'DESC' : 'ASC';
$fetchBooks = $book->getAllBooks($order);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="shortcut icon" href="../../img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style/style.css">
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
                    <li class="active"><a href="books.php">Books</a></li>
                    <li><a href="user.php">Users</a></li>
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
                <a class="btn new-task" href="addBook.php">+ New Book</a>
                <a href="" class="profile-link"><img src="img/profile.png" alt="" class="profile"></a>
            </div>
        </header>

        <section class="dashboard-books">
            <div class="widget books-widget">
                <h2>Listed Books</h2>

                <button class="filter" onclick="window.location.href='books.php?order=asc'" name="a-z">
                    <img src="../img/down.png" alt="">
                </button>

                <button class="filter" onclick="window.location.href='books.php?order=desc'" name="z-a">
                    <img src="../img/up.png" alt="">
                </button>

                <div class="book-grid">
                    <?php foreach ($fetchBooks as $b) : ?>
                        <div class='book'>
                            <a href='../server/set-session.php?bookId=<?= $b['book_id'] ?>' class='book-link'>
                                <img src='../<?= $b['cover_image'] ?>' class='book-image' alt=''>
                                <h3><?= $b['title'] ?></h3>
                                <p><strong>Author: </strong><span><?= $b['author'] ?></span></p>
                                <p>Genre: <span><?= $b['category_name'] ?></span></p>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="books-button">
                    <a class="add-widget" href="addBook.php">Add New Book</a>
                </div>
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
<?php

session_start();
include "../conn.php";

if (!isset($_SESSION['user_id']) && $_SESSION['role'] !== 'client') {
    header("Location: ../index.php");
    exit();
}
$book = new Book();

$fetchBookById = $book->getBookById($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalog</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/style.css">
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

        <div class="book-container">
            <h2>Book Details</h2>
            <?php foreach ($fetchBookById as $book) : ?>
                <form action="server/process-list.php?id=<?= $book['book_id'] ?>" method="post" class="book-form">
                    <div class="book-details">

                        <div>
                            <img src="../admin/<?= $book['cover_image'] ?>" alt="<?= $book['title'] ?>" class="book-cover">
                        </div>
                        <div class="book-info">
                            <h1><?= $book['title'] ?></h1>
                            <p><strong>Author:</strong> <?= $book['author'] ?></p>
                            <p><strong>Published: </strong><?= $book['publication_year'] ?></p>
                            <p><strong>Genre:</strong> <?= $book['category_name'] ?></p>
                            <p><strong>Description:</strong> <?= $book['description'] ?></p>
                        </div>
                    </div>
                    <div class="book-actions">
                        <button class="add-to-list" name="addList">Add to My List</button>
                        <a href="<?= $book['url'] ?>" target="_blank" class="read-now">Read Now</a>
                    </div>
                </form>
            <?php endforeach; ?>
        </div>
    </div>
    <footer>
        <label>&copy; 2025 Chester Don Valencerina | Bryden Dupuis</label>
        <a href="https://www.linkedin.com/" target="_blank"><img src="../img/linkedin icon.png" alt="linkedin"></a>
        <a href="https://discord.com/" target="_blank"><img src="../img/discord icon.png" alt="discord"></a>
        <a href="https://github.com/" target="_blank"><img src="../img/github icon.png" alt="github"></a>
    </footer>
</body>

</html>
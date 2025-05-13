<?php

session_start();
include "../conn.php";

if (!isset($_SESSION['user_id']) && $_SESSION['role'] !== 'client') {
    header("Location: ../index.php");
    exit();
}
$book = new Book();
$fetchGenres = $book->getCategory();
$fetchUserList = $book->getUserList($_SESSION['user_id']);

$selected_category = isset($_GET['category']) ? intval($_GET['category']) : null;

// Fetch data based on filters
$fetchBooks = $selected_category ? $book->getBooksByCategory($selected_category) : $book->getAllBooks();
$fetchCategory = $book->getAllCategories();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genres</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="client.js"></script>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body class="client">
    <div class="sidebarclient">
        <a href="./catalog.php"><img src="../img/logo.png" class="logo" alt=""></a>
        <nav>
            <a href="catalog.php">📚 Library</a>
            <a href="my-list.php">📂 My List</a>
            <a href="account.php">👤 Account</a>
            <a href="../logout.php">🚪 Logout</a>
        </nav>
    </div>

    <main class="main-content">
        <button class="menu-toggle-client">&#9776;</button>
        <header class="client">
            <input type="text" class="search-bar-client" id="getName" placeholder="🔍 Start Searching...">
            <ul id="searchResultClient"></ul>
            <div class="user-info"><a href="catalog.php">👤 <?php echo ucfirst($_SESSION['username']) ?>'s Library</a></div>
        </header>
        <div class="filters">
            <h2>My Books</h2>
        </div>
        <form method="post" action="server/process-remove.php" class="list-controls">
            <div class="list-actions">
                <button type="submit" name="remove_selected" class="btn-danger">Remove Selected</button>
                <button type="submit" name="remove_all" class="btn-danger"
                    onclick="return confirm('Are you sure you want to remove ALL books?')">
                    Remove All
                </button>
            </div>

            <div class="book-grid">
                <?php foreach ($fetchUserList as $b): ?>
                    <div class="list-item">
                        <input type="checkbox" name="selected_books[]" value="<?= $b['id'] ?>" class="list-checkbox">
                        <a href="book.php?id=<?= $b['book_id'] ?>" class="book-card-list">
                            <img src="../admin/<?= $b['cover_image'] ?>" alt="Book Cover">
                            <p class="title"><?= $b['title'] ?></p>
                            <p class="author"><?= $b['author'] ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>

    </main>
    <footer>
        <label>&copy; 2025 Chester Don Valencerina | Bryden Dupuis</label>
        <a href="https://www.linkedin.com/" target="_blank"><img src="../img/linkedin icon.png" alt="linkedin"></a>
        <a href="https://discord.com/" target="_blank"><img src="../img/discord icon.png" alt="discord"></a>
        <a href="https://github.com/" target="_blank"><img src="../img/github icon.png" alt="github"></a>
    </footer>
</body>

</html>
<?php
if (isset($_GET['success'])) {
    echo '<div id="successMessage" class="success-box">Successfully Removed</div>';
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
    echo '<div id="successMessage" class="failed-box">Failed to Remove</div>';
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
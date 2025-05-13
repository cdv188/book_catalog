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

if (!isset($_SESSION['bookId'])) {
    echo "No book selected!";
    exit;
}

$bookId = $_SESSION['bookId'];

$specificBooks = $book->getBookById($bookId);
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
                <h2>Edit Book</h2>
                <div class="books-container">
                    <form action="../server/update-book.php" method="post" class="book-edit" enctype="multipart/form-data">
                        <?php foreach ($specificBooks as $sp): ?>
                            <div class="profile-container">
                                <img src="../<?= htmlspecialchars($sp['cover_image']) ?>" class="book-image-edit" alt="Book Cover">

                                <label for="change" class="custom-file-upload" data-file-name="No file chosen">
                                    <img class="change_prof" src="../img/refresh.png" alt="Refresh Icon">
                                </label>
                                <input type="file" name="image" id="change" onchange="showUploadButton()">
                            </div>

                            <div class="inputs">
                                <label for="title">Title:</label>
                                <input type="text" id="title" class="title" placeholder="Title" value="<?= $sp['title'] ?>" name="title" required>

                                <label for="author">Author:</label>
                                <input type="text" id="author" placeholder="Author" value="<?= $sp['author'] ?>" name="author" required>

                                <label for="isbn">ISBN:</label>
                                <input type="text" id="isbn" placeholder="ISBN" value="<?= $sp['isbn'] ?>" name="isbn" required>

                                <label for="publishYear">Published Year:</label>
                                <input type="number" id="publishYear" placeholder="Year" value="<?= $sp['publication_year'] ?>" name="published_year" required>

                                <label for="quantity">Quantity:</label>
                                <input type="number" id="quantity" placeholder="Quantity" value="<?= $sp['quantity'] ?>" name="quantity" required>

                                <label for="url">URL:</label>
                                <input type="text" id="quantity" placeholder="URL" value="<?= $sp['url'] ?>" name="url" required>

                                <label for="description">Description:</label>
                                <textarea name="description" id="description" rows="5" required><?= $sp['description'] ?></textarea>

                                <label for="category_id">Category:</label>
                                <select name="category_id" id="category_id" required>
                                    <?php
                                    $categories = $book->getCategory();
                                    foreach ($categories as $category):
                                        $selected = ($category['category_id'] == $bookDetails['category_id']) ? 'selected' : '';
                                    ?>
                                        <option value="<?= $category['category_id'] ?>" <?= $selected ?>>
                                            <?= $category['category_name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <br>
                                <button class="add-widget" type="submit" name="updateBook">Update Book</button>
                                <button class="add-widget block" type="submit" name="deleteBook">Delete Book</button>
                            </div>
                        <?php endforeach; ?>
                    </form>

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
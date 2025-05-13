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
$categories = $book->getCategory();

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
                <a class="btn new-task" href="#">+ New Book</a>
                <a href="" class="profile-link"><img src="img/profile.png" alt="" class="profile"></a>
            </div>
        </header>

        <section class="dashboard-books ">
            <div class="widget books-widget">
                <h2>Add Books and Category</h2>
                <div class=" addbook-dash">
                    <form action="../server/add-books.php" method="post" enctype="multipart/form-data" class="book-edit">
                        <div class="inputs">
                            <label>Title:</label> <input type="text" name="title" required>
                            <label>Author:</label> <input type="text" name="author" required>

                            <label>Quantity:</label> <input type="number" name="quantity" required>
                            <label>ISBN:</label> <input type="text" name="isbn" required>
                            <label>Published Year:</label> <input type="number" name="published_year" required>
                            <label>URL:</label> <input type="text" name="url" required>
                            <label>Description:</label> <textarea name="description" required></textarea>

                            <select name="categoryId" required>
                                <option value="" class="category">Category</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['category_id']; ?>"><?= $category['category_name']; ?></option>
                                <?php endforeach; ?>
                            </select><br><br>

                            <label>Image:</label> <input type="file" name="image" accept="image/*" required>

                            <button class="add-widget" type="submit" name="addBook">Add Book</button>
                        </div>
                    </form>
                    <form action="../server/add-category.php" method="post" class="book-edit">
                        <div class="inputs">
                            <label for="category_name">Category Name:</label>
                            <input type="text" name="category_name">
                            <label for="description">Description:</label>
                            <textarea type="text" name="description" rows="10"></textarea>
                            <button class="add-widget" type="submit" name="addCategory">Add Category</button>
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
}
?>
<?php


session_start();
include "../../conn.php";
$book = new Book();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateBook'])) {
    $bookId = $_SESSION['bookId'];
    $title = $_POST["title"];
    $author = $_POST["author"];
    $isbn = $_POST["isbn"];
    $description = $_POST["description"];
    $publishYear = $_POST["published_year"];
    $categoryId = $_POST["category_id"];
    $quantity = $_POST["quantity"];
    $url = $_POST["url"];
    $image = null;

    // Handle new image upload
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "../img/books/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
        }

        $image_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = "img/books/" . $image_name; // Store relative path
        }
    }

    // Call updateBook() function
    if ($book->updateBook($bookId, $title, $author, $isbn, $description, $publishYear, $categoryId, $quantity, $image, $url)) {
        header("Location: ../components/edit-book.php?success=updated");
        exit;
    } else {
        header("Location: ../components/edit-book.php?failed=updated");
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteBook'])) {
    $bookId = $_SESSION['bookId'];

    if ($book->deleteBook($bookId)) {
        header("Location: ../components/books.php?success=deleted");
        exit();
    } else {
        header("Location: ../components/edit-book.php?failed=delete");
    }
}

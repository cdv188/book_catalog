<?php


include "../../conn.php";

$book = new Book();
$message = "";
$categories = $book->getCategory();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addBook'])) {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $isbn = $_POST["isbn"];
    $description = $_POST["description"];
    $publishYear = $_POST["published_year"];
    $categoryId = $_POST["categoryId"];
    $quantity = $_POST["quantity"];
    $url = $_POST['url'];

    // Handle file upload
    $target_dir = "../img/books/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
    }

    // Ensure an image is uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name; // Full path for saving

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Save only the relative path (for easier retrieval in HTML)
            $imagePath = "img/books/" . $image_name;

            // Insert book into the database
            if ($book->addBook($title, $author, $isbn, $description, $publishYear, $categoryId, $quantity, $imagePath, $url)) {
                header("Location: ../components/addBook.php?success=added");
            } else {
                header("Location: ../components/addBook.php?success=added");
            }
        } else {
            $message = "Error uploading image.";
        }
    } else {
        $message = "No valid image uploaded.";
    }
}

// Fetch books
$books = $book->getAllBooks();

<?php


include "../../conn.php";

$book = new Book();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addCategory'])) {
    $category_name = $_POST["category_name"];
    $description = $_POST["description"];

    if ($book->addCategory($category_name, $description)) {
        header("Location: ../components/addBook.php?success=added");
        exit;
    }
}

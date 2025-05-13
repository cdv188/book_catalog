<?php


session_start();

if (isset($_GET['bookId'])) {
    $_SESSION['bookId'] = $_GET['bookId'];
    header("Location: ../components/edit-book.php");
    exit;
} elseif (isset($_GET['userId'])) {
    $_SESSION['userId'] = $_GET['userId'];
    header("Location: ../components/edit-user.php");
    exit;
}




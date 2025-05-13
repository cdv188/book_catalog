<?php

session_start();
include "../../conn.php";
$book = new Book();

if (isset($_POST['addList'])) {
    $bookid = $_GET['id'];
    $userid = $_SESSION['user_id'];

    try {
        if ($book->addToUserList($userid, $bookid)) {
            header("location: ../catalog.php?success=book_added");
        } else {
            header("location: ../catalog.php?error=already_in_list");
        }
        exit();
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 1062) {
            header("location: ../catalog.php?error=already_in_list");
        } else {
            header("location: ../catalog.php?error=failed");
        }
        exit();
    }
} else {
    header("location: ../catalog.php");
    exit();
}

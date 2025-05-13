<?php

session_start();
include "conn.php";
$book = new Book();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = $book->verifyUser($username);

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];


        if ($user['status'] === 'suspended') {
            header("location: index.php?status=suspended");
            exit();
        }

        if ($user['role'] === 'admin') {
            header("Location: admin/index.php");
        } else {
            header("Location: client/catalog.php");
        }
        exit();
    } else {
        header("Location: index.php?error=invalid_credentials");
        exit();
    }
}

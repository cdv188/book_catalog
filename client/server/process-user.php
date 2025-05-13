<?php

include "../../conn.php";
$book = new Book();
if (isset($_POST['save-changes'])) {
    $user_id = $_POST['userId'];
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $password = password_hash($password, PASSWORD_DEFAULT);

    if ($book->updateUser($user_id, $name, $email, $password)) {
        header("Location:../account.php?success=updated");
        exit();
    } else {
        header("Location:../account.php?failed=updated");
    }
}

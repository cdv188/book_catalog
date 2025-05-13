<?php

session_start();
include "../../conn.php";

$book = new Book();

if (isset($_POST['block']) || isset($_POST['unblock'])) {
    $user_id = $_POST['userId'];

    $book->changePermission($user_id);
} elseif (isset($_POST['save-changes'])) {
    $user_id = $_POST['userId'];
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $password = password_hash($password, PASSWORD_DEFAULT);

    if ($book->updateUser($user_id, $name, $email, $password)) {
        header("Location:../components/edit-user.php?success=updated");
        exit();
    } else {
        header("Location:../components/edit-user.php?failed=updated");
    }
}
if (isset($_POST['delete'])) {
    $user_id = $_POST['userId'];

    $book->deleteUser($user_id);
    header("Location:../components/user.php?delete=success");
    exit();
}
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();

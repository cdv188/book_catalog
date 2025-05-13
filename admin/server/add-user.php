<?php


include "../../conn.php";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addUser'])) {
    $name = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $status = $_POST["status"];
    $user = new Book();

    $password = password_hash($password, PASSWORD_DEFAULT);
    $result = $user->addUser($name, $email, $password, $role, $status);

    if ($result === "Email already exists") {
        header("Location: ../components/addUser.php?error=email_exists");
        exit();
    } elseif ($result) {
        header("Location: ../components/addUser.php?success=user_added");
        exit();
    } else {
        header("Location: ../components/addUser.php?error=failed");
        exit();
    }
}

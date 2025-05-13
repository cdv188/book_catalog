<?php

include "../../conn.php";
$user = new Book();



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addUser'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = "client";
    $status = "active";

    if (empty($name) || empty($email) || empty($password)) {
        header("Location: ../register.php?error=empty_fields");
        exit();
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $result = $user->addUser($name, $email, $password, $role, $status);
    if (!$result) {
        header("Location: ../register.php?error=failed");
        exit();
    }

    if ($result === "Email already exists") {
        header("Location: ../register.php?error=email_exists");
        exit();
    } elseif ($result) {
        header("Location: ../register.php?success=user_added");
        exit();
    } else {
        header("Location: ../register.php?error=failed");
        exit();
    }
}

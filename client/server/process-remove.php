<?php

session_start();
include "../../conn.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'client') {
    header("Location: ../index.php");
    exit();
}

$book = new Book();
$userId = $_SESSION['user_id'];

if (isset($_POST['remove_selected'])) {
    $selectedBooks = $_POST['selected_books'] ?? [];
    $listIds = array_map('intval', $selectedBooks);

    if (!empty($listIds)) {
        $success = $book->removeFromList($userId, $listIds);
        header("Location: ../my-list.php?" . ($success ? 'success=removed' : 'error=remove_failed'));
        exit();
    }
    header("Location: ../my-list.php?error=no_selection");
    exit();
} elseif (isset($_POST['remove_all'])) {
    $success = $book->removeFromList($userId);
    header("Location: ../my-list.php?" . ($success ? 'success=removed_all' : 'error=remove_failed'));
    exit();
}

header("Location: ../my-list.php");
exit();

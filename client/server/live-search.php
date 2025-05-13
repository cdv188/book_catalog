<?php

session_start();
include "../../conn.php";

if (isset($_POST['searchQuery'])) {
    $book = new book();
    $searchResults = $book->clientSearch($_POST['searchQuery']);

    if (!empty($searchResults)) {
        foreach ($searchResults as $result) {

            echo "
                    <li class='client-item-search'>
                        <a href='book.php?id={$result['id']}' class='client-search-item'>📚 " . htmlspecialchars($result['name']) . "</a>
                    </li>";
        }
    } else {
        echo "<div class='search-item'>No results found</div>";
    }
}

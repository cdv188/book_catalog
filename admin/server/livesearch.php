<?php


include "../../conn.php";

if (isset($_POST['searchQuery'])) {
    $book = new book();
    $searchResults = $book->searchBooksAndUsers($_POST['searchQuery']);

    if (!empty($searchResults)) {
        foreach ($searchResults as $result) {
            if ($result['type'] === 'book') {
                echo "
                    <li class='item-search'>
                        <a href='../server/set-session.php?bookId={$result['id']}' class='search-item'>📚 " . htmlspecialchars($result['name']) . "</a>
                    </li>";
            } else {
                echo "
                    <li class='item-search'>
                        <a href='../server/set-session.php?userId={$result['id']}' class='search-item'>👤 " . htmlspecialchars($result['name']) . "</a>
                    </li>";
            }
        }
    } else {
        echo "<div class='search-item'>No results found</div>";
    }
}

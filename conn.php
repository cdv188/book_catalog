<?php


define("SERVER", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DB", "book_catalog");

class Book
{
    // Database connection
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new mysqli(SERVER, USER, PASSWORD, DB);
            $this->conn->set_charset("utf8mb4");
        } catch (mysqli_sql_exception $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Search for books and users
    public function searchBooksAndUsers($searchQuery)
    {
        $query = "%$searchQuery%";
        $sql = "
            (SELECT 'book' AS type, book_id AS id, title AS name, author AS extra_info 
             FROM books WHERE title LIKE ?)
            UNION
            (SELECT 'user' AS type, user_id AS id, username AS name, role AS extra_info 
             FROM users WHERE username LIKE ?)
            LIMIT 10;
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $query, $query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get all books
    public function getAllBooks($order = "ASC")
    {
        $order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';
        $sql = "SELECT books.title, books.book_id, books.cover_image, books.author, categories.category_name 
                FROM books 
                LEFT JOIN categories ON books.category_id = categories.category_id
                ORDER BY books.title $order";

        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get book by its ID
    public function getBookById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM book_catalog_view WHERE book_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get users by their ID
    public function getUserById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get all users
    public function getUser($sortBy = "username", $order = "ASC")
    {
        $allowedSortColumns = ['username', 'email', 'role', 'status', 'user_id'];
        $sortBy = in_array($sortBy, $allowedSortColumns) ? $sortBy : 'username';
        $order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';
        $sql = "SELECT * FROM users ORDER BY $sortBy $order";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get all categories
    public function getCategory()
    {
        $result = $this->conn->query("SELECT * FROM categories");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get all roles
    public function getRole()
    {
        $result = $this->conn->query("SELECT DISTINCT role FROM users");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get all status
    public function getStatus()
    {
        $result = $this->conn->query("SELECT DISTINCT status FROM users");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Add a new user
    public function addUser($name, $email, $password, $role, $status)
    {
        // Check if email exists
        $checkQuery = "SELECT COUNT(*) AS count FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($checkQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            return "Email already exists";
        }

        $query = "INSERT INTO users (username, email, password, role, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssss", $name, $email, $password, $role, $status);
        return $stmt->execute();
    }

    // Add a new book
    public function addBook($title, $author, $isbn, $description, $publishYear, $categoryId, $quantity, $image, $url)
    {
        $query = "INSERT INTO books (title, author, isbn, description, publication_year, category_id, quantity, cover_image, url) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssiiiss", $title, $author, $isbn, $description, $publishYear, $categoryId, $quantity, $image, $url);
        return $stmt->execute();
    }

    // Add a new category
    public function addCategory($name, $description)
    {
        $query = "INSERT INTO categories(category_name, description) VALUES (?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $name, $description);
        return $stmt->execute();
    }

    // Update the user's permission
    public function changePermission($user_id)
    {
        $stmt = $this->conn->prepare("
            UPDATE users 
            SET status = CASE 
                WHEN status = 'Active' THEN 'Suspended' 
                ELSE 'Active' 
            END 
            WHERE user_id = ?
        ");
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }

    // Update the book
    public function updateBook($bookId, $title, $author, $isbn, $description, $publishYear, $categoryId, $quantity, $image = null, $url)
    {
        if ($image) {
            $query = "UPDATE books 
                      SET title = ?, author = ?, isbn = ?, description = ?, publication_year = ?, category_id = ?, quantity = ?, url = ?, cover_image = ? 
                      WHERE book_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssssiiissi", $title, $author, $isbn, $description, $publishYear, $categoryId, $quantity, $url, $image, $bookId);
        } else {
            $query = "UPDATE books 
                      SET title = ?, author = ?, isbn = ?, description = ?, publication_year = ?, category_id = ?, quantity = ?, url = ?
                      WHERE book_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssssiiisi", $title, $author, $isbn, $description, $publishYear, $categoryId, $quantity, $url, $bookId);
        }
        return $stmt->execute();
    }

    // Delete a book
    public function deleteBook($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM books WHERE book_id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Delete a user
    public function deleteUser($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Update the user
    public function updateUser($id, $name, $email, $password)
    {
        $stmt = $this->conn->prepare("
            UPDATE users 
            SET username = ?, email = ?, password = ?
            WHERE user_id = ?
        ");
        $stmt->bind_param("sssi", $name, $email, $password, $id);
        return $stmt->execute();
    }

    // User verification
    public function verifyUser($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Add to user List
    public function addToUserList($userId, $bookId)
    {
        // First check if the book is already in the user's list
        $checkStmt = $this->conn->prepare("
            SELECT id FROM user_list 
            WHERE user_id = ? AND book_id = ?
        ");
        $checkStmt->bind_param("ii", $userId, $bookId);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        // If book already exists in list, return false
        if ($result->num_rows > 0) {
            return false;
        }

        // If not exists, insert new entry
        $insertStmt = $this->conn->prepare("
            INSERT INTO user_list (user_id, book_id) 
            VALUES (?, ? )
        ");
        $insertStmt->bind_param("ii", $userId, $bookId);

        return $insertStmt->execute();
    }
    // Get user list and book details by joining tables
    public function getUserList($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT ul.id, b.book_id, b.title, b.author, b.cover_image 
            FROM user_list ul 
            JOIN books b ON ul.book_id = b.book_id 
            WHERE ul.user_id = ?
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    // Remove from user list
    public function removeFromUserList($userId, $bookId)
    {
        $stmt = $this->conn->prepare("DELETE FROM user_list WHERE user_id = ? AND book_id = ?");
        $stmt->bind_param("ii", $userId, $bookId);
        return $stmt->execute();
    }

    // Search for books client side
    public function clientSearch($searchQuery)
    {
        $query = "%$searchQuery%";
        $sql = "
            SELECT book_id AS id, title AS name, author AS extra_info 
             FROM books WHERE title LIKE ?
            LIMIT 10;
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Get Books By its Category
    public function getBooksByCategory($category_id)
    {
        $stmt = $this->conn->prepare("
        SELECT b.*, c.category_name 
        FROM books b
        JOIN categories c ON b.category_id = c.category_id
        WHERE b.category_id = ?
    ");
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Get All Categories
    public function getAllCategories()
    {
        $stmt = $this->conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Remove a list based on user ID
    public function removeFromList($userId, $listIds = [])
    {
        if (empty($listIds)) {
            // Remove all
            $stmt = $this->conn->prepare("DELETE FROM user_list WHERE user_id = ?");
            $stmt->bind_param("i", $userId);
            return $stmt->execute();
        }

        // Remove selected
        $placeholders = implode(',', array_fill(0, count($listIds), '?'));
        $stmt = $this->conn->prepare("DELETE FROM user_list WHERE user_id = ? AND id IN ($placeholders)");
        $types = str_repeat('i', count($listIds) + 1);
        $params = array_merge([$userId], $listIds);
        $stmt->bind_param($types, ...$params);
        return $stmt->execute();
    }
}

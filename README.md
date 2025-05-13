# 📚 Book Catalog Web Application

A PHP-based book catalog web application with **admin** and **client** interfaces.  
- The **Admin side** allows management of book listings.  
- The **Client side** enables users to register, browse, and manage their personal book lists.

---

## 🗂️ Project Structure

```
BOOK_CATALOG/
│
├── admin/                 # Admin dashboard and functionality
│   ├── components/        # Reusable components (future use)
│   ├── img/               # Admin-specific images
│   ├── server/            # Admin-side server scripts
│   ├── index.php          # Admin login/dashboard
│   └── script.js          # Admin-side JavaScript
│
├── client/                # Client-facing pages
│   ├── server/            # Client-side server scripts
│   ├── account.php        # Client account page
│   ├── book.php           # Book detail page
│   ├── catalog.php        # Book catalog listing
│   ├── my-list.php        # Client’s book list
│   ├── register.php       # User registration
│   └── client.js          # Client-side JavaScript
│
├── img/                   # Common images (icons, logo)
│
├── style/                 # CSS styles
│   └── style.css
│
├── WireFrame&Diagram/     # Wireframes and system design
│
├── book_catalog.sql       # Database schema and sample data
├── conn.php               # Database connection script
├── index.php              # Landing/login page
├── logout.php             # Logout functionality
└── process-login.php      # Login processing script
```

---

## 🌐 Features

### ✅ Admin Side
- Secure admin login  
- View and manage book listings  
- Organized codebase for easy updates  

### 👤 Client Side
- User registration and login  
- Browse available books  
- Add/view personal book list  

---

## 🧰 Technologies Used

- **PHP** – Server-side scripting  
- **MySQL** – Relational database  
- **JavaScript** – Client-side interactivity  
- **HTML/CSS** – Webpage structure and styling  

---

## 🔧 Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-username/book_catalog.git
   cd book_catalog
   ```

2. **Import the Database**
   - Open phpMyAdmin or use MySQL CLI
   - Import the file: `book_catalog.sql`

3. **Configure Database Connection**
   - Edit `conn.php`:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "book_catalog";
     ```

4. **Run the Application**
   - Place the project in your `htdocs` (XAMPP) or web server directory  
   - Open in browser:  
     ```
     http://localhost/book_catalog/
     ```

---

## 📷 Previews and Diagrams

See the `WireFrame&Diagram/` folder for design sketches and diagrams (if available).

---

## 🙌 Contribution

Feel free to fork, modify, and enhance the project. Pull requests are welcome!

---

## 📄 License

This project is open-source and free to use and modify.

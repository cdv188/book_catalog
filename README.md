📚 Book Catalog Web Application
A PHP-based book catalog web application that includes admin and client interfaces. The admin side allows management of book listings, while the client side enables users to register, browse, and manage their book lists.

🗂️ Project Structure
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
├── style/                 # CSS styles
│   └── style.css
│
├── WireFrame&Diagram/     # Wireframes and system design (if applicable)
│
├── book_catalog.sql       # Database schema and sample data
├── conn.php               # Database connection script
├── index.php              # Landing/login page
├── logout.php             # Logout functionality
└── process-login.php      # Login processing script
🌐 Features
✅ Admin Side
Secure admin login

View and manage book listings

Organized code structure for future expansion

👤 Client Side
User registration and login

Browse available books

Add/view books in personal list

🧰 Technologies Used
PHP – Server-side scripting

MySQL – Relational database

JavaScript – Frontend interactivity

HTML/CSS – Webpage structure and styling

🔧 Setup Instructions
Clone the Repository
git clone https://github.com/your-username/book_catalog.git
cd book_catalog
Import the Database

Use tools like phpMyAdmin or MySQL CLI.

Import book_catalog.sql.

Configure Database Connection

Edit conn.php with your database credentials:
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_catalog";
Run the Application

Place the project folder inside your XAMPP/htdocs or your web server directory.

Access it via: http://localhost/book_catalog/

📷 Previews and Diagrams
Check the WireFrame&Diagram/ folder for design sketches and flow diagrams (if included).

🙌 Contribution
Feel free to fork and improve the project! Pull requests are welcome.

📄 License
This project is open-source. You may use and modify it as needed.

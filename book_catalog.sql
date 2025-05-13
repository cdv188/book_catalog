-- Written by: Chester Don Valencerina
--
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2025 at 07:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_catalog`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(17) NOT NULL,
  `description` text DEFAULT NULL,
  `publication_year` year(4) NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `cover_image` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `isbn`, `description`, `publication_year`, `category_id`, `quantity`, `cover_image`, `url`, `date_added`) VALUES
(11, 'My Lorraine journal', ' Edith Louise Coues O\'Shaughnessy', '75744', 'Credits: MWS and the Online Distributed Proofreading Team at https://www.pgdp.net (This file was produced from images generously made available by The Internet Archive)', '2025', 3, 20, 'img/books/1743289362_myJorraineJournaljpg.jpg', 'https://www.gutenberg.org/ebooks/75744.html.images', '2025-03-29 19:02:42'),
(12, 'Romeo and Juliet', 'William Shakespeare', '1513', 'The play centers on the intense love affair between two young lovers, Romeo Montague and Juliet Capulet, whose families are embroiled in a bitter feud. Their love, while passionate and profound, is met with adversities that ultimately lead to tragic consequences.', '1998', 1, 233, 'img/books/1743289845_romeo&juliet.jpg', 'https://www.gutenberg.org/ebooks/1513.html.images', '2025-03-29 19:10:45'),
(13, 'Alice\'s Adventures in Wonderland ', 'Lewis Carroll', '2873298', 'The story follows a young girl named Alice who, feeling bored and sleepy while sitting by a riverbank, encounters a White Rabbit and follows it down a rabbit hole, plunging into a fantastical world filled with curious creatures and whimsical adventures.', '2008', 1, 211, 'img/books/1743289967_aliceinwonderland.jpg', 'https://www.gutenberg.org/ebooks/11.html.images', '2025-03-29 19:12:47'),
(14, 'The Great Gatsby', 'F. Scott Fitzgerald', '64317', 'The story is mainly narrated by Nick Carraway, who reflects on the life of his enigmatic neighbor, Jay Gatsby, and the extravagant world of wealth and excess he inhabits. The novel explores themes of the American Dream, love, and social class.', '2021', 1, 213, 'img/books/1743290299_thegreatgatsby.jpg', 'https://www.gutenberg.org/ebooks/64317.html.images', '2025-03-29 19:18:19'),
(15, 'The Invisible Man', 'H. G. Wells', '0451528522', 'The Invisible Man of the title is \'\'Griffin\'\', a scientist who theorizes that if a person\'s refractive index is changed to exactly that of air and his body does not absorb or reflect light, then he will not be visible.', '0000', 5, 31, 'img/books/1743290488_theinisibleman.jpg', 'https://manybooks.net/book/127828/read#epubcfi(/6/2[item3]!/4/2/1:0)', '2025-03-29 19:21:28'),
(16, 'Algorithms Notes for Professionals book', 'GoalKicker.com', '32919', 'The Algorithms Notes for Professionals book is compiled from Stack Overflow Documentation, the content is written by the beautiful people at Stack Overflow. Text content is released under Creative Commons BY-SA. See credits at the end of this book whom contributed to the various chapters. Images may be copyright of their respective owners unless otherwise specified', '2024', 7, 23, 'img/books/1743290906_AlgorithmsGrow.png', '../admin/img/books/AlgorithmsNotesForProfessionals.pdf', '2025-03-29 19:28:26'),
(17, 'PHP Notes for Professionals book', 'GoalKicker.com', '123124', 'The PHP Notes for Professionals book is compiled from Stack Overflow Documentation, the content is written by the beautiful people at Stack Overflow. Text content is released under Creative Commons BY-SA. See credits at the end of this book whom contributed to the various chapters. Images may be copyright of their respective owners unless otherwise specified', '2018', 7, 32, 'img/books/1743291067_PHPGrow.png', '../admin/img/books/PHPNotesForProfessionals.pdf', '2025-03-29 19:31:07'),
(18, 'A Short History of the World', 'H. G. Wells', '35461', 'This work explores the vast expanse of the Earth\'s history, delving into the origins of life, the development of civilizations, and the significant events that have shaped human existence. Its ambitious scope aims to provide readers with a comprehensive and accessible overview of humanity\'s journey through time.', '2011', 3, 23, 'img/books/1743291205_pg35461.cover.medium.jpg', 'https://www.gutenberg.org/ebooks/35461.html.images', '2025-03-29 19:33:25'),
(19, 'The Story of Mankind', 'Hendrik Willem Van Loon', '46399', 'This work aims to present the journey of humanity from prehistoric times through ancient civilizations up to the author\'s contemporary era, exploring the significant events, cultures, and figures that have shaped human history.', '2014', 3, 23, 'img/books/1743291269_pg46399.cover.medium.jpg', 'https://www.gutenberg.org/ebooks/46399.html.images', '2025-03-29 19:34:29'),
(20, 'One Piece (The Goat)', 'Oda Eiichiro', '23132', 'Monkey D. Luffy dreamed of becoming the King of the Pirates. But his life changed when he accidentally gained the power to stretch like rubber...at the cost of never being able to swim again! Now Luffy, with the help of a motley collection of nakama, is setting off in search of \"One Piece,\" said to be the greatest treasure in the world...', '1997', 4, 231, 'img/books/1743291756_71y+XnBXm4L.jpg', 'https://www.natomanga.com/manga/one-piece/chapter-1', '2025-03-29 19:42:36'),
(21, 'Fundamentals of Electrical Engineering I', 'Don Johnson', '9781300160137', 'The course focuses on the creation, manipulation, transmission, and reception of information by electronic means. Elementary signal theory; time- and frequency-domain analysis; Sampling Theorem. Digital information theory; digital transmission of analog signals; error-correcting codes.', '2014', 2, 35, 'img/books/1743292131_9781300160137.jpg', 'https://open.umn.edu/opentextbooks/formats/404', '2025-03-29 19:48:51');

-- --------------------------------------------------------

--
-- Stand-in structure for view `book_catalog_view`
-- (See below for the actual view)
--
CREATE TABLE `book_catalog_view` (
`book_id` int(11)
,`title` varchar(255)
,`author` varchar(255)
,`category_name` varchar(100)
,`publication_year` year(4)
,`description` text
,`quantity` int(11)
,`cover_image` varchar(255)
,`date_added` datetime
,`url` varchar(255)
,`isbn` varchar(17)
);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`) VALUES
(1, 'Fiction', 'Imaginary stories and narratives'),
(2, 'Science', 'Scientific books and publications'),
(3, 'History', 'Historical accounts and analyses'),
(4, 'Manga', 'Japanese Comics'),
(5, 'Sci-fy', 'daomfapsda'),
(6, 'Adult', 'sdjafinsfjklcawe'),
(7, 'Programming', 'Coders');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','client') NOT NULL DEFAULT 'client',
  `registration_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','suspended') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`, `registration_date`, `status`) VALUES
(1, 'admin', '$2y$10$jr6brjpsLXu/FgZEengDnu44szvwgJQxQ9TPfnt8kR2rc2s7qYjui', 'admin@library.com', 'admin', '2025-03-16 16:50:21', 'active'),
(3, 'lebron', '$2y$10$Vno8XeP7E1vgVcMykCZ0KeTmenOytP0w6KjOdWu2RH3fwXYUQ3B8m', 'LB@example.com', 'client', '2025-03-23 16:13:33', 'suspended'),
(6, 'bryden', '$2y$10$6AAdl7IMiSl7pWp0SWbrHef.0CHb3Z3.34vD6LGn7vGzVGBoy.0Qm', 'bryden@example.com', 'admin', '2025-03-23 16:23:19', 'active'),
(7, 'kd', '$2y$10$Di9l9rAwZSI30y4Nd6Ea7Ohjb036csYtbDMXYYPrJTzUoE5biFn4i', '123@user.com', 'client', '2025-03-23 16:29:56', 'suspended'),
(8, 'sample', '$2y$10$3P99WrFsozo4/Dy0vj43aOQf05MvRxAQZuZ94bn5G/e7n6MKw0Dl2', 'sample@clien.com', 'client', '2025-03-23 16:34:04', 'suspended'),
(9, 'alem', '$2y$10$Gcsf/FC2wGQJsCWMN1UCye4OyaftIzXU/ptoNaGuzAU1QD3Nfv1E2', 'alem@prof.com', 'client', '2025-03-23 16:35:00', 'active'),
(11, 'chester', '$2y$10$exx5LlMl8ujZkcBJzJUPguoGvDcOweZ8ya.PsybEo5QCYKKVcpqYK', 'chsas@gmail.com', 'admin', '2025-03-29 14:13:54', 'active'),
(12, 'yeah', '$2y$10$pyPDcknrR2/.pABNN2968OqrFi5JxJrb5AW3T9K2m2.uHosY7JlsW', 'yeahmen@gmail.com', 'client', '2025-03-29 14:37:55', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_list`
--

CREATE TABLE `user_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_list`
--

INSERT INTO `user_list` (`id`, `user_id`, `book_id`) VALUES
(4, 9, 8),
(2, 9, 10),
(5, 9, 16),
(16, 9, 17),
(10, 12, 12),
(12, 12, 14),
(11, 12, 20),
(13, 12, 21);

-- --------------------------------------------------------

--
-- Structure for view `book_catalog_view`
--
DROP TABLE IF EXISTS `book_catalog_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `book_catalog_view`  AS SELECT `b`.`book_id` AS `book_id`, `b`.`title` AS `title`, `b`.`author` AS `author`, `c`.`category_name` AS `category_name`, `b`.`publication_year` AS `publication_year`, `b`.`description` AS `description`, `b`.`quantity` AS `quantity`, `b`.`cover_image` AS `cover_image`, `b`.`date_added` AS `date_added`, `b`.`url` AS `url`, `b`.`isbn` AS `isbn` FROM (`books` `b` join `categories` `c` on(`b`.`category_id` = `c`.`category_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `idx_title` (`title`),
  ADD KEY `idx_author` (`author`),
  ADD KEY `idx_publication_year` (`publication_year`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_list`
--
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_book` (`user_id`,`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_list`
--
ALTER TABLE `user_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

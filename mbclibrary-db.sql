-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2025 at 10:34 AM
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
-- Database: `mbclibrary-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `Date_published` date DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `is_borrowed` tinyint(1) NOT NULL,
  `Reader_id` int(11) DEFAULT NULL,
  `date_borrowed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `ISBN`, `Title`, `Author`, `Date_published`, `qr_code`, `is_borrowed`, `Reader_id`, `date_borrowed`) VALUES
(1, '9780131103627', 'The C Programming Language', 'Brian W. Kernighan', '1988-03-22', NULL, 0, NULL, NULL),
(2, '9780596007126', 'Head First Design Patterns', 'Eric Freeman', '2004-10-25', NULL, 0, NULL, NULL),
(6, '9781491950296', 'Learning PHP, MySQL & JavaScript', 'Robin Nixon', '2017-05-01', NULL, 0, NULL, NULL),
(7, '9780596009205', 'JavaScript: The Good Parts', 'Douglas Crockford', '2008-05-15', NULL, 0, NULL, NULL),
(8, '9781492078005', 'Fluent Python', 'Luciano Ramalho', '2022-04-19', NULL, 0, NULL, NULL),
(9, '9780137081073', 'The Clean Coder', 'Robert C. Martin', '2011-05-23', NULL, 0, NULL, NULL),
(10, '9780321356680', 'Refactoring: Improving the Design of Existing Code', 'Martin Fowler', '1999-07-08', NULL, 0, NULL, NULL),
(11, '9781492091509', 'Building Microservices', 'Sam Newman', '2021-02-02', NULL, 0, NULL, NULL),
(12, '9780131103627', 'The C Programming Language', 'Brian W. Kernighan', '1988-03-22', NULL, 0, NULL, NULL),
(13, '9780596007126', 'Head First Design Patterns', 'Eric Freeman', '2004-10-25', NULL, 0, NULL, NULL),
(14, '9780596007126', 'Head First Design Patterns', 'Eric Freeman', '2004-10-25', NULL, 0, NULL, NULL),
(15, '9780137081073', 'The Clean Coder', 'Robert C. Martin', '2011-05-23', NULL, 0, NULL, NULL),
(16, '9781492091509', 'Building Microservices', 'Sam Newman', '2021-02-02', NULL, 0, NULL, NULL),
(17, '9781492078005', 'Fluent Python', 'Luciano Ramalho', '2022-04-19', 'assets/qrcodes/book_17.png', 0, NULL, NULL),
(26, '9780136006176', 'Chemistry', 'Theodore L. Brown', '2008-01-01', 'assets/qrcodes/book_26.png', 0, NULL, NULL),
(27, '9780136006176', 'Chemistry', 'Theodore L. Brown', '2008-01-01', 'assets/qrcodes/book_27.png', 0, NULL, NULL),
(28, '9780136006176', 'Chemistry', 'Theodore L. Brown', '2008-01-01', 'assets/qrcodes/book_28.png', 0, NULL, NULL),
(29, '9780136006176', 'Chemistry', 'Theodore L. Brown', '2008-01-01', 'assets/qrcodes/book_29.png', 0, NULL, NULL),
(30, '9780134685991', 'Effective Java', 'Joshua Bloch', '2017-12-26', 'assets/qrcodes/book_30.png', 0, NULL, NULL),
(31, '9780134685991', 'Effective Java', 'Joshua Bloch', '2017-12-26', 'assets/qrcodes/book_31.png', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` int(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `ver_code` int(150) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `acc_creation` date NOT NULL DEFAULT current_timestamp(),
  `type` tinyint(4) NOT NULL,
  `id_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `phone`, `password`, `ver_code`, `status`, `acc_creation`, `type`, `id_no`) VALUES
(1, 'Yuan', 'cano', 'yuks@mbc.edu.ph', 2147483647, 'asdfasdf123', 21, 1, '2025-10-08', 0, '424002719AB'),
(2, 'fgkldfgk', 'asdl;fk', 'asdf@mbc.edu.ph', 92384273, 'asdfasdf123', 2, 1, '2025-10-08', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2025 at 07:51 PM
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
  `date_borrowed` datetime DEFAULT NULL,
  `book_cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `ISBN`, `Title`, `Author`, `Date_published`, `qr_code`, `is_borrowed`, `date_borrowed`, `book_cover`) VALUES
(58, '9780131103627', 'The C Programming Language', 'Brian W. Kernighan', '1988-01-01', 'book_58.png', 0, NULL, 'cover_68f863a1c1b498.70916238.jpg'),
(59, '9780131103627', 'The C Programming Language', 'Brian W. Kernighan', '1988-01-01', 'book_59.png', 1, '2025-11-12 02:48:08', 'cover_68f863a1c1b498.70916238.jpg'),
(60, '9780131103627', 'The C Programming Language', 'Brian W. Kernighan', '1988-01-01', 'book_60.png', 0, NULL, 'cover_68f863a1c1b498.70916238.jpg'),
(61, '9780134685991', 'Effective Java', 'Joshua Bloch', '2017-12-26', 'book_61.png', 0, NULL, 'cover_68f863b1e03363.48373771.jpg'),
(62, '9780134685991', 'Effective Java', 'Joshua Bloch', '2017-12-26', 'book_62.png', 0, NULL, 'cover_68f863b1e03363.48373771.jpg'),
(63, '9780136006176', 'Chemistry', 'Theodore L. Brown', '2008-01-01', 'book_63.png', 0, NULL, 'cover_68f863cd4158e9.95184643.jpg'),
(64, '9780136006176', 'Chemistry', 'Theodore L. Brown', '2008-01-01', 'book_64.png', 0, NULL, 'cover_68f863cd4158e9.95184643.jpg'),
(65, '9780136006176', 'Chemistry', 'Theodore L. Brown', '2008-01-01', 'book_65.png', 0, NULL, 'cover_68f863cd4158e9.95184643.jpg'),
(66, '9780136006176', 'Chemistry', 'Theodore L. Brown', '2008-01-01', 'book_66.png', 0, NULL, 'cover_68f863cd4158e9.95184643.jpg'),
(67, '9780136006176', 'Chemistry', 'Theodore L. Brown', '2008-01-01', 'book_67.png', 1, '2025-11-12 02:45:37', 'cover_68f863cd4158e9.95184643.jpg'),
(68, '9780137081073', 'The Clean Coder', 'Robert C. Martin', '2011-01-01', 'book_68.png', 0, NULL, 'cover_68f863e0edcab8.73178969.jpg'),
(69, '9780321356680', 'Effective Java', 'Joshua Bloch', '2008-01-01', 'book_69.png', 0, NULL, 'cover_68f863f11134e7.91677759.jpg'),
(70, '9780321356680', 'Effective Java', 'Joshua Bloch', '2008-01-01', 'book_70.png', 0, NULL, 'cover_68f863f11134e7.91677759.jpg'),
(71, '9780596007126', 'Head First design patterns', 'Eric Freeman', '2004-01-01', 'book_71.png', 0, NULL, 'cover_68f86404ec8215.90966354.jpg'),
(72, '9780596007126', 'Head First design patterns', 'Eric Freeman', '2004-01-01', 'book_72.png', 0, NULL, 'cover_68f86404ec8215.90966354.jpg'),
(73, '9780596007126', 'Head First design patterns', 'Eric Freeman', '2004-01-01', 'book_73.png', 0, NULL, 'cover_68f86404ec8215.90966354.jpg'),
(74, '9780596009205', 'Head first Java', 'Kathy Sierra', '2005-01-01', 'book_74.png', 0, NULL, 'cover_68f864243e4f26.58271469.jpg'),
(75, '9780596009205', 'Head first Java', 'Kathy Sierra', '2005-01-01', 'book_75.png', 0, NULL, 'cover_68f864243e4f26.58271469.jpg'),
(76, '9780596009205', 'Head first Java', 'Kathy Sierra', '2005-01-01', 'book_76.png', 0, NULL, 'cover_68f864243e4f26.58271469.jpg'),
(77, '9781491950296', 'Programming JavaScript Applications: Robust Web Architecture with Node, HTML5, and Modern JS Libraries', 'Eric Elliott', '2014-07-19', 'book_77.png', 0, NULL, 'cover_68f8643b8c5262.79304670.jpg'),
(82, '9781492091509', 'Practical Python Data Wrangling and Data Quality', 'Susan E. McGregor', '2022-01-01', 'book_82.png', 0, NULL, 'cover_68f864b6ebe4c1.90147180.jpg'),
(83, '9781492091509', 'Practical Python Data Wrangling and Data Quality', 'Susan E. McGregor', '2022-01-01', 'book_83.png', 0, NULL, 'cover_68f864cceae285.82508189.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `id_no` varchar(50) NOT NULL,
  `book_id` int(11) NOT NULL,
  `date_borrowed` datetime NOT NULL,
  `date_return_expected` date NOT NULL,
  `date_returned` datetime DEFAULT NULL,
  `status` enum('borrowed','returned') DEFAULT 'borrowed',
  `overdue_days` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `id_no`, `book_id`, `date_borrowed`, `date_return_expected`, `date_returned`, `status`, `overdue_days`) VALUES
(1, '424002719AB', 59, '2025-11-11 12:39:00', '2025-11-13', '2025-11-11 23:50:34', 'returned', 0),
(2, '424002719AB', 59, '2025-11-11 18:14:00', '2025-11-19', '2025-11-12 02:16:42', 'returned', 0),
(3, '424002719AB', 67, '2025-11-11 18:45:00', '2025-11-13', NULL, 'borrowed', 0),
(4, '424002719AB', 61, '2025-11-11 18:45:00', '2025-11-20', '2025-11-12 02:46:20', 'returned', 0),
(5, '424002719AB', 59, '2025-11-11 18:48:00', '2025-11-20', NULL, 'borrowed', 0),
(6, '424002719AB', 64, '2025-11-11 18:49:00', '2025-11-14', '2025-11-12 02:50:03', 'returned', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(100) NOT NULL,
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
(1, 'Yuan', 'cano', 'yuks@mbc.edu.ph', '2147483647', 'asdfasdf123', 21, 1, '2025-10-08', 0, '424002719AB'),
(2, 'fgkldfgk', 'asdl;fk', 'asdf@mbc.edu.ph', '92384273', 'asdfasdf123', 2, 1, '2025-10-08', 1, ''),
(6, 'Juan', 'Dela cruz', 'yukinerocano@gmail.com', '09298628202', 'asdfasdf123', 0, 0, '2025-10-20', 0, 'BA209789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `id_no` (`id_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `id_no` (`id_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`id_no`) REFERENCES `users` (`id_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

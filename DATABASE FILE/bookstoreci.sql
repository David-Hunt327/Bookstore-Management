-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2024 at 01:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstoreci`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_code` int(11) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `category_code` int(11) NOT NULL,
  `price` int(25) NOT NULL,
  `book_image` longblob NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_code`, `book_title`, `year`, `category_code`, `price`, `book_image`, `publisher`, `author`, `stock`) VALUES
(22, 'Intro to Java', 2022, 1, 2500, '', 'Mr Ugo', 'Mr Ugo', 175),
(24, 'Psychology', 1987, 23, 2000, '', 'David', 'David', 1),
(25, 'Intro to DBMS', 2024, 1, 1000, '', 'You', 'YOu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `category_code` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`category_code`, `category_name`) VALUES
(1, 'Computer Science'),
(23, 'Medicine');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_code` int(11) NOT NULL,
  `user_code` int(11) NOT NULL,
  `buyer_name` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `date` date NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_code`, `user_code`, `buyer_name`, `total`, `date`, `book_name`, `book_quantity`) VALUES
(35, 6, 'David Programmer', 10000, '2024-08-05', 'Psychology, Intro to Java, Intro to DBMS', 2),
(36, 6, 'David', 7000, '2024-08-05', 'Intro to Java, Psychology', 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `transaction_code` int(11) NOT NULL,
  `book_code` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`transaction_code`, `book_code`, `quantity`) VALUES
(11, 16, 2),
(12, 16, 1),
(13, 13, 2),
(14, 14, 1),
(15, 9, 1),
(16, 11, 2),
(17, 12, 1),
(18, 10, 1),
(19, 17, 2),
(20, 13, 1),
(21, 11, 1),
(22, 22, 5),
(23, 22, 1),
(24, 22, 1),
(25, 22, 1),
(26, 22, 1),
(27, 22, 1),
(28, 22, 4),
(29, 22, 3),
(30, 22, 2),
(31, 22, 4),
(32, 22, 3),
(33, 22, 2),
(34, 24, 2),
(34, 22, 1),
(35, 24, 2),
(35, 22, 2),
(35, 25, 1),
(36, 22, 2),
(36, 24, 1),
(37, 22, 1),
(37, 24, 1),
(38, 22, 1),
(38, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_code` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_code`, `user_name`, `username`, `password`, `level`) VALUES
(6, 'Demo Account', 'Demo', 'd00f5d5217896fb7fd601412cb890830', 'admin'),
(8, 'Demo Cashier', 'Cashier', 'd00f5d5217896fb7fd601412cb890830', 'cashier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_code`),
  ADD KEY `category_code` (`category_code`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`category_code`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_code`),
  ADD KEY `user_code` (`user_code`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD KEY `transaction_code` (`transaction_code`),
  ADD KEY `book_code` (`book_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `category_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=910;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2025 at 03:12 PM
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
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'lenovo', 'first1@gmail.com', '22', '22', '2025-11-30 15:25:16'),
(2, 'lenovo', 'first1@gmail.com', '22', '22', '2025-11-30 15:26:54'),
(3, 'lenovo', 'first1@gmail.com', '22', '22', '2025-11-30 15:26:58'),
(4, 'lenovo', 'first1@gmail.com', '123-456-8970', 'hello merf', '2025-11-30 15:27:20'),
(5, 'lenovo', 'first1@gmail.com', '123-456-8970', 'hello merf', '2025-11-30 15:30:14'),
(6, 'Galaxy S24 Ultra', 'first2@gmail.com', '123-456-8970', 'eihgeiufrijfierufh3rfyherhernffef', '2025-11-30 15:30:49'),
(7, 'Ipad Air 5', '12231472@students.liu.edu.lb', '1', 'fff', '2025-11-30 15:32:01'),
(8, 'Ipad Air 5', '12231472@students.liu.edu.lb', '1', 'fff', '2025-11-30 15:32:13'),
(9, 'Itel Smart watch 1 GS', 'first3@gmail.com', '22345622', 'gtgrgrtrttrgrt', '2025-11-30 15:32:21'),
(10, 'Itel Smart watch 1 GS', 'first3@gmail.com', '22345622', 'gtgrgrtrttrgrt', '2025-11-30 15:33:01'),
(11, 'Itel Smart watch 1 GS', 'first3@gmail.com', '22345622', 'gtgrgrtrttrgrt', '2025-11-30 15:33:11'),
(12, 'Itel Smart watch 1 GS', 'first3@gmail.com', '22345622', 'gtgrgrtrttrgrt', '2025-11-30 15:35:30'),
(13, 'Galaxy S24 Ultra', '12231472@students.liu.edu.lb', '123-456-897033333333', '23423423423', '2025-11-30 15:35:48'),
(14, 'Galaxy S23 Ultra', 'first2@gmail.com', '22345622', '3232332', '2025-11-30 15:36:04'),
(15, 'Galaxy S23 Ultra', '12231472@students.liu.edu.lb', '22', '4444', '2025-11-30 15:36:33'),
(16, 'Galaxy S23 Ultra', 'first5@gmail.com', '123-456-897033333333', '222', '2025-11-30 15:38:25'),
(17, 'Iphone 12 Pro', 'first2@gmail.com', '22345622', 'frf4f', '2025-11-30 15:39:05'),
(18, 'Itel Smart watch 1 GS', '12231472@students.liu.edu.lb', 'ffff', 'ff4', '2025-11-30 15:40:20'),
(19, 'Galaxy S24 Ultra', 'first4@gmail.com', '123-456-897033333333', '333', '2025-11-30 15:43:21'),
(20, 'lenovo', 'first1@gmail.com', '9888888888', '22', '2025-11-30 15:44:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

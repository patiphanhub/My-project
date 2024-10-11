-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2024 at 09:58 AM
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
-- Database: `login_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `hire_history`
--

CREATE TABLE `hire_history` (
  `hire_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `hire_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hire_history`
--

INSERT INTO `hire_history` (`hire_id`, `user_id`, `full_name`, `hire_date`) VALUES
(14, 1, 'สมชาย ใจดี', '2024-10-11 07:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `age` int(2) NOT NULL,
  `address` varchar(255) NOT NULL,
  `province` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `id_card_number` varchar(13) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `full_name`, `gender`, `age`, `address`, `province`, `postal_code`, `phone`, `id_card_number`, `image`) VALUES
(1, 'admin', 'admin@example.com', '123', 'สมชาย ใจดี', 'male', 35, '123/45 ถนนสุขสบาย', 'กรุงเทพ', '10260', '080-123-4567', '1234567890123', '../images/YamLap.jpg'),
(2, 'user01', 'user01@example.com', 'user123', 'สมหญิง ประหยัดทรัพย์', 'female', 28, '789/99 ซอยสบายใจ', 'กรุงเทพ', '10310', '081-987-6543', '2345678901234', '../images/YamNgao.jpg'),
(3, 'user02', 'user02@example.com', 'user123', 'สมปอง รวยทรัพย์', 'male', 42, '456/78 หมู่บ้านหรู', 'กรุงเทพ', '10400', '082-456-7890', '3456789012345', '../images/YamKhriat.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hire_history`
--
ALTER TABLE `hire_history`
  ADD PRIMARY KEY (`hire_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hire_history`
--
ALTER TABLE `hire_history`
  MODIFY `hire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hire_history`
--
ALTER TABLE `hire_history`
  ADD CONSTRAINT `hire_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

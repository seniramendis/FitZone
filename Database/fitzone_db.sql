-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2026 at 07:33 AM
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
-- Database: `fitzone_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `trainer_name` varchar(100) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `booking_time` varchar(20) NOT NULL,
  `status` enum('Pending','Confirmed','Waitlist','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `class_name`, `trainer_name`, `booking_date`, `booking_time`, `status`, `created_at`) VALUES
(3, 15, 'Strength & Power', 'Nuwan Perera', '2026-03-15', '09:00 AM', 'Confirmed', '2026-03-13 19:08:10'),
(4, 16, 'Yoga & Mobility', 'Dilani Silva', '2026-03-16', '05:30 PM', 'Confirmed', '2026-03-15 06:08:18'),
(5, 16, 'Yoga & Mobility', 'Dilani Silva', '2026-03-16', '09:00 AM', 'Confirmed', '2026-03-15 06:10:59'),
(6, 16, 'Yoga & Mobility', 'Dilani Silva', '2026-04-06', '09:00 AM', 'Confirmed', '2026-03-15 06:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `amount`, `transaction_type`, `created_at`) VALUES
(1, 15, 5500, 'Subscription Upgrade (Pro)', '2026-03-13 19:09:31'),
(2, 16, 5500, 'Subscription Upgrade (Pro)', '2026-03-15 06:03:39'),
(3, 16, 2000, 'Trainer Service: Dilani Silva (Yoga & Mobility)', '2026-03-15 06:08:18'),
(4, 16, 2000, 'Trainer Service: Dilani Silva (Yoga & Mobility)', '2026-03-15 06:10:59'),
(5, 16, 2000, 'Trainer Service: Dilani Silva (Yoga & Mobility)', '2026-03-15 06:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` enum('pending','resolved') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`id`, `name`, `email`, `subject`, `message`, `status`, `created_at`) VALUES
(1, 'Senira Mendis', 'seniramendis41@gmail.com', 'Personal Training Info', 'sdfghjk', 'resolved', '2026-03-13 04:59:59'),
(2, 'Guest User', 'guest@test.com', 'Membership Inquiry', 'System testing message.', 'pending', '2026-03-15 05:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `goal` varchar(50) DEFAULT 'general',
  `role` enum('member','trainer','admin') DEFAULT 'member',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `subscription_plan` varchar(50) DEFAULT 'Basic'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `goal`, `role`, `created_at`, `subscription_plan`) VALUES
(1, 'Joel Fernando', 'jehanfernando@gmail.com', '$2y$10$xL4I8GV1nOunilRXxQ7.NugGYuOKGEnEHt6cMgHguqvL5baPjzcXS', 'weight_loss', 'member', '2026-03-13 01:19:57', 'VIP'),
(2, 'Admin', 'admin@fitzone.lk', '$2y$10$kU3TmAW6s1iy9JgPJRjD4.pi4QZU84XnxDHGfGXhaYxXlDTfQGJi2', 'general', 'admin', '2026-03-13 01:32:47', 'Basic'),
(9, 'Nuwan Perera', 'nuwan@fitzone.lk', '$2y$10$Ej.2NK9ta0nOf68bPYkGUO1F2a/5AFXnk9yf6zVQdIkLJjUcTbQcC', 'general', 'trainer', '2026-03-13 03:29:54', 'Basic'),
(10, 'Dilani Silva', 'dilani@fitzone.lk', '$2y$10$U5OhDgWc3MCcV5ve4y0EeuVekkKwDmAuaXiiXICnwZLKS6dbws64u', 'general', 'trainer', '2026-03-13 03:54:34', 'Basic'),
(11, 'Kavindu Jayawardena', 'kavindu@fitzone.lk', '$2y$10$x9b.XsETDHFuRswN9d14gurlBOBPTrng47hwdw5NMmZeUcZpxHJku', 'general', 'trainer', '2026-03-13 03:55:11', 'Basic'),
(12, 'Senuri Fernando', 'senuri@fitzone.lk', '$2y$10$gEHaPVgelOcp5/VNhqTpyulHM15D1mjipOeyGl2ua.lLqmzvgqNNW', 'general', 'trainer', '2026-03-13 04:02:07', 'Basic'),
(13, 'Roshan Silva', 'roshan@fitzone.lk', '$2y$10$FoCOypGgz4zlk/mFwa52M.zkgf6UAMAf8hoz7ImPHWSq0VZKUSqgW', 'general', 'trainer', '2026-03-13 04:02:45', 'Basic'),
(14, 'Malith Kumara', 'malith@fitzone.lk', '$2y$10$QtsvxHYKgUMh0RdDEM1k6OlbKOtXqD1ruA59bx5RLEqI3LDlHe2U2', 'general', 'trainer', '2026-03-13 04:03:30', 'Basic'),
(15, 'Senesh ', 'senesh@gmail.com', '$2y$10$2V8hontKHwAbrs8t2QD/L.nHUaEhn7L.ZfF8aq2E/Uzq.7T2ufRBK', 'muscle_gain', 'member', '2026-03-13 04:45:32', 'Pro'),
(16, 'Test 1', 'member@test.com', '$2y$10$VgNZ5IWmjomiTXsr7f4EKe9VEjIqt6swPRsoDRCn3./V0gjDbjeGa', 'muscle_gain', 'member', '2026-03-15 05:28:28', 'Pro');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

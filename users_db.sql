-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 08, 2025 at 01:56 PM
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
-- Database: `users_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `service` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT 'Scheduled',
  `doctor_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `name`, `email`, `date`, `service`, `status`, `doctor_notes`) VALUES
(23, 'power', 'power@user.com', '2025-03-07', 'Regular Checkup', 'Scheduled', NULL),
(24, 'power', 'power@user.com', '2025-03-23', 'Neurology', 'Scheduled', 'Maybe maybenot');

-- --------------------------------------------------------

--
-- Table structure for table `medical_notes`
--

CREATE TABLE `medical_notes` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `prescription` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_notes`
--

INSERT INTO `medical_notes` (`id`, `patient_id`, `doctor_id`, `note`, `diagnosis`, `prescription`, `created_at`) VALUES
(1, 10, 22, 'awdad', 'awdaw', 'awed', '2025-03-08 10:45:45'),
(2, 10, 22, 'Emergency Surgery', 'Appendix', '---NA----', '2025-03-08 10:46:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin','doctor') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `specialty` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `specialty`) VALUES
(3, 'power', 'power@admin.com', '$2y$10$Ee3tPbnJ1ClZre6fGsjfXOljOdO6grMs.MO2vYV0oOO5l57ldBRMW', 'admin', '2025-03-07 05:35:30', ''),
(10, 'power', 'power@user.com', '$2y$10$a2xtsWewyNg.a3T2ec65SuvQAqcnmqdeNIX75Cto.Ynnm9zS9WaSO', 'user', '2025-03-07 05:35:30', ''),
(22, 'power', 'power@doctor.com', '$2y$10$H1Hw4/vFXEcbhTw03VxRw.7CzxeE6Z.Zmkt5FKiNaTlS2Xye24uUi', 'doctor', '2025-03-07 15:10:53', 'Cardiology'),
(23, 'pawan', 'saugat@doctor.com', '$2y$10$zXgNk8/4qgZm2TZecAJ3Luy2XKbq9yKRFUfFJ0x3bk/9Ksm9BHNyC', 'doctor', '2025-03-08 10:47:48', 'Neurology');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_notes`
--
ALTER TABLE `medical_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `medical_notes`
--
ALTER TABLE `medical_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

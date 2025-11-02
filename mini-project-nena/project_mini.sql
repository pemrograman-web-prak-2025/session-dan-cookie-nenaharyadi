-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2025 at 02:44 PM
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
-- Database: `project_mini`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id_post`, `user_id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(3, 2, 'tiran dan adila', 'di hari ini trian adila pergi ke kota tasikmalaya tepatnya di cilembang untuk datanf di karnaval.', '2025-10-25 23:30:56', '2025-10-25 23:30:56'),
(4, 1, 'Tugas senin', 'halloo guys jadi hari senin itu ada beberapa tugas yang harus aku kerjain ada tugas mandiri 1 dan 2, terus ada kuis praktikum sisdat2 sama kuis metode numerik, cuma aku belom belajar soalnya aku lagi beresin tugas project mini ini.', '2025-10-26 05:12:26', '2025-10-26 05:12:26'),
(5, 3, 'hari minggu salwa', 'Hari ini ssalwa udah beresin semua tugas nyaa, jadi awa sekarang mau nonton tapi masih bingung nonton apa', '2025-10-26 06:39:04', '2025-10-26 06:39:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(125) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'nena', 'nena@gmail.com', '$2y$12$sCRUU1n/Len9DobK.dGJbuoDINUbJCkHyF575lOSgUwDhKCLEBJQu', '2025-10-25 18:43:26', '2025-10-25 18:43:26'),
(2, 'adila', 'adila@gmail.com', '$2y$12$qZedmQFuQNj/PDAeW4ADne1r/SCuwtys.9gsy4tUBfYvfReRGp7hK', '2025-10-26 06:29:39', '2025-10-26 06:29:39'),
(3, 'salwa', 'salwa@gmail.com', '$2y$12$VPDqyWZ7OHYZPLS6PubZFeS51Gqzo64fraby5NpC61qnLjP6joGM6', '2025-10-26 13:38:01', '2025-10-26 13:38:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

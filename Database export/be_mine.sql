-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2026 at 09:50 AM
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
-- Database: `be_mine`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `wedding_plan_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `booking_status_id` int(11) NOT NULL,
  `booked_price` decimal(10,2) DEFAULT NULL,
  `booked_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_status`
--

CREATE TABLE `booking_status` (
  `booking_status_id` int(11) NOT NULL,
  `booking_status_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'florists'),
(4, 'invitations'),
(5, 'ceremony Venue'),
(6, 'videograpers'),
(7, 'reception venue'),
(8, 'photographers'),
(9, 'bridal and groom wear'),
(10, 'caterers and beverages'),
(11, 'fireworks'),
(12, 'music'),
(13, 'wedding rings'),
(14, 'beauty services');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `is_group` tinyint(1) DEFAULT NULL,
  `chat_name` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_member`
--

CREATE TABLE `chat_member` (
  `chat_member_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message_content` text DEFAULT NULL,
  `sent_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `guest_id` int(11) NOT NULL,
  `wedding_plan_id` int(11) DEFAULT NULL,
  `guest_email` varchar(255) DEFAULT NULL,
  `guest_name` varchar(255) DEFAULT NULL,
  `guest_surname` varchar(255) DEFAULT NULL,
  `rsvp_status` enum('pending','accepted','declined') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`guest_id`, `wedding_plan_id`, `guest_email`, `guest_name`, `guest_surname`, `rsvp_status`) VALUES
(1, 4, 'kimberly@gmail.com', 'Kim', 'Borg', 'accepted'),
(2, 4, 'kimpara@gmail.com', 'Char', 'Borg', 'accepted'),
(3, 6, 'kim@gmail.com', 'Kevin', 'Hili', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `our_wedding`
--

CREATE TABLE `our_wedding` (
  `our_wedding_id` int(11) NOT NULL,
  `profile_image` varchar(500) DEFAULT NULL,
  `wedding_plan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `reset_password_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Couple'),
(3, 'Vendor'),
(17, 'Wedding Planner');

-- --------------------------------------------------------

--
-- Table structure for table `settings_theme`
--

CREATE TABLE `settings_theme` (
  `settings_theme_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dark_mode` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `task_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `category_id`, `task_name`) VALUES
(3, 1, 'booking'),
(4, 1, 'quotation');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `role_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password_hash`, `first_name`, `last_name`, `created_at`, `role_id`, `is_active`) VALUES
(2, 'kimberly.parascandalo@rocketfin.co', '$2y$10$vS4m85IGOB.mTUMdNZ7nEO0QcSbN3BW1ZLLpFq90vo7M4GXA1PO0O', 'Kimberly', 'Para', NULL, 3, 1),
(3, 'kimberly@mcast.edu.mt', '$2y$10$eC4fCYBEt/laWYGzt8RKIOJap9v19yKmuMmNuTslx7CvjzmEAYlSC', 'Kim', 'Para', '2026-03-30 20:06:54', 2, 1),
(11, 'kimberlymcast.edu.mt', '$2y$10$MldM9tvVlPUZ8D4ZVshT2O29da3TuG.tNG/NP7lhQsBEdDgLYl5CS', 'Kim', 'Para', '2026-04-17 18:22:16', 2, 1),
(12, 'kimb@mcast.edu.mt', '$2y$10$nzNCClj1PDUbiUhit7bsbu2Gpw2Jn.5tLyAR7wrYy/RATc3gKhN7e', 'Kim', 'Para', '2026-04-17 18:41:39', 2, 1),
(13, 'cparahili@gmail.com', '$2y$10$XbaAi8fxOOi3HI1PqiCenuPx1GePbRyIsgw5uMWowMOmi068KUJJ6', 'Kimberly', 'Parascandalo', '2026-04-29 20:19:37', 2, 1),
(14, 'mayborg@gmail.com', '$2y$10$cnZQBamhu4i9eMkl4jEY6ePpSyaL0ujeDfd3X8b/4jfF7ddAdL50q', 'Mary', 'Borg', '2026-04-30 14:53:41', 2, 1),
(15, 'kparascanytrdalo@gmail.com', '$2y$10$1tj/g4BwVcYbgPg45b9U4OPBUy0qTnoASO3dTh3.t38.fmgJOSOYu', 'Kim', 'Parascandalo', '2026-04-30 15:02:54', 2, 1),
(16, 'kparaschnjklandalo@gmail.com', '$2y$10$VzLjZFXMMq5P3Rr7I5XuKuc6.sV2qAgpWstjuRRIeP/loSJzTIHwi', 'Kimberly', 'Parascandalo', '2026-04-30 15:04:47', 2, 1),
(17, 'kparascawerndalo@gmail.com', '$2y$10$4qwg4txqWPDYS6j9C67yW.pl620tGNJZjWxIhmy.N58s5YM/91XPG', 'Kimberly', 'Parascandalo', '2026-04-30 15:07:34', 2, 1),
(18, 'lolo@mcast.edu.mt', '$2y$10$JSgy80I8TtqlSz4gg59eYu2AbNRj0b3Yk6bCUNRbCkAB/H/a4XPi6', 'Kim', 'Para', '2026-05-01 10:27:27', 2, 1),
(19, 'kparascandalo@gmail.com', '$2y$10$.41UsG06EOAp3WGJIiaO3eDwV6TByqAuu4N6hsJhrkGjIxpFdyK.G', 'Kimberly', 'Parascandalo', '2026-05-03 13:39:20', 2, 1),
(20, 'kevinpara@gmail.com', '$2y$10$tzOnxMAV7bSanI0iTHeBBOTlB8qQUepnkd1k4/PUKxcU/Txx56lP6', 'Kevin', 'Parascandalo', '2026-05-03 13:43:49', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(500) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `locations` varchar(255) DEFAULT NULL,
  `basic_info` varchar(500) DEFAULT NULL,
  `min_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `vendor_name`, `category_id`, `user_id`, `locations`, `basic_info`, `min_price`) VALUES
(4, 'Andrew Gerardi Photography', 8, 2, 'Mobile', 'By 2017, some of my work was being noticed and I had a number of assignments. This necessitated serious investment in my gear to satisfy the range of work I was doing. In 2022, I switched all my camera bodies and lenses to a mirrorless system as I believe that, although yes, the photographer needs to be artist, technology is always improving and good tools help you achieve a better result. I am lucky enough to have had the opportunity of shooting different scenarios and subjects including weddin', 1200.00),
(5, 'Flower Land', 1, 3, 'Qormi', 'The company specializes in seasonal gifts and decorations, with a wide selection for Christmas and Valentine’s amongst the many special yearly occasions. Flower Land provides the best quality service on the island to some of Malta’s leading hotels and restaurants, high profile conferences and meetings, weddings, private occasions, funerals, hospitals.', 800.00),
(8, 'Romano Cassar', 1, 3, 'Qormi', 'Now that the date is set, it’s time to talk flowers. We create and deliver innovative wedding floral designs and bridal bouquets inspired by you. Using only the finest and freshest flowers available, we provide you with stunning arrangements that match your personality. From bridal bouquets, bridesmaids’ flowers and buttonholes to garlands, table centrepieces, romantic archways, and floral installations – everything you need for your wedding look.', 750.00);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_image`
--

CREATE TABLE `vendor_image` (
  `vendor_image_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor_image`
--

INSERT INTO `vendor_image` (`vendor_image_id`, `vendor_id`, `image_path`) VALUES
(4, 4, 'assets/vendor_images/andrew_gerardi1.jpg'),
(5, 4, 'assets/vendor_images/andrew_gerardi2.jpg'),
(6, 4, 'assets/vendor_images/andrew_gerardi3.jpg'),
(7, 5, 'assets/vendor_images/flower_land1.jpg'),
(8, 5, 'assets/vendor_images/flower_land2.jpg'),
(9, 5, 'assets/vendor_images/flower_land3.jpg'),
(13, 8, 'assets/vendor_images/romano_cassar1.jpg'),
(14, 8, 'assets/vendor_images/romano_cassar2.jpg'),
(15, 8, 'assets/vendor_images/romano_cassar3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wedding_plan`
--

CREATE TABLE `wedding_plan` (
  `wedding_plan_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_nickname` varchar(100) DEFAULT NULL,
  `partner_nickname` varchar(100) DEFAULT NULL,
  `wedding_date` date DEFAULT NULL,
  `guest_count` int(11) DEFAULT NULL,
  `budget` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wedding_plan`
--

INSERT INTO `wedding_plan` (`wedding_plan_id`, `user_id`, `user_nickname`, `partner_nickname`, `wedding_date`, `guest_count`, `budget`, `created_at`) VALUES
(4, 2, 'Kitty', 'Mike', '2028-01-03', 300, 100000.50, '2026-04-02 15:02:40'),
(6, 3, 'Kate', 'Borg', '2026-01-02', 400, 70000.00, '2026-04-18 13:50:29'),
(7, 14, 'MayFlower', 'Kitten', '2028-02-13', 200, 35000.00, '2026-05-03 10:28:57'),
(8, 19, 'Kimmy', 'Puppy', '2030-08-30', 200, 37000.00, '2026-05-03 13:45:16');

-- --------------------------------------------------------

--
-- Table structure for table `wedding_plan_category`
--

CREATE TABLE `wedding_plan_category` (
  `wedding_plan_category_id` int(11) NOT NULL,
  `wedding_plan_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wedding_plan_category`
--

INSERT INTO `wedding_plan_category` (`wedding_plan_category_id`, `wedding_plan_id`, `category_id`) VALUES
(50, 7, 1),
(51, 7, 4),
(47, 7, 5),
(52, 7, 6),
(48, 7, 7),
(49, 7, 9),
(53, 7, 12),
(64, 8, 1),
(61, 8, 5),
(62, 8, 7),
(63, 8, 9),
(65, 8, 10),
(66, 8, 11),
(67, 8, 12);

-- --------------------------------------------------------

--
-- Table structure for table `wedding_plan_task`
--

CREATE TABLE `wedding_plan_task` (
  `wedding_plan_task_id` int(11) NOT NULL,
  `wedding_plan_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `is_selected` tinyint(1) DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `is_completed` tinyint(1) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `wedding_plan_id` (`wedding_plan_id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `booking_status_id` (`booking_status_id`);

--
-- Indexes for table `booking_status`
--
ALTER TABLE `booking_status`
  ADD PRIMARY KEY (`booking_status_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `chat_member`
--
ALTER TABLE `chat_member`
  ADD PRIMARY KEY (`chat_member_id`),
  ADD KEY `chat_id` (`chat_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`),
  ADD KEY `chat_id` (`chat_id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`guest_id`),
  ADD KEY `wedding_plan_id` (`wedding_plan_id`);

--
-- Indexes for table `our_wedding`
--
ALTER TABLE `our_wedding`
  ADD PRIMARY KEY (`our_wedding_id`),
  ADD KEY `wedding_plan_id` (`wedding_plan_id`);

--
-- Indexes for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`reset_password_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `unique_role_name` (`role_name`);

--
-- Indexes for table `settings_theme`
--
ALTER TABLE `settings_theme`
  ADD PRIMARY KEY (`settings_theme_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `vendor_image`
--
ALTER TABLE `vendor_image`
  ADD PRIMARY KEY (`vendor_image_id`);

--
-- Indexes for table `wedding_plan`
--
ALTER TABLE `wedding_plan`
  ADD PRIMARY KEY (`wedding_plan_id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wedding_plan_category`
--
ALTER TABLE `wedding_plan_category`
  ADD PRIMARY KEY (`wedding_plan_category_id`),
  ADD UNIQUE KEY `wedding_plan_id` (`wedding_plan_id`,`category_id`);

--
-- Indexes for table `wedding_plan_task`
--
ALTER TABLE `wedding_plan_task`
  ADD PRIMARY KEY (`wedding_plan_task_id`),
  ADD UNIQUE KEY `unique_wpt` (`wedding_plan_id`,`category_id`,`task_id`),
  ADD UNIQUE KEY `unique_wpt_category_task` (`wedding_plan_id`,`category_id`,`task_id`),
  ADD KEY `wedding_plan_id` (`wedding_plan_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `fk_wpt_category` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_status`
--
ALTER TABLE `booking_status`
  MODIFY `booking_status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_member`
--
ALTER TABLE `chat_member`
  MODIFY `chat_member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `our_wedding`
--
ALTER TABLE `our_wedding`
  MODIFY `our_wedding_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `reset_password_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `settings_theme`
--
ALTER TABLE `settings_theme`
  MODIFY `settings_theme_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vendor_image`
--
ALTER TABLE `vendor_image`
  MODIFY `vendor_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wedding_plan`
--
ALTER TABLE `wedding_plan`
  MODIFY `wedding_plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wedding_plan_category`
--
ALTER TABLE `wedding_plan_category`
  MODIFY `wedding_plan_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `wedding_plan_task`
--
ALTER TABLE `wedding_plan_task`
  MODIFY `wedding_plan_task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`wedding_plan_id`) REFERENCES `wedding_plan` (`wedding_plan_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`),
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`booking_status_id`) REFERENCES `booking_status` (`booking_status_id`);

--
-- Constraints for table `chat_member`
--
ALTER TABLE `chat_member`
  ADD CONSTRAINT `chat_member_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`chat_id`),
  ADD CONSTRAINT `chat_member_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD CONSTRAINT `chat_message_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`chat_id`),
  ADD CONSTRAINT `chat_message_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `guest`
--
ALTER TABLE `guest`
  ADD CONSTRAINT `guest_ibfk_1` FOREIGN KEY (`wedding_plan_id`) REFERENCES `wedding_plan` (`wedding_plan_id`);

--
-- Constraints for table `our_wedding`
--
ALTER TABLE `our_wedding`
  ADD CONSTRAINT `our_wedding_ibfk_1` FOREIGN KEY (`wedding_plan_id`) REFERENCES `wedding_plan` (`wedding_plan_id`);

--
-- Constraints for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD CONSTRAINT `reset_password_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `settings_theme`
--
ALTER TABLE `settings_theme`
  ADD CONSTRAINT `settings_theme_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `vendor_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `vendor_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `wedding_plan`
--
ALTER TABLE `wedding_plan`
  ADD CONSTRAINT `wedding_plan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `wedding_plan_task`
--
ALTER TABLE `wedding_plan_task`
  ADD CONSTRAINT `fk_wpt_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `wedding_plan_task_ibfk_1` FOREIGN KEY (`wedding_plan_id`) REFERENCES `wedding_plan` (`wedding_plan_id`),
  ADD CONSTRAINT `wedding_plan_task_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

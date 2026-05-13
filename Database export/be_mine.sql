-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2026 at 07:17 PM
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
  `category_name` varchar(255) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `slug`) VALUES
(1, 'Florists', 'florists'),
(4, 'Invitations', 'invitations'),
(5, 'Ceremony Venue', 'ceremony_venue'),
(6, 'Videograpers', 'videograpers'),
(7, 'Reception Venue', 'reception_venue'),
(8, 'Photographers', 'photographers'),
(9, 'Bridal Wear', 'bridal_wear'),
(10, 'Caterers', 'caterers'),
(11, 'Fireworks', 'fireworks'),
(12, 'Live Bands', 'live_bands'),
(13, 'Wedding Rings', 'wedding_rings'),
(14, 'Makeup Artists', 'makeup_artists'),
(15, 'Nail Artists', 'nail_artists'),
(16, 'Hair Stylists', 'hair_stylists'),
(17, 'Groom Wear', 'groom_wear'),
(18, 'Bridesmaid Dresses', 'bridesmaid_dresses'),
(19, 'Beverage Services', 'beverage_services'),
(20, 'Cocktail Bars', 'cocktail_bars'),
(21, 'Wedding Cars', 'wedding_cars'),
(22, 'Horse Carriages', 'horse_carriages'),
(23, 'Video Booths 360', '360_video_booths'),
(24, 'Children’s Entertainment', 'children_entertainment'),
(25, 'Singers', 'singers'),
(26, 'DJs', 'DJs'),
(27, 'Balloon Decorations', 'balloon_decorations'),
(28, 'Lighting Effects', 'lighting_effects'),
(31, 'Drone Videography', 'drone_videography');

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
-- Table structure for table `quotation_request`
--

CREATE TABLE `quotation_request` (
  `quotation_request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `estimated_price` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT 'requested',
  `requested_at` datetime DEFAULT current_timestamp()
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
(3, 'kimberly@mcast.edu.mt', '$2y$10$eC4fCYBEt/laWYGzt8RKIOJap9v19yKmuMmNuTslx7CvjzmEAYlSC', 'Kim', 'Para', '2026-03-30 20:06:54', 3, 1),
(11, 'kimberlymcast.edu.mt', '$2y$10$MldM9tvVlPUZ8D4ZVshT2O29da3TuG.tNG/NP7lhQsBEdDgLYl5CS', 'Kim', 'Para', '2026-04-17 18:22:16', 3, 1),
(12, 'kimb@mcast.edu.mt', '$2y$10$nzNCClj1PDUbiUhit7bsbu2Gpw2Jn.5tLyAR7wrYy/RATc3gKhN7e', 'Kim', 'Para', '2026-04-17 18:41:39', 2, 1),
(13, 'chparahili@gmail.com', '', 'Kimberly', 'Parascandalo', '2026-04-29 20:19:37', 2, 1),
(14, 'mayborg@gmail.com', '$2y$10$cnZQBamhu4i9eMkl4jEY6ePpSyaL0ujeDfd3X8b/4jfF7ddAdL50q', 'Mary', 'Borg', '2026-04-30 14:53:41', 2, 1),
(15, 'kparascanytrdalo@gmail.com', '$2y$10$1tj/g4BwVcYbgPg45b9U4OPBUy0qTnoASO3dTh3.t38.fmgJOSOYu', 'Kim', 'Parascandalo', '2026-04-30 15:02:54', 2, 1),
(16, 'kparaschnjklandalo@gmail.com', '$2y$10$VzLjZFXMMq5P3Rr7I5XuKuc6.sV2qAgpWstjuRRIeP/loSJzTIHwi', 'Kimberly', 'Parascandalo', '2026-04-30 15:04:47', 2, 1),
(17, 'kparascawerndalo@gmail.com', '$2y$10$4qwg4txqWPDYS6j9C67yW.pl620tGNJZjWxIhmy.N58s5YM/91XPG', 'Kimberly', 'Parascandalo', '2026-04-30 15:07:34', 2, 1),
(18, 'lolo@mcast.edu.mt', '$2y$10$JSgy80I8TtqlSz4gg59eYu2AbNRj0b3Yk6bCUNRbCkAB/H/a4XPi6', 'Kim', 'Para', '2026-05-01 10:27:27', 2, 1),
(19, 'kparascandalo@gmail.com', '$2y$10$.41UsG06EOAp3WGJIiaO3eDwV6TByqAuu4N6hsJhrkGjIxpFdyK.G', 'Kimberly', 'Parascandalo', '2026-05-03 13:39:20', 2, 1),
(20, 'kevinpara@gmail.com', '$2y$10$tzOnxMAV7bSanI0iTHeBBOTlB8qQUepnkd1k4/PUKxcU/Txx56lP6', 'Kevin', 'Parascandalo', '2026-05-03 13:43:49', 2, 1),
(21, 'cparahili@gmail.com', '$2y$10$krPx0e9lQfFQz/uvMlGIQOrwU7RRA/n6tHtMzNMELEnIKXWnjPuD6', 'Charmaine', 'Hili', '2026-05-12 15:35:12', 2, 1);

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
(4, 'Eternal Lens Co.', 8, 2, 'Mobile', 'By 2017, some of my work was being noticed and I had a number of assignments. This necessitated serious investment in my gear to satisfy the range of work I was doing. In 2022, I switched all my camera bodies and lenses to a mirrorless system as I believe that, although yes, the photographer needs to be artist, technology is always improving and good tools help you achieve a better result. I am lucky enough to have had the opportunity of shooting different scenarios and subjects including weddin', 1200.00),
(5, 'Forever Flowers', 1, 3, 'Qormi', 'The company specializes in seasonal gifts and decorations, with a wide selection for Christmas and Valentine’s amongst the many special yearly occasions. Flower Land provides the best quality service on the island to some of Malta’s leading hotels and restaurants, high profile conferences and meetings, weddings, private occasions, funerals, hospitals.', 800.00),
(11, 'Pearl Ink Designs', 4, 2, 'Rabat', 'We are a family business and we run different businesses/projects that complement each other in providing excellent customer service in every area that we operate in. Each project is focused on a particular service that we can provide to our customers. Stampatur.com is a design and printing service focused on delivering rapid design and printing services professionally at an affordable price. We take pride in our ability to understand our customers and come up with the right solutions.', 400.00),
(12, 'Golden Olive Catering', 10, 2, 'Paola', 'Founded in 1969, Neriku Catering has garnered 50 years of experience in the catering industry, providing top quality service at affordable prices. Everything we do is done with passion and utmost dedication.', 12000.00),
(13, 'Dream Bouquet Co.', 1, 2, 'Fgura', 'Founded in 1969, Neriku Catering has garnered 50 years of experience in the catering industry, providing top quality service at affordable prices. Everything we do is done with passion and utmost dedication.', 11000.00),
(14, 'EverAfter Dresses', 9, 11, 'Fgura', 'We believe every bride deserves to feel confident, beautiful, and unforgettable on her special day. Our bridal collection combines timeless elegance with modern design, offering carefully selected gowns for every wedding style.', 400.00),
(15, 'Golden Horizon Venue', 7, 11, 'Mellieha', 'We believe every love story deserves a beautiful setting. Our venue offers romantic gardens, elegant spaces, and personalised service to help create unforgettable wedding memories.', 6000.00);

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
(4, 4, 'assets/vendor_images/eternalLens1.jpg'),
(5, 4, 'assets/vendor_images/eternalLens2.jpg'),
(6, 4, 'assets/vendor_images/eternalLens3.jpg'),
(7, 5, 'assets/vendor_images/foreverFlowers1.jpg'),
(8, 5, 'assets/vendor_images/foreverFlowers2.jpg'),
(9, 5, 'assets/vendor_images/foreverFlowers3.jpg'),
(25, 1, 'assets/vendor_images/dreamBouquet1.jpg'),
(26, 1, 'assets/vendor_images/dreamBouquet2.jpg'),
(27, 1, 'assets/vendor_images/dreamBouquet3.jpg'),
(43, 11, 'assets/vendor_images/pearlInk1.jpg'),
(44, 11, 'assets/vendor_images/pearlInk2.jpg'),
(45, 11, 'assets/vendor_images/pearlInk3.jpg'),
(46, 12, 'assets/vendor_images/GoldenOlive1.jpg'),
(47, 12, 'assets/vendor_images/GoldenOlive2.jpg'),
(48, 12, 'assets/vendor_images/GoldenOlive3.jpg'),
(52, 13, 'assets/vendor_images/dreamBouquet1.jpg'),
(53, 13, 'assets/vendor_images/dreamBouquet2.jpg'),
(54, 13, 'assets/vendor_images/dreamBouquet3.jpg'),
(58, 8, 'assets/vendor_images/stampatur1.jpg'),
(59, 8, 'assets/vendor_images/stampatur2.jpg'),
(60, 8, 'assets/vendor_images/stampatur3.jpg'),
(61, 14, 'assets/vendor_images/EverAfterDresses1.jpg'),
(62, 14, 'assets/vendor_images/EverAfterDresses2.jpg'),
(63, 14, 'assets/vendor_images/EverAfterDresses3.jpg'),
(67, 15, 'assets/vendor_images/GoldenHorizonVenue1.jpg'),
(68, 15, 'assets/vendor_images/GoldenHorizonVenue2.jpg'),
(69, 15, 'assets/vendor_images/GoldenHorizonVenue3.jpg');

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
(7, 14, 'MayFlower', 'Kitten', '2028-02-13', 300, 35000.00, '2026-05-03 10:28:57'),
(8, 19, 'Kimmy', 'Puppy', '2030-08-30', 200, 37000.00, '2026-05-03 13:45:16'),
(17, 21, 'Charm', 'Tommy', '2028-10-15', 300, 40000.00, '2026-05-12 15:40:37'),
(19, 20, 'Kim', 'Tim', '2027-01-02', 300, 60000.00, '2026-05-13 18:31:00');

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
(376, 7, 1),
(378, 7, 4),
(371, 7, 5),
(381, 7, 6),
(380, 7, 7),
(369, 7, 9),
(370, 7, 10),
(375, 7, 11),
(379, 7, 12),
(382, 7, 13),
(377, 7, 17),
(368, 7, 19),
(373, 7, 20),
(372, 7, 24),
(374, 7, 26),
(367, 7, 27),
(64, 8, 1),
(61, 8, 5),
(62, 8, 7),
(63, 8, 9),
(65, 8, 10),
(66, 8, 11),
(67, 8, 12),
(390, 16, 1),
(392, 16, 4),
(387, 16, 5),
(397, 16, 7),
(396, 16, 8),
(384, 16, 9),
(386, 16, 10),
(389, 16, 11),
(393, 16, 12),
(399, 16, 13),
(394, 16, 14),
(395, 16, 15),
(391, 16, 16),
(385, 16, 18),
(383, 16, 19),
(398, 16, 21),
(388, 16, 31),
(622, 17, 1),
(625, 17, 4),
(617, 17, 5),
(629, 17, 7),
(628, 17, 8),
(614, 17, 9),
(616, 17, 10),
(621, 17, 11),
(626, 17, 12),
(631, 17, 13),
(627, 17, 15),
(624, 17, 16),
(623, 17, 17),
(615, 17, 18),
(613, 17, 19),
(630, 17, 21),
(618, 17, 24),
(619, 17, 26),
(612, 17, 27),
(620, 17, 31),
(668, 19, 1),
(670, 19, 4),
(673, 19, 6),
(671, 19, 7),
(664, 19, 9),
(665, 19, 10),
(675, 19, 13),
(669, 19, 16),
(674, 19, 21),
(672, 19, 23),
(666, 19, 24),
(667, 19, 26),
(663, 19, 27);

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
-- Dumping data for table `wedding_plan_task`
--

INSERT INTO `wedding_plan_task` (`wedding_plan_task_id`, `wedding_plan_id`, `task_id`, `is_selected`, `completed_at`, `is_completed`, `category_id`) VALUES
(222, 17, NULL, 1, '2026-05-12 19:17:41', 1, 9),
(224, 17, NULL, 1, '2026-05-12 19:17:41', 1, 10),
(227, 17, NULL, 1, NULL, 0, 26),
(242, 19, NULL, 1, NULL, 0, 9),
(243, 19, NULL, 1, '2026-05-13 18:55:58', 1, 10),
(245, 19, NULL, 1, '2026-05-13 18:55:58', 1, 26),
(254, 19, NULL, 1, NULL, 0, 27),
(255, 19, NULL, 1, NULL, 0, 24),
(256, 19, NULL, 1, NULL, 0, 1),
(257, 19, NULL, 1, NULL, 0, 16),
(258, 19, NULL, 1, NULL, 0, 4),
(259, 19, NULL, 1, NULL, 0, 7),
(260, 19, NULL, 1, NULL, 0, 23),
(261, 19, NULL, 1, NULL, 0, 6),
(262, 19, NULL, 1, NULL, 0, 21),
(263, 19, NULL, 1, NULL, 0, 13);

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
-- Indexes for table `quotation_request`
--
ALTER TABLE `quotation_request`
  ADD PRIMARY KEY (`quotation_request_id`);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
-- AUTO_INCREMENT for table `quotation_request`
--
ALTER TABLE `quotation_request`
  MODIFY `quotation_request_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vendor_image`
--
ALTER TABLE `vendor_image`
  MODIFY `vendor_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `wedding_plan`
--
ALTER TABLE `wedding_plan`
  MODIFY `wedding_plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wedding_plan_category`
--
ALTER TABLE `wedding_plan_category`
  MODIFY `wedding_plan_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=676;

--
-- AUTO_INCREMENT for table `wedding_plan_task`
--
ALTER TABLE `wedding_plan_task`
  MODIFY `wedding_plan_task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

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
  ADD CONSTRAINT `fk_vendor_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
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

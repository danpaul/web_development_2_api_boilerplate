-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Nov 30, 2021 at 02:48 PM
-- Server version: 10.6.4-MariaDB-1:10.6.4+maria~focal
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `author` varchar(255) NOT NULL,
  `posted_at` datetime  DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Dumping data for table `article`
--
INSERT INTO `articles` (`id`, `title`, `content`, `author`, `posted_at`) VALUES
(1, 'The Future of AI', 'Artificial intelligence is reshaping industries...', 'John Doe', NOW()),
(2, 'Exploring the Ocean Depths', 'The deep sea remains one of the last frontiers...', 'Jane Smith', NOW()),
(3, 'Space Travel in the 21st Century', 'With private companies entering the space race...', 'Alice Johnson', NOW()),
(4, 'The Evolution of Smartphones', 'From basic cell phones to powerful mini-computers...', 'Bob Brown', NOW()),
(5, 'Sustainable Energy Solutions', 'Solar and wind energy are gaining traction...', 'Emily White', NOW()),
(6, 'Advancements in Quantum Computing', 'Quantum computers are pushing the boundaries of computation...', 'David Green', NOW()),
(7, 'The Impact of Social Media', 'Social media platforms have changed how we communicate...', 'Olivia Martinez', NOW()),
(8, 'The Rise of Electric Vehicles', 'EVs are becoming more accessible and widespread...', 'Daniel Wilson', NOW()),
(9, 'Cybersecurity in the Digital Age', 'Protecting data has never been more critical...', 'Sophia Brown', NOW()),
(10, 'The Role of Biotechnology', 'Gene editing and medical advancements are revolutionizing healthcare...', 'James Anderson', NOW()),
(11, 'Climate Change and Its Effects', 'The planet is experiencing unprecedented climate shifts...', 'Sarah Johnson', NOW()),
(12, 'The Evolution of Video Games', 'Gaming has evolved from simple pixels to immersive experiences...', 'Michael Scott', NOW()),
(13, 'Breakthroughs in Medicine', 'New treatments and drugs are extending lifespans...', 'Anna Thomas', NOW()),
(14, 'The Influence of Artificial Reality', 'Virtual and augmented reality are shaping industries...', 'Chris White', NOW()),
(15, 'The Science Behind Nutrition', 'Understanding diet and health is more important than ever...', 'Jessica Parker', NOW()),
(16, 'The Future of Work', 'Remote work and AI automation are redefining jobs...', 'Matthew Lewis', NOW()),
(17, 'Space Colonization', 'Plans for Mars and beyond are becoming more realistic...', 'Emma Roberts', NOW()),
(18, 'Exploring the Human Mind', 'Neuroscience is unlocking the secrets of cognition...', 'Robert King', NOW()),
(19, 'Modern Architecture Trends', 'Sustainable and smart designs are leading construction...', 'Laura Hall', NOW()),
(20, 'The Renaissance of Board Games', 'Tabletop games are making a big comeback...', 'Andrew Carter', NOW()),
(21, 'Blockchain Beyond Cryptocurrency', 'Decentralized applications are transforming industries...', 'Nathan Perez', NOW()),
(22, 'Renewable Energy Innovations', 'New materials and technologies are improving efficiency...', 'Isabella Walker', NOW()),
(23, 'AI in Creative Industries', 'Artificial intelligence is influencing art and music...', 'Liam Harris', NOW()),
(24, 'The Psychology of Happiness', 'Science-backed methods for leading a fulfilling life...', 'Sophia Nelson', NOW()),
(25, 'The Importance of Mental Health', 'Society is prioritizing well-being like never before...', 'Ethan Moore', NOW()),
(26, 'Automation in Everyday Life', 'Smart devices and AI assistants are becoming standard...', 'Ava Cooper', NOW()),
(27, 'Advancements in Space Telescopes', 'New observatories are uncovering deep-space secrets...', 'Benjamin Adams', NOW()),
(28, 'The Evolution of Online Shopping', 'E-commerce is changing how consumers buy goods...', 'Zoe Brooks', NOW()),
(29, 'The Role of Robotics in Industry', 'Automation is streamlining production across sectors...', 'Henry Phillips', NOW()),
(30, 'The Art of Storytelling in Media', 'Engaging narratives are key to successful content...', 'Charlotte Stewart', NOW()),
(31, 'The Future of Education', 'Online learning is transforming how we acquire knowledge...', 'Michael Adams', NOW());

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

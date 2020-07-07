-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2019 at 04:54 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectmonitordb`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_task`
--

CREATE TABLE `assign_task` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task` text,
  `assigned_date` date DEFAULT NULL,
  `start_date` date NOT NULL,
  `completion_date` date DEFAULT NULL,
  `status` varchar(11) DEFAULT 'Incomplete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_title` varchar(255) DEFAULT NULL,
  `project_owner` varchar(30) DEFAULT NULL,
  `project_head` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` varchar(15) DEFAULT 'Ongoing',
  `stakeholders` text,
  `description` text,
  `date_created` datetime DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects_update`
--

CREATE TABLE `projects_update` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `update_text` text,
  `date_added` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `member_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `member_role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstName`, `lastName`, `email`, `password`, `user_role`) VALUES
(1, 'Jafar', 'Agbelekale', 'jafar.agbelekale@mainone.net', 'jafar1234', 'admin'),
(4, 'Amir', 'Sanni', 'amir.sanni@mainone.net', 'amir1234', 'admin'),
(5, 'Kolade ', 'Ige', 'kolade.ige@mainone.net', 'kolade1234', 'admin'),
(6, 'Tawhid', 'Kassim', 'tawhid.kassim@mainone.net', 'tawhid12334', 'user'),
(8, 'Ameen', 'Majaro', 'ameen.majaro@mainone.net', 'ameen1234', 'user'),
(9, 'Charles ', 'Nwaokukwu', 'charles.nwaokukwu@mainone.net', 'charles1234', 'user'),
(10, 'Bukola', 'Raji', 'bukola.raji@mainone.net', 'bukola1234', 'user'),
(11, 'Jeremiah', 'Agwu', 'jeremiah.agwu@mainone.net', 'jeremiah1234', 'admin'),
(12, 'Aja', 'Enyi', 'aja.enyi@mainone.net', 'aja1234', 'admin'),
(13, 'Ayodeji', 'Babatunde', 'ayodeji.babatunde@mainone.net', 'ayodeji1234', 'admin'),
(14, 'Ovua', 'Ezekiel', 'ovua.ezekiel@mainone.net', 'ovua1234', 'user'),
(18, 'Dipo', 'Onibile', 'dipo.onibile@mainone.net', 'Dipo1234', 'user'),
(23, 'Hadiza', 'Mamudu', 'hadiza.mamudu@mainone.net', 'hadiza1234', 'user'),
(24, 'Tolulope', 'Dairo', 'tolulope.dairo@mainone.net', 'Tolulope1234', 'user'),
(57, 'Ade', 'Agbelekale', 'jafarolamidekale@gmail.com', 'Ade1234', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_task`
--
ALTER TABLE `assign_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `projects_update`
--
ALTER TABLE `projects_update`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_task`
--
ALTER TABLE `assign_task`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects_update`
--
ALTER TABLE `projects_update`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_members`
--
ALTER TABLE `project_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects_update`
--
ALTER TABLE `projects_update`
  ADD CONSTRAINT `projects_update_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

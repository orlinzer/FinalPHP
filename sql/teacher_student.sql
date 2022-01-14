-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2022 at 01:36 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ypo_ide`
--

-- --------------------------------------------------------

--
-- Table structure for table `teacher_student`
--

CREATE TABLE `teacher_student` (
  `teacher` varchar(16) NOT NULL,
  `student` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teacher_student`
--
ALTER TABLE `teacher_student`
  ADD UNIQUE KEY `teacher` (`teacher`),
  ADD UNIQUE KEY `student` (`student`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teacher_student`
--
ALTER TABLE `teacher_student`
  ADD CONSTRAINT `teacher_student_ibfk_1` FOREIGN KEY (`student`) REFERENCES `users` (`name`),
  ADD CONSTRAINT `teacher_student_ibfk_2` FOREIGN KEY (`teacher`) REFERENCES `users` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

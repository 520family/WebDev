-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2021 at 06:34 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `concertbooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(18) NOT NULL,
  `password` varchar(18) NOT NULL,
  `first_name` varchar(18) NOT NULL,
  `last_name` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `password`, `first_name`, `last_name`) VALUES
('001', '123456', 'Low', 'Zi Jian'),
('admin123', 'haha123', 'AdminTerence', 'Tan'),
('admintest', 'haha1234', 'Admin Terence', 'Tan');

-- --------------------------------------------------------

--
-- Table structure for table `concert`
--

CREATE TABLE `concert` (
  `id` int(11) NOT NULL,
  `name` varchar(18) NOT NULL,
  `type` varchar(18) NOT NULL,
  `details` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `admin_id` varchar(18) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `concert`
--

INSERT INTO `concert` (`id`, `name`, `type`, `details`, `date`, `start_time`, `end_time`, `admin_id`, `image_path`) VALUES
(20000, 'Drake Singing', 'Classical', 'AubreyDrakeGraham[5] (born October 24, 1986) is a Canadian rapper, singer, songwriter, actor, and entrepreneur.[6] ', '2020-06-16', '09:52:39', '11:00:00', '001', 'image/drake.jpg'),
(20002, 'Chore Sing', 'Threatical', 'qeqrqwqewqw', '2020-06-15', '09:52:39', '16:52:39', '001', 'image/threatical_concert.png'),
(20018, 'concertA', 'Classical', 'test12123123123', '2021-02-21', '21:06:00', '23:06:00', 'admin123', 'image/6022508659db44.png'),
(20019, 'ConcertB', 'Recital', 'testconcertB', '2021-02-15', '22:05:00', '12:50:00', 'admintest', 'image/6024c5b12b9ab461Weavile-300x300.png'),
(20020, 'Ahmad', 'Classical', 'ewrwerwerwer', '2021-02-21', '15:56:00', '17:56:00', 'admintest', 'image/6024c706e25953.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `user_id` varchar(18) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `concert_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `user_id`, `status`, `concert_id`, `total_price`) VALUES
(50095, 'ABC', 1, 20000, 50),
(50111, 'ABC', 1, 20000, 25),
(50113, 'ABC', 1, 20000, 25),
(50114, 'ABC', 0, 20000, 72),
(50118, 'user1234', 0, 20000, 54),
(50119, 'test1234', 0, 20000, 101);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_seat`
--

CREATE TABLE `reservation_seat` (
  `id` int(11) NOT NULL,
  `seat_id` varchar(18) NOT NULL,
  `reservation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation_seat`
--

INSERT INTO `reservation_seat` (`id`, `seat_id`, `reservation_id`) VALUES
(40062, 'A-1', 50095),
(40063, 'A-2', 50095),
(40078, 'A-5', 50111),
(40080, 'A-7', 50113),
(40081, 'J-1', 50114),
(40082, 'J-2', 50114),
(40083, 'J-3', 50114),
(40089, 'A-3', 50118),
(40090, 'A-4', 50118),
(40091, 'C-4', 50119),
(40092, 'D-3', 50119),
(40093, 'E-2', 50119),
(40094, 'F-4', 50119);

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id` varchar(18) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`id`, `price`) VALUES
('A-1', 27),
('A-10', 27),
('A-2', 27),
('A-3', 27),
('A-4', 27),
('A-5', 27),
('A-6', 27),
('A-7', 27),
('A-8', 27),
('A-9', 27),
('B-1', 26),
('B-10', 26),
('B-2', 26),
('B-3', 26),
('B-4', 26),
('B-5', 26),
('B-6', 26),
('B-7', 26),
('B-8', 26),
('B-9', 26),
('C-1', 26),
('C-10', 26),
('C-2', 26),
('C-3', 26),
('C-4', 26),
('C-5', 26),
('C-6', 26),
('C-7', 26),
('C-8', 26),
('C-9', 26),
('D-1', 25),
('D-10', 25),
('D-2', 25),
('D-3', 25),
('D-4', 25),
('D-5', 25),
('D-6', 25),
('D-7', 25),
('D-8', 25),
('D-9', 25),
('E-1', 25),
('E-10', 25),
('E-2', 25),
('E-3', 25),
('E-4', 25),
('E-5', 25),
('E-6', 25),
('E-7', 25),
('E-8', 25),
('E-9', 25),
('F-1', 25),
('F-10', 25),
('F-2', 25),
('F-3', 25),
('F-4', 25),
('F-5', 25),
('F-6', 25),
('F-7', 25),
('F-8', 25),
('F-9', 25),
('G-1', 25),
('G-10', 25),
('G-2', 25),
('G-3', 25),
('G-4', 25),
('G-5', 25),
('G-6', 25),
('G-7', 25),
('G-8', 25),
('G-9', 25),
('H-1', 24),
('H-10', 24),
('H-2', 24),
('H-3', 24),
('H-4', 24),
('H-5', 24),
('H-6', 24),
('H-7', 24),
('H-8', 24),
('H-9', 24),
('I-1', 24),
('I-10', 24),
('I-2', 24),
('I-3', 24),
('I-4', 24),
('I-5', 24),
('I-6', 24),
('I-7', 24),
('I-8', 24),
('I-9', 24),
('J-1', 24),
('J-10', 24),
('J-2', 24),
('J-3', 24),
('J-4', 24),
('J-5', 24),
('J-6', 24),
('J-7', 24),
('J-8', 24),
('J-9', 24);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(18) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(18) NOT NULL,
  `last_name` varchar(18) NOT NULL,
  `address` varchar(80) NOT NULL,
  `phone_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `password`, `first_name`, `last_name`, `address`, `phone_num`) VALUES
('ABC', '$2y$10$agYk4z4hEHY', 'Low', 'Zi Jian', '1,abc,abc', 142356),
('test1234', '$2y$10$b8TW76js0hLOBI7OH42at.SOyOItGkmHVZOodCNJE2vJPoVc/6FQ.', 'Terence', 'Tan', 'No 34, Jalan PU 1/3, Taman Puchong Utama, 47100 Puchong ', 1123773617),
('user123', '$2y$10$OR.NELo61rS', 'terence', 'tan', 'iweiwure', 0),
('user1234', '$2y$10$7gNOhlLDS/Ik.35xzTNX2O/4URrQ1/hgFNnsqlts71USJHHVKnJfS', 'Terence', 'Tan', 'iweiwure', 123123123),
('user1234111', '$2y$10$PWvdV/x9Hs9', 'Terence', 'Tan', 'iweiwure', 1234567);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `concert`
--
ALTER TABLE `concert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign3` (`admin_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign1` (`user_id`),
  ADD KEY `foreign2` (`concert_id`);

--
-- Indexes for table `reservation_seat`
--
ALTER TABLE `reservation_seat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign5` (`seat_id`),
  ADD KEY `foreign6` (`reservation_id`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `concert`
--
ALTER TABLE `concert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20021;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50121;

--
-- AUTO_INCREMENT for table `reservation_seat`
--
ALTER TABLE `reservation_seat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40096;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `concert`
--
ALTER TABLE `concert`
  ADD CONSTRAINT `foreign3` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `foreign1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `foreign2` FOREIGN KEY (`concert_id`) REFERENCES `concert` (`id`);

--
-- Constraints for table `reservation_seat`
--
ALTER TABLE `reservation_seat`
  ADD CONSTRAINT `foreign5` FOREIGN KEY (`seat_id`) REFERENCES `seat` (`id`),
  ADD CONSTRAINT `foreign6` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

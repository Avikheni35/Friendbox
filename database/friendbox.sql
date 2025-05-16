-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 04:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `friendbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `advertise`
--

CREATE TABLE `advertise` (
  `ad_id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `image` varchar(256) NOT NULL,
  `link` varchar(256) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advertise`
--

INSERT INTO `advertise` (`ad_id`, `brand`, `image`, `link`, `datetime`) VALUES
(1, 'Amazon', '', 'www.amazon.in', '2024-03-31 18:52:44'),
(3, 'Amazon', 'amazon.png', 'www.amazon.in', '2024-03-31 18:58:36'),
(4, 'Amazon', 'amazon.png', 'https://www.amazon.in/', '2024-03-31 19:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `book_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`book_id`, `username`, `pid`, `datetime`) VALUES
(32, 'dipen123', 4, '2024-03-31 19:29:12'),
(33, 'avikheni35', 10, '2024-03-31 20:16:07'),
(35, 'avikheni35', 9, '2024-03-31 20:23:38');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `cid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `message` varchar(256) DEFAULT NULL,
  `posts` varchar(256) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`cid`, `username`, `user`, `message`, `posts`, `status`, `time`) VALUES
(1, 'dipen123', 'jensi1011', 'hello', NULL, 'sender', '2024-03-20 18:43:17'),
(2, 'jensi1011', 'dipen123', 'hello', NULL, 'receiver', '2024-03-20 18:43:17'),
(3, 'dipen123', 'avikheni35', 'hello avi', NULL, 'sender', '2024-03-20 18:43:28'),
(4, 'avikheni35', 'dipen123', 'hello avi', NULL, 'receiver', '2024-03-20 18:43:28'),
(5, 'avikheni35', 'jensi1011', 'hey jensi', NULL, 'sender', '2024-03-20 18:44:36'),
(6, 'jensi1011', 'avikheni35', 'hey jensi', NULL, 'receiver', '2024-03-20 18:44:36'),
(7, 'avikheni35', 'dipen123', 'bol bol dk', NULL, 'sender', '2024-03-20 18:44:45'),
(8, 'dipen123', 'avikheni35', 'bol bol dk', NULL, 'receiver', '2024-03-20 18:44:45'),
(9, 'jensi1011', 'avikheni35', 'hey avi', NULL, 'sender', '2024-03-20 18:45:19'),
(10, 'avikheni35', 'jensi1011', 'hey avi', NULL, 'receiver', '2024-03-20 18:45:19'),
(11, 'jensi1011', 'dipen123', 'hey dk', NULL, 'sender', '2024-03-20 18:45:27'),
(12, 'dipen123', 'jensi1011', 'hey dk', NULL, 'receiver', '2024-03-20 18:45:27'),
(13, 'jensi1011', 'dipen123', 'project thay gayo?', NULL, 'sender', '2024-03-20 18:45:35'),
(14, 'dipen123', 'jensi1011', 'project thay gayo?', NULL, 'receiver', '2024-03-20 18:45:35'),
(15, 'dipen123', 'jensi1011', 'ha thay gayo', NULL, 'sender', '2024-03-20 18:45:57'),
(16, 'jensi1011', 'dipen123', 'ha thay gayo', NULL, 'receiver', '2024-03-20 18:45:57'),
(17, 'dipen123', 'jensi1011', 'tare?', NULL, 'sender', '2024-03-20 18:46:02'),
(18, 'jensi1011', 'dipen123', 'tare?', NULL, 'receiver', '2024-03-20 18:46:02'),
(19, 'dipen123', 'avikheni35', 'shu kar cho?', NULL, 'sender', '2024-03-20 18:46:12'),
(20, 'avikheni35', 'dipen123', 'shu kar cho?', NULL, 'receiver', '2024-03-20 18:46:12'),
(21, 'avikheni35', 'dipen123', 'bs jo project', NULL, 'sender', '2024-03-20 18:46:47'),
(22, 'dipen123', 'avikheni35', 'bs jo project', NULL, 'receiver', '2024-03-20 18:46:47'),
(23, 'avikheni35', 'jensi1011', 'bol bol', NULL, 'sender', '2024-03-20 18:46:58'),
(24, 'jensi1011', 'avikheni35', 'bol bol', NULL, 'receiver', '2024-03-20 18:46:58'),
(25, 'avikheni35', 'dipen123', 'hello dipen', NULL, 'sender', '2024-03-21 08:00:25'),
(26, 'dipen123', 'avikheni35', 'hello dipen', NULL, 'receiver', '2024-03-21 08:00:25'),
(27, 'avikheni35', 'dipen123', NULL, '20230911_074709.jpg', 'sender', '2024-03-31 06:22:54'),
(28, 'dipen123', 'avikheni35', NULL, '20230911_074709.jpg', 'receiver', '2024-03-31 06:24:55'),
(53, 'dipen123', 'vinit123', NULL, '20230910_143515_portrait.jpg', 'sender', '2024-03-31 08:55:00'),
(54, 'vinit123', 'dipen123', NULL, '20230910_143515_portrait.jpg', 'receiver', '2024-03-31 08:55:00'),
(55, 'dipen123', 'avikheni35', 'hello', NULL, 'sender', '2024-03-31 09:01:17'),
(56, 'avikheni35', 'dipen123', 'hello', NULL, 'receiver', '2024-03-31 09:01:17'),
(57, 'dipen123', 'vinit123', 'do you know him?', NULL, 'sender', '2024-03-31 09:07:19'),
(58, 'vinit123', 'dipen123', 'do you know him?', NULL, 'receiver', '2024-03-31 09:07:19'),
(59, 'dipen123', 'vinit123', NULL, 'Screenshot_20240319_230550_Instagram.jpg', 'sender', '2024-03-31 13:37:42'),
(60, 'vinit123', 'dipen123', NULL, 'Screenshot_20240319_230550_Instagram.jpg', 'receiver', '2024-03-31 13:37:42');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cid` int(11) NOT NULL,
  `pid` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `commentby` varchar(20) NOT NULL,
  `comment` varchar(256) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cid`, `pid`, `username`, `commentby`, `comment`, `date_time`) VALUES
(1, 2, 'avikheni35', 'jensi1011', 'nice', '2024-03-21 00:09:46'),
(2, 2, 'avikheni35', 'jensi1011', 'looking fab', '2024-03-21 00:09:55'),
(3, 1, 'avikheni35', 'jensi1011', 'srs srs', '2024-03-21 00:10:07'),
(4, 4, 'jensi1011', 'dipen123', 'excellent', '2024-03-21 00:12:03'),
(5, 1, 'avikheni35', 'dipen123', 'excellent', '2024-03-21 00:12:36'),
(6, 3, 'jensi1011', 'dipen123', 'gorgeous', '2024-03-21 00:12:58'),
(7, 9, 'dipen123', 'avikheni35', 'handsome', '2024-03-21 00:13:53'),
(8, 3, 'jensi1011', 'avikheni35', 'beautiful', '2024-03-21 00:14:10'),
(9, 10, 'avikheni35', 'avikheni35', 'excellent', '2024-03-21 13:26:43'),
(10, 10, 'avikheni35', 'avikheni35', 'dfgh', '2024-03-21 13:28:16'),
(11, 3, 'jensi1011', 'avikheni35', 'hello', '2024-03-31 00:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `fid` int(11) NOT NULL,
  `followedby` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`fid`, `followedby`, `username`) VALUES
(3, 'avikheni35', 'vinit123'),
(5, 'jensi1011', 'dipen123'),
(7, 'dipen123', 'jensi1011'),
(8, 'dipen123', 'avikheni35'),
(10, 'avikheni35', 'jensi1011'),
(11, 'avikheni35', 'dipen123');

-- --------------------------------------------------------

--
-- Table structure for table `followings`
--

CREATE TABLE `followings` (
  `fid` int(11) NOT NULL,
  `following` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `followings`
--

INSERT INTO `followings` (`fid`, `following`, `username`) VALUES
(3, 'vinit123', 'avikheni35'),
(5, 'dipen123', 'jensi1011'),
(7, 'jensi1011', 'dipen123'),
(8, 'avikheni35', 'dipen123'),
(10, 'jensi1011', 'avikheni35'),
(11, 'dipen123', 'avikheni35');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `lid` int(11) NOT NULL,
  `likedby` varchar(20) NOT NULL,
  `pid` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`lid`, `likedby`, `pid`, `username`) VALUES
(1, 'avikheni35', '2', ''),
(2, 'avikheni35', '1', ''),
(9, 'jensi1011', '4', ''),
(10, 'jensi1011', '3', ''),
(11, 'jensi1011', '2', ''),
(12, 'jensi1011', '1', ''),
(13, 'dipen123', '9', ''),
(14, 'dipen123', '8', ''),
(15, 'dipen123', '4', ''),
(16, 'dipen123', '3', ''),
(17, 'dipen123', '2', ''),
(18, 'dipen123', '1', ''),
(19, 'avikheni35', '9', ''),
(20, 'avikheni35', '8', ''),
(21, 'avikheni35', '4', ''),
(23, 'jensi1011', '9', ''),
(31, 'avikheni35', '3', ''),
(36, 'dipen123', '10', ''),
(37, 'avikheni35', '10', '');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `caption` varchar(256) NOT NULL,
  `datetime` date NOT NULL DEFAULT current_timestamp(),
  `pid` int(11) NOT NULL,
  `source` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`caption`, `datetime`, `pid`, `source`, `username`) VALUES
('chilling...', '2024-03-20', 1, '20231227_205445.jpg', 'avikheni35'),
('enjoying vacation', '2024-03-20', 2, '20231114_192230_remastered.jpg', 'avikheni35'),
('with attitude...', '2024-03-21', 3, '20231120_105447.jpg', 'jensi1011'),
('chilling near river..', '2024-03-21', 4, 'IMG-20231122-WA0012.jpg', 'jensi1011'),
('enjoying near sea', '2024-03-21', 8, '20230911_074709.jpg', 'dipen123'),
('at wedding', '2024-03-21', 9, 'Screenshot_20240319_230550_Instagram.jpg', 'dipen123'),
('fabbbb', '2024-03-21', 10, '20230910_143515_portrait.jpg', 'avikheni35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `profile` varchar(50) NOT NULL,
  `coverpic` varchar(100) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `name`, `password`, `phone`, `profile`, `coverpic`, `uid`, `username`, `status`) VALUES
('jensi123@gmail.com', 'jensi lathiya', '1011', '9748468443', '20231120_105447.jpg', 'IMG-20231122-WA0012.jpg', 1, 'jensi1011', 'active'),
('avikheni35@gmail.com', 'avi kheni', '1234', '9727112347', '20231114_192230_remastered.jpg', '20230910_143515_portrait.jpg', 2, 'avikheni35', 'active'),
('dipen123@gmail.com', 'dipen kanpariya', '1234', '9727112348', '20230911_074709.jpg', 'Screenshot_20240319_230550_Instagram.jpg', 3, 'dipen123', 'active'),
('xyz@gmail.com', 'vinit parmar', '1234', '584384855', 'vinit1.webp', 'vinit.jpg', 4, 'vinit123', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `advertise`
--
ALTER TABLE `advertise`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `followings`
--
ALTER TABLE `followings`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advertise`
--
ALTER TABLE `advertise`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `followings`
--
ALTER TABLE `followings`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

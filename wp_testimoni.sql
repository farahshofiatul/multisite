-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 04, 2018 at 03:19 PM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wordpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_testimoni`
--

CREATE TABLE `wp_testimoni` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `testimoni` text NOT NULL,
  `blog_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_testimoni`
--

INSERT INTO `wp_testimoni` (`id`, `name`, `email`, `phone`, `testimoni`, `blog_id`) VALUES
(1, 'farah', 'farahshofiatul@gmail.com', '081333106239', 'great', 1),
(5, 'a', 'farah@gimail.com', '081222222222', 'a', 1),
(6, 'a', 'farah@gimail.com', '33333333', 'f', 2),
(7, 'a', 'farah@gimail.com', '081222222222', 'd', 3),
(8, 'a', 'farah@gimail.com', '33333333', 'a', 3),
(10, 'naruto', 'naruto@gmail.com', '081222222222', 'hahaha', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_testimoni`
--
ALTER TABLE `wp_testimoni`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_testimoni`
--
ALTER TABLE `wp_testimoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

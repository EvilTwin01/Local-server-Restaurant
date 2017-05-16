-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2017 at 08:47 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffeecorner`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_reservation`
--

CREATE TABLE `add_reservation` (
  `username` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reserve_id` int(14) NOT NULL,
  `no_of_people` int(14) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_reservation`
--

INSERT INTO `add_reservation` (`username`, `user_id`, `reserve_id`, `no_of_people`, `date`, `time`, `status`) VALUES
('ipin', 0, 1028, 2, '2017-03-23', '01:00:00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user`, `pass`) VALUES
('admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `noti_id` int(11) NOT NULL,
  `noti_text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`noti_id`, `noti_text`) VALUES
(1, 'Welcome to Coffee Corner !');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(14) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `phone`, `password`) VALUES
(9023, 'ipin', 'ipin@gmail.com', 109999, '1234'),
(1139, 'upin', 'upin@gmail.com', 0, '1234'),
(7449, 'kakros', 'kk', 12, '1234'),
(9478, 'kk', 'kk', 11, '1234'),
(2845, 'Aku', 'f', 3, '1234'),
(3750, 'Ariffin', 'ariffin@gmail.com', 10, '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_reservation`
--
ALTER TABLE `add_reservation`
  ADD PRIMARY KEY (`reserve_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_reservation`
--
ALTER TABLE `add_reservation`
  MODIFY `reserve_id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1030;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

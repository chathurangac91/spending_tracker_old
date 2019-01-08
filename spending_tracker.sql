-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2018 at 09:22 AM
-- Server version: 5.6.17
-- PHP Version: 5.6.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `expense_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1=Income, 2=Expense',
  `main` int(1) NOT NULL COMMENT '1=Yes, 2=No',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `user_id`, `name`, `type`, `main`) VALUES
(1, 2, 'Fiverr', 1, 1),
(2, 2, 'Recharge Card', 2, 1),
(3, 2, 'DC UNLOCKER', 2, 1),
(4, 2, 'Internet Bill', 2, 1),
(5, 2, 'Beard Trimmer', 2, 1),
(7, 2, 'Last Month Balance', 1, 1),
(8, 2, 'Other', 2, 1),
(10, 3, 'PickMe', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_config`
--

CREATE TABLE IF NOT EXISTS `system_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_zone` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `logo` text,
  `logo_small` text,
  `contact_email` varchar(255) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` int(11) NOT NULL,
  `smtp_user` varchar(255) NOT NULL,
  `smtp_pass` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `system_config`
--

INSERT INTO `system_config` (`id`, `time_zone`, `company_name`, `logo`, `logo_small`, `contact_email`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`) VALUES
(1, 'Asia/Colombo', 'Spending Tracker', 'd3c83-91581-logo-large.png', '3a39c-logo-iconic.png', 'maxitwebsolutions@gmail.com', 'smtp.mailtrap.io', 2525, 'd1305dd478e27a', 'f53f0d24c9f08e');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1=Income,2=Expense',
  `item_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` text,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `id_user` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `type`, `item_id`, `amount`, `date`, `note`) VALUES
(1, 2, 1, 1, 4379, '2018-12-01', NULL),
(2, 2, 2, 2, 99, '2018-12-02', NULL),
(3, 2, 2, 2, 99, '2018-12-03', NULL),
(4, 2, 2, 2, 100, '2018-12-05', NULL),
(5, 2, 1, 7, 1596, '2018-12-08', NULL),
(6, 2, 2, 3, 800, '2018-12-09', 'Root my mobile'),
(7, 2, 2, 4, 1112, '2018-12-13', NULL),
(8, 2, 2, 5, 1140, '2018-12-13', NULL),
(9, 2, 2, 8, 52, '2018-12-14', 'Unknown');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` text,
  `currencry_code` varchar(11) NOT NULL,
  `goal` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL COMMENT '2 = inactive\\n1 = active',
  `pw_changed` int(2) NOT NULL DEFAULT '2' COMMENT '2 = no\\n1 = yes',
  `type` int(1) NOT NULL COMMENT '1=Admin, 2=User',
  `created_datetime` datetime DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `currencry_code`, `goal`, `is_active`, `pw_changed`, `type`, `created_datetime`, `modified_datetime`) VALUES
(1, 'Demo', 'Admin', 'admin@email.com', '036d0ef7567a20b5a4ad24a354ea4a945ddab676', 'Rs.', 1, 1, 1, 1, '2018-11-01 08:46:26', '2018-12-15 13:10:25'),
(2, 'Chanaka', 'Chathuranga', 'chanakac.91@gmail.com', 'c46e80823f1a29a981b155f62b1f18481bcb57ac', 'Rs.', 40000, 1, 2, 2, '2018-12-02 05:45:35', '2018-12-15 13:14:01'),
(3, 'Manjula', 'Kalupahana', 'manjula973@gmail.com', 'e3435a6ef91aa3dca61d9ec98ef2afd06524d01e', 'Rs.', 50000, 1, 2, 2, '2018-12-15 13:46:00', '2018-12-15 13:46:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

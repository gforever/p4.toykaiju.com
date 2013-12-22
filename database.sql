-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2013 at 03:42 PM
-- Server version: 5.1.68-cll
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `toykaiju_p4`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'FK',
  `content` text NOT NULL,
  `task` text NOT NULL,
  `priority` varchar(15) NOT NULL,
  `crossout` tinyint(1) NOT NULL,
  `ranking` int(11) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `created`, `modified`, `user_id`, `content`, `task`, `priority`, `crossout`, `ranking`) VALUES
(3, 1387050882, 1387050882, 2, 'Hi Andrew, \r\nI was able to sign up, log in and see you post - no DB error message. Nice design!\r\nI also edited my post.', '', '', 0, 0),
(7, 1387215243, 1387215243, 1, 'I should be red', 'Urgent task 1', 'urgent', 1, 4),
(8, 1387215253, 1387215253, 1, 'I should be normal... right?', 'Not urgent 2', '0', 0, 1),
(10, 1387402743, 1387402743, 1, 'Make me urgent', 'I am urgent now 3', 'urgent', 0, 0),
(11, 1387599279, 1387599279, 4, 'Kickass!cfbvxcbv', 'Help?  Okay', 'urgent', 0, 0),
(12, 1387599322, 1387599322, 4, 'So many wires!  That I''ll never use...', 'Cut and compress RG6', '0', 0, 0),
(14, 1387726667, 1387726667, 5, '123', '123', '', 0, 0),
(15, 1387730819, 1387730819, 1, 'i want more', 'more tasks 4', '0', 0, 5),
(16, 1387730826, 1387730826, 1, 'i want more 2', 'more tasks 5', '0', 1, 3),
(18, 1387731594, 1387731594, 1, 'testing ranking default', 'One more task', '', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` int(11) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `created`, `modified`, `token`, `password`, `last_login`, `timezone`, `first_name`, `last_name`, `email`) VALUES
(1, 1387032361, 0, 'bc6e3423062e70ac2a006342c192b78cb310d8cc', 'b3eb91ec5851333f75456622f5fbbb5a1e5a562a', 0, '', 'Andrew', 'Wong', 'akwong84@gmail.com'),
(2, 1387050771, 0, '7abae733c80b8a005f3fe9f257c5cffe176b509e', 'e0400a12d015368f45103f1bd976f723ce3fcf67', 0, '', 'Ann', 'Adelsberger', 'adelsbergerann@gmail.com'),
(3, 1387156919, 0, '5663ab3c475ecd09bf3cdb3f1944eca2ddbddd5c', '1c1f96e95b46b9440e126b0ba8ac085aa70588d8', 0, '', 'test', 'test', 'test@test.test'),
(4, 1387599231, 0, 'd4582312bbd8c7f2b9f6b4ed71cdf0364240302d', 'bc8ac405e96e2f5806c1d3e056ee204840ca2ab4', 0, '', 'Chris', 'Griffies', 'chrisgriffies@gmail.com'),
(5, 1387726631, 0, '758ffd6218d7533c1b0b43d51ec408cf088c5c03', 'd9e1a127536996781a42bf81bcfb37a646d4f239', 0, '', '123', '123', '123@123.com'),
(6, 1387740017, 0, '1dccfafc239156c64d43c3509ac2ec546caaf9eb', 'd9e1a127536996781a42bf81bcfb37a646d4f239', 0, '', 'a', 'b', 'a.b@c');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

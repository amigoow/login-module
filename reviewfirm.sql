-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2016 at 07:44 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `reviewfirm`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('7526d70e5d58bcf4f820f719ef0eb36fc5b0ee41', '::1', 1457890469, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435373839303136393b),
('b2e7f05971ef26570a3a4d12432c7c9db1474ec4', '::1', 1457886574, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435373838363537343b),
('8227e8c23bc477d66a001395d2f6d175f09cf7f4', '::1', 1457886451, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435373838363139333b),
('f49d0201850ccb687cfd7588e0d17e6cf4a62e2a', '::1', 1457894139, ''),
('791270fbd1fd23150b384d20bc2225e337320a61', '::1', 1457893867, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435373839333735323b757365725f69647c693a393b757365726e616d657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b69735f636f6e6669726d65647c623a313b69735f61646d696e7c623a313b),
('c78e3aae218a3a45b941bd1fcc57c9045f0cb11c', '::1', 1457893248, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435373839333234373b757365725f69647c693a393b757365726e616d657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b69735f636f6e6669726d65647c623a313b69735f61646d696e7c623a313b),
('5c293b54ea3321217f2d2ce579bc149abe36f019', '::1', 1457890843, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435373839303634313b);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL,
  `username` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(255) DEFAULT 'default.jpg',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_confirmed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `confirm_code` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `created_at`, `updated_at`, `is_admin`, `is_confirmed`, `is_deleted`, `confirm_code`) VALUES
(8, 'amigoow1', 'faisalashfaq81z@gmail.com', '$2y$10$pVAB4Vi3D.C1f3Wc/8HPDO1cXBgYpmWk0sBeRYrMDc.m7MYcVikpq', 'default.jpg', '2016-03-12 18:43:56', NULL, 0, 1, 0, '8aa5b4044c81d8ee'),
(9, 'admin', 'admin@corporatefilter.com', 'admin12345', 'default.jpg', '0000-00-00 00:00:00', NULL, 1, 1, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
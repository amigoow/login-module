-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2016 at 06:15 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `reviewfirm`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(30) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `acc_type` varchar(100) NOT NULL,
  `img_path` varchar(10000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

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
('d82b0aca04102600d9f4d136543098b10f6547b5', '::1', 1460303520, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436303330333437363b757365725f69647c693a31333b757365726e616d657c733a353a22616d69676f223b6c6f676765645f696e7c623a313b69735f636f6e6669726d65647c623a313b69735f61646d696e7c623a303b),
('eca3fba99ede178868ec801506fe5faf404ed355', '::1', 1460298282, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436303239383237373b757365725f69647c693a31343b757365726e616d657c733a343a226a6f6e79223b6c6f676765645f696e7c623a313b69735f636f6e6669726d65647c623a313b69735f61646d696e7c623a303b),
('349d4789fbaea849d6c7b0606785225dae68247f', '::1', 1460298672, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436303239383634303b757365725f69647c693a31343b757365726e616d657c733a343a226a6f6e79223b6c6f676765645f696e7c623a313b69735f636f6e6669726d65647c623a313b69735f61646d696e7c623a303b),
('e4e9db64a89969e0fa2855c81eb5adf2b2810c7e', '::1', 1460300156, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436303239393930333b757365725f69647c693a31343b757365726e616d657c733a343a226a6f6e79223b6c6f676765645f696e7c623a313b69735f636f6e6669726d65647c623a313b69735f61646d696e7c623a303b),
('7ac52a6d856724f68b404650d9c7a18dd74d661d', '::1', 1460300241, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436303330303231343b757365725f69647c693a31343b757365726e616d657c733a343a226a6f6e79223b6c6f676765645f696e7c623a313b69735f636f6e6669726d65647c623a313b69735f61646d696e7c623a303b),
('88e2aacd51cbffdf6e484af749106742287d456c', '::1', 1460301036, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436303330303733343b757365725f69647c693a31343b757365726e616d657c733a343a226a6f6e79223b6c6f676765645f696e7c623a313b69735f636f6e6669726d65647c623a313b69735f61646d696e7c623a303b),
('0c70da6f1f07c283daac57f6ac53b43a9a0cb517', '::1', 1460301391, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436303330313130383b757365725f69647c693a31343b757365726e616d657c733a343a226a6f6e79223b6c6f676765645f696e7c623a313b69735f636f6e6669726d65647c623a313b69735f61646d696e7c623a303b),
('6850665bdb5a3e9e607b4266dd2ee977c625079f', '::1', 1460302646, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436303330323433393b757365725f69647c693a31343b757365726e616d657c733a343a226a6f6e79223b6c6f676765645f696e7c623a313b69735f636f6e6669726d65647c623a313b69735f61646d696e7c623a303b),
('a23835dec29176a2a21dff621ff3296cc381039e', '::1', 1460303445, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436303330333136393b757365725f69647c693a31343b757365726e616d657c733a343a226a6f6e79223b6c6f676765645f696e7c623a313b69735f636f6e6669726d65647c623a313b69735f61646d696e7c623a303b);

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `created_at`, `updated_at`, `is_admin`, `is_confirmed`, `is_deleted`, `confirm_code`) VALUES
(9, 'admin', 'admin@corporatefilter.com', 'admin12345', 'default.jpg', '0000-00-00 00:00:00', NULL, 1, 1, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

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
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
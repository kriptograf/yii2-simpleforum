-- phpMyAdmin SQL Dump
-- version 4.3.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2015 at 10:57 PM
-- Server version: 5.6.22
-- PHP Version: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yii2-forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `attach_file`
--

CREATE TABLE IF NOT EXISTS `attach_file` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `itemId` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `mime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
`id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `is_locked` tinyint(1) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1433939320),
('m140209_132017_init', 1433939388),
('m140403_174025_create_account_table', 1433939388),
('m140504_113157_update_tables', 1433939388),
('m140504_130429_create_token_table', 1433939388),
('m140830_171933_fix_ip_field', 1433939388),
('m140830_172703_change_account_table_name', 1433939388),
('m141222_110026_update_ip_field', 1433939388),
('m141222_135246_alter_username_length', 1433939388),
('m150127_040544_add_attachments', 1434920240);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
`id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `editor_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `social_account`
--

CREATE TABLE IF NOT EXISTS `social_account` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
`id` int(11) NOT NULL,
  `forum_id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `is_locked` tinyint(1) unsigned NOT NULL,
  `view_count` bigint(20) unsigned NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attach_file`
--
ALTER TABLE `attach_file`
 ADD PRIMARY KEY (`id`), ADD KEY `file_model` (`model`), ADD KEY `file_item_id` (`itemId`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
 ADD PRIMARY KEY (`id`), ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
 ADD PRIMARY KEY (`version`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
 ADD PRIMARY KEY (`id`), ADD KEY `thread_id` (`thread_id`), ADD KEY `author_id` (`author_id`), ADD KEY `editor_id` (`editor_id`), ADD KEY `author_id_2` (`author_id`), ADD KEY `editor_id_2` (`editor_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `social_account`
--
ALTER TABLE `social_account`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `account_unique` (`provider`,`client_id`), ADD KEY `fk_user_account` (`user_id`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
 ADD PRIMARY KEY (`id`), ADD KEY `forum_id` (`forum_id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
 ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user_unique_email` (`email`), ADD UNIQUE KEY `user_unique_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attach_file`
--
ALTER TABLE `attach_file`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `social_account`
--
ALTER TABLE `social_account`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `forum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`editor_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_account`
--
ALTER TABLE `social_account`
ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `thread`
--
ALTER TABLE `thread`
ADD CONSTRAINT `thread_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

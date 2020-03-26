-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2016 at 12:38 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `reviews`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `make`
--

CREATE TABLE `make` (
  `mf_id` int(11) NOT NULL,
  `manufacturer` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `model_id` int(11) NOT NULL,
  `model` char(50) NOT NULL,
  `make_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `youtube_embed_link` varchar(200) NOT NULL,
  `image_links` varchar(200) NOT NULL,
  `review_content` varchar(2000) NOT NULL,
  `published_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `freq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usercredentials`
--

CREATE TABLE `usercredentials` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `password` varchar(40) NOT NULL,
  `passwordSalt` varchar(8) NOT NULL,
  `administrator` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(40) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `email`, `profile`, `avatar`, `date_created`) VALUES
(4, 'dan', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', '', '', '', '', '', '2016-05-18 10:35:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Reviews_Comments` (`review_id`),
  ADD KEY `Users_Comments` (`user_id`);

--
-- Indexes for table `make`
--
ALTER TABLE `make`
  ADD PRIMARY KEY (`mf_id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`model_id`),
  ADD KEY `Make_Model` (`make_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Reviews_Users` (`user_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usercredentials`
--
ALTER TABLE `usercredentials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Users_UserCredentials` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `make`
--
ALTER TABLE `make`
  MODIFY `mf_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usercredentials`
--
ALTER TABLE `usercredentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Reviews_Comments` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`),
  ADD CONSTRAINT `Users_Comments` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `Make_Model` FOREIGN KEY (`make_id`) REFERENCES `make` (`mf_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `Reviews_Users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `usercredentials`
--
ALTER TABLE `usercredentials`
  ADD CONSTRAINT `Users_UserCredentials` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

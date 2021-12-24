-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 20, 2021 at 11:25 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_pj01`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `message`, `timestamp`, `user_id`, `post_id`) VALUES
(4, 'it is a comment', NULL, 19, 7),
(6, 'woww it beautiful', NULL, 19, 7),
(8, 'add comment ', NULL, 19, 7);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `post-excerpt` varchar(60) NOT NULL,
  `content` text NOT NULL,
  `timestamp` datetime DEFAULT NULL,
  `user_author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `post-excerpt`, `content`, `timestamp`, `user_author_id`) VALUES
(6, 'PHP OOP - Destructor', 'PHP - The __destruct Function&', 'PHP - The __destruct Function&#13;&#10;A destructor is called when the object is destructed or the script is stopped or exited.&#13;&#10;&#13;&#10;If you create a __destruct() function, PHP will automatically call this function at the end of the script.&#13;&#10;&#13;&#10;Notice that the destruct function starts with two underscores (__)!', NULL, 16),
(7, 'PHP OOP - Access Modifiers', 'public - the property or metho', 'public - the property or method can be accessed from everywhere. This is default&#13;&#10;protected - the property or method can be accessed within the class and by classes derived from that class&#13;&#10;private - the property or method can ONLY be accessed within the class', NULL, 19),
(8, 'PHP OOP - Inheritance', 'Inheritance in OOP = When a cl', 'Inheritance in OOP = When a class derives from another class.&#13;&#10;&#13;&#10;The child class will inherit all the public and protected properties and methods from the parent class. In addition, it can have its own properties and methods.', NULL, 19),
(15, 'DOLLI HOUSE BEAUTY', '', 'PHP - The __destruct Function A destructor is called when the object is destructed or the script is stopped or exited. If you create a __destruct() function, PHP will automatically call this function at the end of the script. Notice that the destruct function starts with two underscores (__)!&#13;&#10;', NULL, 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(45) NOT NULL,
  `confirm-password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `confirm-password`) VALUES
(15, 'LuongThiLinh', 'luongthilinh00@gmail.com', 'jkjkjkjk', 'jkjkjkjk'),
(16, 'DOLLI HOUSE', 'dolli@gmail.com', 'dddddddd', 'dddddddd'),
(19, 'linh', 'luongthilinh00@gmail.com', '123123123', '123123123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

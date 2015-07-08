-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 02, 2015 at 10:52 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

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
-- Table structure for table `arttcle_tags`
--

CREATE TABLE IF NOT EXISTS `arttcle_tags` (
`id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `arttcle_tags`
--

INSERT INTO `arttcle_tags` (`id`, `article_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 4),
(4, 2, 1),
(5, 3, 1),
(6, 3, 6),
(7, 4, 6),
(8, 4, 7),
(9, 5, 4),
(10, 5, 1),
(11, 5, 8),
(12, 6, 3),
(13, 6, 9),
(14, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cat_expenses`
--

CREATE TABLE IF NOT EXISTS `cat_expenses` (
  `date_selected` date NOT NULL,
`id` int(11) NOT NULL,
  `categories` varchar(30) NOT NULL,
  `description` varchar(50) NOT NULL,
  `expense` double(10,2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `cat_expenses`
--

INSERT INTO `cat_expenses` (`date_selected`, `id`, `categories`, `description`, `expense`) VALUES
('2015-05-02', 1, 'food', 'coffee', 2.00),
('2015-05-02', 2, 'general', 'movie', 12.00),
('2015-05-02', 3, 'food', 'lunch', 6.00),
('2015-05-02', 4, 'food', 'lunch', 6.00),
('2015-05-02', 5, 'food', 'lunch', 6.00),
('2015-05-02', 6, 'food', 'lunch', 6.00),
('2015-05-02', 7, 'general', 'medicines', 8.00),
('2015-05-02', 8, 'iTunes', 'VSCO', 5.00),
('2015-05-01', 9, 'groceries', 'walmart', 12.00),
('2015-05-02', 10, 'transport', 'College', 50.00),
('2015-05-06', 11, 'general', 'movie', 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
`article_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `tags` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userselecteddate` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`article_id`, `title`, `money`, `tags`, `created_on`, `userselecteddate`) VALUES
(1, 'Food', '12.00', 'food,chinese,non-veg', '2015-04-27 19:32:14', '2015-04-01'),
(2, 'Food', '10.00', 'indian, food', '2015-04-28 01:36:12', '0000-00-00'),
(3, 'Food', '8.00', 'food, dunkin', '2015-04-28 01:36:12', '0000-00-00'),
(4, 'Coffee', '3.00', 'coffee, dunkin', '2015-04-28 01:36:12', '0000-00-00'),
(5, 'Food', '15.00', 'indian, briyani, food', '2015-04-28 01:36:12', '0000-00-00'),
(6, 'Food', '6.00', 'chinese, chicken, food', '2015-04-28 01:36:12', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`tag_id` int(11) NOT NULL,
  `tag_name` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`, `created_on`) VALUES
(1, 'food', '2015-04-27 20:11:06'),
(2, 'non-veg', '2015-04-27 20:11:06'),
(3, 'chicken', '2015-04-28 01:25:37'),
(4, 'indian', '2015-04-28 01:25:37'),
(5, 'sweet', '2015-04-28 01:26:36'),
(6, 'dunkin', '2015-04-28 01:26:36'),
(7, 'coffee', '2015-04-29 00:07:22'),
(8, 'briyani', '2015-04-29 00:07:22'),
(9, 'chinese', '2015-04-29 00:07:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arttcle_tags`
--
ALTER TABLE `arttcle_tags`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_expenses`
--
ALTER TABLE `cat_expenses`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
 ADD PRIMARY KEY (`article_id`), ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`tag_id`), ADD UNIQUE KEY `id` (`tag_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arttcle_tags`
--
ALTER TABLE `arttcle_tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `cat_expenses`
--
ALTER TABLE `cat_expenses`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

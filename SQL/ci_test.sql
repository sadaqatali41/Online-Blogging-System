-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2019 at 04:33 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `body` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `img_count` int(11) DEFAULT '0',
  `created_date` varchar(100) DEFAULT NULL,
  `updated_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`article_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `id`, `title`, `body`, `image_path`, `img_count`, `created_date`, `updated_date`) VALUES
(8, 1, 'Pomegranate', 'Pomegranate is also a very good fruit. It have a lots of seeds and it is very testy.', 'http://127.0.0.1/online-blogging-system/uploads/Tulips.jpg', 5, '2019-02-26 23:29:15', NULL),
(9, 2, 'Guava', 'Guava is a also a fruit. It is very testy, and it is very beneficial in dysentery. ', 'http://127.0.0.1/online-blogging-system/uploads/usufZuekha.jpg', 0, NULL, NULL),
(10, 2, 'Almonds', 'Almonds are dry fruits, it is very costly and it is very healthy.', 'http://127.0.0.1/online-blogging-system/uploads/Spit.jpg', 0, NULL, NULL),
(13, 2, 'MANUU', 'MANUU stands for Maulana Azad National Urdu Universit. It is Located in hyderabad. It was established in 1998 November. It is a central University.', 'http://127.0.0.1/online-blogging-system/uploads/Tulips2.jpg', 0, NULL, NULL),
(14, 1, 'Orcout', 'Orcout is like a fruit that is very good and healthy fruit. We should use it daily.', 'http://127.0.0.1/online-blogging-system/uploads/tereIshqa.jpg', 1, NULL, NULL),
(15, 1, 'Orange Fruit', 'Orange is also a fruit that is little  sour but it is good. I like it very much.', 'http://127.0.0.1/online-blogging-system/uploads/Desert.jpg', 0, NULL, NULL),
(16, 1, 'Guava', 'Guava is also a fruit that is very good in taste, and it is little bit hard when it is not reap, but it is taste.', 'http://127.0.0.1/online-blogging-system/uploads/Tulips1.jpg', 0, NULL, NULL),
(17, 1, 'Grapes', 'Grapes is also a fruit that is good and tasty. It is small in size, it is be in bunch of groups.', 'http://127.0.0.1/online-blogging-system/uploads/Jellyfish1.jpg', 0, NULL, NULL),
(18, 1, 'Mango', 'Mango is a also a fruit that is very tasty and it is the king of fruits. Everyone likes mango. There are different types of mango.', 'http://127.0.0.1/online-blogging-system/uploads/Penguins2.jpg', 0, NULL, NULL),
(19, 2, 'Azad ', 'The person whose name is Azad is Hard worker. He is living in Tolichowki Hyderabad. He is preparing for GATE 2019. Today he makes eggs in dinner but it was little spicy and more hard.', 'http://127.0.0.1/online-blogging-system/uploads/Lighthouse3.jpg', 0, NULL, NULL),
(20, 2, 'Mister', 'Mister Babu is very and very hard worker. He is preparing for GATE 2019. He is living in Tolichowki, Hyderabad.', 'http://127.0.0.1/online-blogging-system/uploads/Chrysanthemum1.jpg', 1, NULL, NULL),
(21, 2, 'Afroz', 'Afroz is very cool guy. He is living in Ameerpet and preparing for jobs in Hyderabad. He is learning Core Java.', 'http://127.0.0.1/online-blogging-system/uploads/ishq.jpg', 0, NULL, NULL),
(26, 1, 'Ali Khan', 'Ali Khan is a sincere and passionate student, and he is also punctual students. ', 'http://127.0.0.1/online-blogging-system/uploads/Lighthouse.jpg', 0, NULL, NULL),
(27, 1, 'Shohrab Khan', 'Shohrab Khan is Mental student, he don''t know what we have to do and what not to do?', 'http://127.0.0.1/online-blogging-system/uploads/Penguins.jpg', 0, NULL, NULL),
(28, 1, 'Mohd. Arif', 'Arif is teaching in Tolichowli, he is teaching 10 students.', 'http://127.0.0.1/online-blogging-system/uploads/Onion.jpg', 0, NULL, NULL),
(29, 1, 'Imran Khan', 'Hello, How are you imran ?', 'http://127.0.0.1/online-blogging-system/uploads/Tulips3.jpg', 2, NULL, NULL),
(30, 3, 'First', 'This is my First Article', 'http://127.0.0.1/online-blogging-system/uploads/Desert1.jpg', 0, NULL, NULL),
(31, 3, 'Second', 'This is my Second Artcile', 'http://127.0.0.1/online-blogging-system/uploads/Chrysanthemum2.jpg', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article_average_ratings`
--

CREATE TABLE IF NOT EXISTS `article_average_ratings` (
  `article_average_rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `average_rating` float NOT NULL,
  `rating_count` float NOT NULL,
  `total_ratings` float NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `updated_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`article_average_rating_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `article_average_ratings`
--

INSERT INTO `article_average_ratings` (`article_average_rating_id`, `article_id`, `average_rating`, `rating_count`, `total_ratings`, `created_date`, `updated_date`) VALUES
(2, 30, 4.66667, 3, 14, '2019-02-03 00:41:20', '2019-02-27 00:30:39'),
(3, 9, 4, 2, 8, '2019-02-27 00:24:41', '2019-02-27 00:29:12'),
(4, 13, 2, 2, 4, '2019-02-27 00:25:33', '2019-02-27 00:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `article_ratings`
--

CREATE TABLE IF NOT EXISTS `article_ratings` (
  `article_rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `ratings` int(11) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `updated_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`article_rating_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `article_ratings`
--

INSERT INTO `article_ratings` (`article_rating_id`, `article_id`, `id`, `ratings`, `created_date`, `updated_date`) VALUES
(1, 30, 2, 4, '2019-02-03 00:41:20', NULL),
(2, 30, 1, 5, '2019-02-03 00:43:26', '2019-02-05 00:08:20'),
(3, 9, 1, 4, '2019-02-27 00:24:41', NULL),
(4, 13, 1, 3, '2019-02-27 00:25:33', NULL),
(5, 9, 5, 4, '2019-02-27 00:28:50', '2019-02-27 00:29:11'),
(6, 13, 5, 1, '2019-02-27 00:29:52', NULL),
(7, 30, 5, 5, '2019-02-27 00:30:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1,3 id is admin id',
  `name` varchar(30) NOT NULL,
  `uname` varchar(12) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pwd_count` int(11) DEFAULT '0',
  `sques` varchar(100) NOT NULL,
  `answer` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=disabled;1=enabled',
  `created_date` varchar(100) NOT NULL,
  `updated_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `uname`, `pwd`, `mobile`, `email`, `pwd_count`, `sques`, `answer`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Sadaqat Ali', 'sadaqat', 'Sadaqat1@', 7893941364, 'sadaqatali890@gmail.com', 4, 'childhood', 'kaleem', 1, '2019-01-01 00:15:14', '2019-03-01 22:51:39'),
(2, 'Saif Ali', 'saifali', 'Saifali1@', 8960962290, 'saifali12@gmail.com', 2, 'book', 'C++', 0, '2019-02-10 00:21:16', '2019-03-05 22:53:27'),
(3, 'sadqat ali', 'sadaqat1', 'Sadaqat1@', 9988776677, 'aikhan@gmail.com', 0, 'football_palyer', 'pele', 1, '2019-01-21 00:22:24', '2019-03-01 22:21:12'),
(4, 'Saif Ali', 'saif12', 'Saifali1@', 7890786543, 'saifali890@gmail.com', 0, 'color', 'gulabi', 0, '2019-02-10 00:23:06', '2019-02-14 00:23:06'),
(5, 'Washim Bhai', 'washim1', 'Washim1@', 8885948279, 'washimreza@gmail.com', 0, 'spouse_meet', 'singapore', 0, '2019-01-29 00:24:06', '2019-02-14 00:24:06'),
(6, 'Ozair Ahmad', 'ozair1', 'Ozair@123', 7893941323, 'ozairahmad123@gmail.com', 0, 'childhood', 'ozaira', 0, '2019-01-30 00:25:02', '2019-02-14 00:25:02'),
(7, 'wakil ahmad', 'wakil12', 'Wakeel@123', 7893941362, 'wakil123@gmail.com', 0, 'childhood', 'kamar', 0, '2019-03-01 23:07:07', '2019-03-01 23:26:20'),
(8, 'Saadat Karim', 'saadat1', 'Saadat1@', 8885948287, 'saadatk740@gmail.com', 0, 'color', 'pink', 0, '2019-02-21 00:17:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `story`
--

CREATE TABLE IF NOT EXISTS `story` (
  `story_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `story` text NOT NULL,
  PRIMARY KEY (`story_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `story`
--

INSERT INTO `story` (`story_id`, `user_id`, `story`) VALUES
(1, 1, 'Hello This is Sadaqat Ali and Working at IQ Wave Solutions Ameerpet, Hyderabad since 4 months.'),
(2, 2, 'Hello This Saif Ali, From Maunath Bhanjan U.P.'),
(3, 6, 'Hello, This is Ozair Ahmad From Maunath Bhanjan, U.P.');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login` (`id`);

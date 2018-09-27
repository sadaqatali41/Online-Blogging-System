-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2018 at 09:01 AM
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
  PRIMARY KEY (`article_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `id`, `title`, `body`, `image_path`) VALUES
(4, 1, 'Rabbit', 'Rabbit is also a small animal he lives in ground and he is little bigger than mouse and eats grass.', 'http://127.0.0.1/CI/uploads/Tulips.jpg'),
(6, 1, 'Banana', 'Banana is also a good Fruit. I like it very much.', 'http://127.0.0.1/CI/uploads/Jellyfish.jpg'),
(8, 1, 'Pomegranate', 'Pomegranate is also a very good fruit. It have a lots of seeds and it is very testy.', 'http://127.0.0.1/CI/uploads/Koala.jpg'),
(9, 2, 'Guava', 'Guava is a also a fruit. It is very testy, and it is very beneficial in dysentery. ', 'http://127.0.0.1/CI/uploads/usufZuekha.jpg'),
(10, 2, 'Almonds', 'Almonds are dry fruits, it is very costly and it is very healthy.', 'http://127.0.0.1/CI/uploads/Spit.jpg'),
(12, 1, 'Sadaqat Ali', 'I am Learning at Hyderabad in Maulana Azad National Urdu University. I have recently done my Graduation that means B-Tech(CS). ', 'http://127.0.0.1/CI/uploads/IMG_20170317_112109_-_Copy.jpg'),
(13, 2, 'MANUU', 'MANUU stands for Maulana Azad National Urdu Universit. It is Located in hyderabad. It was established in 1998 November. It is a central University.', 'http://127.0.0.1/CI/uploads/Tulips2.jpg'),
(14, 1, 'Orcout', 'Orcout is like a fruit that is very good and healthy fruit. We should use it daily.', 'http://127.0.0.1/CI/uploads/tereIshqa.jpg'),
(15, 1, 'Orange Fruit', 'Orange is also a fruit that is little  sour but it is good. I like it very much.', 'http://127.0.0.1/CI/uploads/Desert.jpg'),
(16, 1, 'Guava', 'Guava is also a fruit that is very good in taste, and it is little bit hard when it is not reap, but it is taste.', 'http://127.0.0.1/CI/uploads/Tulips1.jpg'),
(17, 1, 'Grapes', 'Grapes is also a fruit that is good and tasty. It is small in size, it is be in bunch of groups.', 'http://127.0.0.1/CI/uploads/Jellyfish1.jpg'),
(18, 1, 'Mango', 'Mango is a also a fruit that is very tasty and it is the king of fruits. Everyone likes mango. There are different types of mango.', 'http://127.0.0.1/CI/uploads/Penguins2.jpg'),
(19, 2, 'Azad ', 'The person whose name is Azad is Hard worker. He is living in Tolichowki Hyderabad. He is preparing for GATE 2019. Today he makes eggs in dinner but it was little spicy and more hard.', 'http://127.0.0.1/CI/uploads/Lighthouse3.jpg'),
(20, 2, 'Mister', 'Mister Babu is very and very hard worker. He is preparing for GATE 2019. He is living in Tolichowki, Hyderabad.', 'http://127.0.0.1/CI/uploads/Chrysanthemum1.jpg'),
(21, 2, 'Afroz', 'Afroz is very cool guy. He is living in Ameerpet and preparing for jobs in Hyderabad. He is learning Core Java.', 'http://127.0.0.1/CI/uploads/ishq.jpg'),
(26, 1, 'Ali', 'Ali Khan is a sincere and passionate student, and he is also punctual students. ', 'http://127.0.0.1/CI/uploads/Lighthouse.jpg'),
(27, 1, 'Shohrab Khan', 'Shohrab Khan is Mental student, he don''t know what we have to do and what not to do?', 'http://127.0.0.1/CI/uploads/Penguins.jpg'),
(28, 1, 'Mohd. Arif', 'Arif is teaching in Tolichowli, he is teaching 10 students.', 'http://127.0.0.1/CI/uploads/Onion.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `uname` varchar(12) NOT NULL,
  `pwd` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `uname`, `pwd`) VALUES
(1, 'Sadaqat Ali', 'sadaqat', 'abcdef'),
(2, 'Saif Ali', 'saifali', 'saifali');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login` (`id`);

-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Време на генериране: 12 март 2012 в 13:36
-- Версия на сървъра: 5.1.61
-- Версия на PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данни: `wherebgi_where`
--

-- --------------------------------------------------------

--
-- Структура на таблица `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `stamp` int(11) NOT NULL,
  `approved` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `google_stats`
--

CREATE TABLE IF NOT EXISTS `google_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `update_stat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Ссхема на данните от таблица `keywords`
--

INSERT INTO `keywords` (`id`, `word`) VALUES
(9, 'good'),
(10, 'добро'),
(11, 'гадно'),
(12, 'бавно'),
(13, 'страхотно'),
(14, 'сурово'),
(15, 'добро обслужване'),
(16, 'чакахме'),
(17, 'струва си'),
(18, 'вкусно'),
(19, 'bad'),
(20, 'груби'),
(21, 'малки порции'),
(22, 'гладни'),
(23, 'delicious'),
(24, 'tasty'),
(25, 'опитайте');

-- --------------------------------------------------------

--
-- Структура на таблица `keywords_to_types`
--

CREATE TABLE IF NOT EXISTS `keywords_to_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Ссхема на данните от таблица `keywords_to_types`
--

INSERT INTO `keywords_to_types` (`id`, `keyword_id`, `type_id`) VALUES
(18, 9, 1),
(19, 9, 3),
(20, 10, 1),
(21, 10, 3),
(22, 11, 2),
(23, 11, 4),
(24, 12, 4),
(25, 13, 1),
(26, 13, 3),
(27, 14, 2),
(28, 15, 3),
(29, 16, 4),
(30, 17, 1),
(31, 17, 3),
(32, 18, 1),
(33, 19, 2),
(34, 19, 4),
(35, 20, 4),
(36, 21, 2),
(37, 22, 2),
(38, 22, 4),
(39, 23, 1),
(40, 24, 1),
(41, 25, 1);

-- --------------------------------------------------------

--
-- Структура на таблица `keyword_types`
--

CREATE TABLE IF NOT EXISTS `keyword_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Ссхема на данните от таблица `keyword_types`
--

INSERT INTO `keyword_types` (`id`, `type`) VALUES
(1, 'pFood'),
(2, 'nFood'),
(3, 'pService'),
(4, 'nService');

-- --------------------------------------------------------

--
-- Структура на таблица `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `venue_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int(45) NOT NULL,
  `stamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `Venues`
--

CREATE TABLE IF NOT EXISTS `Venues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lat` float(10,8) NOT NULL,
  `lng` float(10,8) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(15) NOT NULL,
  `checkins` int(11) NOT NULL,
  `twitter_checkins` int(11) NOT NULL,
  `users_count` int(11) NOT NULL,
  `service` int(11) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `prices` int(11) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `stamp` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

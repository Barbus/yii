-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 03 2013 г., 23:50
-- Версия сервера: 5.5.31
-- Версия PHP: 5.3.10-1ubuntu3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mobidev`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_contributors`
--

CREATE TABLE IF NOT EXISTS `tbl_contributors` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `repo_name` varchar(64) NOT NULL,
  `login` varchar(64) NOT NULL,
  `html_url` varchar(64) NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `like` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `find` (`repo_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_mobidev`
--

CREATE TABLE IF NOT EXISTS `tbl_mobidev` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `owner` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `homepage` varchar(128) NOT NULL,
  `watchers` int(12) NOT NULL,
  `forks` int(12) NOT NULL,
  `open_issues` int(32) NOT NULL,
  `url` varchar(128) NOT NULL,
  `created` varchar(128) NOT NULL,
  `like` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `find` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `gravatar_id` varchar(64) NOT NULL,
  `login` varchar(64) NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `company` varchar(64) NOT NULL,
  `blog` varchar(64) NOT NULL,
  `followers` int(32) NOT NULL,
  `like` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `find` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

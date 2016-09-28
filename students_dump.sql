-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 17 2016 г., 02:51
-- Версия сервера: 5.5.50-0ubuntu0.14.04.1
-- Версия PHP: 5.6.23-1+deprecated+dontuse+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `students`
--

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `title`) VALUES
(1, 'M-01z'),
(2, 'SO-33');

-- --------------------------------------------------------

--
-- Структура таблицы `rates`
--

CREATE TABLE IF NOT EXISTS `rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part` int(11) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` varchar(45) NOT NULL,
  `rate` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Дамп данных таблицы `rates`
--

INSERT INTO `rates` (`id`, `part`, `student_id`, `subject_id`, `rate`) VALUES
(1, 1, 1, '1', '5'),
(2, 1, 1, '2', '4'),
(3, 1, 1, '3', '3'),
(4, 1, 1, '4', '3'),
(5, 1, 2, '1', '5'),
(6, 1, 2, '1', '5'),
(7, 1, 2, '3', '5'),
(8, 1, 2, '4', '5'),
(9, 1, 3, '1', '3'),
(10, 1, 3, '2', '3'),
(11, 1, 3, '3', '4'),
(12, 1, 3, '4', '3'),
(13, 1, 4, '1', '5'),
(14, 1, 4, '2', '3'),
(15, 1, 4, '3', '4'),
(16, 1, 4, '4', '4'),
(17, 1, 5, '1', '4'),
(18, 1, 5, '2', '5'),
(19, 1, 5, '3', '5'),
(20, 1, 5, '4', '4'),
(21, 1, 6, '1', '4'),
(22, 1, 6, '2', '4'),
(23, 1, 6, '3', '3'),
(24, 1, 6, '4', '3'),
(25, 1, 7, '1', '2'),
(26, 1, 7, '2', '2'),
(27, 1, 7, '3', '3'),
(28, 1, 7, '4', '4'),
(29, 1, 8, '1', '3'),
(30, 1, 8, '2', '3'),
(31, 1, 8, '3', '5'),
(32, 1, 8, '4', '3'),
(33, 1, 9, '1', '4'),
(34, 1, 9, '2', '4'),
(35, 1, 9, '3', '5'),
(36, 1, 9, '4', '5'),
(37, 1, 10, '1', '4'),
(38, 1, 10, '2', '2'),
(39, 1, 10, '3', '4'),
(40, 1, 10, '4', '2'),
(41, 1, 11, '1', '3'),
(42, 1, 11, '2', '5'),
(43, 1, 11, '3', '5'),
(44, 1, 11, '4', '5'),
(45, 2, 12, '1', '4'),
(46, 2, 12, '2', '4'),
(47, 4, 1, '4', '5');

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `birth` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `time` varchar(45) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `name`, `surname`, `group_id`, `birth`, `email`, `ip`, `time`, `comment`) VALUES
(1, 'Ivan', 'Ivanov', 1, '1992-01-01', 'email.email.com', '192.168.1.1', '14-08-2016 01:52:39', 'bla bla'),
(2, 'Peter', 'Petrov', 1, '1990-01-02', 'test@test.com', '10.10.10.10', '15-08-2016 01:52:39', NULL),
(3, 'Alex', 'Alexeev', 1, '1992-01-01', 'alekseev@mail.ru', '10.10.10.10', '14-08-2016 01:52:39', NULL),
(4, 'Serge', 'Sergeev', 1, '1989-06-01', 'sergeev@mail.ru', '12.345.6.78', '14-08-2016 03:52:39', 'test message'),
(5, 'Mike', 'Johnson', 1, '1990-12-01', 'mihailov@mail.ru', '245.23.312.2', '14-10-2016 01:52:39', 'comment'),
(6, 'Pail', 'McGregor', 1, '1989-09-12', 'pavlov@mail.ru', '1.10.32.234', '01-08-2016 23:43:12', NULL),
(7, 'Danil', 'Danilov', 1, '1980-03-25', 'danilov@mail.ru', '195.2.232.23', '15-08-2016 01:52:39', NULL),
(8, 'Evgeniev', 'Evgeniy', 1, '1983-02-21', 'evgeniev@mail.ru', '192.168.0.1', '15-08-2016 01:52:39', 'comment'),
(9, 'Andrew', 'Andreev', 1, '1990-10-17', 'andreev@mail.ru', '123.13.1.13', '14-08-2016 01:52:39', NULL),
(10, 'Grigory', 'Grigoryanz', 1, '1989-01-23', 'grigoryanz@mail.ru', '12.56.654.23', '14-01-2016 23:00:00', NULL),
(11, 'Roman', 'Romanov', 2, '1992-01-01', 'romanov@mail.ru', '10.10.10.10', '14-08-2016 01:53:39', NULL),
(12, 'John', 'Doe', 2, '1992-01-01', 'doe@mail.ru', '12.345.6.78', '14-08-2016 01:52:39', 'normal');

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL,
  `subject` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`id`, `subject`) VALUES
(1, 'Subject_1'),
(2, 'Subject_2'),
(3, 'Subject_3'),
(4, 'Subject_4');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

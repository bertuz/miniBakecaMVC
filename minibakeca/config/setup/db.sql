-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 21, 2014 at 07:53 PM
-- Server version: 5.6.17
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `minibakeca`
--

-- --------------------------------------------------------

--
-- Table structure for table `annuncio`
--

CREATE TABLE IF NOT EXISTS `annuncio` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `answers` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `annuncio`
--

INSERT INTO `annuncio` (`ID`, `title`, `description`, `date`, `name`, `email`, `views`, `answers`) VALUES
(1, 'Programmatore poliedrico offresi', 'Ciao! \r\nSono un assegnista di ricerca dell''università di Trento. Sto cercando lavoro in quel di Torino come front end e/o back end developer.\r\nPer maggiori informazioni contattatemi.', '2014-04-19 15:03:22', 'Matteo', 'matteoappfarmer@gmail.comm', 76, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2014 at 02:49 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `odmdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `data1`
--

CREATE TABLE IF NOT EXISTS `data1` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sheet_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MRP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `data1`
--

INSERT INTO `data1` (`id`, `sheet_name`, `Category`, `SP`, `DP`, `MRP`) VALUES
(1, 'data1', 'PHILIPS', '25409', '25000', '26690'),
(2, 'data1', 'PHILIPS', '25000', '21020', '24523');

-- --------------------------------------------------------

--
-- Table structure for table `data2`
--

CREATE TABLE IF NOT EXISTS `data2` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sheet_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MRP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `data2`
--

INSERT INTO `data2` (`id`, `sheet_name`, `Category`, `MRP`, `SP`, `DP`, `Brand`) VALUES
(1, 'data2', 'PANASONIC', 'Awesome', '25000', '21020', 'Nice');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_06_30_171608_create_user_table', 1),
('2014_06_30_182840_update_user_table', 2),
('2014_06_30_195739_create_sheets_table', 3),
('2014_07_01_073911_create_products_table', 4),
('2014_07_01_101712_add_size_column', 5);

-- --------------------------------------------------------

--
-- Table structure for table `sheets`
--

CREATE TABLE IF NOT EXISTS `sheets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Dumping data for table `sheets`
--

INSERT INTO `sheets` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(56, 'data1', 'PHILIPS', '2014-07-04 05:06:03', '2014-07-04 05:06:03'),
(58, 'data2', 'PANASONIC', '2014-07-04 05:09:55', '2014-07-04 05:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `remember_token`, `created_at`, `updated_at`, `admin`) VALUES
(1, 'admin', '$2y$10$lg7UNwkbx0sj0IOTt7iSdeoqD3Re9gvYyEgzuULwOKzs70sREd1GS', 'dwij.stardust@gmail.com', 'V5nE0dQmpD3sPD6l42Y6EX2hMhAOFjcSxsmXFkrCGcnl2TUYsdiyM27Z06F3', '2014-06-30 12:07:56', '2014-07-01 09:20:22', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

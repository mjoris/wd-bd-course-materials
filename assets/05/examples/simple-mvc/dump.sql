-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 17, 2013 at 04:30 PM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `todo`
--

DROP DATABASE IF EXISTS simpletodo;
CREATE DATABASE simpletodo DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE simpletodo;

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `what` varchar(255) NOT NULL,
  `priority` enum('high','normal','low') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `what`, `priority`) VALUES
(1,  'ksat tnegru yrev A', 'high'),
(2,  'A normal priority task', 'normal'),
(3,  'A low priority task', 'low'),
(4,  'A very urgent task', 'high');

-- --------------------------------------------------------


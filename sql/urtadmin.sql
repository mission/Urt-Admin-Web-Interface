-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 16, 2010 at 01:39 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `urtadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `urtAdmin_bans`
--

CREATE TABLE IF NOT EXISTS `urtAdmin_bans` (
  `banid` int(10) NOT NULL AUTO_INCREMENT,
  `player` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `admin` varchar(100) NOT NULL,
  `reason` varchar(254) NOT NULL,
  `length` varchar(100) NOT NULL DEFAULT 'perm',
  `date` varchar(100) NOT NULL,
  `Status` varchar(100) NOT NULL DEFAULT 'Active',
  `UnbanDate` varchar(100) NOT NULL DEFAULT 'n/a',
  PRIMARY KEY (`banid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `urtAdmin_bans`
--


-- --------------------------------------------------------

--
-- Table structure for table `urtAdmin_mainmenu`
--

CREATE TABLE IF NOT EXISTS `urtAdmin_mainmenu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order` int(10) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `href` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `urtAdmin_mainmenu`
--

INSERT INTO `urtAdmin_mainmenu` (`id`, `order`, `name`, `href`, `type`) VALUES
(1, '0', 'Home', 'index.php', 'mainmenu'),
(2, '1', 'Rcon Command', 'javascript:popUp1("modules/rcon.php")', 'mainmenu'),
(3, '2', 'Player Search', 'javascript:popUp("modules/search.php")', 'mainmenu'),
(4, '3', 'Ban Search', 'javascript:popUp("modules/bansearch.php")', 'mainmenu');

-- --------------------------------------------------------

--
-- Table structure for table `urtAdmin_modules`
--

CREATE TABLE IF NOT EXISTS `urtAdmin_modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order` int(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `requiredarg1` varchar(100) NOT NULL,
  `requiredarg2` varchar(100) NOT NULL,
  `requiredarg3` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pos` varchar(100) NOT NULL DEFAULT 'left',
  `class` varchar(100) NOT NULL DEFAULT 'container',
  `status` varchar(10) NOT NULL DEFAULT 'enabled',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `urtAdmin_modules`
--

INSERT INTO `urtAdmin_modules` (`id`, `order`, `file`, `requiredarg1`, `requiredarg2`, `requiredarg3`, `name`, `pos`, `class`, `status`) VALUES
(1, 0, 'mainmenu.php', '', '', '', 'Main Menu', 'left', 'container4', 'Enabled'),
(2, 1, 'servermenu.php', '', '', '', 'Server Menu', 'left', 'container4', 'Enabled'),
(3, 0, 'playerinfo.php', '', '', '', 'Player Info', 'body', '', 'Enabled'),
(4, 1, 'default_body.php', '', '', '', 'Default Body', 'body', 'container4', 'Enabled'),
(5, 0, 'adminmenu.php', '', '', '', 'Admin Menu', 'admin', '', 'Enabled'),
(6, 0, 'default_news.php', '', '', '', 'Default News', 'news', '', 'Enabled'),
(7, 2, 'banform.php', '', '', '', 'Ban Form', 'left', 'container3', 'Enabled'),
(8, 3, 'themes.php', '', '', '', 'Themes', 'left', 'container4', 'Enabled');

-- --------------------------------------------------------

--
-- Table structure for table `urtAdmin_players`
--

CREATE TABLE IF NOT EXISTS `urtAdmin_players` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `guid` varchar(32) NOT NULL,
  `last` varchar(100) NOT NULL,
  `added` varchar(100) NOT NULL,
  `laston` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `urtAdmin_players`
--


-- --------------------------------------------------------

--
-- Table structure for table `urtadmin_servers`
--

CREATE TABLE IF NOT EXISTS `urtAdmin_servers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `port` varchar(100) NOT NULL,
  `version` varchar(100) NOT NULL,
  `rconpass` varchar(100) NOT NULL,
  `Status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `urtadmin_servers`
--

INSERT INTO `urtAdmin_servers` (`id`, `order`, `name`, `ip`, `port`, `version`, `rconpass`, `Status`) VALUES
(1, '0', 'example', 'example.com', '27960', 'ioq3 1.35', 'example', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `urtadmin_users`
--

CREATE TABLE IF NOT EXISTS `urtAdmin_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `usr` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `regIP` varchar(15) NOT NULL,
  `admin` varchar(3) NOT NULL DEFAULT 'Yes',
  `fullname` varchar(100) NOT NULL,
  `theme` varchar(100) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `urtAdmin_styles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `folder` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `urtAdmin_styles` (`id`, `name`, `folder`) VALUES
(1, 'Default', 'default');

CREATE TABLE IF NOT EXISTS `urtAdmin_settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `var` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `urtAdmin_settings` (`var`, `value`) VALUES
('site_loc', 'http://www.example.com/urtadmin/'),
('header', '<strong>Welcome to the New Server Administrator Site!</strong>'),
('subheader', 'This is under construction still!'),
('title', 'Administrators Site'),
('ban_status', 'On'),
('ip_check', 'On'),
('redirect_url', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

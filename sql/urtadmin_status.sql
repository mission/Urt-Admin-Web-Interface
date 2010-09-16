-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 16, 2010 at 02:22 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `urtAdmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `urtAdmin_status`
--

CREATE TABLE IF NOT EXISTS `urtAdmin_status` (
  `ip` varchar(100) NOT NULL,
  `port` varchar(100) NOT NULL,
  `data` varchar(10000) NOT NULL,
  `updated` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `urtAdmin_maps`
--

CREATE TABLE IF NOT EXISTS `urtAdmin_maps` (
  `map` varchar(100) NOT NULL,
  `screenshot1` varchar(100) NOT NULL,
  `screenshot2` varchar(100) NOT NULL,
  `screenshot3` varchar(100) NOT NULL,
  `screenshot4` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `urtAdmin_maps`
--

INSERT INTO `urtAdmin_maps` (`map`, `screenshot1`, `screenshot2`, `screenshot3`, `screenshot4`) VALUES
('ut4_eagle', 'ut4_eagle-a.jpg', 'ut4_eagle-b.jpg', 'ut4_eagle-c.jpg', 'ut4_eagle-d.jpg'),
('ut4_maya', 'ut4_maya-a.jpg', 'ut4_maya-b.jpg', 'ut4_maya-c.jpg', 'ut4_maya-d.jpg'),
('ut4_oildepot', 'ut4_oildepot-a.jpg', 'ut4_oildepot-b.jpg', 'ut4_oildepot-c.jpg', 'ut4_oildepot-d.jpg'),
('ut4_swim', 'ut4_swim-a.jpg', 'ut4_swim-b.jpg', 'ut4_swim-c.jpg', 'ut4_swim-d.jpg'),
('ut4_kingdom', 'ut4_kingdom-a.jpg', 'ut4_kingdom-b.jpg', 'ut4_kingdom-c.jpg', 'ut4_kingdom-d.jpg'),
('ut4_tunis', 'ut4_tunis-a.jpg', 'ut4_tunis-b.jpg', 'ut4_tunis-c.jpg', 'ut4_tunis-d.jpg'),
('ut4_subway', 'ut4_subway-a.jpg', 'ut4_subway-b.jpg', 'ut4_subway-c.jpg', 'ut4_subway-d.jpg'),
('ut4_harbortown', 'ut4_harbortown-a.jpg', 'ut4_harbortown-b.jpg', 'ut4_harbortown-c.jpg', 'ut4_harbortown-d.jpg'),
('ut4_suburbs', 'ut4_suburbs-a.jpg', 'ut4_suburbs-b.jpg', 'ut4_suburbs-c.jpg', 'ut4_suburbs-d.jpg'),
('ut4_streets', 'ut4_streets-a.jpg', 'ut4_streets-b.jpg', 'ut4_streets-c.jpg', 'ut4_streets-d.jpg'),
('ut4_superman_b4', 'ut4_superman_b4-a.jpg', 'ut4_superman_b4-b.jpg', 'ut4_superman_b4-c.jpg', 'ut4_superman_b4-d.jpg'),
('ut4_dicks', 'ut4_dicks-a.jpg', 'ut4_dicks-b.jpg', 'ut4_dicks-c.jpg', 'ut4_dicks-d.jpg'),
('ut4_sliema', 'ut4_sliema-a.jpg', 'ut4_sliema-b.jpg', 'ut4_sliema-c.jpg', 'ut4_sliema-d.jpg'),
('ut4_village', 'ut4_village-a.jpg', 'ut4_village-b.jpg', 'ut4_village-c.jpg', 'ut4_village-d.jpg'),
('ut4_island', 'ut4_island-a.jpg', 'ut4_island-b.jpg', 'ut4_island-c.jpg', 'ut4_island-d.jpg'),
('ut4_ricochet', 'ut4_ricochet-a.jpg', 'ut4_ricochet-b.jpg', 'ut4_ricochet-c.jpg', 'ut4_ricochet-d.jpg'),
('ut4_firingrange', 'ut4_firingrange-a.jpg', 'ut4_firingrange-b.jpg', 'ut4_firingrange-c.jpg', 'ut4_firingrange-d.jpg'),
('ut4_eagle', 'ut4_eagle-a.jpg', 'ut4_eagle-b.jpg', 'ut4_eagle-c.jpg', 'ut4_eagle-d.jpg'),
('ut4_maya', 'ut4_maya-a.jpg', 'ut4_maya-b.jpg', 'ut4_maya-c.jpg', 'ut4_maya-d.jpg'),
('ut4_oildepot', 'ut4_oildepot-a.jpg', 'ut4_oildepot-b.jpg', 'ut4_oildepot-c.jpg', 'ut4_oildepot-d.jpg'),
('ut4_swim', 'ut4_swim-a.jpg', 'ut4_swim-b.jpg', 'ut4_swim-c.jpg', 'ut4_swim-d.jpg'),
('ut4_kingdom', 'ut4_kingdom-a.jpg', 'ut4_kingdom-b.jpg', 'ut4_kingdom-c.jpg', 'ut4_kingdom-d.jpg'),
('ut4_tunis', 'ut4_tunis-a.jpg', 'ut4_tunis-b.jpg', 'ut4_tunis-c.jpg', 'ut4_tunis-d.jpg'),
('ut4_subway', 'ut4_subway-a.jpg', 'ut4_subway-b.jpg', 'ut4_subway-c.jpg', 'ut4_subway-d.jpg'),
('ut4_harbortown', 'ut4_harbortown-a.jpg', 'ut4_harbortown-b.jpg', 'ut4_harbortown-c.jpg', 'ut4_harbortown-d.jpg'),
('ut4_suburbs', 'ut4_suburbs-a.jpg', 'ut4_suburbs-b.jpg', 'ut4_suburbs-c.jpg', 'ut4_suburbs-d.jpg'),
('ut4_streets', 'ut4_streets-a.jpg', 'ut4_streets-b.jpg', 'ut4_streets-c.jpg', 'ut4_streets-d.jpg'),
('ut4_superman_b4', 'ut4_superman_b4-a.jpg', 'ut4_superman_b4-b.jpg', 'ut4_superman_b4-c.jpg', 'ut4_superman_b4-d.jpg'),
('ut4_dicks', 'ut4_dicks-a.jpg', 'ut4_dicks-b.jpg', 'ut4_dicks-c.jpg', 'ut4_dicks-d.jpg'),
('ut4_sliema', 'ut4_sliema-a.jpg', 'ut4_sliema-b.jpg', 'ut4_sliema-c.jpg', 'ut4_sliema-d.jpg'),
('ut4_village', 'ut4_village-a.jpg', 'ut4_village-b.jpg', 'ut4_village-c.jpg', 'ut4_village-d.jpg'),
('ut4_island', 'ut4_island-a.jpg', 'ut4_island-b.jpg', 'ut4_island-c.jpg', 'ut4_island-d.jpg'),
('ut4_ricochet', 'ut4_ricochet-a.jpg', 'ut4_ricochet-b.jpg', 'ut4_ricochet-c.jpg', 'ut4_ricochet-d.jpg'),
('ut4_firingrange', 'ut4_firingrange-a.jpg', 'ut4_firingrange-b.jpg', 'ut4_firingrange-c.jpg', 'ut4_firingrange-d.jpg'),
('ut4_abbey', 'ut4_abbey-a.jpg', 'ut4_abbey-b.jpg', 'ut4_abbey-c.jpg', 'ut4_abbey-d.jpg'),
('ut4_abbeyctf', 'ut4_abbeyctf-a.jpg', 'ut4_abbeyctf-b.jpg', 'ut4_abbeyctf-c.jpg', 'ut4_abbeyctf-d.jpg'),
('ut4_algiers', 'ut4_algiers-a.jpg', 'ut4_algiers-b.jpg', 'ut4_algiers-c.jpg', 'ut4_algiers-d.jpg'),
('ut4_ambush', 'ut4_ambush-a.jpg', 'ut4_ambush-b.jpg', 'ut4_ambush-c.jpg', 'ut4_ambush-d.jpg'),
('ut4_austria', 'ut4_austria-a.jpg', 'ut4_austria-b.jpg', 'ut4_austria-c.jpg', 'ut4_austria-d.jpg'),
('ut4_casa', 'ut4_casa-a.jpg', 'ut4_casa-b.jpg', 'ut4_casa-c.jpg', 'ut4_casa-d.jpg'),
('ut4_crenshaw', 'ut4_crenshaw-a.jpg', 'ut4_crenshaw-b.jpg', 'ut4_crenshaw-c.jpg', 'ut4_crenshaw-d.jpg'),
('ut4_dressingroom', 'ut4_dressingroom-a.jpg', 'ut4_dressingroom-b.jpg', 'ut4_dressingroom-c.jpg', 'ut4_dressingroom-d.jpg'),
('ut4_elgin', 'ut4_elgin-a.jpg', 'ut4_elgin-b.jpg', 'ut4_elgin-c.jpg', 'ut4_elgin-d.jpg'),
('ut4_mandolin', 'ut4_mandolin-a.jpg', 'ut4_mandolin-b.jpg', 'ut4_mandolin-c.jpg', 'ut4_mandolin-d.jpg'),
('ut4_paradise', 'ut4_paradise-a.jpg', 'ut4_paradise-b.jpg', 'ut4_paradise-c.jpg', 'ut4_paradise-d.jpg'),
('ut4_prague', 'ut4_prague-a.jpg', 'ut4_prague-b.jpg', 'ut4_prague-c.jpg', 'ut4_prague-d.jpg'),
('ut4_prague', 'ut4_prague-b.jpg', 'ut4_prague-b.jpg', 'ut4_prague-c.jpg', 'ut4_prague-d.jpg'),
('ut4_provinggrounds', 'ut4_provinggrounds-a.jpg', 'ut4_provinggrounds-b.jpg', 'ut4_provinggrounds-c.jpg', 'ut4_provinggrounds-d.jpg'),
('ut4_ramelle', 'ut4_ramelle-a.jpg', 'ut4_ramelle-b.jpg', 'ut4_ramelle-c.jpg', 'ut4_ramelle-d.jpg'),
('ut4_riyadh', 'ut4_riyadh-a.jpg', 'ut4_riyadh-b.jpg', 'ut4_riyadh-c.jpg', 'ut4_riyadh-d.jpg'),
('ut4_sanc', 'ut4_sanc-a.jpg', 'ut4_sanc-b.jpg', 'ut4_sanc-c.jpg', 'ut4_sanc-d.jpg'),
('ut4_snoppis', 'ut4_snoppis-a.jpg', 'ut4_snoppis-b.jpg', 'ut4_snoppis-c.jpg', 'ut4_snoppis-d.jpg'),
('ut4_thingley', 'ut4_thingley-a.jpg', 'ut4_thingley-b.jpg', 'ut4_thingley-c.jpg', 'ut4_thingley-d.jpg'),
('ut4_tombs', 'ut4_tombs-a.jpg', 'ut4_tombs-b.jpg', 'ut4_tombs-c.jpg', 'ut4_tombs-d.jpg'),
('ut4_toxic', 'ut4_toxic-a.jpg', 'ut4_toxic-b.jpg', 'ut4_toxic-c.jpg', 'ut4_toxic-d.jpg'),
('ut4_turnpike', 'ut4_turnpike-a.jpg', 'ut4_turnpike-b.jpg', 'ut4_turnpike-c.jpg', 'ut4_turnpike-d.jpg'),
('ut4_uptown', 'ut4_uptown-a.jpg', 'ut4_uptown-b.jpg', 'ut4_uptown-c.jpg', 'ut4_uptown-d.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
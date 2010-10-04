-- Oct 3, 2010 Update for database tables

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


UPDATE `urtAdmin_modules` SET `class`='container3' WHERE `class`='srvcontainer';
UPDATE `urtAdmin_modules` SET `class`='container4' WHERE `class`='utilcontainer6';

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
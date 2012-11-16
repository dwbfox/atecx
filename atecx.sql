-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.24-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4206
-- Date/time:                    2012-11-15 22:49:26
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table atecx.milestones
DROP TABLE IF EXISTS `milestones`;
CREATE TABLE IF NOT EXISTS `milestones` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `comment` text,
  `attachment` varchar(50) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `type` varchar(50) DEFAULT 'Status Update',
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `FK_milestones_projects` (`project_id`),
  CONSTRAINT `FK_milestones_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

-- Dumping data for table atecx.milestones: ~4 rows (approximately)
/*!40000 ALTER TABLE `milestones` DISABLE KEYS */;
INSERT INTO `milestones` (`id`, `date`, `comment`, `attachment`, `user_id`, `type`, `project_id`) VALUES
	(48, '2012-11-16', 'Project begun.', '', 15, 'Status Update', 102),
	(49, '2012-11-16', 'dfkjsfg', '', 14, 'Status Update', 102),
	(50, '2012-11-16', 'Project begun.', '', 14, 'Status Update', 103),
	(51, '2012-11-16', 'This is a status update!', '', 14, 'Status Update', 103);
/*!40000 ALTER TABLE `milestones` ENABLE KEYS */;


-- Dumping structure for table atecx.proficiencies
DROP TABLE IF EXISTS `proficiencies`;
CREATE TABLE IF NOT EXISTS `proficiencies` (
  `user_id` int(11) NOT NULL,
  `prof_id` int(11) DEFAULT NULL,
  `prof_value` int(11) DEFAULT NULL,
  KEY `FK_proficiencies_users` (`user_id`),
  CONSTRAINT `FK_proficiencies_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table atecx.proficiencies: ~3 rows (approximately)
/*!40000 ALTER TABLE `proficiencies` DISABLE KEYS */;
INSERT INTO `proficiencies` (`user_id`, `prof_id`, `prof_value`) VALUES
	(15, 1, 3),
	(15, 2, 2),
	(15, 3, 3);
/*!40000 ALTER TABLE `proficiencies` ENABLE KEYS */;


-- Dumping structure for table atecx.prof_roles
DROP TABLE IF EXISTS `prof_roles`;
CREATE TABLE IF NOT EXISTS `prof_roles` (
  `prof_id` int(11) NOT NULL,
  `prof_name` varchar(45) DEFAULT NULL,
  `prof_catagory` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`prof_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table atecx.prof_roles: ~12 rows (approximately)
/*!40000 ALTER TABLE `prof_roles` DISABLE KEYS */;
INSERT INTO `prof_roles` (`prof_id`, `prof_name`, `prof_catagory`) VALUES
	(1, 'Autodesk Maya', 'Game Design'),
	(2, 'Unreal Development Kit', 'Game Design'),
	(3, 'Source Development Kit', 'Game Design'),
	(4, 'Unity', 'Game Design'),
	(5, 'Flash', 'Animation'),
	(6, 'POVray', 'Animation'),
	(7, 'Blender', 'Animation'),
	(8, 'Unity', 'Animation'),
	(9, 'Adobe Photoshop', 'Interactive/Web'),
	(10, 'Adobe Illustrator', 'Interactive/Web'),
	(11, 'HTML + CSS', 'Interactive/Web'),
	(12, 'JavaScript', 'Interactive/Web');
/*!40000 ALTER TABLE `prof_roles` ENABLE KEYS */;


-- Dumping structure for table atecx.projects
DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(10) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(100) NOT NULL,
  `project_tagline` mediumtext NOT NULL,
  `project_catagory` mediumtext NOT NULL,
  `project_description` text,
  `project_image` varchar(255) DEFAULT NULL,
  `project_image_thumb` varchar(255) DEFAULT NULL,
  `project_end` date NOT NULL,
  `owner_id` varchar(50) NOT NULL,
  `project_start` date NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

-- Dumping data for table atecx.projects: ~2 rows (approximately)
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` (`project_id`, `project_name`, `project_tagline`, `project_catagory`, `project_description`, `project_image`, `project_image_thumb`, `project_end`, `owner_id`, `project_start`) VALUES
	(102, 'Test', 'sdf', 'Animation', 'sadf', 'appData/project_data/project_images/luiEx.jpg', 'appData/project_data/project_images/luiEx_thumb.jpg', '2012-12-07', '15', '2012-11-16'),
	(103, 'Cloverfield', 'An animated rendition of J.J. Abrams\' finest work', 'Animation', 'All animated properties should be animated to a single numeric value, except as noted below; most properties that are non-numeric cannot be animated using basic jQuery functionality (For example, width, height, or left can be animated but background-color cannot be, unless the jQuery.Color() plugin is used). Property values are treated as a number of pixels unless otherwise specified. The units em and % can be specified where applicable.', 'appData/project_data/project_images/SSOuT.jpg', 'appData/project_data/project_images/SSOuT_thumb.jpg', '2012-11-30', '14', '2012-11-16');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;


-- Dumping structure for table atecx.project_members
DROP TABLE IF EXISTS `project_members`;
CREATE TABLE IF NOT EXISTS `project_members` (
  `member_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `role_id` int(2) NOT NULL,
  `project_id` int(10) NOT NULL,
  `join_date` date NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `member_fk` (`user_id`),
  KEY `FK_project_members_projects` (`project_id`),
  CONSTRAINT `FK_project_members_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- Dumping data for table atecx.project_members: ~3 rows (approximately)
/*!40000 ALTER TABLE `project_members` DISABLE KEYS */;
INSERT INTO `project_members` (`member_id`, `user_id`, `role_id`, `project_id`, `join_date`) VALUES
	(45, 15, 1, 102, '2012-11-16'),
	(47, 14, 2, 102, '2012-11-16'),
	(48, 14, 1, 103, '2012-11-16');
/*!40000 ALTER TABLE `project_members` ENABLE KEYS */;


-- Dumping structure for table atecx.project_roles
DROP TABLE IF EXISTS `project_roles`;
CREATE TABLE IF NOT EXISTS `project_roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) DEFAULT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `is_admin` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table atecx.project_roles: ~1 rows (approximately)
/*!40000 ALTER TABLE `project_roles` DISABLE KEYS */;
INSERT INTO `project_roles` (`id`, `role_id`, `role_name`, `is_admin`) VALUES
	(1, 1, 'Administrator', 'Y');
/*!40000 ALTER TABLE `project_roles` ENABLE KEYS */;


-- Dumping structure for table atecx.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `screen_name` varchar(45) NOT NULL,
  `join_date` date NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `bio` text,
  `interests` text,
  `oauth_user_id` int(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `screen_name` (`screen_name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table atecx.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `screen_name`, `join_date`, `avatar`, `email`, `bio`, `interests`, `oauth_user_id`) VALUES
	(14, 'app_tester_acc', '2012-11-16', NULL, 'sadf@utdallas.edu', 'sadfsadfdsa', '', 538356074),
	(15, 'dagmawi', '2012-11-16', NULL, 'dwb100020@utdallas.edu', 'EMAC major at UT Dallas, focusing on web development and design.', 'Gaming,programming,fun!', 182955316);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

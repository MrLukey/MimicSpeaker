# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.34)
# Database: mimic_speaker_database
# Generation Time: 2021-10-11 19:54:32 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table activity
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activity`;

CREATE TABLE `activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) unsigned NOT NULL,
  `logins` int(11) unsigned NOT NULL DEFAULT '0',
  `loginAttempts` int(11) unsigned NOT NULL DEFAULT '0',
  `tasksCreated` int(11) unsigned NOT NULL DEFAULT '0',
  `tasksCompleted` int(11) unsigned NOT NULL DEFAULT '0',
  `tasksReset` int(11) unsigned NOT NULL DEFAULT '0',
  `tasksArchived` int(11) unsigned NOT NULL DEFAULT '0',
  `tasksRecovered` int(11) unsigned NOT NULL DEFAULT '0',
  `tasksDeleted` int(11) unsigned NOT NULL DEFAULT '0',
  `lastActive` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;

INSERT INTO `activity` (`id`, `userID`, `logins`, `loginAttempts`, `tasksCreated`, `tasksCompleted`, `tasksReset`, `tasksArchived`, `tasksRecovered`, `tasksDeleted`, `lastActive`)
VALUES
	(2,3,3,0,0,0,0,0,0,0,'2021-10-10 21:13:59'),
	(3,4,1,0,0,0,0,0,0,0,'2021-10-10 21:14:48'),
	(4,5,17,3,0,0,0,0,0,0,'2021-10-11 18:45:13'),
	(5,8,1,0,0,0,0,0,0,0,'2021-10-11 02:00:42'),
	(6,9,1,0,0,0,0,0,0,0,'2021-10-11 18:16:48');

/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table genres
# ------------------------------------------------------------

DROP TABLE IF EXISTS `genres`;

CREATE TABLE `genres` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `image_path` varchar(120) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `genres` WRITE;
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;

INSERT INTO `genres` (`id`, `name`, `image_path`)
VALUES
	(1,'Politics','assets/images/politics.jpg'),
	(2,'Sci-fi','assets/images/sci-fi.jpg'),
	(3,'Poetry','assets/images/poetry.jpg'),
	(4,'Religion','assets/images/religion.jpg'),
	(5,'Comedy','assets/images/comedy.jpg');

/*!40000 ALTER TABLE `genres` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table mimics
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mimics`;

CREATE TABLE `mimics` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `processed_text_id` int(11) unsigned NOT NULL,
  `mimic_string` longtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `likes` int(11) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `mimics` WRITE;
/*!40000 ALTER TABLE `mimics` DISABLE KEYS */;

INSERT INTO `mimics` (`id`, `user_id`, `processed_text_id`, `mimic_string`, `created`, `likes`, `deleted`)
VALUES
	(46,5,13,'Trembleth chosen judah shall stink among lions roar and madai her streets for himself forty sons go thou ravished my family is upholden by words were pertaining unto hobab the thigh was sent levites bearing removeth away now make holy day appointed his asses the grapes strange from sixty and.','2021-10-11 19:49:26',0,0),
	(47,5,11,'Tom shon said afraid to sink whoâ€™s stood on the wind veered to fame like snow him pain him his sea-green grave in battle shone bless and cablesâ€™ rattle amain from pole the royal craft to breeze is it uttered vain fire back from loop and birds of sight with.','2021-10-11 19:49:40',0,0),
	(48,5,5,'Package that shouldnâ€™t happen today who doesnâ€™t amount of mocked and therefore you coming here right in such bad automatically attended by many radicalized people now heâ€™s probably heads said were signing them was close the daycare is their backs in partnership is anybody with political people living here you.','2021-10-11 19:49:53',0,0),
	(49,5,12,'Defense against enemy has happened in belgium not hurry their cause of hostile aircraft centuries of tyranny strong scythe around the storm of this struggle was driven away by valor seriously of 21st march the bombers which they have perhaps lost march and fought fiercely on holding in england within.','2021-10-11 19:50:11',0,0),
	(50,5,9,'Dish indeed and food at jane marching soldiers could not at every nation saw and down upon thousands upon moscow and assaulted by more head-lamps the path as heartily as someone with four of peace down on us was dim and contracted its half-breed holster slung on her somewhere it.','2021-10-11 19:51:23',0,0),
	(51,5,11,'Hast slain the only thing he said to plutoâ€™s realms steering heavily timbered with golden store commotion the spirit long lines of brightness flew their motherâ€™s quest to test their broadsides they did pour the vessel crack upon his tomb when bright and be roll together like one of slaughter.','2021-10-11 19:52:44',0,0);

/*!40000 ALTER TABLE `mimics` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table processed_texts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `processed_texts`;

CREATE TABLE `processed_texts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `short_title` varchar(30) DEFAULT '',
  `genre_id` int(11) unsigned NOT NULL,
  `full_title` varchar(120) NOT NULL DEFAULT '',
  `author` varchar(30) NOT NULL DEFAULT '',
  `year_first_published` int(4) NOT NULL,
  `file_path` varchar(120) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `full_title` (`full_title`),
  UNIQUE KEY `file_path` (`file_path`),
  UNIQUE KEY `short_title` (`short_title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `processed_texts` WRITE;
/*!40000 ALTER TABLE `processed_texts` DISABLE KEYS */;

INSERT INTO `processed_texts` (`id`, `short_title`, `genre_id`, `full_title`, `author`, `year_first_published`, `file_path`)
VALUES
	(5,'trump',1,'Speeches of Donald Trump','Donald Trump',2020,'assets/processedTexts/TrumpSpeeches.json'),
	(9,'dont-panic',2,'Don\'t Panic','Geoff St. Reynard',0,'assets/processedTexts/DontPanicbyGeoffStReynard.json'),
	(10,'hitchers',2,'Hitchhiker\'s Guide to the Galaxy','Douglas Adams',1990,'assets/processedTexts/HitchhikersGuideToTheGalaxybyDouglasAdams.json'),
	(11,'corsair',3,'The Corsair','Anonymous',0,'assets/processedTexts/TheCorsairbyAnonymous.json'),
	(12,'churchill',1,'We Shall Fight Them on the Beaches','Winston Churchill',0,'assets/processedTexts/WeShallFightThemOnTheBeachesbyWinstonChurchill.json'),
	(13,'bible',4,'King James Bible','Multiple',0,'assets/processedTexts/KingJamesBible.json'),
	(14,'luther-king',1,'I Have A Dream','Martin Luther King',0,'assets/processedTexts/IHaveADreambyMartinLutherKing.json');

/*!40000 ALTER TABLE `processed_texts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `email`, `password`)
VALUES
	(1,'admin000','admin@admin.admin','$2y$10$xKkiwusLpBu.wMrV7OVruuOY74WMqSu/AvYDV5HHPXIYuaDTxKV9q'),
	(2,'Guest','guest@guest.guest','$2y$10$2wK1ZJJwSgHf2f9S3mpXeONVqGbKny.Ivqjv8485l0.jhRtyusf9G'),
	(5,'MrLukey','luke.a.landau@gmail.com','$2y$10$fqoB9yNaZpL341ZB6dson.YI2Fifixf56mgtbOOY2rV.wLZzSkhKC');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.34)
# Database: mimic_speaker_database
# Generation Time: 2021-10-12 20:50:46 +0000
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
  `user_id` int(11) unsigned NOT NULL,
  `logins` int(11) unsigned NOT NULL DEFAULT '0',
  `login_attempts` int(11) unsigned NOT NULL DEFAULT '0',
  `mimics_liked` int(11) unsigned NOT NULL DEFAULT '0',
  `mimics_unliked` int(11) unsigned NOT NULL DEFAULT '0',
  `mimic_speakers_built` int(11) unsigned NOT NULL DEFAULT '0',
  `mimics_generated` int(11) unsigned NOT NULL DEFAULT '0',
  `mimics_published` int(11) unsigned NOT NULL DEFAULT '0',
  `mimics_deleted` int(11) unsigned NOT NULL DEFAULT '0',
  `mimics_recovered` int(11) unsigned NOT NULL DEFAULT '0',
  `last_active` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;

INSERT INTO `activity` (`id`, `user_id`, `logins`, `login_attempts`, `mimics_liked`, `mimics_unliked`, `mimic_speakers_built`, `mimics_generated`, `mimics_published`, `mimics_deleted`, `mimics_recovered`, `last_active`)
VALUES
	(7,6,1,1,0,0,0,0,0,0,0,'2021-10-12 20:40:23'),
	(8,7,1,0,0,0,0,0,0,0,0,'2021-10-12 20:40:24'),
	(9,8,1,0,0,0,7,20,3,0,0,'2021-10-12 20:48:50');

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
	(111,7,12,'Leopold called upon them losses in vain upon the question of increasing stringency to cover had rescued in upon us all who were brought off by orders from that what was told by orders the queen victoriaâ€™s rifles we should the tragic consequences that loss that was driven into such.','2021-10-12 20:20:37',0,0),
	(112,7,11,'Might doubt its truth castle lost to breeze her virtuous sway grew the surging current loitered before us will pray thee and loved behind growling like sunshine narrow pass profound through islandsâ€™ darkling groves as from brooklyn and irate main these tropic seas were of wing his norman castle by.','2021-10-12 20:20:50',0,0),
	(113,7,11,'Last fair islands of wing neptuneâ€™s silent builder to bind her amber hue some dread those racking clouds fond maid found he might doubt its cells with never-ceasing flashing of slaughter it died of ship was the spirit long was lighted revealed despair natureâ€™s throne the azores his daughter leonore.','2021-10-12 20:22:18',0,0),
	(114,8,11,'Dutchmanâ€™s fire was lighted oâ€™er them till that had made the earth was that eâ€™er with never-ceasing flashing did pra on your father held in darknes in all her virtuous sway the res them in crowds from seaward we shall stream no fond maid found it shall blow the royal.','2021-10-12 20:32:33',0,0),
	(115,8,13,'Buyer for fortyâ€™s sake turn their offspring shall make merchandise is only doeth these dwelt had some place mahanaim and irad wherewith spread peace shall cover not lift them joshua to bashan remained alive nothing with israel remove it galeed that remaineth have need of jashen with winding stairs that.','2021-10-12 20:47:48',0,0),
	(116,8,11,'Glory fated could stand below where turbid waters wide before their motherâ€™s quest to catch the lightningâ€™s lurid rays where night her head to breast to read of brightness flew may dance upon his noble breast the dutch behind her childre her side growling like pearl the orange grew phantom-like.','2021-10-12 20:48:33',0,0);

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
	(6,'admin000','admin@admin.admin','$2y$10$pwEY2.SBe2tzeg5QdjtI9.1q2EhmSEOU6cMDcdXY30hqvciT2U2aK'),
	(7,'Guest','guest@guest.guest','$2y$10$./L/2d8A2BySX3gWshYdzOhpFb5QKwMgy5lhF.cWJzhE0ifox9I86'),
	(8,'MrLukey','luke.a.landau@gmail.com','$2y$10$FmtPbk9Uwyrs/1adnY045.8QKZEVCl/v.L7OTVbI4SGgv3LXG2L3q');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

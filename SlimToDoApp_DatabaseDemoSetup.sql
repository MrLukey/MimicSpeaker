# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.34)
# Database: SlimToDoApp
# Generation Time: 2021-09-27 17:34:25 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tasks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `creationTime` varchar(20) NOT NULL DEFAULT 'N/A',
  `complete` tinyint(1) NOT NULL DEFAULT '0',
  `completionTime` varchar(20) NOT NULL DEFAULT 'N/A',
  `archived` tinyint(4) NOT NULL DEFAULT '0',
  `archivedTime` varchar(20) NOT NULL DEFAULT 'N/A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;

INSERT INTO `tasks` (`id`, `title`, `text`, `creationTime`, `complete`, `completionTime`, `archived`, `archivedTime`)
VALUES
	(179,'What is Lorem Ipsum?','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','2021-09-26 17:17:08',0,'N/A',0,'N/A'),
	(181,'Where does it come from?','Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.','2021-09-26 17:18:12',0,'N/A',0,'N/A'),
	(182,'Why do we use it?','t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).','2021-09-26 17:18:26',0,'N/A',0,'N/A'),
	(183,'Where can I get some?','There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.','2021-09-26 17:18:45',1,'2021-09-26 17:22:03',0,'N/A'),
	(184,'Lorem ipsum dolor sit amet, consectetur adipiscing elit.','Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Felis eget velit aliquet sagittis id consectetur purus ut faucibus. Sed augue lacus viverra vitae congue eu consequat. Urna et pharetra pharetra massa massa ultricies mi. Enim praesent elementum facilisis leo vel fringilla est ullamcorper. Nibh cras pulvinar mattis nunc sed blandit libero. Maecenas pharetra convallis posuere morbi leo urna molestie at. A cras semper auctor neque vitae tempus. Suspendisse in est ante in nibh mauris cursus. Magna fringilla urna porttitor rhoncus dolor purus non enim. Viverra aliquet eget sit amet tellus cras. Non pulvinar neque laoreet suspendisse interdum consectetur. Euismod quis viverra nibh cras pulvinar mattis nunc. Nibh praesent tristique magna sit amet purus gravida quis. Tempor commodo ullamcorper a lacus vestibulum sed. Nisi lacus sed viverra tellus in hac habitasse platea. Posuere morbi leo urna molestie at elementum eu.','2021-09-26 17:20:13',1,'2021-09-26 17:22:08',0,'N/A'),
	(185,'Enim neque volutpat ac tincidunt vitae semper quis.','Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Interdum velit euismod in pellentesque massa placerat duis ultricies. Volutpat sed cras ornare arcu dui vivamus. Cursus eget nunc scelerisque viverra mauris. Integer malesuada nunc vel risus commodo viverra maecenas accumsan lacus. Lorem mollis aliquam ut porttitor leo a. Sagittis id consectetur purus ut faucibus. Ac tortor dignissim convallis aenean et. Nunc eget lorem dolor sed. Quis eleifend quam adipiscing vitae proin sagittis nisl rhoncus. Ullamcorper malesuada proin libero nunc consequat interdum. Eu consequat ac felis donec. Nunc eget lorem dolor sed viverra ipsum nunc aliquet bibendum. Aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque.','2021-09-26 17:20:44',1,'2021-09-26 17:22:26',1,'2021-09-26 17:22:45'),
	(186,'Eu augue ut lectus arcu bibendum.','Enim nulla aliquet porttitor lacus luctus. Mi tempus imperdiet nulla malesuada pellentesque elit eget. At augue eget arcu dictum. Faucibus scelerisque eleifend donec pretium vulputate sapien nec sagittis aliquam. Augue ut lectus arcu bibendum at varius vel pharetra. Faucibus scelerisque eleifend donec pretium vulputate sapien nec sagittis. Condimentum id venenatis a condimentum vitae. Molestie a iaculis at erat pellentesque adipiscing. Interdum posuere lorem ipsum dolor sit. Arcu non sodales neque sodales. Morbi leo urna molestie at elementum eu facilisis sed. Sit amet nisl suscipit adipiscing bibendum est ultricies. Dictum fusce ut placerat orci nulla pellentesque. Nec feugiat in fermentum posuere urna nec tincidunt praesent semper.','2021-09-26 17:20:56',1,'2021-09-26 17:22:29',0,'N/A'),
	(187,'Id aliquet lectus proin nibh nisl condimentum id venenatis a.','Duis ultricies lacus sed turpis tincidunt. Sagittis vitae et leo duis ut diam quam nulla porttitor. Quis lectus nulla at volutpat diam ut venenatis tellus in. Et ultrices neque ornare aenean euismod. Duis convallis convallis tellus id interdum velit laoreet id donec. Venenatis lectus magna fringilla urna porttitor. Sed faucibus turpis in eu mi. Ultrices neque ornare aenean euismod. Risus nec feugiat in fermentum posuere urna nec. Dui nunc mattis enim ut tellus elementum.','2021-09-26 17:21:12',1,'2021-09-26 17:22:31',1,'2021-09-26 17:22:41'),
	(188,'Faucibus vitae aliquet nec ullamcorper sit amet risus nullam.','Mattis molestie a iaculis at erat pellentesque. Eget felis eget nunc lobortis mattis aliquam. Interdum velit laoreet id donec ultrices tincidunt. Elit at imperdiet dui accumsan. Ac tortor dignissim convallis aenean et tortor at risus. Blandit turpis cursus in hac habitasse. Facilisis gravida neque convallis a cras semper auctor neque. Posuere lorem ipsum dolor sit. Urna cursus eget nunc scelerisque. Adipiscing vitae proin sagittis nisl rhoncus. Massa tincidunt nunc pulvinar sapien et ligula ullamcorper. Enim nec dui nunc mattis enim ut. Et tortor at risus viverra adipiscing at in tellus integer.','2021-09-26 17:21:26',1,'2021-09-26 17:22:33',1,'2021-09-26 17:22:50');

/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.8.4-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table schoo_chatbotv2.board
CREATE TABLE IF NOT EXISTS `board` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `data` text DEFAULT NULL,
  `preview` text DEFAULT NULL,
  `data_file` text DEFAULT NULL,
  `post_by` text DEFAULT NULL,
  `line_userid` text DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `remove_post` enum('0','1') DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table schoo_chatbotv2.course
CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` text DEFAULT NULL,
  `name_course` text DEFAULT NULL,
  `about_course` text DEFAULT NULL,
  `banner_course` text DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table schoo_chatbotv2.dialogflow
CREATE TABLE IF NOT EXISTS `dialogflow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_name` text DEFAULT NULL,
  `name_intent` text DEFAULT NULL,
  `input_text` text DEFAULT NULL,
  `output_text` text DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table schoo_chatbotv2.leave_data
CREATE TABLE IF NOT EXISTS `leave_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` text DEFAULT NULL,
  `line_userid` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `premise` text DEFAULT NULL,
  `grade` text DEFAULT NULL,
  `class` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table schoo_chatbotv2.media
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `data` text DEFAULT NULL,
  `preview` text DEFAULT NULL,
  `file` text DEFAULT NULL,
  `type_file` enum('youtube','file','drive','pdf') DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `class` text DEFAULT NULL,
  `media_remove` int(11) DEFAULT 0,
  `post_by` text DEFAULT NULL,
  `line_userid` text DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table schoo_chatbotv2.teacher
CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` text DEFAULT NULL,
  `line_userid` text DEFAULT NULL,
  `course` text DEFAULT NULL,
  `teach_grade` text DEFAULT NULL,
  `teach_class` text DEFAULT NULL,
  `levels` text DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table schoo_chatbotv2.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` text DEFAULT NULL,
  `card_id` text DEFAULT NULL,
  `register` enum('0','1') DEFAULT '0',
  `name` text DEFAULT NULL,
  `lastname` text DEFAULT NULL,
  `profile` text DEFAULT NULL,
  `line_userid` text DEFAULT NULL,
  `phone_parent` text DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `class` text DEFAULT NULL,
  `type_user` enum('student','teacher','admin') DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `expired` enum('0','1') DEFAULT NULL,
  `main_function` text DEFAULT NULL,
  `sub_function` text DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

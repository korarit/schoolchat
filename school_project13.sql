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


-- Dumping database structure for schoo_chatbotv2
CREATE DATABASE IF NOT EXISTS `schoo_chatbotv2` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `schoo_chatbotv2`;

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

-- Dumping data for table schoo_chatbotv2.board: ~1 rows (approximately)
INSERT INTO `board` (`id`, `course`, `title`, `data`, `preview`, `data_file`, `post_by`, `line_userid`, `post_date`, `remove_post`) VALUES
	(6, 'thai', 'เชิญชวนนักเรียนเข้าชมนิทรรศการแนะนำหนังสือดีน่าอ่าน', 'กลุ่มสาระการเรียนรู้ภาษาไทย เชิญชวนนักเรียนเข้าชมนิทรรศการแนะนำหนังสือดีน่าอ่าน ห้วข้อ “หนังสือเล่มนี้ดี พี่อยากเล่า” ของนักเรียนชั้นมัธยมศึกษาปีที่ 5', '/upload/board/preview/305709609.png', '/upload/board/data/305709609.jpg', 'กรฤต แสงทอง', 'U487983dab42aeebbc038716e93c27eab', '2022-09-02', '0');

-- Dumping structure for table schoo_chatbotv2.course
CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` text DEFAULT NULL,
  `name_course` text DEFAULT NULL,
  `about_course` text DEFAULT NULL,
  `banner_course` text DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table schoo_chatbotv2.course: ~3 rows (approximately)
INSERT INTO `course` (`id`, `course`, `name_course`, `about_course`, `banner_course`) VALUES
	(2, 'math', 'คณิต', 'สวัสดี', 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_1_cafe.png'),
	(3, 'science', 'วิทยาศาสตร์', 'add', 'https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_1_cafe.png'),
	(4, 'thai', 'ภาษาไทย', 'วิชาภาษาไทย', 'https://scontent.fphs2-1.fna.fbcdn.net/v/t1.6435-9/188482559_104990915113914_1506852693298598173_n.png?_nc_cat=107&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeEwcgABDffbphxKS5lk6NePZjvxiu-Hxc5mO_GK74fFzstY4I28FOLtR0sTJBjY2JRvHKjuwzLm5EB2v7h96zBW&_nc_ohc=Xc2L2xF0AtsAX8CLgz8&tn=vBG6lMYQni5XlNIf&_nc_ht=scontent.fphs2-1.fna&oh=00_AT-I-B2vXrvbbLFYoAUjZhYWGIblFRfze3kpsc7LCtq7aA&oe=6343879F');

-- Dumping structure for table schoo_chatbotv2.dialogflow
CREATE TABLE IF NOT EXISTS `dialogflow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_name` text DEFAULT NULL,
  `name_intent` text DEFAULT NULL,
  `input_text` text DEFAULT NULL,
  `output_text` text DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table schoo_chatbotv2.dialogflow: ~1 rows (approximately)
INSERT INTO `dialogflow` (`id`, `display_name`, `name_intent`, `input_text`, `output_text`) VALUES
	(8, 'เบอร์โทร', 'projects/ai-sheh/agent/intents/eabee6e8-4616-4eac-ac44-f4b9830cb1c4', 'ขอเบอร์โทรศัพท์ ของ โรงเรียน หน่อยครับ', 'xxx-xxx-xxxxx');

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

-- Dumping data for table schoo_chatbotv2.leave_data: ~48 rows (approximately)
INSERT INTO `leave_data` (`id`, `user_id`, `line_userid`, `name`, `type`, `reason`, `premise`, `grade`, `class`, `start_date`, `end_date`) VALUES
	(5, '111', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต', '1', 'Aaa', '/upload/leave/1005309139.png', '1', '1', '2022-08-31', '2022-08-31'),
	(6, '111', 'U487983dab42aeebbc038716e93c27eab', 'แสงทอง', '1', 'Aaa', '/upload/leave/216106442.zip', '1', '1', '2022-08-31', '2022-08-31'),
	(7, '111', 'U487983dab42aeebbc038716e93c27eab', NULL, '1', 'ฟฟฟฟ', '/upload/leave/934873573.png', NULL, NULL, '2022-09-01', '2022-09-01'),
	(8, '111', 'U487983dab42aeebbc038716e93c27eab', NULL, '1', 'ฟฟฟก', '/upload/leave/480622415.png', NULL, NULL, '2022-09-01', '2022-09-14'),
	(9, '', 'U487983dab42aeebbc038716e93c27eab', NULL, '1', 'ดดด', '/upload/leave/85035201.png', '', '', '2022-09-01', '2022-09-19'),
	(10, '', 'U487983dab42aeebbc038716e93c27eab', NULL, '1', 'ฟฟฟ', '/upload/leave/260640654.png', '', '', '2022-09-02', '2022-09-04'),
	(11, '', 'U487983dab42aeebbc038716e93c27eab', NULL, '1', 'กกกอ', '/upload/leave/502818136.png', '', '', '2022-09-01', '2022-09-08'),
	(12, '', 'U487983dab42aeebbc038716e93c27eab', NULL, '1', 'กกกอ', '/upload/leave/607673987.png', '', '', '2022-09-01', '2022-09-08'),
	(13, '', 'U487983dab42aeebbc038716e93c27eab', NULL, '1', 'กกกอ', '/upload/leave/916675048.png', '', '', '2022-09-01', '2022-09-08'),
	(14, '', 'U487983dab42aeebbc038716e93c27eab', NULL, '1', 'กกกก', '/upload/leave/792256198.png', '', '', '2022-09-01', '2022-09-09'),
	(15, '', 'U487983dab42aeebbc038716e93c27eab', NULL, '1', 'ดดดด', '/upload/leave/1229986306.png', '', '', '2022-09-01', '2022-09-16'),
	(16, '', 'U487983dab42aeebbc038716e93c27eab', NULL, '1', 'าาาาา', '/upload/leave/895413077.png', '', '', '2022-09-02', '2022-09-08'),
	(17, '222', 'U487983dab42aeebbc038716e93c27eab', NULL, '1', 'สสสส', '/upload/leave/72022672.png', '1', '1', '2022-09-01', '2022-09-08'),
	(18, '222', 'U487983dab42aeebbc038716e93c27eab', 'null null', '1', 'ดดดด', '/upload/leave/1474165540.png', '1', '1', '2022-09-15', '2022-09-08'),
	(19, '222', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'กกกด', '/upload/leave/1624500223.png', '1', '1', '2022-09-01', '2022-09-01'),
	(20, '222', 'Uf2e57e2245ac7f7d8cc43e149d50f3e2', 'กรฤต แสงทอง', '2', 'ไปคอน', '/upload/leave/1816423675.jpeg', '1', '1', '2022-09-02', '2022-09-05'),
	(21, '222', 'Uf2e57e2245ac7f7d8cc43e149d50f3e2', 'กรฤต แสงทอง', '2', 'ไปคอน', '/upload/leave/1637855735.jpeg', '1', '1', '2022-09-02', '2022-09-05'),
	(22, '222', 'Uf2e57e2245ac7f7d8cc43e149d50f3e2', 'กรฤต แสงทอง', '2', 'ไปคอน', '/upload/leave/768999838.jpeg', '1', '1', '2022-09-02', '2022-09-05'),
	(23, '222', 'Uf2e57e2245ac7f7d8cc43e149d50f3e2', 'กรฤต แสงทอง', '2', 'ไปคอนเสิร์ต', '/upload/leave/206179488.jpeg', '1', '1', '2022-11-18', '2022-11-20'),
	(24, '222', 'Uf2e57e2245ac7f7d8cc43e149d50f3e2', 'กรฤต แสงทอง', '2', 'ไปคอนเสิร์ต', '/upload/leave/863049347.jpeg', '1', '1', '2022-11-18', '2022-11-20'),
	(25, '222', 'Uf2e57e2245ac7f7d8cc43e149d50f3e2', 'กรฤต แสงทอง', '2', 'ไปคอนเสิร์ต', '/upload/leave/1140801992.jpeg', '1', '1', '2022-11-18', '2022-11-20'),
	(26, '222', 'Uf2e57e2245ac7f7d8cc43e149d50f3e2', 'กรฤต แสงทอง', '2', 'ไปคอนเสิร์ต', '/upload/leave/335687484.jpeg', '1', '1', '2022-11-18', '2022-11-20'),
	(27, '1234', 'Uf2e57e2245ac7f7d8cc43e149d50f3e2', 'ธนกฤต ชูเชิด', '2', 'ไปขายตัวช่วยครอบครัว', '/upload/leave/964448643.jpeg', '1', '1', '2022-09-03', '2022-09-04'),
	(28, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'ก', '/upload/leave/2052760064.png', '6', '4', '2022-09-07', '2022-09-08'),
	(29, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/1643955726.png', '6', '4', '2022-09-08', '2022-09-10'),
	(30, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/868227501.png', '6', '4', '2022-09-08', '2022-09-10'),
	(31, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/648528001.png', '6', '4', '2022-09-08', '2022-09-10'),
	(32, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/1542697296.png', '6', '4', '2022-09-08', '2022-09-10'),
	(33, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/32616092.png', '6', '4', '2022-09-08', '2022-09-10'),
	(34, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/459744118.png', '6', '4', '2022-09-08', '2022-09-10'),
	(35, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/1941206141.png', '6', '4', '2022-09-08', '2022-09-10'),
	(36, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/649685285.png', '6', '4', '2022-09-08', '2022-09-10'),
	(37, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/1599951459.png', '6', '4', '2022-09-08', '2022-09-10'),
	(38, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/1936919294.png', '6', '4', '2022-09-08', '2022-09-10'),
	(39, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/1950657669.png', '6', '4', '2022-09-08', '2022-09-10'),
	(40, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/1854712998.png', '6', '4', '2022-09-08', '2022-09-10'),
	(41, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/1879325718.png', '6', '4', '2022-09-08', '2022-09-10'),
	(42, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/408320655.png', '6', '4', '2022-09-08', '2022-09-10'),
	(43, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/230494977.png', '6', '4', '2022-09-08', '2022-09-10'),
	(44, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/490658261.png', '6', '4', '2022-09-08', '2022-09-10'),
	(45, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/2080196581.png', '6', '4', '2022-09-08', '2022-09-10'),
	(46, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/1702114516.png', '6', '4', '2022-09-08', '2022-09-10'),
	(47, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/1957028242.png', '6', '4', '2022-09-08', '2022-09-10'),
	(48, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/398153580.png', '6', '4', '2022-09-08', '2022-09-10'),
	(49, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/31333181.png', '6', '4', '2022-09-08', '2022-09-10'),
	(50, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/1726091862.png', '6', '4', '2022-09-08', '2022-09-10'),
	(51, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'สวัสดีน่ะ ลาไปนอนครับ', '/upload/leave/1042421795.png', '6', '4', '2022-09-08', '2022-09-10'),
	(52, '29609', 'U487983dab42aeebbc038716e93c27eab', 'กรฤต แสงทอง', '1', 'นอน', '/upload/leave/1517399617.jpg', '6', '4', '2022-09-10', '2022-09-23');

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

-- Dumping data for table schoo_chatbotv2.media: ~2 rows (approximately)
INSERT INTO `media` (`id`, `course`, `name`, `data`, `preview`, `file`, `type_file`, `grade`, `class`, `media_remove`, `post_by`, `line_userid`, `post_date`) VALUES
	(2, 'thai', 'เชิญชวนนักเรียนเข้าชมนิทรรศการแนะนำหนังสือดีน่าอ่าน', 'เชิญชวนนักเรียนเข้าชมนิทรรศการแนะนำหนังสือดีน่าอ่าน ห้วข้อ “หนังสือเล่มนี้ดี พี่อยากเล่า” ของนักเรียนชั้นมัธยมศึกษาปีที่ 5', '/upload/media/preview/1678906906.png', 'https://www.youtube.com/embed/d2--BcJx0-s', 'youtube', 1, '1', 0, 'กรฤต แสงทอง', 'U487983dab42aeebbc038716e93c27eab', '2022-09-03'),
	(11, 'thai', 'มี1', 'อะไรครับ', '/upload/media/preview/1840797186.png', '/upload/media/data/2090686815.png', 'file', 1, '1', 0, 'กรฤต แสงทอง', 'U487983dab42aeebbc038716e93c27eab', '2022-09-10');

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

-- Dumping data for table schoo_chatbotv2.teacher: ~1 rows (approximately)
INSERT INTO `teacher` (`id`, `user_id`, `line_userid`, `course`, `teach_grade`, `teach_class`, `levels`) VALUES
	(3, '29609', 'U487983dab42aeebbc038716e93c27eab', 'thai', '1', 'O1', 'ครู');

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

-- Dumping data for table schoo_chatbotv2.user: ~1 rows (approximately)
INSERT INTO `user` (`id`, `user_id`, `card_id`, `register`, `name`, `lastname`, `profile`, `line_userid`, `phone_parent`, `grade`, `class`, `type_user`, `start_date`, `expired`, `main_function`, `sub_function`) VALUES
	(7, '29609', 'e7a156930dbf02ca64172e7c375a668ea0e2e62e', '1', 'กรฤต', 'แสงทอง', NULL, 'U487983dab42aeebbc038716e93c27eab', '0909265955', 6, '4', 'teacher', '2022-09-04', NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

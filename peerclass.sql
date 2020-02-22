-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Feb 22, 2020 at 05:23 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peerclass`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment_course`
--

DROP TABLE IF EXISTS `assignment_course`;
CREATE TABLE IF NOT EXISTS `assignment_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` int(11) NOT NULL,
  `topic` text NOT NULL,
  `approval` int(11) NOT NULL DEFAULT '-1',
  `loc` text NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assignment_course`
--

INSERT INTO `assignment_course` (`id`, `course`, `topic`, `approval`, `loc`, `dt`) VALUES
(1, 4, 'Django', 1, '1/assignment/ARNOLD_MRI_Overview.pdf', '2020-02-22 02:43:46'),
(2, 7, 'HTML + CSS', 0, '2/assignment/ARNOLD_MRI_Overview.pdf', '2020-02-22 07:48:33');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_questions`
--

DROP TABLE IF EXISTS `assignment_questions`;
CREATE TABLE IF NOT EXISTS `assignment_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson` int(14) DEFAULT NULL,
  `question` text,
  `answer1` text,
  `answer2` text,
  `answer3` text,
  `answer4` text,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assignment_questions`
--

INSERT INTO `assignment_questions` (`id`, `lesson`, `question`, `answer1`, `answer2`, `answer3`, `answer4`, `dt`) VALUES
(1, 1, 'What is this?', 'Programming Language', 'App', 'Apple', 'Android', '2020-02-15 14:48:42'),
(2, 1, 'This is?', 'correct', 'wrong1', 'wrong 2', 'wrong 3', '2020-02-15 15:12:43'),
(3, 6, 'What is Django?', 'A web development framework', 'Software', 'Language', 'IDE', '2020-02-19 11:03:30'),
(4, 2, 'Find a python operator from below?', '=', ',', '.', '/', '2020-02-22 15:47:19'),
(5, 3, 'What is Django?', 'A web development framework', 'Software', 'Language', 'IDE', '2020-02-22 17:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`) VALUES
(1, 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `connections`
--

DROP TABLE IF EXISTS `connections`;
CREATE TABLE IF NOT EXISTS `connections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person1` int(11) NOT NULL,
  `person2` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `type` text,
  `category` text,
  `branch` text NOT NULL,
  `language` text NOT NULL,
  `tags` text,
  `description` text,
  `teacher` int(14) DEFAULT NULL,
  `rank` float NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `type`, `category`, `branch`, `language`, `tags`, `description`, `teacher`, `rank`, `dt`) VALUES
(4, 'Introduction to Django', 'Web Development', 'Engineering', 'Computer Science', 'Python', 'python,programming,engineering', 'The Web Framework for perfectionists with deadlines.\r\nWeb Application Framework written in python programming language.\r\nVery demanding due to rapid development feature.\r\nLess time to build an application after collecting client requirements.\r\nSites using Django: Instagram,Mozilla.\r\nDjango in Instagram: \r\n-Instagram uses Django ORM to manage over 5 million users,it starts quickly as it is accessed as it uses django which is tightly integrated.\r\n-ORM can be replaced if Django is loosely coupled.\r\n-Instagram features the world’s largest deployment of Django Web Framework.\r\n', 2, 0, '2020-02-11 21:10:21'),
(7, 'Introduction To Python', 'Web Development', 'Engineering', 'Computer Science', 'Python', 'python, pip ,fandango', 'Python is an interpreted, high-level, general-purpose programming language. Created by Guido van Rossum and first released in 1991, Python\'s design philosophy emphasizes code readability with its notable use of significant whitespace.', 2, 0, '2020-02-14 20:48:47'),
(8, 'Introduction to HTML', 'Web Development', 'Engineering', 'Computer Science', 'HTML', 'web development, html,css', 'HTML is standard markup language for documents designed to be displayed in a web browser.With HTML, you can create your own website.It can be assisted by technologies like CSS (Cascading Style Sheets) and Scripting languages such as JavaScript. ', 5, 0, '2020-02-22 10:16:51'),
(9, 'CSS', 'Web Development', 'Engineering', 'Computer Science', 'CSS', 'layout,colors,fonts', 'CSS is a style sheet language used for describing the presentation of a document written in a markup language like HTML.CSS is a cornerstone technology of the World Wide Web, alongside HTML and JavaScript.', 5, 0, '2020-02-22 10:25:30'),
(10, 'JavaScript', 'Web Development', 'Engineering', 'Computer Science', 'Javascript', 'event-driven, functional, imperative', 'JavaScript or JS is an interpreted programming language. JS is high-level,just in time compiled and multi-paradigm.', 5, 0, '2020-02-22 10:30:42'),
(11, 'Tensor Flow', 'Machine Learning', 'Engineering', 'Computer Science', 'Python', 'python, machine learning,ai', 'TensorFlow is a free and open-source software library for dataflow and differentiable programming across a range of tasks. It is a symbolic math library, and is also used for machine learning applications such as neural networks.', 5, 0, '2020-02-22 10:34:35'),
(12, 'Sci-Kit Learn', 'Machine Learning', 'Engineering', 'Computer Science', 'Python', 'python,AI,beginner', 'Scikit-learn is a free software machine learning library for the Python programming language. It features various classification, regression and clustering algorithms including support vector machines', 6, 0, '2020-02-22 10:36:08'),
(13, 'Android App Development Using Android Studio', 'Mobile App Development', 'Engineering', 'Computer Science', 'Java', 'Android Studio,java, mobile applications', 'Android Studio is the official integrated development environment for Google\'s Android operating system, built on JetBrains\' IntelliJ IDEA software and designed specifically for Android development. It is available for download on Windows, macOS and Linux based operating systems.', 6, 0, '2020-02-22 10:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
CREATE TABLE IF NOT EXISTS `lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `course` int(14) DEFAULT NULL,
  `description` text,
  `tags` text,
  `assignment` int(10) NOT NULL DEFAULT '0',
  `assignment_due` datetime DEFAULT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `name`, `course`, `description`, `tags`, `assignment`, `assignment_due`, `dt`) VALUES
(1, 'Data Structure', 7, 'This lesson focuses on simple data structure in python programming.', NULL, 0, NULL, '2020-02-11 22:06:24'),
(2, 'Operators', 7, 'This lesson is about operators in Python.', 'python, operators', 0, NULL, '2020-02-14 21:09:01'),
(3, 'Introduction', 4, 'This is a basic introduction course to django', 'beginner to django', 1, NULL, '2020-02-14 22:15:31'),
(6, 'Installing Django on PC', 4, 'Learn how to install Django on your PC', 'pc, windows,mac', 1, '2020-02-20 00:00:00', '2020-02-15 14:26:16'),
(7, 'Machine Learning With Tensor FLow', 11, 'Beginner introduction to Tensor flow', 'tensor flow, python', 0, '0000-00-00 00:00:00', '2020-02-22 15:49:36');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_files`
--

DROP TABLE IF EXISTS `lesson_files`;
CREATE TABLE IF NOT EXISTS `lesson_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loc` text,
  `lesson` int(14) DEFAULT NULL,
  `data` text,
  `type` text,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lesson_files`
--

INSERT INTO `lesson_files` (`id`, `loc`, `lesson`, `data`, `type`, `dt`) VALUES
(8, NULL, 3, 'https://www.youtube.com/watch?v=D6esTdOLXh4', 'yt', '2020-02-21 20:22:50'),
(7, NULL, 3, 'https://simpleisbetterthancomplex.com/\r\n', 'link', '2020-02-21 20:22:22'),
(6, NULL, 3, 'https://realpython.com/tutorials/django/\r\n', 'link', '2020-02-21 20:22:09'),
(9, NULL, 3, 'https://www.youtube.com/watch?v=F5mRW0jo-U4\r\n', 'yt', '2020-02-21 20:23:02'),
(10, NULL, 2, 'https://www.youtube.com/watch?v=O9RPGLDXkF0', 'yt', '2020-02-22 02:20:42'),
(11, '1/assignment/ARNOLD_MRI_Overview.pdf', NULL, NULL, 'doc', '2020-02-22 03:46:19'),
(12, '1/assignment/ARNOLD_MRI_Overview.pdf', NULL, NULL, 'doc', '2020-02-22 03:47:33'),
(13, '1/assignment/ARNOLD_MRI_Overview.pdf', NULL, NULL, 'doc', '2020-02-22 03:48:00'),
(14, NULL, 1, 'https://www.youtube.com/watch?v=RBSGKlAvoiM', 'yt', '2020-02-22 15:44:49'),
(15, NULL, 1, 'https://www.youtube.com/watch?v=BBpAmxU_NQo', 'yt', '2020-02-22 15:45:07'),
(16, NULL, 1, 'https://thomas-cokelaer.info/tutorials/python/data_structures.html', 'link', '2020-02-22 15:46:08'),
(17, NULL, 7, 'https://www.youtube.com/watch?v=tXVNS-V39A0', 'yt', '2020-02-22 15:55:02'),
(18, NULL, 7, 'https://www.tensorflow.org/', 'link', '2020-02-22 15:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `user` int(11) NOT NULL,
  `data` text NOT NULL,
  `dt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
CREATE TABLE IF NOT EXISTS `survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prev_id` int(11) NOT NULL,
  `question` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_results`
--

DROP TABLE IF EXISTS `survey_results`;
CREATE TABLE IF NOT EXISTS `survey_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phase` int(11) NOT NULL,
  `ans` text NOT NULL,
  `student` int(11) NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `survey_results`
--

INSERT INTO `survey_results` (`id`, `phase`, `ans`, `student`, `dt`) VALUES
(58, 2, 'Machine Learning', 1, '2020-02-22 19:38:09'),
(57, 1, 'Computer Science', 1, '2020-02-22 19:38:06'),
(56, 3, 'Python', 1, '2020-02-22 18:11:14'),
(55, 2, 'Web Development', 1, '2020-02-22 18:11:12'),
(54, 1, 'Computer Science', 1, '2020-02-22 18:11:08'),
(43, 2, 'Web Development', 1, '2020-02-21 20:46:50'),
(44, 3, 'Python', 1, '2020-02-21 20:46:52'),
(45, 1, 'Computer Science', 1, '2020-02-21 22:26:22'),
(46, 2, 'Web Development', 1, '2020-02-21 22:26:38'),
(47, 3, 'Python', 1, '2020-02-21 22:26:41'),
(48, 1, 'Computer Science', 1, '2020-02-22 12:27:04'),
(49, 2, 'Web Development', 1, '2020-02-22 12:27:08'),
(50, 3, 'Python', 1, '2020-02-22 12:27:12'),
(51, 1, 'Computer Science', 1, '2020-02-22 15:59:58'),
(52, 2, 'Machine Learning', 1, '2020-02-22 16:00:01'),
(53, 3, 'Java', 1, '2020-02-22 16:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `s_assign_ans`
--

DROP TABLE IF EXISTS `s_assign_ans`;
CREATE TABLE IF NOT EXISTS `s_assign_ans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assignment` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `lesson` int(11) NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `s_assign_ans`
--

INSERT INTO `s_assign_ans` (`id`, `assignment`, `answer`, `lesson`, `dt`) VALUES
(12, 3, 1, 6, '2020-02-22 18:00:28'),
(11, 5, 1, 3, '2020-02-22 17:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `s_courses`
--

DROP TABLE IF EXISTS `s_courses`;
CREATE TABLE IF NOT EXISTS `s_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` int(14) NOT NULL,
  `student` int(14) NOT NULL,
  `completed` int(10) NOT NULL DEFAULT '0',
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `s_courses`
--

INSERT INTO `s_courses` (`id`, `course`, `student`, `completed`, `dt`) VALUES
(17, 7, 1, 0, '2020-02-22 12:28:09'),
(16, 4, 1, 0, '2020-02-22 08:29:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

DROP TABLE IF EXISTS `tbl_comment`;
CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_comment_id` int(11) DEFAULT NULL,
  `comment` varchar(200) NOT NULL,
  `sender` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lesson` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`comment_id`, `parent_comment_id`, `comment`, `sender`, `lesson`, `date`) VALUES
(11, 0, '    comment 1', '1', 6, '2020-02-18 16:34:42'),
(12, 11, '  comment 1 reply', '1', 6, '2020-02-18 16:34:49'),
(13, 12, '  comment 1 reply reply', '1', 6, '2020-02-18 16:34:59'),
(14, 0, '  comment 2', '1', 6, '2020-02-18 16:35:08'),
(15, 12, 'hey', '1', 6, '2020-02-18 16:35:15'),
(16, 0, '  hello', '1', 6, '2020-02-18 16:36:17'),
(17, 0, '  what>?', '1', 3, '2020-02-22 03:51:06'),
(18, 0, '  hi', '2', 2, '2020-02-22 05:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `useremail` varchar(128) NOT NULL,
  `username` varchar(32) NOT NULL,
  `userpassword` varchar(128) NOT NULL,
  `teacher` int(11) NOT NULL DEFAULT '0',
  `termcondition` tinyint(1) NOT NULL DEFAULT '0',
  `userstatus` tinyint(4) NOT NULL DEFAULT '0',
  `token` varchar(128) NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `useremail`, `username`, `userpassword`, `teacher`, `termcondition`, `userstatus`, `token`, `dt`) VALUES
(1, 'demo@demo.com', 'demo', '1a1dc91c907325c69271ddf0c944bc72', 0, 1, 1, '', '2020-02-09 14:47:08'),
(2, 'teacher@teacher.com', 'teacher', '1a1dc91c907325c69271ddf0c944bc72', 1, 1, 1, '', '2020-02-09 15:43:24'),
(6, 'teacher2@teacher.com', 'teacher2', '1a1dc91c907325c69271ddf0c944bc72', 1, 1, 1, 'b5e5be6b9310db3405ede628cd63c118', '2020-02-18 22:22:48'),
(5, 'teacher1@teacher.com', 'teacher1', '1a1dc91c907325c69271ddf0c944bc72', 1, 1, 1, 'f2407741d247631feef9f4063f069879', '2020-02-18 22:22:37'),
(7, 'teacher3@teacher.com', 'teacher3', '1a1dc91c907325c69271ddf0c944bc72', 1, 1, 1, 'b77bd63ede66fcdcec5a86aebfbe0f25', '2020-02-18 22:22:53'),
(8, 'teacher4@teacher.com', 'teacher4', '1a1dc91c907325c69271ddf0c944bc72', 1, 1, 1, '97e40e98e50e5e215e1a859796e48345', '2020-02-18 22:22:58'),
(9, 's1@demo.com', 'student1', '1a1dc91c907325c69271ddf0c944bc72', 0, 1, 1, 'd0405033cc864d26eec30c0dd9fd840e', '2020-02-18 22:23:22'),
(10, 's2@demo.com', 'student2', '1a1dc91c907325c69271ddf0c944bc72', 0, 1, 1, 'b27221e596e165735d46aa1195f8c70c', '2020-02-18 22:23:27'),
(11, 's3@demo.com', 'student3', '1a1dc91c907325c69271ddf0c944bc72', 0, 1, 1, '19af2e343103aa63f958a2ee97e591ef', '2020-02-18 22:23:32'),
(12, 's4@demo.com', 'student4', '1a1dc91c907325c69271ddf0c944bc72', 0, 1, 1, 'f9a90bf48de6e9a7b37c60d92d1c7237', '2020-02-18 22:23:38'),
(13, 's5@demo.com', 'student5', '1a1dc91c907325c69271ddf0c944bc72', 0, 1, 1, 'de1999cf81b46cfb58671c19c77a27b8', '2020-02-18 22:23:43'),
(14, 's6@demo.com', 'student6', '1a1dc91c907325c69271ddf0c944bc72', 0, 1, 1, 'b85152d1c0c2d7b8c03f417a8acccfbb', '2020-02-18 22:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_user` int(11) NOT NULL,
  `fname` text NOT NULL,
  `last_name` text NOT NULL,
  `p_img` text NOT NULL,
  `qualification` text NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `tb_user`, `fname`, `last_name`, `p_img`, `qualification`, `dt`) VALUES
(1, 1, 'Demo', 'User', 'https://placehold.it/80x80', '0', '2020-02-18 19:22:00'),
(2, 2, 'Teacher', 'One', 'https://placehold.it/80x80', '0', '2020-02-18 19:22:00'),
(3, 5, '', '', '', '', '2020-02-18 22:22:37'),
(4, 6, '', '', '', '', '2020-02-18 22:22:48'),
(5, 7, '', '', '', '', '2020-02-18 22:22:53'),
(6, 8, '', '', '', '', '2020-02-18 22:22:58'),
(7, 9, '', '', '', '', '2020-02-18 22:23:22'),
(8, 10, '', '', '', '', '2020-02-18 22:23:27'),
(9, 11, '', '', '', '', '2020-02-18 22:23:32'),
(10, 12, '', '', '', '', '2020-02-18 22:23:38'),
(11, 13, '', '', '', '', '2020-02-18 22:23:43'),
(12, 14, '', '', '', '', '2020-02-18 22:23:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

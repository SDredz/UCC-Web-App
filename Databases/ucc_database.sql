-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 16, 2024 at 03:50 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ucc_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `course_code` varchar(6) NOT NULL,
  `course_title` varchar(100) DEFAULT NULL,
  `course_credits` int DEFAULT NULL,
  `degree_level` varchar(50) DEFAULT NULL,
  `prerequisites` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`course_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_code`, `course_title`, `course_credits`, `degree_level`, `prerequisites`) VALUES
('PSY123', 'Introduction to Psychology', 3, 'Undergraduate', 'None'),
('ITT419', 'Internet Authoring II', 3, 'Undergraduate', 'Internet Authoring 1');

-- --------------------------------------------------------

--
-- Table structure for table `course_enrolment`
--

DROP TABLE IF EXISTS `course_enrolment`;
CREATE TABLE IF NOT EXISTS `course_enrolment` (
  `course_code` varchar(6) NOT NULL,
  `student_id` int UNSIGNED DEFAULT NULL,
  `semesteryear` year DEFAULT NULL,
  `course_work_grade` float DEFAULT NULL,
  `final_exam_grade` float DEFAULT NULL,
  `project_grade` float DEFAULT NULL,
  PRIMARY KEY (`course_code`),
  KEY `student_id` (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course_enrolment`
--

INSERT INTO `course_enrolment` (`course_code`, `student_id`, `semesteryear`, `course_work_grade`, `final_exam_grade`, `project_grade`) VALUES
('MKT201', 2023001, 2024, 50, 0, 30),
('ITT419', 2023002, 2024, 20, 0, 19);

-- --------------------------------------------------------

--
-- Table structure for table `course_schedule`
--

DROP TABLE IF EXISTS `course_schedule`;
CREATE TABLE IF NOT EXISTS `course_schedule` (
  `course_code` varchar(6) NOT NULL,
  `lecturer_ID` int UNSIGNED DEFAULT NULL,
  `semesteryear` year DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `section` varchar(100) DEFAULT NULL,
  `course_day` varchar(9) DEFAULT NULL,
  `course_time` varchar(4) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  UNIQUE KEY `course_code` (`course_code`),
  KEY `lecturer_ID` (`lecturer_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course_schedule`
--

INSERT INTO `course_schedule` (`course_code`, `lecturer_ID`, `semesteryear`, `semester`, `section`, `course_day`, `course_time`, `location`) VALUES
('HUM101', 2014587, 2024, 'Summer', 'Human Resources', 'Thursday', '11am', 'ONLINE'),
('BIS203', 2014587, 2024, 'Summer', 'Business Administration', 'Monday', '08pm', 'ONLINE');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_database`
--

DROP TABLE IF EXISTS `lecturer_database`;
CREATE TABLE IF NOT EXISTS `lecturer_database` (
  `lecturer_ID` int UNSIGNED NOT NULL,
  `lecturer_title` varchar(45) DEFAULT NULL,
  `lecturer_firstname` varchar(45) DEFAULT NULL,
  `lecturer_lastname` varchar(45) DEFAULT NULL,
  `lecturer_department` varchar(45) DEFAULT NULL,
  `lecturer_position` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`lecturer_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lecturer_database`
--

INSERT INTO `lecturer_database` (`lecturer_ID`, `lecturer_title`, `lecturer_firstname`, `lecturer_lastname`, `lecturer_department`, `lecturer_position`) VALUES
(2010158, 'Miss', 'Sophia', 'Brown', 'Information Technology', 'Staff Lecturer'),
(2014587, 'Miss', 'Ryah', 'Lynn', 'Business Administration', 'Adjunct Lecturer'),
(2020654, 'Mr', 'Otis', 'Osbourne', 'Information Technology', 'Head of Department');

-- --------------------------------------------------------

--
-- Table structure for table `login_lec_cred`
--

DROP TABLE IF EXISTS `login_lec_cred`;
CREATE TABLE IF NOT EXISTS `login_lec_cred` (
  `lecturer_ID` int UNSIGNED DEFAULT NULL,
  `pass_word` varchar(14) DEFAULT NULL,
  UNIQUE KEY `lecturer_ID` (`lecturer_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_stu_cred`
--

DROP TABLE IF EXISTS `login_stu_cred`;
CREATE TABLE IF NOT EXISTS `login_stu_cred` (
  `student_id` int UNSIGNED DEFAULT NULL,
  `pass_word` varchar(14) DEFAULT NULL,
  UNIQUE KEY `student_id` (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int UNSIGNED NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `personal_email` varchar(50) DEFAULT NULL,
  `student_email` varchar(50) DEFAULT NULL,
  `home_address` varchar(100) DEFAULT NULL,
  `home_contact` varchar(12) DEFAULT NULL,
  `work_contact` varchar(12) DEFAULT NULL,
  `mobile_contact` varchar(12) DEFAULT NULL,
  `next_of_kin` varchar(80) DEFAULT NULL,
  `nok_contact` varchar(12) DEFAULT NULL,
  `program` varchar(50) DEFAULT NULL,
  `gpa` float DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `middle_name`, `last_name`, `personal_email`, `student_email`, `home_address`, `home_contact`, `work_contact`, `mobile_contact`, `next_of_kin`, `nok_contact`, `program`, `gpa`) VALUES
(2023001, 'John', 'James', 'Doe', 'jdoe2024@hotmail.com', 'jdoe32@stu.ucc.edu.jm', '23 Duke Street, Kingston 5', '876-221-3321', '876-972-2244', '876-567-0081', 'Mary Lamb', '876-345-6789', 'Business Administration', 3.2),
(2023002, 'Helen', 'Nicole', 'Smith', 'helensmith1980@gmail.com', 'hsmith12@stu.ucc.edu.jm', 'Exchange, Ocho Rios', '876-456-0987', '876-975-3801', '876-623-0067', 'Oniqua Bailey', '876-290-1122', 'Information Technology', 2.9);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

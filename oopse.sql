-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 30, 2022 at 10:25 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oopse`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `html_data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `html_data`) VALUES
(1, '<p><strong>About us page.</strong></p>');

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_id`, `name`, `parent_id`) VALUES
(1, 151, 'Giza', 0),
(2, 151, 'Haram', 1),
(3, 151, '101', 2),
(43, 153, 'Cairo', 0),
(44, 153, 'Nasr City', 43),
(45, 135, '1054', 44),
(61, 163, 'Giza', 0),
(62, 163, 'Haram', 61),
(63, 163, '6060', 62),
(64, 164, 'Giza', 0),
(65, 164, 'Haram', 64),
(66, 164, '1010', 65),
(70, 166, 'Giza', 0),
(71, 166, 'October', 70),
(72, 166, '1010', 71);

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `homework_id` int(11) NOT NULL,
  `answers_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id` int(11) NOT NULL,
  `route_id` varchar(255) NOT NULL,
  `bus_timing_id` int(11) NOT NULL,
  `meet_at` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `supervisor_name` varchar(255) NOT NULL,
  `seats_left` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `route_id`, `bus_timing_id`, `meet_at`, `code`, `driver_name`, `supervisor_name`, `seats_left`, `date`) VALUES
(3, '1', 1, 'el3areesh', 'H001', 'Ahmed', 'Kareem', 20, '2021-01-06 15:29:04'),
(5, '1', 2, 'Maryoteya', 'H002', 'Khaled', 'Noha', 0, '2021-01-06 16:31:00'),
(6, '1', 3, 'Matba3a', 'H003', 'Anwar', 'Ameen', 17, '2021-01-06 16:31:41'),
(7, '2', 8, '7ay El Ashgar', 'O001', 'Ismail', 'Kareema', 20, '2021-01-06 16:32:26'),
(8, '1', 5, 'Talbeya', 'H004', 'Saad', 'Raheem', 20, '2021-01-06 16:43:33'),
(9, '3', 6, 'Hardees', 'D001', 'Ali', 'Hady', 20, '2021-01-06 17:04:05'),
(10, '3', 7, 'Semsema', 'D002', 'Abdallah', 'Sayed', 1, '2021-01-06 17:08:26'),
(11, '2', 4, 'Hosary', 'O002', 'Saeed', 'Ahmed', 20, '2021-01-06 17:46:35'),
(12, '3', 8, 'Baheya', 'D003', 'Mohamed', 'Adel', 15, '2021-01-06 17:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `bus_routes`
--

CREATE TABLE `bus_routes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fees` int(11) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bus_routes`
--

INSERT INTO `bus_routes` (`id`, `name`, `fees`, `date_added`) VALUES
(1, 'haram', 3500, '2021-01-06'),
(2, 'october', 5000, '2021-01-06'),
(3, 'dokki', 15000, '2021-01-06'),
(5, 'sample', 1700, '2022-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `bus_SV_numbers`
--

CREATE TABLE `bus_SV_numbers` (
  `id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `phone_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bus_SV_numbers`
--

INSERT INTO `bus_SV_numbers` (`id`, `bus_id`, `phone_number`) VALUES
(1, 3, '01120304050'),
(3, 5, '01096120050'),
(4, 6, '01120366050'),
(5, 7, '01124444050'),
(6, 8, '01120304155'),
(7, 9, '01125304155'),
(8, 10, '01140406060'),
(9, 11, '01124304050'),
(10, 12, '01120914050');

-- --------------------------------------------------------

--
-- Table structure for table `bus_timing`
--

CREATE TABLE `bus_timing` (
  `id` int(11) NOT NULL,
  `first_time` varchar(255) NOT NULL,
  `second_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bus_timing`
--

INSERT INTO `bus_timing` (`id`, `first_time`, `second_time`) VALUES
(1, '10:00am', '02:00pm'),
(2, '10:30am', '02:00pm'),
(3, '11:00am', '02:00pm'),
(4, '10:20am', '02:00pm'),
(5, '09:30am', '02:40pm'),
(6, '10:00am', '03:00pm'),
(7, '10:10am', '02:30pm'),
(8, '10:45am', '01:30pm');

-- --------------------------------------------------------

--
-- Table structure for table `customized_reports`
--

CREATE TABLE `customized_reports` (
  `id` int(11) NOT NULL,
  `report_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sql_statement` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grading_method`
--

CREATE TABLE `grading_method` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grading_method`
--

INSERT INTO `grading_method` (`id`, `name`, `marks`) VALUES
(1, 'assignment', 15),
(3, 'quiz', 15),
(4, 'project', 20),
(5, 'final', 50);

-- --------------------------------------------------------

--
-- Table structure for table `grading_method_values`
--

CREATE TABLE `grading_method_values` (
  `id` int(11) NOT NULL,
  `grading_method_id` int(11) NOT NULL,
  `reg_details_id` int(11) NOT NULL,
  `grade` double NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp(),
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grading_method_values`
--

INSERT INTO `grading_method_values` (`id`, `grading_method_id`, `reg_details_id`, `grade`, `date_added`, `date_updated`, `teacher_id`) VALUES
(1, 1, 5, 12, '2020-12-20 23:28:52', '2021-09-27 01:49:31', 153),
(5, 1, 7, 12, '2020-12-20 23:28:52', '2020-12-21 10:31:47', 153),
(6, 3, 7, 14, '2020-12-20 23:28:52', '2020-12-21 10:31:47', 153),
(7, 4, 7, 5, '2020-12-20 23:28:52', '2020-12-21 10:31:47', 153),
(8, 5, 7, 20, '2020-12-20 23:28:52', '2020-12-21 10:31:47', 153),
(9, 1, 14, 13, '2020-12-20 23:28:52', '2021-01-13 00:01:33', 153),
(10, 3, 14, 12, '2020-12-20 23:28:52', '2021-01-11 04:37:54', 153),
(13, 1, 15, 10, '2020-12-20 23:28:52', '2020-12-21 10:31:47', 153),
(14, 3, 15, 15, '2020-12-20 23:28:52', '2020-12-21 10:31:47', 153),
(15, 4, 15, 20, '2020-12-20 23:28:52', '2020-12-21 10:31:47', 153),
(16, 5, 15, 25, '2020-12-20 23:28:52', '2020-12-21 10:31:47', 153),
(17, 1, 16, 5, '2020-12-20 23:28:52', '2021-01-04 09:08:08', 153),
(18, 3, 16, 0, '2020-12-20 23:28:52', '2021-01-04 09:08:01', 153),
(19, 4, 16, 10, '2020-12-20 23:28:52', '2021-01-04 09:07:52', 153),
(25, 5, 16, 14, '2020-12-22 13:53:45', '2021-01-04 12:20:33', 153),
(27, 1, 17, 10, '2021-01-04 11:04:09', '2021-01-04 11:04:09', 153),
(28, 4, 17, 15, '2021-01-04 11:06:17', '2021-01-04 11:06:17', 153),
(29, 3, 17, 14, '2021-01-04 11:06:25', '2021-01-04 11:06:36', 153),
(30, 4, 14, 10, '2021-01-08 19:10:19', '2021-09-27 01:49:28', 153),
(31, 4, 5, 12, '2021-01-08 19:18:15', '2021-09-27 01:49:30', 153),
(33, 5, 14, 32, '2021-01-08 21:35:18', '2021-09-27 01:49:29', 153),
(40, 1, 18, 5, '2021-01-12 19:52:26', '2021-09-27 01:49:24', 153),
(41, 3, 18, 14, '2021-01-12 19:52:50', '2021-09-27 01:49:25', 153),
(45, 1, 24, 12, '2022-06-30 18:04:01', '2022-06-30 18:04:01', 153),
(46, 3, 24, 14, '2022-06-30 18:04:04', '2022-06-30 18:04:04', 153),
(47, 5, 24, 45, '2022-06-30 18:04:17', '2022-06-30 18:04:25', 153),
(48, 4, 24, 20, '2022-06-30 18:04:33', '2022-06-30 18:04:38', 153),
(49, 1, 23, 15, '2022-06-30 18:05:10', '2022-06-30 18:05:10', 153),
(50, 3, 23, 15, '2022-06-30 18:05:11', '2022-06-30 18:05:11', 153),
(51, 4, 23, 20, '2022-06-30 18:05:12', '2022-06-30 18:05:12', 153),
(52, 5, 23, 50, '2022-06-30 18:05:15', '2022-06-30 18:05:38', 153);

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `subject_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `degree` int(11) NOT NULL,
  `details` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `deadline` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`id`, `subject_id`, `title`, `degree`, `details`, `image`, `deadline`) VALUES
(8, '14', 'Math', 10, 'quick', 'test', 'tomorrow'),
(9, '14', 'Math', 10, 'quick', 'test', 'tomorrow'),
(10, '14', 'Math', 10, 'quick', 'test', 'tomorrow'),
(11, '14', 'Math', 10, 'quick', 'test', 'tomorrow'),
(12, '14', 'Math', 10, 'quick', 'test', 'tomorrow'),
(13, '14', 'Math', 10, 'do it quick', 'test', 'tomorrow'),
(14, '14', 'test', 10, 'test', 'test', 'test'),
(15, '14', 'test', 10, 'test', 'test', 'test'),
(16, '14', 'test', 10, 'test', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `identity_images`
--

CREATE TABLE `identity_images` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `face_image` varchar(255) NOT NULL,
  `birth_certificate` varchar(255) DEFAULT NULL,
  `identity_front` varchar(255) DEFAULT NULL,
  `identity_back` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `identity_images`
--

INSERT INTO `identity_images` (`id`, `user_id`, `face_image`, `birth_certificate`, `identity_front`, `identity_back`) VALUES
(21, 151, 'S+M06h85otgvhji4Q9A0+TOmoyBimgCE3O8xYe869FmKICSj2D8QuKQfQAv6ZB95FS59SI97nN4F', 'S+M06h85otgvhji4Q9A0+TOptSpimi+RxsxsPLF860aLIDm+3FEMu79zQhTmY045eG9iS7csmcAFSCr1TA==', NULL, NULL),
(23, 153, 'S+M06h85otgvhji4Q9A0+TOmoyBimgCE3O8xYe869FmKICSj2T8RvqQfQAv5Yg55FS59SI97nN4F', NULL, 'S+M06h85otgvhji4Q9A0+TOptSpimi+RxsxsPLF860aLIDm+3FIMur1zQxLmYU05eGdiS7cmhs8BAzioBlgQ5cquQ+3B3/Q2840spdCHnSrvOzWt', 'S+M06h85otgvhji4Q9A0+TOptSpimi+Rxsh/MLQn9kSJIiSi300RvtYcRwv4YVMmeid/eYcmm88MSzLkRUkQ6b6VO63Nh9lxydNyoNKVni6gIi3kmA1d'),
(24, 154, 'S+M06h85otgvhji4Q9A0+TOmoyBimgCE3O8xYe869FmKICSj2D8QuKQfQAv6ZB95FS59SI97nN4F', 'S+M06h85otgvhji4Q9A0+TOiuD14hgWAzf53NbZrpQDePTuj31AMu7sBQxOUY0w5eWQ/F940m/ERFiHmTlAQg/nuPtbu0MVZv6pyoNKVni6gIi3kmA1d', NULL, NULL),
(25, 155, 'S+M06h85otgvhji4Q9A0+TOmoyBimgCE3O8xYe869FmKICSj2D8Rs6QZQwv5ag55FS59SI97nN4F', NULL, 'S+M06h85otgvhji4Q9A0+TOptSpimi+RxsxsPLF860aLIDm+3FIMurxzQx/mZ045eG9iS7cmhs8BAzioBlgQ5cquQ+3B3/Q2840spdCHnSrvOzWt', 'S+M06h85otgvhji4Q9A0+TOptSpimi+Rxsh/MLQn9kSJIiSi300Rv9YcSgv+YlMmcid/eZo6lMcMSzDsTlpPy6SnJfLTidROz4oHvpGTgDGxPSS5mlNQdn0='),
(28, 162, 'S+M06h85otgvhji4Q9A0+TOmoyBimgCE3O8xYe869VmLIySj3D8QuqQdRgv7Zw55FQRxVI0wmI4xDi/xCxoNnLnuRKeu1IQ755d/5IzI3XfvY3XqszAUdnSr', 'S+M06h85otgvhji4Q9A0+TOiuD14hgWAzf53NbZrpQDePTuj31EMurgBQxeUY045e2I/Ft0lm/ExBTLgTkYd/eGsAbWx1o8rq9Jt+I7fziO1cXT63E4PKCj8Y2wL8zdAkQ==', NULL, NULL),
(29, 163, 'S+M06h85otgvhji4Q9A0+TOmoyBimgCE3O8xYe869VmLIySj2D8Rv6QdQgv4Yh95FS59SI97nN4F', NULL, 'S+M06h85otgvhji4Q9A0+TOptSpimi+RxsxsPLF860aLIDi+3VEMurxzQxPmY085eWdzS7csmcAFSCr1TA==', 'S+M06h85otgvhji4Q9A0+TOptSpimi+Rxsh/MLQn9kSJIySj3E0Rv9YcRgv6Y1MnejZ/eZE6mMlMDDDi'),
(30, 164, 'S+M06h85otgvhji4Q9A0+TOmoyBimgCE3O8xYe869VmLIySi3z8RvKQeQQv4YA55FSV9RIE7294LAzL3TgVZ/u6TGvzWr9RD7c4qu8+WgiOyOWuggho=', 'S+M06h85otgvhji4Q9A0+TOiuD14hgWAzf53NbZrpQDePTuj31EMurgBQhSUYkg5eGU/Fdolm/EbCS7iBUJNyQ==', NULL, NULL),
(31, 166, 'S+M06h85otgvhji4Q9A0+TOmoyBimgCE3O8xYe869lmLJCSg3T8Rv6QZQAv7Zg55FSd6SZw6259XV3SxHBgOnb/7Qqauh9gs4IZs5N7ejSekfy+6lxo=', 'S+M06h85otgvhji4Q9A0+TOiuD14hgWAzf53NbZrpQDePTuj31IMur8BQBaUYks5f2Q/Ftwlm/EQBzfkRQVEz/qwEOeuv5Bx6YIHjYu+rRPsJCu5ghFbdXLiKV0h', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `value`) VALUES
(1, 'Art Course', 1500),
(2, 'clothes', 1900),
(3, 'Swimming Course', 1200),
(4, 'books', 1800),
(10, 'library', 450),
(20, 'test', 180);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `selected` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `selected`) VALUES
(1, 'english', 1),
(2, 'arabic', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `IsRead` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `content`, `IsRead`, `user_id`, `date`) VALUES
(285, 'Your final grade for History HIS314 has been updated. You got 32 out of 50', 1, 151, '2021-01-11 04:56:39'),
(286, 'Your assignment grade for Science SCI301 has been updated. You got 12 out of 15', 1, 151, '2021-01-11 04:56:48'),
(288, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 13 out of 15', 0, 154, '2021-01-11 04:56:55'),
(289, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 12 out of 15', 0, 164, '2021-01-12 19:52:26'),
(290, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 12 out of 15', 0, 164, '2021-01-12 19:52:42'),
(291, 'Your quiz grade for Object Oriented OOP314 has been updated. You got 14 out of 15', 0, 164, '2021-01-12 19:52:50'),
(292, 'Your project grade for Object Oriented OOP314 has been updated. You got 19 out of 20', 0, 164, '2021-01-12 19:52:53'),
(293, 'Your final grade for Object Oriented OOP314 has been updated. You got 35 out of 50', 0, 164, '2021-01-12 19:52:56'),
(294, 'Your final grade for Object Oriented OOP314 has been updated. You got 2 out of 50', 0, 164, '2021-01-12 19:54:14'),
(295, 'Your final grade for Object Oriented OOP314 has been updated. You got 4 out of 50', 0, 164, '2021-01-12 19:55:04'),
(296, 'Your final grade for Object Oriented OOP314 has been updated. You got 4 out of 50', 0, 164, '2021-01-12 19:55:11'),
(297, 'Your final grade for Object Oriented OOP314 has been updated. You got 4 out of 50', 0, 164, '2021-01-12 19:55:18'),
(298, 'Your final grade for Object Oriented OOP314 has been updated. You got 4 out of 50', 0, 164, '2021-01-12 19:58:17'),
(299, 'Your final grade for Object Oriented OOP314 has been updated. You got 5 out of 50', 0, 164, '2021-01-12 19:58:26'),
(300, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 12 out of 15', 0, 164, '2021-01-12 20:06:33'),
(301, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 12 out of 15', 0, 164, '2021-01-12 20:06:46'),
(302, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 14 out of 15', 0, 164, '2021-01-13 00:01:03'),
(303, 'Your assignment grade for Geoghraphy GEO334 has been updated. You got 13 out of 15', 1, 151, '2021-01-13 00:01:33'),
(304, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 13 out of 15', 0, 164, '2021-01-13 02:53:42'),
(305, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 13 out of 15', 0, 164, '2021-01-13 02:53:49'),
(306, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 15 out of 15', 0, 164, '2021-01-13 06:09:57'),
(307, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 10 out of 15', 0, 164, '2021-01-13 06:10:01'),
(308, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 10 out of 15', 0, 164, '2021-01-13 06:10:13'),
(309, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 10 out of 15', 0, 164, '2021-01-13 06:10:20'),
(310, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 10 out of 15', 0, 154, '2021-01-13 06:10:22'),
(311, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 9 out of 15', 0, 164, '2021-01-13 06:14:51'),
(312, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 9 out of 15', 0, 164, '2021-01-13 06:14:57'),
(313, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 15 out of 15', 0, 164, '2021-01-13 06:15:02'),
(314, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 12 out of 15', 0, 154, '2021-01-13 06:15:07'),
(315, 'Your project grade for Object Oriented OOP314 has been updated. You got 12 out of 20', 0, 154, '2021-01-13 06:15:11'),
(316, 'Your final grade for Object Oriented OOP314 has been updated. You got 28 out of 50', 0, 164, '2021-01-13 06:15:19'),
(317, 'Your assignment grade for Operating System OS351 has been updated. You got 4 out of 15', 0, 154, '2021-01-13 07:06:38'),
(318, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 10 out of 15', 0, 164, '2021-01-13 12:37:08'),
(319, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 10 out of 15', 0, 164, '2021-01-13 12:37:45'),
(320, 'Your assignment grade for Object Oriented OOP314 has been updated. You got 5 out of 15', 0, 164, '2021-01-13 12:38:07'),
(321, 'Your assignment grade for History HIS314 has been updated. You got 5 out of 15', 0, 164, '2021-09-27 01:49:19'),
(322, 'Your assignment grade for History HIS314 has been updated. You got 5 out of 15', 0, 164, '2021-09-27 01:49:24'),
(323, 'Your quiz grade for History HIS314 has been updated. You got 14 out of 15', 0, 164, '2021-09-27 01:49:25'),
(324, 'Your project grade for History HIS314 has been updated. You got 10 out of 20', 1, 151, '2021-09-27 01:49:28'),
(325, 'Your final grade for History HIS314 has been updated. You got 32 out of 50', 1, 151, '2021-09-27 01:49:29'),
(326, 'Your project grade for History HIS314 has been updated. You got 12 out of 20', 0, 154, '2021-09-27 01:49:30'),
(327, 'Your assignment grade for History HIS314 has been updated. You got 12 out of 15', 0, 154, '2021-09-27 01:49:31'),
(328, 'Your assignment grade for Arabic AR101 has been updated. You got 12 out of 15', 1, 166, '2022-06-30 18:04:01'),
(329, 'Your quiz grade for Arabic AR101 has been updated. You got 14 out of 15', 1, 166, '2022-06-30 18:04:04'),
(330, 'Your final grade for Arabic AR101 has been updated. You got 45 out of 50', 1, 166, '2022-06-30 18:04:17'),
(331, 'Your final grade for Arabic AR101 has been updated. You got 45 out of 50', 1, 166, '2022-06-30 18:04:25'),
(332, 'Your project grade for Arabic AR101 has been updated. You got 20 out of 20', 1, 166, '2022-06-30 18:04:33'),
(333, 'Your project grade for Arabic AR101 has been updated. You got 20 out of 20', 1, 166, '2022-06-30 18:04:38'),
(334, 'Your assignment grade for Math MTH101 has been updated. You got 15 out of 15', 1, 166, '2022-06-30 18:05:10'),
(335, 'Your quiz grade for Math MTH101 has been updated. You got 15 out of 15', 1, 166, '2022-06-30 18:05:11'),
(336, 'Your project grade for Math MTH101 has been updated. You got 20 out of 20', 1, 166, '2022-06-30 18:05:12'),
(337, 'Your final grade for Math MTH101 has been updated. You got 50 out of 50', 1, 166, '2022-06-30 18:05:15'),
(338, 'Your final grade for Math MTH101 has been updated. You got 50 out of 50', 1, 166, '2022-06-30 18:05:34'),
(339, 'Your final grade for Math MTH101 has been updated. You got 50 out of 50', 1, 166, '2022-06-30 18:05:38');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`) VALUES
(1, 'credit card'),
(3, 'fawry'),
(2, 'paypal'),
(25, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `payment_options`
--

CREATE TABLE `payment_options` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_options`
--

INSERT INTO `payment_options` (`id`, `payment_id`, `name`, `type`) VALUES
(1, 1, 'name on the card', 'text'),
(6, 1, 'card number', 'number'),
(7, 1, 'MM/YY', 'text'),
(9, 1, 'CVC', 'text'),
(10, 1, 'ZIP/Postal Code', 'text'),
(11, 2, 'Paypal Email', 'email'),
(12, 3, 'Phone Number', 'text'),
(13, 25, 'name', 'text'),
(14, 25, 'number', 'number');

-- --------------------------------------------------------

--
-- Table structure for table `payment_options_values`
--

CREATE TABLE `payment_options_values` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registration_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_options_values`
--

INSERT INTO `payment_options_values` (`id`, `payment_id`, `option_id`, `value`, `user_id`, `registration_id`) VALUES
(20, 1, 1, 'Mahmoud Ahmed', 163, 5),
(21, 1, 6, '111222333', 163, 5),
(22, 1, 7, '11/22', 163, 5),
(23, 1, 9, '111', 163, 5),
(24, 1, 10, '0999', 163, 5),
(50, 3, 12, '011', 163, 5),
(51, 3, 12, '0444', 163, 5),
(52, 1, 1, 'Mahmoud', 166, 10),
(53, 1, 6, '100200300400', 166, 10),
(54, 1, 7, '02/30', 166, 10),
(55, 1, 9, '000', 166, 10),
(56, 1, 10, '1010', 166, 10);

-- --------------------------------------------------------

--
-- Table structure for table `payment_rendered_html`
--

CREATE TABLE `payment_rendered_html` (
  `id` int(11) NOT NULL,
  `HTML` longtext NOT NULL,
  `payment_method_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_rendered_html`
--

INSERT INTO `payment_rendered_html` (`id`, `HTML`, `payment_method_id`) VALUES
(1, '<form action=\"\" style=\"width: 30%; margin: 0px auto;\" method=\"POST\" >\r\n    <div class=\"input-group mb-3\">\r\n        <input type=\"text\" class=\"form-control\"  name=\"studentId\" placeholder=\"Your Student ID\" required>\r\n    </div>\r\n        <div class=\"input-group mb-3\">\r\n            <div class=\"input-group\" id=\"options\">\r\n\r\n<div class=\'form-group mb-2 w-100\'>\r\n            <input type=\'text\' class=\'form-control\'  name=\'optionValue[]\' placeholder=\'Name on the Card\' required></div>\r\n\r\n<div class=\'form-group mb-2 w-100\'>\r\n            <input type=\'number\' class=\'form-control\'  name=\'optionValue[]\' placeholder=\'Card Number\' required></div>\r\n\r\n<div class=\'form-group mb-2 w-100\'>\r\n            <input type=\'text\' class=\'form-control\'  name=\'optionValue[]\' placeholder=\'MM/YY\' required pattern=\'[0-9][0-9]/[0-9][0-9]\'></div>\r\n\r\n<div class=\'form-group mb-2 w-100\'>\r\n            <input type=\'text\' class=\'form-control\'  name=\'optionValue[]\' placeholder=\'CVC\' required></div>\r\n\r\n<div class=\'form-group mb-2 w-100\'>\r\n            <input type=\'text\' class=\'form-control\'  name=\'optionValue[]\' placeholder=\'ZIP/Postal Code\' required></div>\r\n            \r\n        <input type=\'hidden\' name=\'methodId[]\' value=\'1\'>\r\n        <input type=\'hidden\' name=\'optionId[]\' value=\'1\'>\r\n        <input type=\'hidden\' name=\'optionId[]\' value=\'6\'>\r\n        <input type=\'hidden\' name=\'optionId[]\' value=\'7\'>\r\n        <input type=\'hidden\' name=\'optionId[]\' value=\'9\'>\r\n        <input type=\'hidden\' name=\'optionId[]\' value=\'10\'>\r\n        \r\n\r\n\r\n<button type=\'submit\' name=\'payNow\' class=\'btn btn-outline-success\' style=\'width: 100%; margin-top:10px;\'><i class=\'ion-ios-locked\' style=\'font-size:20px;\'></i> &nbsp<strong>PAY</strong></button>\r\n</div>\r\n            </div>\r\n    </form>\r\n', 1),
(2, '<form action=\"\" style=\"width: 30%; margin: 0px auto;\" method=\"POST\" >\r\n    <div class=\"input-group mb-3\">\r\n        <input type=\"text\" class=\"form-control\"  name=\"studentId\" placeholder=\"Your Student ID\" required>\r\n    </div>\r\n        <div class=\"input-group mb-3\">\r\n            <div class=\"input-group\" id=\"options\">\r\n\r\n<div class=\'input-group mb-2\'>\r\n\r\n            <input type=\'email\' class=\'form-control\'  name=\'optionValue[]\' placeholder=\'Paypal Email\' required>\r\n            \r\n\r\n        <input type=\'hidden\' name=\'optionId[]\' value=\'11\'>\r\n        <input type=\'hidden\' name=\'methodId[]\' value=\'2\'>\r\n\r\n</div>\r\n<button type=\'submit\' name=\'payNow\' class=\'btn btn-outline-success\' style=\'width: 100%; margin-top:10px;\'><i class=\'fa fa-paypal\' style=\'font-size:20px;\'></i> &nbsp<strong>NEXT</strong></button>\r\n\r\n</div>\r\n</div>\r\n</form>', 2),
(3, '<form action=\"\" style=\"width: 30%; margin: 0px auto;\" method=\"POST\" >\r\n    <div class=\"input-group mb-3\">\r\n        <input type=\"text\" class=\"form-control\"  name=\"studentId\" placeholder=\"Your Student ID\" required>\r\n    </div>\r\n        <div class=\"input-group mb-3\">\r\n            <div class=\"input-group\" id=\"options\">\r\n\r\n<div class=\'input-group mb-2\'>\r\n\r\n            <input type=\'text\' class=\'form-control\'  name=\'optionValue[]\' placeholder=\'Phone Number\' required>\r\n            \r\n\r\n        <input type=\'hidden\' name=\'optionId[]\' value=\'12\'>\r\n        <input type=\'hidden\' name=\'methodId[]\' value=\'3\'>\r\n\r\n</div>\r\n        <button type=\'submit\' name=\'payNow\' class=\'btn btn-outline-success\' style=\'width: 100%; margin-top:10px;\'><i class=\'fa fa-lock\' style=\'font-size:20px;\'></i> &nbsp<strong>CONFIRM</strong></button>\r\n    \r\n</div>\r\n</div>\r\n</form>', 3);

-- --------------------------------------------------------

--
-- Table structure for table `phone_numbers`
--

CREATE TABLE `phone_numbers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phone_numbers`
--

INSERT INTO `phone_numbers` (`id`, `user_id`, `number`) VALUES
(61, 151, '01130407677'),
(63, 153, '01140227688'),
(64, 154, '01130485767'),
(65, 155, '01008080881'),
(72, 162, '01234567890'),
(73, 163, '01234567889'),
(74, 164, '01067078080'),
(76, 166, '01120394857');

-- --------------------------------------------------------

--
-- Table structure for table `qr_link`
--

CREATE TABLE `qr_link` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qr_link`
--

INSERT INTO `qr_link` (`id`, `name`) VALUES
(1, 'http://localhost/PharaohSchoolSystem/modules/Student/Controller/studentController.php?selected=SubjectsGrades');

-- --------------------------------------------------------

--
-- Table structure for table `question_bank`
--

CREATE TABLE `question_bank` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_bank`
--

INSERT INTO `question_bank` (`id`, `question`, `type`, `answer`) VALUES
(1, '3amel eh?', 1, 'tmam el7amdullah');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp(),
  `reg_fees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `student_id`, `semester_id`, `reg_date`, `reg_fees`) VALUES
(3, 154, 3, '2020-12-05 01:36:32', 150),
(5, 151, 3, '2020-12-22 12:47:26', 250),
(8, 164, 3, '2021-01-12 20:48:27', 450),
(10, 166, 2, '2022-06-30 17:55:03', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `registration_details`
--

CREATE TABLE `registration_details` (
  `id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registration_details`
--

INSERT INTO `registration_details` (`id`, `reg_id`, `subject_id`, `date`) VALUES
(5, 3, 2, '2020-12-05 01:41:51'),
(7, 3, 13, '2020-12-05 02:20:51'),
(14, 5, 2, '2020-12-20 23:06:17'),
(15, 5, 13, '2020-12-20 23:06:19'),
(16, 5, 15, '2020-12-20 23:06:21'),
(17, 5, 23, '2021-01-04 11:03:00'),
(18, 8, 2, '2021-01-12 19:30:40'),
(19, 8, 13, '2021-01-12 19:30:50'),
(20, 8, 15, '2021-01-12 19:30:52'),
(21, 8, 23, '2021-01-12 19:30:55'),
(22, 3, 15, '2021-01-13 07:04:57'),
(23, 10, 1, '2022-06-30 17:55:12'),
(24, 10, 14, '2022-06-30 17:55:14');

-- --------------------------------------------------------

--
-- Table structure for table `registration_item_details`
--

CREATE TABLE `registration_item_details` (
  `id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `value` double NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `student_bill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registration_item_details`
--

INSERT INTO `registration_item_details` (`id`, `reg_id`, `item_id`, `value`, `date_added`, `student_bill_id`) VALUES
(30, 5, 1, 1500, '2020-12-30 06:14:34', 1),
(31, 5, 2, 1900, '2020-12-30 06:14:34', 1),
(32, 5, 3, 1200, '2020-12-30 06:14:34', 1),
(33, 5, 10, 450, '2020-12-30 06:15:30', 1),
(42, 5, 3, 1200, '2020-12-30 07:11:08', 12),
(43, 5, 4, 1800, '2020-12-30 07:11:08', 12),
(44, 5, 10, 450, '2020-12-30 07:11:08', 12),
(45, 5, 4, 1800, '2021-01-04 10:50:20', 13),
(46, 5, 10, 450, '2021-01-04 10:50:20', 13),
(47, 8, 1, 1500, '2021-01-12 19:31:41', 14),
(48, 8, 2, 1900, '2021-01-12 19:31:41', 14),
(49, 8, 10, 450, '2021-01-12 19:31:41', 14),
(50, 5, 2, 1900, '2021-01-13 14:48:33', 15),
(51, 5, 3, 1200, '2021-01-13 14:48:33', 15),
(52, 10, 2, 1900, '2022-06-30 17:58:24', 16),
(53, 10, 3, 1200, '2022-06-30 17:58:24', 16),
(54, 10, 4, 1800, '2022-06-30 17:58:24', 16),
(55, 10, 20, 180, '2022-06-30 17:58:24', 16);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `name`, `fees`) VALUES
(1, 'S1', 1500),
(2, 'S2', 3000),
(3, 'S3', 5000),
(4, 'S4', 7500),
(5, 'S5', 9000),
(6, 'S6', 12000),
(7, 'S7', 19000),
(8, 'S8', 17000);

-- --------------------------------------------------------

--
-- Table structure for table `students_bus`
--

CREATE TABLE `students_bus` (
  `id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `registered_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students_bus`
--

INSERT INTO `students_bus` (`id`, `bus_id`, `student_id`, `registered_date`) VALUES
(70, 6, 3, '2022-06-30 17:34:52'),
(73, 6, 151, '2022-06-30 18:02:44'),
(74, 6, 166, '2022-06-30 18:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `student_bill`
--

CREATE TABLE `student_bill` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_bill`
--

INSERT INTO `student_bill` (`id`, `student_id`, `date_created`) VALUES
(1, 151, '2020-12-30 06:14:34'),
(12, 151, '2020-12-30 07:11:08'),
(13, 151, '2021-01-04 10:50:20'),
(14, 164, '2021-01-12 19:31:41'),
(15, 151, '2021-01-13 14:48:33'),
(16, 166, '2022-06-30 17:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `subjects_names_id` varchar(255) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `semester_id`, `subject_code`, `subjects_names_id`, `marks`) VALUES
(1, 1, 'MTH101', '1', 100),
(2, 3, 'HIS314', '2', 100),
(3, 4, 'SCI401', '3', 100),
(13, 3, 'SCI301', '3', 100),
(14, 1, 'AR101', '4', 100),
(15, 3, 'EN351', '5', 100),
(22, 7, 'TTT', '11', 100),
(23, 3, 'GEO334', '12', 100),
(25, 1, 'smpl', '14', 100);

-- --------------------------------------------------------

--
-- Table structure for table `subjects_names`
--

CREATE TABLE `subjects_names` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects_names`
--

INSERT INTO `subjects_names` (`id`, `subject_name`) VALUES
(1, 'Math'),
(2, 'History'),
(3, 'Science'),
(4, 'Arabic'),
(5, 'English'),
(11, 'Test'),
(12, 'Geoghraphy'),
(14, 'Sample');

-- --------------------------------------------------------

--
-- Table structure for table `subject_grading`
--

CREATE TABLE `subject_grading` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `grading_method_id` int(11) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `system_log`
--

CREATE TABLE `system_log` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_log`
--

INSERT INTO `system_log` (`id`, `message`, `user_id`, `date`) VALUES
(551, 'User Login', 153, '2021-01-09 03:30:29'),
(552, 'Teacher Update Grade', 153, '2021-01-09 03:32:58'),
(556, 'Teacher Update Grade to Student 151 in Subject Object Oriented - OOP314', 153, '2021-01-09 03:38:13'),
(557, 'User Login', 153, '2021-01-09 03:55:59'),
(558, 'Student Viewed His Grades', 151, '2021-01-09 04:03:49'),
(559, 'User Login', 151, '2021-01-09 15:49:38'),
(560, 'Student Viewed His Grades', 151, '2021-01-09 15:51:25'),
(561, 'User Login', 153, '2021-01-09 15:51:33'),
(562, 'User Login', 163, '2021-01-09 15:52:23'),
(563, 'Employee Login', 1, '2021-01-10 11:36:26'),
(564, 'User Login', 151, '2021-01-10 11:38:24'),
(565, 'Student Viewed His Grades', 151, '2021-01-10 11:39:01'),
(566, 'Student Viewed His Grades', 151, '2021-01-10 11:39:06'),
(567, 'User Login', 163, '2021-01-10 11:39:52'),
(568, 'User Login', 153, '2021-01-10 11:41:08'),
(569, 'User Login', 151, '2021-01-10 11:44:38'),
(570, 'User Login', 163, '2021-01-11 03:05:49'),
(571, 'User Login', 153, '2021-01-11 04:08:36'),
(572, 'Teacher Add Grade to Student 154 in Subject Object Oriented - OOP314', 153, '2021-01-11 04:21:19'),
(573, 'Teacher Add Grade to Student 154 in Subject Object Oriented - OOP314', 153, '2021-01-11 04:24:33'),
(574, 'Teacher Add Grade to Student 154 in Subject Object Oriented - OOP314', 153, '2021-01-11 04:26:37'),
(575, 'Teacher Add Grade to Student 154 in Subject Object Oriented - OOP314', 153, '2021-01-11 04:26:55'),
(576, 'User Login', 153, '2021-01-11 04:51:19'),
(577, 'Teacher Update Grade to Student 154 in Subject Object Oriented - OOP314', 153, '2021-01-11 04:56:55'),
(578, 'Employee Login', 1, '2021-01-12 19:22:53'),
(579, 'Employee Accept User', 1, '2021-01-12 19:24:20'),
(580, 'User Login', 164, '2021-01-12 19:24:35'),
(581, 'Student Viewed His Grades', 164, '2021-01-12 19:27:02'),
(582, 'Student Viewed His Grades', 164, '2021-01-12 19:27:05'),
(583, 'Employee Register Student', 164, '2021-01-12 19:27:38'),
(584, 'Employee Add Subject to Student', 164, '2021-01-12 19:30:40'),
(585, 'Employee Add Subject to Student', 164, '2021-01-12 19:30:50'),
(586, 'Employee Add Subject to Student', 164, '2021-01-12 19:30:52'),
(587, 'Employee Add Subject to Student', 164, '2021-01-12 19:30:55'),
(588, 'Employee Add Subject to Student', 164, '2021-01-12 19:31:02'),
(589, 'Employee Create New Bill', 164, '2021-01-12 19:31:41'),
(590, 'Employee Display Bill', 164, '2021-01-12 19:31:50'),
(591, 'Employee Display Bill', 164, '2021-01-12 19:31:56'),
(592, 'Employee Display Bill', 164, '2021-01-12 19:32:13'),
(593, 'Employee Display Bill', 164, '2021-01-12 19:33:37'),
(594, 'Employee Display Bill', 164, '2021-01-12 19:33:40'),
(595, 'Employee Display Bill', 164, '2021-01-12 19:35:52'),
(596, 'Employee Edited About Us Page', 164, '2021-01-12 19:39:53'),
(597, 'Employee Delete User', 164, '2021-01-12 19:41:01'),
(598, 'Employee Delete User', 164, '2021-01-12 19:41:06'),
(599, 'Employee Generate Certificate', 164, '2021-01-12 19:41:39'),
(600, 'User Login', 163, '2021-01-12 19:42:10'),
(601, 'Employee Login', 1, '2021-01-12 19:44:35'),
(602, 'Employee Display Bill', 1, '2021-01-12 19:44:42'),
(603, 'User Login', 163, '2021-01-12 19:46:02'),
(604, 'User Login', 153, '2021-01-12 19:48:08'),
(605, 'Teacher Add Grade to Student 164 in Subject Object Oriented - OOP314', 153, '2021-01-12 19:52:26'),
(606, 'Teacher Update Grade to Student 164 in Subject Object Oriented - OOP314', 153, '2021-01-12 19:52:42'),
(607, 'Teacher Add Grade to Student 164 in Subject Object Oriented - OOP314', 153, '2021-01-12 19:52:50'),
(608, 'Teacher Add Grade to Student 164 in Subject Object Oriented - OOP314', 153, '2021-01-12 19:52:53'),
(609, 'Teacher Add Grade to Student 164 in Subject Object Oriented - OOP314', 153, '2021-01-12 19:52:56'),
(610, 'Employee Login', 1, '2021-01-12 19:53:14'),
(611, 'Employee Generate Certificate', 1, '2021-01-12 19:53:20'),
(612, 'Employee Generate Certificate', 1, '2021-01-12 19:54:16'),
(613, 'Teacher Update Grade to Student 164 in Subject Object Oriented - OOP314', 1, '2021-01-12 19:55:04'),
(614, 'User Login', 153, '2021-01-12 19:56:47'),
(615, 'Employee Login', 1, '2021-01-12 19:58:06'),
(616, 'Employee Generate Certificate', 1, '2021-01-12 19:58:20'),
(617, 'Employee Generate Certificate', 1, '2021-01-12 19:58:28'),
(618, 'User Login', 151, '2021-01-12 19:59:50'),
(619, 'Employee Login', 1, '2021-01-12 20:00:12'),
(620, 'Employee Generate Certificate', 1, '2021-01-12 20:00:19'),
(621, 'User Login', 151, '2021-01-12 20:01:12'),
(622, 'Employee Login', 1, '2021-01-12 20:01:38'),
(623, 'Employee Generate Certificate', 1, '2021-01-12 20:01:44'),
(624, 'User Login', 151, '2021-01-12 20:02:48'),
(625, 'Student Viewed His Grades', 151, '2021-01-12 20:02:52'),
(626, 'User Login', 153, '2021-01-12 20:05:11'),
(627, 'Student Viewed His Grades', 151, '2021-01-12 20:09:30'),
(628, 'Student Viewed His Grades', 151, '2021-01-12 20:12:39'),
(629, 'Employee Login', 1, '2021-01-12 20:22:30'),
(630, 'Employee Display Bill', 1, '2021-01-12 20:22:37'),
(631, 'Employee Display Bill', 1, '2021-01-12 20:23:14'),
(632, 'Employee Display Bill', 1, '2021-01-12 20:26:50'),
(633, 'Employee Display Bill', 1, '2021-01-12 20:26:55'),
(634, 'Employee Display Bill', 1, '2021-01-12 20:28:50'),
(635, 'Employee Display Bill', 1, '2021-01-12 20:28:54'),
(636, 'Employee Display Bill', 1, '2021-01-12 20:30:37'),
(637, 'Employee Display Bill', 1, '2021-01-12 20:30:41'),
(638, 'Employee Display Bill', 1, '2021-01-12 20:32:15'),
(639, 'Employee Display Bill', 1, '2021-01-12 20:33:07'),
(640, 'Employee Display Bill', 1, '2021-01-12 20:33:35'),
(641, 'Employee Display Bill', 1, '2021-01-12 20:36:59'),
(642, 'Employee Display Bill', 1, '2021-01-12 20:37:02'),
(643, 'Employee Display Bill', 1, '2021-01-12 20:37:06'),
(644, 'Employee Display Bill', 1, '2021-01-12 20:37:42'),
(645, 'Employee Display Bill', 1, '2021-01-12 20:38:09'),
(646, 'Employee Display Bill', 1, '2021-01-12 20:38:31'),
(647, 'Employee Display Bill', 1, '2021-01-12 20:38:34'),
(648, 'Employee Display Bill', 1, '2021-01-12 20:39:03'),
(649, 'Employee Display Bill', 1, '2021-01-12 20:42:51'),
(650, 'Employee Display Bill', 1, '2021-01-12 20:43:08'),
(651, 'User Login', 164, '2021-01-12 20:43:43'),
(652, 'Student Viewed His Grades', 164, '2021-01-12 20:45:43'),
(653, 'Student Viewed His Grades', 164, '2021-01-12 20:48:38'),
(654, 'Student Viewed His Grades', 164, '2021-01-12 20:48:43'),
(655, 'Student Viewed His Grades', 164, '2021-01-12 20:48:53'),
(656, 'Student Viewed His Grades', 164, '2021-01-12 20:53:22'),
(657, 'User Login', 151, '2021-01-12 20:53:28'),
(658, 'Student Viewed His Grades', 151, '2021-01-12 20:53:35'),
(659, 'User Login', 154, '2021-01-12 20:53:41'),
(660, 'Student Viewed His Grades', 154, '2021-01-12 20:54:30'),
(661, 'User Login', 151, '2021-01-12 20:54:36'),
(662, 'User Login', 164, '2021-01-12 20:54:45'),
(663, 'Student Viewed His Grades', 164, '2021-01-12 20:54:48'),
(664, 'Student Viewed His Grades', 164, '2021-01-12 21:44:36'),
(665, 'Student Viewed His Grades', 164, '2021-01-12 21:44:38'),
(666, 'User Login', 164, '2021-01-12 21:45:10'),
(667, 'Student Viewed His Grades', 164, '2021-01-12 21:45:15'),
(668, 'Student Viewed His Grades', 164, '2021-01-12 21:45:26'),
(669, 'Student Viewed His Grades', 164, '2021-01-12 21:45:44'),
(670, 'Student Viewed His Grades', 164, '2021-01-12 21:46:10'),
(671, 'Student Viewed His Grades', 164, '2021-01-12 21:46:59'),
(672, 'Employee Login', 1, '2021-01-12 22:15:19'),
(673, 'Employee Add Subject to System', 1, '2021-01-12 22:17:24'),
(674, 'Employee Generate Certificate', 1, '2021-01-12 22:27:57'),
(675, 'Employee Generate Certificate', 1, '2021-01-12 22:28:05'),
(676, 'Employee Generate Certificate', 1, '2021-01-12 22:28:15'),
(677, 'Employee Generate Certificate', 1, '2021-01-12 22:28:35'),
(678, 'Employee Generate Certificate', 1, '2021-01-12 22:29:17'),
(679, 'Employee Login', 1, '2021-01-12 23:38:15'),
(680, 'User Login', 151, '2021-01-13 00:00:45'),
(681, 'Student Viewed His Grades', 151, '2021-01-13 00:00:48'),
(682, 'User Login', 153, '2021-01-13 00:00:54'),
(683, 'User Login', 151, '2021-01-13 01:04:46'),
(684, 'Student Viewed His Grades', 151, '2021-01-13 01:05:14'),
(685, 'User Login', 151, '2021-01-13 01:10:31'),
(686, 'Student Viewed His Grades', 151, '2021-01-13 01:10:34'),
(687, 'Employee Login', 1, '2021-01-13 01:51:04'),
(688, 'Employee Display Bill', 1, '2021-01-13 02:16:00'),
(689, 'Employee Display Bill', 1, '2021-01-13 02:37:46'),
(690, 'Employee Display Bill', 1, '2021-01-13 02:37:50'),
(691, 'Employee Generate Certificate', 1, '2021-01-13 02:44:09'),
(692, 'Employee Generate Certificate', 1, '2021-01-13 02:45:06'),
(693, 'Employee Generate Certificate', 1, '2021-01-13 02:45:14'),
(694, 'Employee Generate Certificate', 1, '2021-01-13 02:45:18'),
(695, 'User Login', 153, '2021-01-13 02:53:25'),
(696, 'User Login', 154, '2021-01-13 03:28:35'),
(697, 'User Login', 163, '2021-01-13 03:28:42'),
(698, 'Employee Login', 1, '2021-01-13 04:59:37'),
(699, 'User Login', 153, '2021-01-13 06:09:46'),
(700, 'User Login', 153, '2021-01-13 06:12:47'),
(701, 'User Login', 163, '2021-01-13 06:44:54'),
(702, 'Employee Login', 1, '2021-01-13 07:04:39'),
(703, 'Employee Add Subject to Student', 1, '2021-01-13 07:04:54'),
(704, 'Employee Add Subject to Student', 1, '2021-01-13 07:04:57'),
(705, 'Employee Generate Certificate', 1, '2021-01-13 07:05:07'),
(706, 'User Login', 154, '2021-01-13 07:06:06'),
(707, 'Student Viewed His Grades', 154, '2021-01-13 07:06:09'),
(708, 'User Login', 153, '2021-01-13 07:06:25'),
(709, 'Teacher Add Grade to Student 154 in Subject Operating System - OS351', 153, '2021-01-13 07:06:38'),
(710, 'Employee Generate Certificate', 153, '2021-01-13 07:06:41'),
(711, 'Employee Generate Certificate', 153, '2021-01-13 07:06:55'),
(712, 'Employee Generate Certificate', 153, '2021-01-13 07:06:57'),
(713, 'Employee Generate Certificate', 153, '2021-01-13 07:07:11'),
(714, 'User Login', 164, '2021-01-13 07:09:21'),
(715, 'Student Viewed His Grades', 164, '2021-01-13 07:09:33'),
(716, 'Employee Login', 1, '2021-01-13 12:20:14'),
(717, 'Employee Login', 1, '2021-01-13 12:30:03'),
(718, 'User Login', 163, '2021-01-13 12:30:36'),
(719, 'User Login', 151, '2021-01-13 12:33:22'),
(720, 'Student Viewed His Grades', 151, '2021-01-13 12:33:29'),
(721, 'Student Viewed His Grades', 151, '2021-01-13 12:33:53'),
(722, 'User Login', 153, '2021-01-13 12:35:45'),
(723, 'Employee Login', 1, '2021-01-13 12:40:18'),
(724, 'Employee Login', 1, '2021-01-13 14:43:57'),
(725, 'Employee Generate Certificate', 1, '2021-01-13 14:45:28'),
(726, 'Employee Create New Bill', 1, '2021-01-13 14:48:33'),
(727, 'Employee Display Bill', 1, '2021-01-13 14:48:41'),
(728, 'User Login', 151, '2021-01-13 14:49:59'),
(729, 'Student Viewed His Grades', 151, '2021-01-13 14:50:03'),
(730, 'Student Viewed His Grades', 151, '2021-01-13 14:59:51'),
(731, 'User Login', 163, '2021-01-13 15:00:07'),
(732, 'User Login', 153, '2021-01-13 15:03:46'),
(733, 'User Login', 151, '2021-01-13 15:06:03'),
(734, 'Student Viewed His Grades', 151, '2021-01-13 15:06:13'),
(735, 'Student Viewed His Grades', 151, '2021-01-13 15:06:15'),
(736, 'User Login', 153, '2021-01-13 15:06:24'),
(737, 'User Login', 151, '2021-01-13 15:16:13'),
(738, 'User Login', 153, '2021-01-13 15:16:23'),
(739, 'Employee Login', 1, '2021-01-13 15:22:19'),
(740, 'User Login', 151, '2021-01-13 15:22:53'),
(741, 'Student Viewed His Grades', 151, '2021-01-13 15:23:01'),
(742, 'User Login', 153, '2021-01-13 15:23:09'),
(743, 'Employee Login', 1, '2021-01-16 21:33:24'),
(744, 'Employee Generate Certificate', 1, '2021-01-16 21:34:22'),
(745, 'Employee Generate Certificate', 1, '2021-01-16 21:35:47'),
(746, 'Employee Generate Certificate', 1, '2021-01-16 21:36:11'),
(747, 'Employee Generate Certificate', 1, '2021-01-16 21:36:19'),
(748, 'Employee Generate Certificate', 1, '2021-01-16 21:37:19'),
(749, 'Employee Generate Certificate', 1, '2021-01-16 21:37:37'),
(750, 'Employee Generate Certificate', 1, '2021-01-16 21:37:58'),
(751, 'Employee Generate Certificate', 1, '2021-01-16 21:38:42'),
(752, 'Employee Display Bill', 1, '2021-01-16 21:39:26'),
(753, 'User Login', 151, '2021-01-16 21:42:09'),
(754, 'Student Viewed His Grades', 151, '2021-01-16 21:42:12'),
(755, 'Student Viewed His Grades', 151, '2021-01-16 21:42:27'),
(756, 'User Login', 153, '2021-01-16 21:58:48'),
(757, 'User Login', 163, '2021-01-16 22:02:45'),
(758, 'User Login', 151, '2021-01-23 06:59:44'),
(759, 'Employee Login', 1, '2021-03-28 14:23:54'),
(760, 'Employee Generate Certificate', 1, '2021-03-28 14:24:03'),
(761, 'Employee Display Bill', 1, '2021-03-28 14:24:56'),
(762, 'Employee Login', 1, '2021-09-27 01:45:05'),
(763, 'Employee Generate Certificate', 1, '2021-09-27 01:45:14'),
(764, 'Employee Display Bill', 1, '2021-09-27 01:46:36'),
(765, 'Employee Display Bill', 1, '2021-09-27 01:46:39'),
(766, 'User Login', 151, '2021-09-27 01:48:22'),
(767, 'Student Viewed His Grades', 151, '2021-09-27 01:48:25'),
(768, 'User Login', 153, '2021-09-27 01:49:07'),
(769, 'Teacher Update Grade to Student 164 in Subject History - HIS314', 153, '2021-09-27 01:49:19'),
(770, 'Teacher Update Grade to Student 151 in Subject History - HIS314', 153, '2021-09-27 01:49:28'),
(771, 'Teacher Update Grade to Student 154 in Subject History - HIS314', 153, '2021-09-27 01:49:30'),
(772, 'User Login', 154, '2021-09-27 01:49:51'),
(773, 'User Login', 163, '2021-09-27 01:50:07'),
(774, 'Employee Login', 1, '2021-09-29 12:53:25'),
(775, 'Employee Display Bill', 1, '2021-09-29 12:54:22'),
(776, 'Employee Generate Certificate', 1, '2021-09-29 12:55:33'),
(777, 'User Login', 151, '2021-09-29 12:56:00'),
(778, 'Student Viewed His Grades', 151, '2021-09-29 12:56:03'),
(779, 'User Login', 151, '2021-09-29 16:20:21'),
(780, 'Employee Login', 1, '2022-06-30 17:31:23'),
(781, 'Employee Generate Certificate', 1, '2022-06-30 17:31:53'),
(782, 'User Login', 151, '2022-06-30 17:33:22'),
(783, 'Student Viewed His Grades', 151, '2022-06-30 17:33:46'),
(784, 'User Login', 3, '2022-06-30 17:34:06'),
(785, 'User Login', 3, '2022-06-30 17:34:44'),
(786, 'Student Viewed His Grades', 3, '2022-06-30 17:34:55'),
(787, 'User Login', 3, '2022-06-30 17:35:33'),
(788, 'User Login', 151, '2022-06-30 17:36:44'),
(789, 'User Login', 153, '2022-06-30 17:36:57'),
(790, 'Employee Login', 1, '2022-06-30 17:38:13'),
(791, 'User Login', 151, '2022-06-30 17:38:28'),
(792, 'User Login', 154, '2022-06-30 17:38:50'),
(793, 'User Login', 163, '2022-06-30 17:39:08'),
(794, 'Employee Display Bill', 163, '2022-06-30 17:43:13'),
(795, 'Employee Accept User', 163, '2022-06-30 17:53:57'),
(796, 'User Login', 166, '2022-06-30 17:54:25'),
(797, 'Student Viewed His Grades', 166, '2022-06-30 17:54:30'),
(798, 'Employee Register Student', 166, '2022-06-30 17:55:03'),
(799, 'Employee Add Subject to Student', 166, '2022-06-30 17:55:12'),
(800, 'Employee Add Subject to Student', 166, '2022-06-30 17:55:14'),
(801, 'Employee Generate Certificate', 166, '2022-06-30 17:55:31'),
(802, 'Employee Add Subject to Teacher', 166, '2022-06-30 17:56:20'),
(803, 'Employee Add Subject to Teacher', 166, '2022-06-30 17:56:23'),
(804, 'Employee Add Subject to Teacher', 166, '2022-06-30 17:56:25'),
(805, 'Employee Add Subject to Teacher', 166, '2022-06-30 17:56:28'),
(806, 'Employee Add Subject to Teacher', 166, '2022-06-30 17:56:32'),
(807, 'Employee Accept User', 166, '2022-06-30 17:56:37'),
(808, 'Employee Add Subject to Teacher', 166, '2022-06-30 17:56:45'),
(809, 'Employee Add Subject to Teacher', 166, '2022-06-30 17:56:47'),
(810, 'Employee Add Subject to System', 166, '2022-06-30 17:57:38'),
(811, 'Employee Add Subject to Teacher', 166, '2022-06-30 17:57:50'),
(812, 'Employee Add New Bills item', 166, '2022-06-30 17:58:07'),
(813, 'Employee Create New Bill', 166, '2022-06-30 17:58:24'),
(814, 'Employee Display Bill', 166, '2022-06-30 17:58:33'),
(815, 'Employee Display Bill', 166, '2022-06-30 17:58:43'),
(816, 'Employee Add New Semester', 166, '2022-06-30 17:59:16'),
(817, 'Employee Add Grade Type', 166, '2022-06-30 17:59:52'),
(818, 'Employee Edited About Us Page', 166, '2022-06-30 18:01:15'),
(819, 'Student Viewed His Grades', 166, '2022-06-30 18:01:40'),
(820, 'User Login', 151, '2022-06-30 18:01:51'),
(821, 'Student Viewed His Grades', 151, '2022-06-30 18:01:54'),
(822, 'Student Viewed His Grades', 151, '2022-06-30 18:01:58'),
(823, 'User Login', 153, '2022-06-30 18:03:29'),
(824, 'User Login', 166, '2022-06-30 18:03:51'),
(825, 'Student Viewed His Grades', 166, '2022-06-30 18:03:54'),
(826, 'Teacher Add Grade to Student 166 in Subject Arabic - AR101', 153, '2022-06-30 18:04:01'),
(827, 'Teacher Add Grade to Student 166 in Subject Arabic - AR101', 153, '2022-06-30 18:04:04'),
(828, 'Teacher Add Grade to Student 166 in Subject Arabic - AR101', 153, '2022-06-30 18:04:17'),
(829, 'Student Viewed His Grades', 166, '2022-06-30 18:04:18'),
(830, 'Teacher Update Grade to Student 166 in Subject Arabic - AR101', 153, '2022-06-30 18:04:25'),
(831, 'Teacher Add Grade to Student 166 in Subject Arabic - AR101', 153, '2022-06-30 18:04:33'),
(832, 'Student Viewed His Grades', 166, '2022-06-30 18:04:33'),
(833, 'User Login', 153, '2022-06-30 18:05:02'),
(834, 'Teacher Add Grade to Student 166 in Subject Math - MTH101', 153, '2022-06-30 18:05:10'),
(835, 'Teacher Add Grade to Student 166 in Subject Math - MTH101', 153, '2022-06-30 18:05:11'),
(836, 'Teacher Add Grade to Student 166 in Subject Math - MTH101', 153, '2022-06-30 18:05:12'),
(837, 'Teacher Add Grade to Student 166 in Subject Math - MTH101', 153, '2022-06-30 18:05:15'),
(838, 'Student Viewed His Grades', 153, '2022-06-30 18:05:15'),
(839, 'User Login', 166, '2022-06-30 18:05:24'),
(840, 'Student Viewed His Grades', 166, '2022-06-30 18:05:28'),
(841, 'Teacher Update Grade to Student 166 in Subject Math - MTH101', 153, '2022-06-30 18:05:34'),
(842, 'Employee Generate Certificate', 166, '2022-06-30 18:06:03'),
(843, 'Employee Generate Certificate', 166, '2022-06-30 18:06:24'),
(844, 'Employee Transfer Student to next Semester', 166, '2022-06-30 18:06:24'),
(845, 'Employee Generate Certificate', 166, '2022-06-30 18:06:37'),
(846, 'Student Viewed His Grades', 166, '2022-06-30 18:07:02'),
(847, 'Employee Generate Certificate', 166, '2022-06-30 18:07:08'),
(848, 'Employee Login', 1, '2022-06-30 18:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `system_messages`
--

CREATE TABLE `system_messages` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_messages`
--

INSERT INTO `system_messages` (`id`, `type`, `message`) VALUES
(1, 'addItemSuccess', ' Item Successfully added'),
(2, 'addItemError', ' Item has not added'),
(5, 'GradeUpdated', 'Your grade has been updated.');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_semesters`
--

CREATE TABLE `teacher_semesters` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_semesters`
--

INSERT INTO `teacher_semesters` (`id`, `teacher_id`, `semester_id`) VALUES
(1, 153, 1),
(2, 153, 3),
(3, 153, 4),
(4, 153, 7),
(6, 155, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_subjects`
--

INSERT INTO `teacher_subjects` (`id`, `user_id`, `subject_id`) VALUES
(1, 153, 1),
(2, 153, 2),
(3, 153, 3),
(4, 153, 14),
(5, 153, 13),
(6, 153, 15),
(7, 153, 23),
(9, 153, 22),
(10, 155, 1),
(11, 155, 14),
(12, 153, 25);

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `themeHTML` longtext NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `name`, `themeHTML`, `parent_id`) VALUES
(5, 'app_status', '<form action=\"applicationStatus.php\" method=\"POST\" style=\"width: 35%; margin: 50px auto;\">\r\n            <div class=\"form-group\">\r\n                <label>Your application number</label>\r\n                <input type=\"number\" class=\"form-control\" placeholder=\"Enter your application number\" required pattern=\"[0-9]+\" name=\"applicationNumber\">\r\n            </div>\r\n            <button type=\"submit\" class=\"btn btn-success\" style=\"width: 20%;\" name=\"check\">Check</button>\r\n        </form>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `translation`
--

CREATE TABLE `translation` (
  `id` int(11) NOT NULL,
  `translation_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `translation`
--

INSERT INTO `translation` (`id`, `translation_name`) VALUES
(1, 'home_title'),
(2, 'nav_1'),
(3, 'nav_2'),
(4, 'nav_3'),
(5, 'nav_4'),
(6, 'card1_1'),
(7, 'card1_2'),
(8, 'card1_3'),
(9, 'card2_1'),
(10, 'card2_2'),
(11, 'card2_3'),
(12, 'card3_1'),
(13, 'card3_2'),
(14, 'card3_3'),
(15, 'button1'),
(16, 'button2'),
(17, 'nav_0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `second_name` varchar(255) NOT NULL,
  `third_name` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `accepted` tinyint(1) NOT NULL,
  `application_number` bigint(20) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `first_name`, `second_name`, `third_name`, `dob`, `password`, `email`, `gender`, `date_created`, `accepted`, `application_number`, `isDeleted`, `date_modified`) VALUES
(1, 1, 'Mahmoud', 'Ahmed', '', '', 'CLR0', 'mahmoud1@gmail.com', 0, '2020-11-13 23:15:16', 0, 0, 0, '2020-12-20 23:23:24'),
(151, 3, 'Mahmoud', 'Ahmed', 'Ibrahim', '15-01-2001', 'CLR0', 'mahmoudT@gmail.com', 0, '2020-11-16 13:10:28', 1, 60392632426, 0, '2020-12-20 23:23:24'),
(153, 2, 'Abdelrahman', 'Ahmed', 'Mohamed', '15-01-2001', 'CLR0', 'Abdo@gmail.com', 0, '2020-12-04 17:33:20', 1, 329167767503, 0, '2020-12-20 23:23:24'),
(154, 3, 'Marwan', 'Aboelseoud', 'Khateeb', '15-01-2001', 'CLR0', 'Marwan@gmail.com', 0, '2020-12-05 01:33:16', 1, 810187894816, 0, '2020-12-20 23:26:27'),
(155, 2, 'Ibrahim', 'Mohamed', 'ElKilany', '15-01-2001', 'CLR0', 'Kilany@gmail.com', 0, '2020-12-05 22:50:28', 1, 407961040109, 0, '2022-06-30 17:56:37'),
(163, 4, 'Khaled', 'Ahmed', 'Abdelwahab', '15-01-2001', 'CLR0', 'khaled@gmail.com', 0, '2021-01-05 06:11:30', 1, 292044349542, 0, '2021-01-05 06:11:44'),
(164, 3, 'Ahmed', 'Ibrahim', 'Mohamed', '30-5-2000', 'CLR0', 'ahmed@gmail.com', 0, '2021-01-12 19:22:32', 1, 932594485066, 0, '2021-01-12 19:41:16'),
(166, 3, 'Mahmoud', 'Ahmed', 'Ibrahim', '10-10-2000', 'CLR0sV999oU=', 'm@gmail.com', 0, '2022-06-30 17:53:04', 1, 637425824268, 0, '2022-06-30 17:53:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`) VALUES
(1, 'employee'),
(2, 'teacher'),
(3, 'student'),
(4, 'parent');

-- --------------------------------------------------------

--
-- Table structure for table `user_type_links`
--

CREATE TABLE `user_type_links` (
  `id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type_links`
--

INSERT INTO `user_type_links` (`id`, `user_type_id`, `link`) VALUES
(1, 2, '/PharaohSchoolSystem/modules/Teacher/Controller/teacherController.php?page=Home'),
(2, 3, '/PharaohSchoolSystem/modules/Student/Controller/studentController.php'),
(4, 4, '/PharaohSchoolSystem/modules/Parent/Controller/parentController.php'),
(5, 1, '/PharaohSchoolSystem/modules/Employee/Controller/employeeController.php');

-- --------------------------------------------------------

--
-- Table structure for table `word`
--

CREATE TABLE `word` (
  `id` int(11) NOT NULL,
  `words` varchar(255) NOT NULL,
  `translation_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `word`
--

INSERT INTO `word` (`id`, `words`, `translation_id`, `language_id`) VALUES
(1, 'Pharaohs Experimental School', 1, 1),
(2, 'مدرسة الفراعنة التجريبية', 1, 2),
(3, 'Login', 2, 1),
(4, 'تسجيل الدخول', 2, 2),
(5, 'Application Status', 3, 1),
(6, 'حالة الابليكيشن', 3, 2),
(7, 'Admin', 4, 1),
(8, 'مشرف', 4, 2),
(9, 'About us', 5, 1),
(10, 'معلومات عنا', 5, 2),
(11, 'Teacher', 6, 1),
(12, 'معلم', 6, 2),
(13, 'Teacher Application', 7, 1),
(14, 'تطبيق المعلم', 7, 2),
(15, 'If you\'re a teacher, you can fill the application here and wait for an acceptance.', 8, 1),
(16, 'إذا كنت مدرسًا ، يمكنك ملء الطلب هنا وانتظار القبول.', 8, 2),
(17, 'Student', 9, 1),
(18, 'طالب', 9, 2),
(19, 'Student Application', 10, 1),
(20, 'تطبيق الطالب', 10, 2),
(21, 'If you\'re a student, fill the application here and wait for an acceptance.', 11, 1),
(22, 'إذا كنت طالبًا ، فاملأ الطلب هنا وانتظر القبول.', 11, 2),
(23, 'Parent', 12, 1),
(24, 'والد', 12, 2),
(25, 'Parent Application', 13, 1),
(26, 'تطبيق الوالد', 13, 2),
(27, 'If you\'re a parent, you need to fill the application here to be able to pay for your student.', 14, 1),
(28, 'إذا كنت أحد الوالدين ، فأنت بحاجة إلى ملء الطلب هنا لتتمكن من الدفع و اشياء اخري.', 14, 2),
(29, 'REGISTER NOW', 15, 1),
(30, 'سجــل الان', 15, 2),
(31, 'Learn more', 16, 1),
(32, 'اعرف اكثر', 16, 2),
(33, 'Change Language', 17, 1),
(34, 'تغيير اللغة', 17, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `bus_routes`
--
ALTER TABLE `bus_routes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `bus_SV_numbers`
--
ALTER TABLE `bus_SV_numbers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `bus_timing`
--
ALTER TABLE `bus_timing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customized_reports`
--
ALTER TABLE `customized_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grading_method`
--
ALTER TABLE `grading_method`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `grading_method_values`
--
ALTER TABLE `grading_method_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identity_images`
--
ALTER TABLE `identity_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `payment_options`
--
ALTER TABLE `payment_options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `payment_options_values`
--
ALTER TABLE `payment_options_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_rendered_html`
--
ALTER TABLE `payment_rendered_html`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phone_numbers`
--
ALTER TABLE `phone_numbers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`);

--
-- Indexes for table `qr_link`
--
ALTER TABLE `qr_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_bank`
--
ALTER TABLE `question_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `registration_details`
--
ALTER TABLE `registration_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration_item_details`
--
ALTER TABLE `registration_item_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `students_bus`
--
ALTER TABLE `students_bus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_bill`
--
ALTER TABLE `student_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects_names`
--
ALTER TABLE `subjects_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_grading`
--
ALTER TABLE `subject_grading`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_log`
--
ALTER TABLE `system_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_messages`
--
ALTER TABLE `system_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_semesters`
--
ALTER TABLE `teacher_semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translation`
--
ALTER TABLE `translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type_links`
--
ALTER TABLE `user_type_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `word`
--
ALTER TABLE `word`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bus_routes`
--
ALTER TABLE `bus_routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bus_SV_numbers`
--
ALTER TABLE `bus_SV_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bus_timing`
--
ALTER TABLE `bus_timing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customized_reports`
--
ALTER TABLE `customized_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `grading_method`
--
ALTER TABLE `grading_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `grading_method_values`
--
ALTER TABLE `grading_method_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `identity_images`
--
ALTER TABLE `identity_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payment_options`
--
ALTER TABLE `payment_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payment_options_values`
--
ALTER TABLE `payment_options_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `payment_rendered_html`
--
ALTER TABLE `payment_rendered_html`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `phone_numbers`
--
ALTER TABLE `phone_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `qr_link`
--
ALTER TABLE `qr_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `registration_details`
--
ALTER TABLE `registration_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `registration_item_details`
--
ALTER TABLE `registration_item_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `students_bus`
--
ALTER TABLE `students_bus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `student_bill`
--
ALTER TABLE `student_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `subjects_names`
--
ALTER TABLE `subjects_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subject_grading`
--
ALTER TABLE `subject_grading`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_log`
--
ALTER TABLE `system_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=849;

--
-- AUTO_INCREMENT for table `system_messages`
--
ALTER TABLE `system_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teacher_semesters`
--
ALTER TABLE `teacher_semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `translation`
--
ALTER TABLE `translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_type_links`
--
ALTER TABLE `user_type_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `word`
--
ALTER TABLE `word`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

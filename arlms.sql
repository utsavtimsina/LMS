-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2022 at 08:17 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arlms`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_category_tbl`
--

CREATE TABLE `book_category_tbl` (
  `cid` int(20) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_category_tbl`
--

INSERT INTO `book_category_tbl` (`cid`, `category_name`, `description`) VALUES
(1, 'Programming', 'Different books related to Programming.'),
(2, 'Accounting & Finance', 'Books Related to Accounting & Finance.'),
(3, 'Language', 'Books Related to language.'),
(4, 'Science and Maths', 'Books of Science And Math Genre.');

-- --------------------------------------------------------

--
-- Table structure for table `book_details_tbl`
--

CREATE TABLE `book_details_tbl` (
  `bid` int(20) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `book_id` varchar(50) NOT NULL,
  `faculty_id` int(20) NOT NULL,
  `subcode` varchar(40) NOT NULL,
  `year` varchar(15) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `edition` int(10) NOT NULL,
  `category_id` int(20) NOT NULL,
  `publication` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `price` int(20) NOT NULL,
  `rack_no` varchar(10) NOT NULL,
  `total_qty` int(20) NOT NULL DEFAULT 0,
  `issued_qty` int(20) NOT NULL DEFAULT 0,
  `available_qty` int(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_details_tbl`
--

INSERT INTO `book_details_tbl` (`bid`, `bname`, `book_id`, `faculty_id`, `subcode`, `year`, `semester`, `edition`, `category_id`, `publication`, `author`, `price`, `rack_no`, `total_qty`, `issued_qty`, `available_qty`) VALUES
(1, 'Scripting Language e1', '1BCACACS254', 1, 'CACS254', '2nd', '4th', 1, 1, 'KEC', 'Ramesh Singh', 500, 'a1', 5, 3, 2),
(2, 'C-Programming e1', '1BCACACS151', 1, 'CACS151', '1st', '2nd', 1, 1, 'KEC', 'Ramesh Singh', 200, 'a2', 2, 1, 1),
(3, 'Math I e1', '1BCACAMT104', 1, 'CAMT104', '1st', '1st', 1, 4, 'KEC', 'Aasish Shrestha', 450, 'a3', 0, 0, 0),
(7, 'Business Mathematics I e1', '1BBAMTH201', 2, 'MTH201', '1st', '1st', 1, 4, 'KEC', 'Rameshor Rai', 550, 'b1', 1, 1, 0),
(8, 'Macro Economics  e1', '1BBAECO202', 2, 'ECO202', '1st', '2nd', 1, 2, 'KEC', 'Ram Yadav', 235, 'c1', 0, 0, 0),
(9, 'Business Finance e1', '1BBAFIN201', 2, 'FIN201', '2nd', '3rd', 1, 2, 'KEC', 'Ramesh Singh', 500, 'd1', 1, 0, 1),
(10, 'Business Statistics e1', '1BBASTT201', 2, 'STT201', '2nd', '3rd', 1, 4, 'KEC', 'Ramesh Singh', 345, 'd2', 0, 0, 0),
(12, 'Software engineering e1', '1BCACACS2052', 1, 'CACS2052', '2nd', '4th', 1, 1, 'kEC', 'Nabin Shrestha', 500, 'd3', 1, 0, 1),
(13, 'Digital logic e1', '1BCACACS105', 1, 'CACS105', '1st', '1st', 1, 1, 'Asmita Publication', 'Hari Khadka', 121, 'e1', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_tbl`
--

CREATE TABLE `book_tbl` (
  `biid` int(11) NOT NULL,
  `bookid` varchar(50) NOT NULL,
  `sn` int(40) NOT NULL,
  `bookuid` varchar(100) DEFAULT NULL,
  `isbn` bigint(100) NOT NULL DEFAULT 0,
  `issued_date` datetime DEFAULT NULL,
  `returned_date` datetime DEFAULT NULL,
  `isreturned` varchar(10) NOT NULL DEFAULT 'true',
  `takenby` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_tbl`
--

INSERT INTO `book_tbl` (`biid`, `bookid`, `sn`, `bookuid`, `isbn`, `issued_date`, `returned_date`, `isreturned`, `takenby`) VALUES
(13, '1BCACACS254', 3, '1BCACACS2543', 65777, NULL, NULL, 'true', NULL),
(14, '1BCACACS254', 2, '1BCACACS2542', 3245673589389, '2022-06-27 17:25:52', NULL, 'false', '2022BCA3'),
(15, '1BCACACS254', 1, '1BCACACS2541', 323333, '2022-06-27 17:26:02', NULL, 'false', '2022BCA3'),
(16, '1BCACACS105', 1, '1BCACACS1051', 32665653333, NULL, NULL, 'true', ''),
(17, '1BCACACS151', 1, '1BCACACS1511', 23434333, '2022-08-03 14:46:44', NULL, 'false', '2022BBA1'),
(18, '1BCACACS2052', 2, '1BCACACS20522', 9789937724746, NULL, NULL, 'true', ''),
(19, '1BCACACS254', 5, '1BCACACS2545', 54875488745, '2022-06-27 17:26:13', NULL, 'false', '2022BCA3'),
(20, '1BCACACS254', 4, '1BCACACS2544', 6754, NULL, NULL, 'true', NULL),
(23, '1BCACACS151', 2, '1BCACACS1512', 32222222, NULL, NULL, 'true', NULL),
(24, '1BBAMTH201', 1, '1BBAMTH2011', 454543255, '2022-08-03 23:22:10', NULL, 'false', '2022BHM4'),
(25, '1BBAFIN201', 1, '1BBAFIN2011', 2123, '2022-08-03 23:25:46', '2022-08-03 23:34:34', 'true', '2022BBA1');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_tbl`
--

CREATE TABLE `faculty_tbl` (
  `fid` int(20) NOT NULL,
  `faculty_name` varchar(50) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_tbl`
--

INSERT INTO `faculty_tbl` (`fid`, `faculty_name`, `description`) VALUES
(1, 'BCA', 'BCA program prefers students to develop their career in the field of computer application and software development.	\r\n'),
(2, 'BBA', 'This course provides specialization on Banking and Finance, Industrial Management, Marketing Management, Travel and Tourism Management, Management Information System.'),
(3, 'BHM', 'Bachelor in Hotel Management (BHM) program has been designed to provide students a strong base of skill & expertise and to operate or manage restaurants, hotels or eateries in the hospitality industry.'),
(4, 'BSW', 'BSW course or Bachelor of Social Work is a professional degree majoring in the field of social work offered at the undergraduate (UG) level.'),
(5, 'BBS', 'The main objective of BBS is to develop students into dynamic managers having ability to handle responsibility in every sector.');

-- --------------------------------------------------------

--
-- Table structure for table `issue_tbl`
--

CREATE TABLE `issue_tbl` (
  `txn_no` int(100) NOT NULL,
  `book_uid` varchar(100) NOT NULL,
  `user_uid` varchar(100) NOT NULL,
  `issued_date` datetime DEFAULT NULL,
  `returned_date` datetime DEFAULT NULL,
  `return_status` varchar(44) NOT NULL,
  `fine` int(60) NOT NULL DEFAULT 0,
  `timestamp` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issue_tbl`
--

INSERT INTO `issue_tbl` (`txn_no`, `book_uid`, `user_uid`, `issued_date`, `returned_date`, `return_status`, `fine`, `timestamp`) VALUES
(9, '1BCACACS2543', '2022BCA3', '2022-06-01 21:03:31', '2022-06-01 21:13:07', 'returned', 0, '2022-06-01 21:13:07.000000'),
(10, '1BCACACS2542', '2022BCA3', '2022-06-01 21:07:17', '2022-06-13 19:45:00', 'returned', 0, '2022-06-13 19:45:00.000000'),
(11, '1BCACACS2543', '2022BBA1', '2022-06-01 21:15:00', '2022-06-13 19:44:09', 'returned', 0, '2022-06-13 19:44:09.000000'),
(12, '1BCACACS2545', '2022BCA3', '2022-06-01 21:18:45', '2022-06-01 21:18:59', 'returned', 0, '2022-06-01 21:18:59.000000'),
(13, '1BCACACS2545', '2022BBA1', '2022-06-01 21:20:14', '2022-06-01 21:20:40', 'returned', 0, '2022-06-01 21:20:40.000000'),
(14, '1BCACACS2541', '2016BCA1', '2022-06-04 21:39:28', '2022-06-04 21:40:18', 'returned', 0, '2022-06-04 21:40:18.000000'),
(15, '1BCACACS2543', '2022BCA3', '2022-06-13 19:56:26', '2022-06-27 15:07:45', 'returned', 0, '2022-06-27 15:07:45.000000'),
(16, '1BCACACS2542', '2022BCA3', '2022-06-27 17:25:52', NULL, 'issued', 0, '2022-06-27 17:25:52.000000'),
(17, '1BCACACS2541', '2022BCA3', '2022-06-27 17:26:02', NULL, 'issued', 10, '2022-06-28 22:54:22.000000'),
(18, '1BCACACS2545', '2022BCA3', '2022-06-27 17:26:13', NULL, 'issued', 0, '2022-06-27 17:26:13.000000'),
(19, '1BCACACS2544', '2022BCA3', '2022-06-27 17:26:20', '2022-06-27 17:26:45', 'returned', 0, '2022-06-27 17:26:45.000000'),
(20, '1BCACACS1511', '44443334', '2022-06-28 21:02:41', '2022-06-28 21:03:21', 'returned', 0, '2022-06-28 21:03:21.000000'),
(21, '1BCACACS1511', '44443334', '2022-06-28 21:03:38', '2022-06-28 21:03:56', 'returned', 0, '2022-06-28 21:03:56.000000'),
(22, '1BCACACS1511', '2022BBA1', '2022-08-03 14:46:44', NULL, 'issued', 0, '2022-08-03 14:46:44.000000'),
(23, '1BBAMTH2011', '2022BHM4', '2022-08-03 23:22:10', NULL, 'issued', 0, '2022-08-03 23:22:10.000000'),
(24, '1BBAFIN2011', '2022BBA1', '2022-08-03 23:25:46', '2022-08-03 23:34:34', 'returned', 0, '2022-08-03 23:34:34.000000');

-- --------------------------------------------------------

--
-- Table structure for table `lib_tbl`
--

CREATE TABLE `lib_tbl` (
  `lid` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `empid` varchar(44) NOT NULL,
  `role` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lib_tbl`
--

INSERT INTO `lib_tbl` (`lid`, `fname`, `mname`, `lname`, `email`, `password`, `empid`, `role`) VALUES
(1, '', '', '', 'admin@gmail.com', 'admin', '', 'admin'),
(2, 'Lazio', '', 'Khadka', 'lazio@gmail.com', 'Lazio', '3232323211', 'librarian');

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `sid` int(11) NOT NULL,
  `faculty_id` int(20) NOT NULL,
  `batch` varchar(20) NOT NULL,
  `rollno` int(44) NOT NULL,
  `stuid` varchar(60) NOT NULL,
  `phone` bigint(44) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `idno` varchar(40) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`sid`, `faculty_id`, `batch`, `rollno`, `stuid`, `phone`, `gender`, `idno`, `address`) VALUES
(1, 1, '2022', 3, '2022BCA3', 133433432, 'male', '2333333333333333333', 'ith'),
(9, 2, '2022', 1, '2022BBA1', 978788988, 'male', '4634635', 'Itahari'),
(10, 3, '2022', 4, '2022BHM4', 9843333333, 'male', '23456781', 'Itahari'),
(11, 1, '2016', 1, '2016BCA1', 9812394546, 'male', '1122', 'aaaaaa'),
(13, 1, '2022', 1, '2022BCA1', 344444444444444, 'male', '34444444444', 'aasis');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(44) NOT NULL,
  `user_uid` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `fname`, `mname`, `lname`, `email`, `role`, `user_uid`, `password`) VALUES
(8, 'Aasish', '', 'Shrestha', 'aasish@gmail.com', 'student', '2022BCA3', 'aasish987'),
(10, 'Utsav', '', 'Khadka', 'utsavk@gmail.com', 'student', '2022BBA1', 'Utsav'),
(11, 'Aman', 'Kumar', 'Rai', 'aman@gmail.com', 'student', '2022BHM4', 'Aman'),
(12, 'Kamal', '', 'Lama', 'kamal@gmail.com', 'student', '2016BCA1', 'Kamal'),
(14, 'Aasish', '', 'Shrestha', 'Aakash@gmail.com', 'student', '2022BCA1', 'Aakash'),
(16, 'Utsav', '', 'Rai', 'utsav@gmail.com', 'staff', '44443334', 'Utsav'),
(17, 'Akhil', '', 'Rai', 'akhil@gmail.com', 'staff', '32321122', 'Akhil'),
(18, 'Kiran', '', 'Adhikari', 'kiran@gmail.com', 'staff', '3421', 'Kiran'),
(19, 'Rajesh', '', 'Rai', 'rajesh@gmail.com', 'staff', '12321', 'Rajesh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_category_tbl`
--
ALTER TABLE `book_category_tbl`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `book_details_tbl`
--
ALTER TABLE `book_details_tbl`
  ADD PRIMARY KEY (`bid`),
  ADD UNIQUE KEY `book_id` (`book_id`),
  ADD KEY `fk_c` (`category_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `book_tbl`
--
ALTER TABLE `book_tbl`
  ADD PRIMARY KEY (`biid`),
  ADD UNIQUE KEY `bookuid` (`bookuid`),
  ADD KEY `book_tbl_ibfk_1` (`bookid`);

--
-- Indexes for table `faculty_tbl`
--
ALTER TABLE `faculty_tbl`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `issue_tbl`
--
ALTER TABLE `issue_tbl`
  ADD PRIMARY KEY (`txn_no`),
  ADD KEY `issue_tbl_ibfk_1` (`book_uid`),
  ADD KEY `user_uid` (`user_uid`);

--
-- Indexes for table `lib_tbl`
--
ALTER TABLE `lib_tbl`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `student_tbl_ibfk_2` (`stuid`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_uid` (`user_uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_category_tbl`
--
ALTER TABLE `book_category_tbl`
  MODIFY `cid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `book_details_tbl`
--
ALTER TABLE `book_details_tbl`
  MODIFY `bid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `book_tbl`
--
ALTER TABLE `book_tbl`
  MODIFY `biid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `faculty_tbl`
--
ALTER TABLE `faculty_tbl`
  MODIFY `fid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `issue_tbl`
--
ALTER TABLE `issue_tbl`
  MODIFY `txn_no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `lib_tbl`
--
ALTER TABLE `lib_tbl`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_details_tbl`
--
ALTER TABLE `book_details_tbl`
  ADD CONSTRAINT `book_details_tbl_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty_tbl` (`fid`),
  ADD CONSTRAINT `fk_c` FOREIGN KEY (`category_id`) REFERENCES `book_category_tbl` (`cid`);

--
-- Constraints for table `book_tbl`
--
ALTER TABLE `book_tbl`
  ADD CONSTRAINT `book_tbl_ibfk_1` FOREIGN KEY (`bookid`) REFERENCES `book_details_tbl` (`book_id`) ON UPDATE CASCADE;

--
-- Constraints for table `issue_tbl`
--
ALTER TABLE `issue_tbl`
  ADD CONSTRAINT `issue_tbl_ibfk_1` FOREIGN KEY (`book_uid`) REFERENCES `book_tbl` (`bookuid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `issue_tbl_ibfk_2` FOREIGN KEY (`user_uid`) REFERENCES `user_tbl` (`user_uid`) ON UPDATE CASCADE;

--
-- Constraints for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD CONSTRAINT `student_tbl_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty_tbl` (`fid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `student_tbl_ibfk_2` FOREIGN KEY (`stuid`) REFERENCES `user_tbl` (`user_uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

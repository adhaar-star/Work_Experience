-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 29, 2018 at 12:32 PM
-- Server version: 5.7.23
-- PHP Version: 7.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gistnew`
--

-- --------------------------------------------------------

--
-- Table structure for table `Candidates`
--

CREATE TABLE `Candidates` (
  `candidate_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `experience` varchar(255) NOT NULL,
  `expertise` varchar(255) NOT NULL,
  `blocked` text CHARACTER SET utf8 NOT NULL,
  `url` text CHARACTER SET utf8 NOT NULL,
  `profile_link` text NOT NULL,
  `question` text CHARACTER SET utf8 NOT NULL,
  `candidate_summary` text CHARACTER SET utf8 NOT NULL,
  `video_url` text CHARACTER SET utf8 NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Candidates`
--

INSERT INTO `Candidates` (`candidate_id`, `user_id`, `Name`, `experience`, `expertise`, `blocked`, `url`, `profile_link`, `question`, `candidate_summary`, `video_url`, `created_at`, `modified_at`) VALUES
(69, 69, 'Thomas Hopp', '2', '3', 'google,facebook', 'http://google.com', 'http://192.168.1.217/gist2/user/Thomas-Hopp', 'You are in charge of 20 people, describe how you\n would organize them to \nfigure out how many \nbicycles were sold in NYC\nlast year. — ', '', 'http://192.168.1.217/gist2/uploads/profileVideo/34a110cb61b714276253d9f6935773441daf83c7-1545370240.mp4', '2018-12-19 10:21:52.000000', '2018-12-27 12:57:44.000000'),
(70, 70, 'prologic technologies', '2', '24', '', 'http://linkedin.com', 'http://192.168.1.217/gist2/user/prologic-technologies', 'If you could have one\n\n                    superpower what would \n\n                    it be and why? — ', '', 'http://192.168.1.217/gist2/uploads/profileVideo/34a110cb61b714276253d9f6935773441daf83c7-1545379128.mp4', '2018-12-20 07:27:09.000000', '2018-12-27 12:59:04.000000'),
(85, 87, 'Ripu Daman', '1', '5', 'google,facebook', 'http://google.com', 'http://192.168.1.217/gist2/user/Ripu-Daman', 'You are in charge of 20 people, describe how you\n would organize them to \nfigure out how many \nbicycles were sold in NYC\nlast year. — ', '', 'http://192.168.1.217/gist2/uploads/profileVideo/34a110cb61b714276253d9f6935773441daf83c7-1546065542.mp4', '2018-12-29 07:25:31.000000', '2018-12-29 07:25:31.000000');

-- --------------------------------------------------------

--
-- Table structure for table `Candidates_hidden`
--

CREATE TABLE `Candidates_hidden` (
  `Hidden_Id` int(25) NOT NULL,
  `Candidate_Id` int(25) NOT NULL,
  `Employer_Id` int(25) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_education`
--

CREATE TABLE `candidate_education` (
  `candidate_education_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `degree_id` int(25) NOT NULL,
  `study_field_id` int(25) NOT NULL,
  `college_id` int(25) NOT NULL,
  `grad_year` int(25) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate_education`
--

INSERT INTO `candidate_education` (`candidate_education_id`, `user_id`, `degree_id`, `study_field_id`, `college_id`, `grad_year`, `created_at`, `modified_at`) VALUES
(3, 69, 1, 61, 5, 2016, '2018-12-19 10:21:52.000000', '2018-12-27 12:57:44.000000'),
(4, 70, 2, 4, 4, 2014, '2018-12-20 07:27:09.000000', '2018-12-27 12:59:04.000000'),
(19, 87, 1, 2, 3, 2016, '2018-12-29 07:25:31.000000', '2018-12-29 07:25:31.000000');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_experience`
--

CREATE TABLE `candidate_experience` (
  `candidate_experience_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `experience_id` int(25) NOT NULL,
  `is_currently_working` enum('0','1') CHARACTER SET utf8 NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_expertise`
--

CREATE TABLE `candidate_expertise` (
  `candidate_expertise_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `expertise_id` int(25) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_jobs`
--

CREATE TABLE `candidate_jobs` (
  `candidate_job_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `company` varchar(255) CHARACTER SET utf8 NOT NULL,
  `job_title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `start_month` varchar(255) NOT NULL,
  `start_year` int(25) NOT NULL,
  `end_month` varchar(255) NOT NULL,
  `end_year` int(25) NOT NULL,
  `is_currently_working` enum('0','1') NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate_jobs`
--

INSERT INTO `candidate_jobs` (`candidate_job_id`, `user_id`, `company`, `job_title`, `start_month`, `start_year`, `end_month`, `end_year`, `is_currently_working`, `created_at`, `modified_at`) VALUES
(4, 69, 'google', 'prologictechnologies', '03', 2018, 'nomonth', 0, '1', '2018-12-19 10:21:52.000000', '2018-12-27 12:57:44.000000'),
(5, 70, 'google', 'prologictechnologies', '03', 2017, 'nomonth', 0, '0', '2018-12-20 07:27:09.000000', '2018-12-27 12:59:04.000000');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_location`
--

CREATE TABLE `candidate_location` (
  `candidate_location_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `location_id` int(25) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate_location`
--

INSERT INTO `candidate_location` (`candidate_location_id`, `user_id`, `location_id`, `created_at`, `modified_at`) VALUES
(85, 69, 1, '2018-12-27 12:57:44.000000', '2018-12-27 12:57:44.000000'),
(86, 69, 3, '2018-12-27 12:57:44.000000', '2018-12-27 12:57:44.000000'),
(87, 69, 28, '2018-12-27 12:57:44.000000', '2018-12-27 12:57:44.000000'),
(88, 70, 1, '2018-12-27 12:59:04.000000', '2018-12-27 12:59:04.000000'),
(89, 70, 3, '2018-12-27 12:59:04.000000', '2018-12-27 12:59:04.000000'),
(112, 87, 1, '2018-12-29 07:25:31.000000', '2018-12-29 07:25:31.000000'),
(113, 87, 3, '2018-12-29 07:25:31.000000', '2018-12-29 07:25:31.000000'),
(114, 87, 5, '2018-12-29 07:25:31.000000', '2018-12-29 07:25:31.000000');

-- --------------------------------------------------------

--
-- Table structure for table `Candidate_skills`
--

CREATE TABLE `Candidate_skills` (
  `candidate_skill_id` int(25) NOT NULL,
  `skill` varchar(255) CHARACTER SET utf8 NOT NULL,
  `experience_Id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Candidate_skills`
--

INSERT INTO `Candidate_skills` (`candidate_skill_id`, `skill`, `experience_Id`, `user_id`, `created_at`, `modified_at`) VALUES
(50, 'PHP', 1, 69, '2018-12-27 12:57:44.000000', '2018-12-27 12:57:44.000000'),
(51, 'java', 4, 69, '2018-12-27 12:57:44.000000', '2018-12-27 12:57:44.000000'),
(52, 'sql', 2, 70, '2018-12-27 12:59:04.000000', '2018-12-27 12:59:04.000000'),
(60, 'JAVASCRIPT', 2, 87, '2018-12-29 07:25:31.000000', '2018-12-29 07:25:31.000000');

-- --------------------------------------------------------

--
-- Table structure for table `Employers`
--

CREATE TABLE `Employers` (
  `employer_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Phone` int(25) NOT NULL,
  `Job_Title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `company_industry` varchar(255) CHARACTER SET utf8 NOT NULL,
  `customer_id` int(25) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Employers`
--

INSERT INTO `Employers` (`employer_id`, `user_id`, `Name`, `Phone`, `Job_Title`, `company_name`, `company_industry`, `customer_id`, `created_at`, `modified_at`) VALUES
(2, 72, 'prologic technologies', 2147483647, 'prologictechnologies', 'google', 'Information technology', 0, '2018-12-21 11:49:03.000000', '2018-12-21 11:49:03.000000');

-- --------------------------------------------------------

--
-- Table structure for table `employer_card_details`
--

CREATE TABLE `employer_card_details` (
  `employer_card_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `card_number` int(25) NOT NULL,
  `card_holder_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `expiration_date` datetime(6) NOT NULL,
  `zipcode` int(25) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employer_card_details`
--

INSERT INTO `employer_card_details` (`employer_card_id`, `user_id`, `card_number`, `card_holder_name`, `expiration_date`, `zipcode`, `created_at`, `modified_at`) VALUES
(0, 72, 4111, 'prologic technologies', '0000-00-00 00:00:00.000000', 95037, '2018-12-21 11:49:03.000000', '2018-12-21 11:49:03.000000');

-- --------------------------------------------------------

--
-- Table structure for table `employer_payments`
--

CREATE TABLE `employer_payments` (
  `employer_payment_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `plan_id` int(25) NOT NULL,
  `amount` int(25) NOT NULL,
  `currency` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_college`
--

CREATE TABLE `master_college` (
  `college_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `college` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_college`
--

INSERT INTO `master_college` (`college_id`, `user_id`, `college`, `created_at`, `modified_at`) VALUES
(1, 0, 'American University', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(2, 0, 'Boston College', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(3, 0, 'Boston University', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(4, 0, 'Harvard University', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(5, 0, 'University of South California', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(6, 0, 'University of Miami', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(7, 0, 'Delaware College', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(8, 0, 'Others', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `master_degree`
--

CREATE TABLE `master_degree` (
  `degree_id` int(25) NOT NULL,
  `Degree` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_degree`
--

INSERT INTO `master_degree` (`degree_id`, `Degree`, `created_at`, `modified_at`) VALUES
(1, 'Student', '2018-12-05 13:14:00.000000', '0000-00-00 00:00:00.000000'),
(2, 'Bacholers', '2018-12-05 13:14:00.000000', '0000-00-00 00:00:00.000000'),
(3, 'Masters', '2018-12-05 13:15:00.000000', '0000-00-00 00:00:00.000000'),
(4, 'PhD', '2018-12-05 13:16:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `master_experience`
--

CREATE TABLE `master_experience` (
  `Experience_Id` int(25) NOT NULL,
  `Experience_level` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_experience`
--

INSERT INTO `master_experience` (`Experience_Id`, `Experience_level`, `created_at`, `modified_at`) VALUES
(1, 'Student', '2018-12-05 13:17:00.000000', '0000-00-00 00:00:00.000000'),
(2, '0-2 Years', '2018-12-05 13:18:00.000000', '0000-00-00 00:00:00.000000'),
(3, '2-5 Years', '2018-12-05 13:19:00.000000', '0000-00-00 00:00:00.000000'),
(4, '5-10 Years', '2018-12-05 13:19:00.000000', '0000-00-00 00:00:00.000000'),
(5, '10+ Years', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `master_expertise`
--

CREATE TABLE `master_expertise` (
  `expertise_id` int(25) NOT NULL,
  `expertise_level` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_expertise`
--

INSERT INTO `master_expertise` (`expertise_id`, `expertise_level`, `created_at`, `modified_at`) VALUES
(1, 'Accounting', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(2, 'Architecture', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(3, 'Automotive', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(4, 'Aviation & Aerospace', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(5, 'Banking', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(6, 'Biotechnology', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(7, 'Civil Engineering', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(8, 'Commercial Real Estate', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(9, 'Consumer Electronics', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(10, 'Cosmetics', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(11, 'Defense & Space', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(12, 'Education', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(13, 'Electrical/Electronic Manufacturing', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(14, 'Entertainment', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(15, 'Fashion', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(16, 'Film', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(17, 'Financial Services', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(18, 'Fitness', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(19, 'Graphic Design', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(20, 'Healthcare', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(21, 'Higher Education', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(22, 'Hospitality', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(23, 'Human Resources', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(24, 'Information Technology and Services', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(25, 'Insurance', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(26, 'Internet', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(27, 'Investment Banking', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(28, 'Legal', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(29, 'Marketing and Advertising', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(30, 'Mechanical or Industrial Engineering', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(31, 'Media', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(32, 'Military', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(33, 'Music', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(34, 'Nanotechnology', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(35, 'Non-Profit', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(36, 'Oil & Energy', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(37, 'Pharmaceuticals', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(38, 'Philanthropy', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(39, 'Public Relations', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(40, 'Real Estate', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(41, 'Transportation', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(42, 'Venture Capital', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(43, 'Renewables', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(44, 'Retail', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(45, 'Software Development', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `master_locations`
--

CREATE TABLE `master_locations` (
  `location_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `location` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_locations`
--

INSERT INTO `master_locations` (`location_id`, `user_id`, `location`, `created_at`, `modified_at`) VALUES
(1, 0, 'Atlanta', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(2, 0, 'Boston', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(3, 0, 'Chicago', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(4, 0, 'Detroit', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(5, 0, 'Indianapolis', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(6, 0, 'Los Angeles', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(7, 0, 'Miami', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(8, 0, 'New York City', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(9, 0, 'Philadelphia', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(10, 0, 'San Diego', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(11, 0, 'San Francisco', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(28, 69, 'delhi', '2018-12-19 10:36:47.000000', '2018-12-19 10:36:47.000000'),
(29, 0, 'Others', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `master_questions`
--

CREATE TABLE `master_questions` (
  `question_id` int(25) NOT NULL,
  `question` text CHARACTER SET utf8 NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_questions`
--

INSERT INTO `master_questions` (`question_id`, `question`, `created_at`, `modified_at`) VALUES
(1, 'If you could have one\r\nsuperpower what would \r\nit be and why?', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(2, 'You are in charge of 20 people, describe how you\r\nwould organize them to \r\nfigure out how many \r\nbicycles were sold in NYC\r\nlast year.', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(3, 'If you could have one\r\nsuperpower what would \r\nit be and why?', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(4, 'If you could have one\r\nsuperpower what would \r\nit be and why?', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `master_skill_level`
--

CREATE TABLE `master_skill_level` (
  `master_skill_level_id` int(25) NOT NULL,
  `master_skill_level` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_skill_level`
--

INSERT INTO `master_skill_level` (`master_skill_level_id`, `master_skill_level`, `created_at`, `modified_at`) VALUES
(1, 'Advanced', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(2, 'Expert', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(3, 'Intermediate', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(4, 'Novice', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `master_study_field`
--

CREATE TABLE `master_study_field` (
  `study_field_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `study_field` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_study_field`
--

INSERT INTO `master_study_field` (`study_field_id`, `user_id`, `study_field`, `created_at`, `modified_at`) VALUES
(1, 0, 'Accounting', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(2, 0, 'Design', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(3, 0, 'Marketing', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(4, 0, 'Telecom', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(5, 0, 'Banking', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(6, 0, 'Finance', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(7, 0, 'Sales', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(8, 0, 'Value Engineering', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(9, 0, 'Others', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(61, 69, 'Web development', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(62, 69, 'software testing', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(255) NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Role` enum('admin','Candidate','Employer') CHARACTER SET utf8 NOT NULL,
  `is_verified` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `verify_token` text NOT NULL,
  `Status` enum('Active','Inactive','Deactive') CHARACTER SET utf8 NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `Email`, `Password`, `Role`, `is_verified`, `is_deleted`, `verify_token`, `Status`, `created_at`, `modified_at`) VALUES
(0, 'admin@admin.com', 'admin@123', 'admin', '0', '0', '', 'Active', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(69, 'adharjswl@yahoo.com', '$2y$10$73VFOrgp7itR918kqfgQIezBJFB9BNlMWofYpvSvKpy3GnK42luD.', 'Candidate', '1', '0', '9140384408', 'Active', '2018-12-19 10:21:52.000000', '2018-12-19 10:21:52.000000'),
(70, 'malename909@gmail.com', '$2y$10$iTsjk8G90dJjgxPTFbtH6ObEGQIfRqiSdy7IsVvfeW0dYL/yuY8eG', 'Candidate', '1', '0', '9140384412', 'Active', '2018-12-20 07:27:09.000000', '2018-12-20 07:27:09.000000'),
(72, 'aadhar@prologictechnologies.in', '$2y$10$Xw4Iow6ybT30rGwfXO3hjuQF2MpiUXO2mY9f/uGxqqYWZDb3bAKHW', 'Employer', '0', '0', '', 'Active', '2018-12-21 11:49:03.000000', '2018-12-21 11:49:03.000000'),
(87, 'ripudaman@prologictechnologies.in', '$2y$10$k1sY7j1bYWXwzNUBNxdfJe5InfvYlTUghlfGDGjRNwXW/wBU0Z9x2', 'Candidate', '1', '0', '9140384427', 'Active', '2018-12-29 07:25:31.000000', '2018-12-29 07:26:41.000000');

-- --------------------------------------------------------

--
-- Table structure for table `video_stats`
--

CREATE TABLE `video_stats` (
  `video_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `employer_id` int(25) NOT NULL,
  `is_share` enum('0','1') CHARACTER SET utf8 NOT NULL,
  `is_save` enum('0','1') CHARACTER SET utf8 NOT NULL,
  `is_view` enum('0','1') CHARACTER SET utf8 NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `modified_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video_stats`
--

INSERT INTO `video_stats` (`video_id`, `user_id`, `employer_id`, `is_share`, `is_save`, `is_view`, `created_at`, `modified_at`) VALUES
(1, 69, 72, '1', '0', '1', '2018-12-25 05:32:35.000000', '2018-12-28 13:27:38.000000'),
(2, 70, 72, '0', '0', '1', '2018-12-25 10:22:24.000000', '2018-12-28 13:19:11.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Candidates`
--
ALTER TABLE `Candidates`
  ADD PRIMARY KEY (`candidate_id`);

--
-- Indexes for table `Candidates_hidden`
--
ALTER TABLE `Candidates_hidden`
  ADD PRIMARY KEY (`Hidden_Id`);

--
-- Indexes for table `candidate_education`
--
ALTER TABLE `candidate_education`
  ADD PRIMARY KEY (`candidate_education_id`);

--
-- Indexes for table `candidate_experience`
--
ALTER TABLE `candidate_experience`
  ADD PRIMARY KEY (`candidate_experience_id`);

--
-- Indexes for table `candidate_expertise`
--
ALTER TABLE `candidate_expertise`
  ADD PRIMARY KEY (`candidate_expertise_id`);

--
-- Indexes for table `candidate_jobs`
--
ALTER TABLE `candidate_jobs`
  ADD PRIMARY KEY (`candidate_job_id`);

--
-- Indexes for table `candidate_location`
--
ALTER TABLE `candidate_location`
  ADD PRIMARY KEY (`candidate_location_id`);

--
-- Indexes for table `Candidate_skills`
--
ALTER TABLE `Candidate_skills`
  ADD PRIMARY KEY (`candidate_skill_id`);

--
-- Indexes for table `Employers`
--
ALTER TABLE `Employers`
  ADD PRIMARY KEY (`employer_id`);

--
-- Indexes for table `master_college`
--
ALTER TABLE `master_college`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `master_degree`
--
ALTER TABLE `master_degree`
  ADD PRIMARY KEY (`degree_id`);

--
-- Indexes for table `master_experience`
--
ALTER TABLE `master_experience`
  ADD PRIMARY KEY (`Experience_Id`);

--
-- Indexes for table `master_expertise`
--
ALTER TABLE `master_expertise`
  ADD PRIMARY KEY (`expertise_id`);

--
-- Indexes for table `master_locations`
--
ALTER TABLE `master_locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `master_questions`
--
ALTER TABLE `master_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `master_skill_level`
--
ALTER TABLE `master_skill_level`
  ADD PRIMARY KEY (`master_skill_level_id`);

--
-- Indexes for table `master_study_field`
--
ALTER TABLE `master_study_field`
  ADD PRIMARY KEY (`study_field_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `video_stats`
--
ALTER TABLE `video_stats`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Candidates`
--
ALTER TABLE `Candidates`
  MODIFY `candidate_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `Candidates_hidden`
--
ALTER TABLE `Candidates_hidden`
  MODIFY `Hidden_Id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_education`
--
ALTER TABLE `candidate_education`
  MODIFY `candidate_education_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `candidate_experience`
--
ALTER TABLE `candidate_experience`
  MODIFY `candidate_experience_id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_expertise`
--
ALTER TABLE `candidate_expertise`
  MODIFY `candidate_expertise_id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_jobs`
--
ALTER TABLE `candidate_jobs`
  MODIFY `candidate_job_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `candidate_location`
--
ALTER TABLE `candidate_location`
  MODIFY `candidate_location_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `Candidate_skills`
--
ALTER TABLE `Candidate_skills`
  MODIFY `candidate_skill_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `Employers`
--
ALTER TABLE `Employers`
  MODIFY `employer_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_college`
--
ALTER TABLE `master_college`
  MODIFY `college_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `master_degree`
--
ALTER TABLE `master_degree`
  MODIFY `degree_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_experience`
--
ALTER TABLE `master_experience`
  MODIFY `Experience_Id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_expertise`
--
ALTER TABLE `master_expertise`
  MODIFY `expertise_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `master_locations`
--
ALTER TABLE `master_locations`
  MODIFY `location_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `master_questions`
--
ALTER TABLE `master_questions`
  MODIFY `question_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_skill_level`
--
ALTER TABLE `master_skill_level`
  MODIFY `master_skill_level_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_study_field`
--
ALTER TABLE `master_study_field`
  MODIFY `study_field_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `video_stats`
--
ALTER TABLE `video_stats`
  MODIFY `video_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

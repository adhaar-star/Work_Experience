-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 07, 2016 at 02:09 PM
-- Server version: 5.6.33
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `helpyaap_HelpYaApp`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `validation_type` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `validation_type`) VALUES
(2, 'records-per-page', '10', 'number');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE IF NOT EXISTS `tbladmin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_image` varchar(250) NOT NULL,
  `contact_num` varchar(11) NOT NULL,
  `address` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `name`, `email`, `password`, `profile_image`, `contact_num`, `address`) VALUES
(2, 'Faza', 'rep.narola@narolainfotech.com', 'e10adc3949ba59abbe56e057f20f883e', 'images_(2)1453356188.jpg', '9632588741', 'Surat');

-- --------------------------------------------------------

--
-- Table structure for table `tbladsimage`
--

CREATE TABLE IF NOT EXISTS `tbladsimage` (
  `adimage_id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `image_name` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladsimage`
--

INSERT INTO `tbladsimage` (`adimage_id`, `ad_id`, `image_name`) VALUES
(1, 1, 'ad1_1.png'),
(2, 1, 'ad2_1.png'),
(3, 1, 'ad3_1.png'),
(4, 1, 'ad4_1.png'),
(5, 1, 'ad5_1.png'),
(6, 1, 'ad6_1.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblbankinfo`
--

CREATE TABLE IF NOT EXISTS `tblbankinfo` (
  `bank_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '0-International, 1-Local',
  `name` varchar(100) NOT NULL,
  `branch` varchar(150) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `code` varchar(10) NOT NULL COMMENT 'Bank code/ IFSC code',
  `swift_code` varchar(50) NOT NULL,
  `beneficiary_account` varchar(50) NOT NULL,
  `beneficiary_name` varchar(50) DEFAULT NULL,
  `beneficiary_nickname` varchar(20) DEFAULT NULL,
  `beneficiary_address` text,
  `beneficiary_phone` varchar(20) DEFAULT NULL,
  `beneficiary_description` text,
  `beneficiary_currency` varchar(50) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbankinfo`
--

INSERT INTO `tblbankinfo` (`bank_id`, `user_id`, `type`, `name`, `branch`, `city`, `country`, `code`, `swift_code`, `beneficiary_account`, `beneficiary_name`, `beneficiary_nickname`, `beneficiary_address`, `beneficiary_phone`, `beneficiary_description`, `beneficiary_currency`, `created_date`) VALUES
(2, 195, 1, 'Al Bilad Bank', '', '', 'Saudi Arabia', '', '', 'gb82west12345698765432', 'Ruchi Rajauria', 'Ruchih', 'Radhey residency', '9876543', 'None', 'Saudi Riyals', '2016-07-26 11:47:41'),
(4, 224, 0, 'SBI', 'Surat, Hazira', '', 'India', 'hjjjg366', '', 'sa0380000000608010167519', 'Ruchi', 'ruchi', 'rahey residency, hazira, surat', '12345678', 'Nothing', 'Euro', '2016-07-27 09:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `tblbanks`
--

CREATE TABLE IF NOT EXISTS `tblbanks` (
  `bank_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `is_active` tinyint(4) NOT NULL COMMENT '0-active 1- deactive'
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbanks`
--

INSERT INTO `tblbanks` (`bank_id`, `country_id`, `name`, `is_active`) VALUES
(1, 1, 'SBI', 0),
(2, 1, 'ICICI', 0),
(5, 1, 'Canara Bank', 0),
(9, 2, 'Test', 0),
(18, 3, 'AL Bank Al Saudi Al Fransi ', 0),
(19, 3, 'AL Inma Bank ', 0),
(20, 3, 'AL Rajhi Bank', 0),
(21, 3, 'Arab National Bank ', 0),
(22, 3, 'Bank Al Jazira ', 0),
(23, 3, 'Bank Muscat Riyadh', 0),
(24, 3, 'BNP Paribas ', 0),
(25, 3, 'Deutsche Bank AG Riyadh Branch', 0),
(26, 3, 'Emirates NBD Bank PJSC', 0),
(27, 3, 'Gulf International Bank ', 0),
(28, 3, 'I And C Bank Of China Riyadh Branch', 0),
(29, 3, 'National Bank Of Bahrain Riyadh', 0),
(30, 3, 'National Bank Of Kuwait SA JED', 0),
(31, 3, 'National Bank Of Pakistan_RIYADH_SA', 0),
(32, 3, 'National Commercial Bank ', 0),
(33, 3, 'Riyad Bank ', 0),
(34, 3, 'Samba Financial Group - S.A', 0),
(35, 3, 'Saudi Hollandi Bank', 0),
(36, 3, 'Saudi Investment Bank - S.A', 0),
(37, 3, 'State Bank Of India Jeddah', 0),
(38, 3, 'T C Ziraat Bankasi TCZB', 0),
(39, 3, 'The Saudi British Bank - S.A', 0),
(40, 3, 'Al Bilad Bank', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblbranches`
--

CREATE TABLE IF NOT EXISTS `tblbranches` (
  `branch_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbranches`
--

INSERT INTO `tblbranches` (`branch_id`, `bank_id`, `name`, `is_active`) VALUES
(1, 1, 'Surat, Hazira', 0),
(2, 1, 'Surat, Pal', 0),
(3, 2, 'Surat, Adajan', 0),
(4, 9, 'Surat, Rander', 0),
(5, 9, 'Pal', 0),
(11, 9, 'Nbmm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcomplaints`
--

CREATE TABLE IF NOT EXISTS `tblcomplaints` (
  `complaints_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text,
  `action` text,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcomplaints`
--

INSERT INTO `tblcomplaints` (`complaints_id`, `user_id`, `description`, `action`, `created_date`) VALUES
(1, 195, 'bmV3IG5ldw==', 'TmV3IG9uZQ==', '2016-08-08 05:22:42'),
(2, 211, 'SGVsbG8gdGVzdGluZw==', 'dGVzdGluZyBUZXN0aW5n', '2016-08-08 06:05:18'),
(3, 196, 'bm8gY29tcGxhaW50cw==', 'bm8gYWN0aW9ucw==', '2016-08-08 06:07:13'),
(4, 106, 'VGVzdDFiZiBmLiBGIGYgZg==', 'RGpkamRiZiBmbmYgZiBmIGcgZyB5IGcgZyBnIGcgaCBoIGggZyBnIGcg', '2016-08-10 11:55:30'),
(5, 137, 'TWU=', 'SGk=', '2016-08-25 07:46:55'),
(6, 195, 'bmV3IG5ldw==', 'TmV3IG9uZSBuZXcgbmV3', '2016-08-31 08:34:27'),
(7, 224, 'VGVzdGluZw==', 'VGVzdGluZw==', '2016-08-31 08:40:12'),
(8, 224, 'VGVzdGluZzE=', 'VGVzdGluZzE=', '2016-08-31 08:40:28'),
(9, 106, 'SSBoYXZlIGEgcHJvYmxlbQ==', 'UGxlYXNlIGZpeCBpdA==', '2016-08-31 13:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `tblcountry`
--

CREATE TABLE IF NOT EXISTS `tblcountry` (
  `country_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `currency_code` varchar(50) NOT NULL,
  `is_active` tinyint(4) NOT NULL COMMENT '0-active 1- deactive'
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcountry`
--

INSERT INTO `tblcountry` (`country_id`, `name`, `currency_code`, `is_active`) VALUES
(1, 'India', 'INR', 0),
(2, 'USA', 'USD', 0),
(3, 'Saudi Arabia', 'SAR', 0),
(4, 'UK', '', 0),
(5, 'Canada', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomads`
--

CREATE TABLE IF NOT EXISTS `tblcustomads` (
  `ad_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `size` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL COMMENT '0= active, 1 = inactive',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcustomads`
--

INSERT INTO `tblcustomads` (`ad_id`, `url`, `size`, `image`, `is_active`, `created_date`) VALUES
(1, '#', '960x510', 'ad1_1.png', 0, '2016-08-10 06:20:15'),
(2, '#', '', 'images1471666169.jpg', 0, '2016-08-20 04:09:29'),
(4, 'http://www.facebook.com', '', 'images1471667708.png', 0, '2016-08-20 04:35:08'),
(6, 'http://www.yahoo.com', '', 'add_review1471667740.png', 1, '2016-08-20 04:35:40'),
(15, 'http://www.yahoo.com', '', 'howit_baner1471668583.jpg', 0, '2016-08-20 04:49:43'),
(8, 'http://www.twitter.com', '', 'man1471667768.jpg', 0, '2016-08-20 04:36:08'),
(14, 'http://www.google.com', '', 'baner_about1471668550.jpg', 0, '2016-08-20 04:49:10'),
(12, 'http://www.linkedin.com', '', 'candle1471668034.jpg', 0, '2016-08-20 04:40:34'),
(13, ' bhnhgnhg', '', 'flower1471668075.jpg', 0, '2016-08-20 04:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbldevicetoken`
--

CREATE TABLE IF NOT EXISTS `tbldevicetoken` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `device_type` varchar(15) NOT NULL DEFAULT 'ios',
  `device_token` text
) ENGINE=InnoDB AUTO_INCREMENT=1375 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldevicetoken`
--

INSERT INTO `tbldevicetoken` (`id`, `user_id`, `device_type`, `device_token`) VALUES
(299, 108, 'iOS', '4ea7762c6845b3671d37477a22e35943fbd67bc7ff175510b8ede6526ade0bbd'),
(346, 122, 'iOS', '19aff9eed3348c482e493327218ecae9519bebbd58282ab8481b5db07b4f1f7f'),
(348, 123, 'iOS', '56e41cf78d669deb8b3ca7a60ba4db5a5183611034fa1354e5e428ca9fe30212'),
(357, 130, 'iOS', '03fb5108ca1d35a9257b346a969eb96924381b0a77ab5cfa46a0a15c90c588b9'),
(359, 131, 'iOS', 'a6e8d6a124dffda6939dfe34d306478f682f96408268b8a3dd4fadb822877ee2'),
(361, 19, 'iOS', 'ee0deec5d9134dd5911c482fe980ff1a15522f4a937d9a051e322c264745316b'),
(391, 122, 'iOS', 'a4d2559a8f59c8f29c18729c2306d7d11b706547a01dbfef98dfd8d36027b3a9'),
(422, 152, 'iOS', '86ce491c4051747c968633f1c622014aa2e94edd4445dfb210f43687b5cbb644'),
(479, 18, 'iOS', '37dba80ed3dc948732a41185df3dedaa533a395f5ad2ce3af992126a6b3a3567'),
(535, 168, 'iOS', '59f6ac45fdf70d6d8e66d5be395c6e5af64c3ff9abea830df155c61f40fbba73'),
(586, 148, 'Android', 'fFGDaVP8G0E:APA91bF2tpzyL8lYthBnu2FtU7A53FBl6sefypmyf84CoPxfoUZK3eQIiQSHS-p_S07xplvL2paJ79HapW0MhC4b49QMNFj7m8MZlCwyTY0Q18vSsS3cYTu0gpnoRoxSV51z_dAGZljf'),
(593, 148, 'Android', 'd1aUipPADVA:APA91bE3GKRc7PYnCCwOywY-MHmbCwvlWLrauaJA719GHtmikAYoem5w2wMNew7oKlXGVwK2LckYSK39SQ42q_ENQDIR8lSM8zKPfc0fdNKFmdZGoPK9UtVosQNd6U6Jbj_fCPPtFKPV'),
(597, 105, 'Android', 'c4Q00EwGS8s:APA91bH1kLlxzXNhMiTKZB7o8xLrnRoV_z9J10BJ9nGy7RHaikHj5odccQsPUui0Tkqj8LgVnYZsX_7VY_BSUtwkBdM8lslJFos1O8D6ufjR4FUg6TN8JjMH3jScvCiN2xpUUiMYcWIm'),
(600, 105, 'Android', 'dPDp2nF_0Dc:APA91bFWhFz1KMfIejLivaXiKr81S6H-sJPNcTQWyg-GsCZqAtxl7KSmkk-1qscz_-UpNLLLeuRTxeJ6UHZpLMUPhP4gBShTd4XM6nxKwOt4V37yF8p9PYiQvdctlhuJRKQkaZlahbb-'),
(604, 105, 'Android', 'ck_ocaRT-rc:APA91bGkJ-hC-r6M_QIf9JPPX60A-kuLXl4Q_3RZK7gx8_s-2ex-MZkcJMHRCHPE4ztXJKpmU7sN8AEpsAe431Dzj46k0zIzEob5CD7-McZ2Ov1hh_sDIfrHM57jG9BGbekEtdgNYImN'),
(610, 18, 'iOS', 'bc454a3c50b6d740a03a155fc829471f1e16e63b12bc5c1273b5c715ccbf3299'),
(616, 148, 'Android', 'fH3kph8v1mc:APA91bEueXVfMsFQ5oqefMqLX-sBDT5q2W65ag1AsFqBp0WAejVt8v3Sd3XqEe41zLY07AkqJGz1BfrLOie5b102oD5G-TLyxi0WJrRuJtynI4eee8TCZJywS1B4-hi0k1DfT65yOzoC'),
(652, 181, 'Android', 'eX97VReT7Vc:APA91bF3BqOv-3oZjVCqa5jtzQM3yG1DZ5He38hvfKKEa-12c3ymT7CmJJXeFliqKhf8CJkHVPSz-pM6ysnWE7Q8OMgYsof0SBQ-47_rs9BDQ15zfFkU482g8KAB78PQgSGXqyvFXU_1'),
(653, 181, 'Android', 'cBuJtHTqMoE:APA91bHavNzL3IrS4NZc1YcnSIWn00T-ha3dNq0e12UFikb2se2f9tEwIHUd5Lv2K6dqgL-lrUf7_7jCNJAW_O_P283dlVGEOespT8JoH-0cPsCUDT5iiMxIEI6jEkCWShXX2EMw2tp2'),
(676, 105, 'Android', 'c__glNHgDP8:APA91bGOC7-Bh2YUYMccfJLL3KcqTkohzBklSsh-apUPkpWYIWzRB8SOoscPEXh8k2ZfFzmVNTz6xAbn0PTv7N2qjdyjfXq0mlgy0NBdw37I9vWyq0wn1G3YnpX-l-xyI0cLDz2NECK_'),
(677, 122, 'iOS', '714644d4716605e7ef364c5a69220f5a5b8dd2135435a7c95a6deba2f76e95c2'),
(688, 105, 'Android', 'cEhShVQ0GZo:APA91bEl_wQHEr_wGt3PZbnJgjKZ6TuIUePJ6ZiRznmiCJyhogL2u7wQoI4AK-vzf1wNCZSyD4xAJpklHuZ_6Hl49QsJKuWBcBw4hxTfArV-y-3cgLiExVWqAFmIyub2w2jx72hTZgRb'),
(691, 105, 'Android', 'eR0jv1V4oqs:APA91bHkjxDqg2cl5nw6YY8-cIw-0gyZELhUvkqNfBNA4NSN00exACQt56B1ARDcTBRYQOUFBJjz4OEYGFbBaI3p1dsveWkcKvjn8ZbJoZn1Yw74i9XPARE1sp-ceFhw-d5b5PtD9t4t'),
(693, 105, 'Android', 'eIBH_VA-a_0:APA91bHYpJct3-8hYlzuiQDwAxT1wreVmqkHLdJrtoVVveOp5KIfq1Z_7wDaw8t1xrUNEiVkz5aJMTnnaJr5gIBinfISfn_sn3lXfW4BTq6llO57xrYejYzjd-pue6BJGzzScCmN7z_s'),
(694, 105, 'Android', 'fyHouS_51bw:APA91bFtsF8LptfIuLxUXjqWHHgILxXa-IXfwPXtQb8MrtsmmLBtLutWJKPBVKNzYRq-6nnNGafNuiGSFlmDNw0IfboZlxOELSixaORmn8bZ03-Z9RQ2gW4itkv1oDu6KfI2uhGstqRj'),
(699, 137, 'iOS', '42ac9a2c6f818c4d2e5047046813563c3b8e0d86381b944027ca48f5f1dc52fb'),
(701, 105, 'Android', 'd8uSzMsKGaA:APA91bE-59qpw5UCApcc8pv60AZj06Ac_lt92cLdwLnGdPrPo2GkbIZKVaSAwXYWlYMO0mYK-rCz2zpQPDTBW7r2Mm1WBQQwq6o31hOatltwajgvz6D-5IniEGuCKpQuHfmyQSC8WSIt'),
(702, 105, 'Android', 'epPgDpsuUec:APA91bEncCcFvvMLLL3FVxyAmu8Ptjt2M8ItvWmHlnfBvyY8nrYIOt6xkoGR6ru9qsnzkUxJAIqJdvQc00zJ9jRs1eE1VtaPGYmYDl8RpixIsCNl6BwbjXfjKpfv2PbewuS55b04t0ww'),
(703, 105, 'Android', 'euOFuq16PW0:APA91bFYvSEutM5bAYcwJ1tYr3WsxVlXkd2ktaAaa618TMck6UqzBRKFe5tVMULNXGZ79Q0ciNueEC4IHtYNkgifqMoEH6Zm6ks7_HqjyFkcvURkGEEXMzBT5Pd-Aah8_lKe9Cr47JMg'),
(705, 105, 'Android', 'engs8K7Fi-Y:APA91bFIKfaqN_OtY_KIBMhKzjp-CFlH0F8SLgyIdzhRLNYXJ2S3Avr-SOa-8phk8MYA0KGwIARLSBnR61_q3fenKFKe-34ncdMO9idpcb3xrbKC9rUrqodk7pZOjh2rKJw8myLopByj'),
(706, 122, 'iOS', 'f84aff8640bbbefc9d14365ea6f57ee42791286b71997527b3e473c00ae8fd41'),
(715, 105, 'Android', 'cD9VMWSdsgw:APA91bFNywQxN9LKZBbdLdYfs-hpPTfZvMVRHvr_P6gof9TcC6whg9eAEciiXt8_KKWMGZchV8c0cl56gsBewGxjR9uMwBBmuR3ehop9EqiHJkRHT7LZLgIWVyH3OjfxHXeirO59Q7Wz'),
(733, 196, 'iOS', '90cd44fdf84fc4b8e65e9012a542d68431ba1b1448d1b18df35a7e3a2566c987'),
(736, 148, 'Android', 'clQ7Ongr9V8:APA91bGWmepao1tVw2uXx1mlllPvUPsH3oUiNrLuovyc8_qYSTUeW1k9PuD6p3vw31GtwBfnvtbi-XBDFGsEER1ELj8T4ToBFrbHHBvc_YvU7N9OHEhIiP4_NzHJz0Xz83avV7XCZ33g'),
(740, 191, 'Android', 'dLPijAo2Rig:APA91bGOrdcZNy0u-EMR4NDV1bYbMXpvk9UYzWwAgpnwWq3qfRiz2Z4waCteu9sPPwTj6XTZdTZRe4nkQQ6_G-hRNtYcvCd_iFbHUtg8tFEUpze9P5XLmeck5KVzeKrSF6FWXC8kNG1E'),
(742, 196, 'iOS', 'd1ae30b453e0e7959de4959209d7f6944d802b9809067a6933ab8e523573b65a'),
(743, 196, 'iOS', '91614a90e34038b03ec4822a660ce302ad8a9113932471e0f50891dee3a25165'),
(744, 191, 'Android', 'fr7AOnfonx0:APA91bF1-RDMmSvR6YtBdKds1-EVA2LJMw0JjIfSgv0iWJn9sfoSyWsN9-nX85mC49PBQvG5025J7kSn6huC4VSoy25tCpR3mhI2XBT_mqHFk7Ce_I1r2Fy-Iv51hs4669y-Shh8HUHv'),
(756, 197, 'Android', 'eSGV9qLSuso:APA91bFVNeeVV8odwMCwDsPki5urKkyTgje1wg0_dgnzNLN8Rg4_IL4BFxb6tWO-2tgiyvQKOuNieDgqx5NIqnCN7bYXjsJOyzwbXe9U8F8QHwkSNuvkoszvasWVUe1RJOhqWmbJsnuG'),
(761, 105, 'Android', 'd8V2TWbGJgY:APA91bHSM8l5R2P8F0ynoNTdgbgCyqgtMza5MLaQk6WE7BfJMARtXy7tNvGl5Sn2E-OYFaSeO5lh3uQvb25D9O4fJJw1q10OGiWIwrySQVRIADVwJNGKr97Sg4fUCcW14xb_SCVGctqd'),
(768, 195, 'iOS', '452d9c168e8da88a88eb32bc970f7fb7c4b0348b9f64b78f55cde744912aba01'),
(773, 196, 'iOS', 'ac78cfb2205ed46636abffd57aedc42b71daa65dec3d0731403b38bb1cd4ce70'),
(778, 195, 'Android', 'erSgfY4NZOw:APA91bHycJXPXnysXiSvnfuDFVZJ0km69t5JewR434Mem8Q3IHvR4vl6e9adycXTcgyIj01VsvVWckg8f2jWe0QDj2JGaSPbmK-8-qN79tfJtHsq5YpZ-Kra7HjX8JD0HKXs51Iac3yG'),
(779, 191, 'Android', 'dLlKn7JtXd4:APA91bEjsT0sdIl_eRc90B4DyYCt70lYKw-hbmJqj8UJYUpT-B35sDx1YOlrnEA0yUX_eq7xZoLOM6u_pWcsJ_71kpdkEQi_J1vs-Z_nBppahxlnwiJFRQf8HiDpdQsRuKlstTgJJqRD'),
(783, 105, 'Android', 'c7Cz6q1DZ2o:APA91bH-XFF9TxoSCDd__IBn7IgOA3-_bX8XEKucLX6gBhan699ByQJ3m6ZTA-56AzfmED0OvtI4fiaSWGt42bXzkeitV6_4-tOaVs1rCaH6pvByExkAI7U4tJF_nVGRpM9N2wG49ZTi'),
(784, 104, 'iOS', 'fa6b394ae2323f6277da3faf5dbd05910996ffc661e7e3e99ac35ade2a7f8ffe'),
(785, 196, 'iOS', 'cf987e0a9f21e1da23c0157317bdaba2db4fe13235fb513795febef122ffd3b9'),
(788, 196, 'iOS', 'cb402b138790719aa458240da6d71670ef9fce22d07cac940b2f5ed96097c31b'),
(789, 196, 'iOS', '804eac244deac213e0e7055493bac76012bd78ca33116238ff8abee6a2f622a2'),
(790, 196, 'iOS', 'b68999404657fd2c3439312a19c39763c3a87a7b03b84a663929e1cd4c8fc425'),
(797, 195, 'iOS', 'cc21ad4bf5f00ab230be3495e1d8a9fda4d1e7a448e38173a36b7f9eb7a0e9ae'),
(813, 105, 'Android', 'fT5DSHeHbxM:APA91bFchWWWK6v0z8Zjw4HGFdSxwkW1WYWe-ydPWI6C8kp_FNDxM7RZin8BU68SvZ64KUIxR0zLVbO0m9_nGhabvNWlPzbNX2KXAuQWtc8AAD9lGhIbe64aFhJti456ZNgeoQWZ07cc'),
(818, 195, 'iOS', '271f6e5b61f2821ae7d9b177d1ac13b516cbb0d9ce47a5913ffbc0d00f040896'),
(831, 196, 'Android', 'eiW7T2JqWqI:APA91bHix8MQyU0IYJAwRvxnXQ2cHze_t1-iyg1bVSuMFbQ6oxwKAHZmLByjIM6R-clLMBiofAjtQB4Sl7BmjkWfQ2EwlvjQx4HRVtOMMAhs7EsqYtGKKm_-6_uNd-Yx7YGknJViXoH3'),
(835, 105, 'Android', 'cg1Qm5i_xDk:APA91bF99j6XtETrq1_y0YJ8ymT5ssCqs4M1Ag6lGXiQo9J0z4GC_HJqaUG9uVteEIk29lgDrC3cta389AEH4NMyIUDX9OZk30mLsfZh7HQMAeNqnb-GfoTMvJqA-xxi8fchRN_ymEHY'),
(862, 105, 'Android', 'f_HGo1Sq7J4:APA91bHYCgML1wSDdzte9OYe-sYcc3vDZLxMA40DK3WrYwzUfczZNPica9znv-qMX9MylGWvvqSo5azG6CYzeKMGUivDTLP7lwhVSM58fPDjpvI44ZgMNeopTIRQ8oH6m468q8KrRJgI'),
(864, 195, 'iOS', 'b50c6d9d094ce7e1d8613f6a82dd8c430db9bd5df489542593e84c18749b407c'),
(904, 191, 'Android', 'ew_u7GGcsFQ:APA91bHK_0ZtH8PBqB6D3yXtROu3ijPhRUO_Kxit7FgQs_DUEagraH7VoS6DWIUiZbuREBM1InHpCOa77hR0IOZzDOGU--jEYwK1to8Ct80Q12S6JBt-mCNM68hRmDTn2XnjC_QSvA0C'),
(923, 195, 'iOS', 'fb5e1f227dd83ab47fb8b843b8ca15ec604f67102f9fcffc92de5dea700ec1da'),
(924, 191, 'Android', 'fdIbiEWCx4s:APA91bF-ZQytF8aUVulk9NFGCHYb48vgjejzzRBdd-4tzM-HUc8pZAsqbklM7TGId7lQa0KGj-FoL-4_tMAZxuboqlLx5-bo2901vqWNjFUrx5qirvARyC_hCFhwAc_XfbjsjoYVQHQb'),
(955, 195, 'iOS', '6f87324246b6cedde2a3a99a4593e2424da7574ec34e9063de9cff7fd4e55f8f'),
(956, 195, 'iOS', '5d19b83b7b9db4b032b7c89bddea060eeb99b2417393b92b89168ea0a5f7d9b6'),
(957, 195, 'iOS', 'f2f4983ee79f06c0d7792957d4c1966ab0be6a85ea78d78d3d0563ae21ca47bb'),
(974, 195, 'Android', 'euaJvP9s3Yc:APA91bEgFap37ZLHHBwFwztop1X1y4qFBbcK6MgojFrZssXVH62Bde6YPuvh0hMf0MUOy2vicfrn3So6jo6A4UURy5A76lH5qqxLxmP5gbjdH9on0GAgLWnSk0mffD-jqFF2hMKQ67VB'),
(975, 191, 'Android', 'fl5LZMfTdKM:APA91bEegBygzjSjz3sSSk5qqAlgGLQQ1stydWaGpDbhlcJUZT95B8-EWYau52A_QrNCRtOBiuONOTQ1kkVFP3LSktfJr8NHBbFqtraWWuF2erJYC1So9tos7M3GknOnVUj3hYaa8Med'),
(991, 163, 'Android', 'c1EPnDULnWI:APA91bGl_zEkBA8PFAEtnuL31eWb_PBaKYCRT9qYWzhWx3a3UKa1x1pNc_yVqUaXy-37clTYRNqpYRFWEUol3JkMIeH02NLy5tlDoJT-ItXuA-1XDRhBU7T1S_PpbLgE6mKqVYN0Ddk1'),
(993, 204, 'Android', '15985236'),
(995, 205, 'Android', '12325879'),
(1012, 191, 'Android', 'cX04RlBK2P4:APA91bHkYcF-c1IrpQpS2E8HAwh1pfA2ibLLBJt_g00EObh8VxxlQY3x3FStjNLR5b9u5qHdx12nERBcSdUIySySK4fFcFg8zSgjko3HjzcC376dz3E9RKNjkjkb1EhPNg2bGEWfe5GC'),
(1025, 191, 'Android', 'ePI0NEYgWdA:APA91bFfHYl4Fhj2jDVwpmVMH3jheJHuK5sthyPqmaLykC3aARZAjf5Rgw_qnC-H_n8oh13idZj_ZF98KrRSqA5uygSzZ72DTv-gN3TA6itEOxBR_pdtSZChti97Mx0xhDI2CvQM4QxX'),
(1026, 191, 'Android', 'cZmetl3yqOo:APA91bE6spizpFdhk3cZL62lF8PZ1WKJgH9xRqYbhenfpvea-herZ3fUToVOxv1OyqBvtSZy-2SOcYyp5fAwe5ifOv_wTCNJRq6jWPIDVzEB1EphcRAOJaWkq_ADR5y5GCmC0hgMs2OT'),
(1032, 191, 'Android', 'e4RuL32b9_4:APA91bH54AeIPkF1qJV7uoz7ALQZAkXQF8OuGqyTPWQqg7if3iXXADUNBCrNBh4X1-icRRKHbB2S1uAVRk5wpGiKLphnwMBRPTDj5DBly8pDXlHFkPQ7RQ_yqc-cYFa9xsU8O_mXavAo'),
(1037, 105, 'Android', 'd0wY6YqgG8o:APA91bHdv9ckfOYII1MEz4KJ8tXT-l3mIXyuNNS_-w73P8a3OH1bI5220Vw1jhd6fooi4qCjwmZWG59jJycHd9duNiQapEFSbRmzgu3HSp83lj_AmoXAfTG-L4pz8smLyNUthilKi48a'),
(1039, 105, 'Android', 'eMuT1wSkoEc:APA91bEG_ba-4AXFaT9cOKpQJUXy-R0SQYbW7q0vs2zdjY54Mwu_Fz0L0oyGe1mW1n2Kwz-TNp7IOMiquiNAI1leHsEYck2bfUKks8t1r0lPUYENASONznZtIrhtxk1oj4wx_kHsRAWl'),
(1041, 191, 'Android', 'dFlkNeEMPiI:APA91bF3z9Cqnh-Sh54fOOWGhdBkLhtnTXv9e3YUoX5XWvihDryCGDy9BDdnRurpQTxCpoduuBRfJd7RaqJpEQSPo_BhXn95lhmdxj0HN81BIsxjMrkaTbScwpuInwC1DvSY6xcbLi-S'),
(1050, 190, 'iOS', '123456789454'),
(1079, 191, 'Android', 'frdKXcBPdHQ:APA91bHTKq2uUU0m-C-a-HShhDTD-5pevLYM9Pl82evWWz5nsaI9T4Nm5ZCzxUVJxBdXbq6XVfwuDnpGzgEBViA23FHcf8MZhFjOej1LgQaT_byNbLmI6UhguBZ3IctEgOtVy-cQcRwy'),
(1109, 191, 'Android', 'fyD9rfOeEFM:APA91bE9fGeokcKZyGDxmsoyzGd8T8rOcb9cm2bmMXDLo2WJYaPwmaLv3IKl4trQzuqFI0SoZ4YB6y1rsqQVuNJUtNUcwZNBcxKuG8-NNaXLlNYSxSc4JWonEz5MgSi0R8Hhj46hvTdS'),
(1111, 191, 'Android', 'dNxvT6Lo8cU:APA91bGWczdm_GS8UkMq94kkPpcYFSA8FoiCVEOZGq1UHXQ1RFp_XCk_FSPtZYaOGhVJzTqpMr4CClgxdHyjS_4Lt-uMdrk8NCHCmPuQ1a4-cqOSUwflyODkfdYfG7eFa9oC_7NBlKE8'),
(1113, 105, 'Android', 'eceaZJs2w60:APA91bGU-H30donE4VPp07F4QnoLdc8fJyWF3wl3cVFCBm5N3DZFqxevu-fpUtNyUn5NoghlBXmu0TH9l5ElDfW-puPnqprPD1XZwrHyOtbEjRQx0bYfa7WhxXEjqIj9SZ6KLPv98P6M'),
(1115, 105, 'Android', 'fhNoL6SceBA:APA91bEyptPFch8mrqxE5oaNGglJdykPirwzqpNsuVdi0Tc6CyOZbwwEdlFRbX3WEA1yMKyMXnomVQi7F8SA0dB-4LbWQEH6RCkZebHJz_uEMn5oscC97uVc_1uMIl8Q1mns0J_dDjHV'),
(1117, 191, 'Android', 'd7GGDnGOYzI:APA91bGDFfrDTTLzzRDZLMtgfVGXWiIigV9ODgRwBfkfRjOkQDfcSX6mt9e2ZrJaYMLjw_un6U-kww8ebDYTNUPz4inbWDiaT-yBhXglGPMXYypBGqxqsAGGAh0t3EBlKeWKtTa_A-nk'),
(1130, 191, 'Android', 'cAczTxkEZsI:APA91bF77gSzY0ajMi5GKMB7Bxe2jrw4xjDIHsYzN2pXcIPj0cO1_rayux4-wEFQOOzbRC9hYOd5YwVvYkcscgtUm-SMFrvQWN9p-OSfxLhMlOPvEdcdh1HuAZ63Xj4TSQvszXUHmWJW'),
(1139, 195, 'iOS', '7b3eb09141ecaa027cd531b1be9a6c43c2be6fa346170f9f963281d9902df3e2'),
(1145, 191, 'Android', 'eyTVyl9hJLA:APA91bEh-WdQshvfq7W2Hxh5tQMJvbZ6Aef1hEp4y2gokfl6GGKsKQT0lGNd3uqOCPdFuIZGH-V0SXVPCAngYKyA8YbbxJcWzKKENhuGtLXY2wGj-MD60yJEv2IOIShDfW9VvmggAzCq'),
(1146, 105, 'Android', 'c1ohNdohnSY:APA91bF450o84q3jII_7O2WFkJW6RlEguwNUK9kdMEHG3smpqNkFAlcCO0BktVyVozphPwzUCzEw5aC0JtArIGbgOObuDZR3Z9pp3sGQ28Y9o9Y_uFMkNCB7alsz5qi6d-nA9S50uXTp'),
(1147, 148, 'Android', 'dwuNJlTTCdw:APA91bHr_jV4tmgEWVozgwqLXPLytnTY_t4n9qSebnxj5cg687O61WqQzPycWROROKsy8MlhcecwWaYEi40mxND1JlOw1R38TSI_dh7z0ACi22vOHZPJq3ws7Uuoag-fP6WrmY1vO7iC'),
(1148, 148, 'Android', 'dmc7ToT6bsM:APA91bE7vxDu1eaClZQnN_y-DPqRKk1FkBPqqCZzH2mu9cG5sovmJizoawThP8exr7bAcLP-SA5D9_QhUp3eywHxTL-GwD96nc7YINuamW_hGvJ03SktgdF-cRzZU1Wl2ILrdgviVtwt'),
(1155, 198, 'iOS', '1b9a2d11b41fed9cde22d3590ffafd02fccfd1d94de3383fe3dc54ef5ebe2a2a'),
(1156, 220, 'iOS', 'a9ff9cd8487004da47df14c69e47e6ca0cf0e6e40615bc04a6832ac932a8a99a'),
(1170, 196, 'iOS', '551f9c36eeb13b3286a14c63ba5c4907c61b48fe6e924e2b352ddcf89ba51b7f'),
(1175, 223, 'iOS', 'c17bc3853bb4e9986bf671d9408bbea753991db7418603c2a1a82e3dfb2d0368'),
(1179, 195, 'iOS', 'd24af15a11e9487b55b78b413dc92f3d7ee5a49365c253ed83592f541fe5a894'),
(1208, 195, 'iOS', 'd5d0731c588fa683c942825b8ef44ed61d7abf1b240f2b1fe9e3c33c38fb1d1b'),
(1209, 195, 'iOS', '8c16059c8c3a68bb22ee5102e2cc6021337ffa0e3048330e835267aeff2b605a'),
(1210, 195, 'iOS', '87c615b62ea19d8b66eac887b7f1df97cde7365efc2cb086041ebd6c781f23cc'),
(1211, 195, 'iOS', '8409752f1087a30b6f10e95ca525d0e1c20077055aa3b03c594b388f9aa54acf'),
(1212, 195, 'iOS', 'c80ad5e5a04fdbaba88e87334a07d06a70cb607075fe02fb1b835f489379bacc'),
(1242, 195, 'iOS', 'c90c429ccae088d6096704862cd6adcec06dc4e2fc0e3e62504cf596be40a169'),
(1247, 137, 'iOS', 'eb3cb4302902664cb41458e16e40c287f3a4516085d4b771a4e8e268a0ea0e13'),
(1252, 195, 'iOS', '6abcb32bdd12ce4a9044820b93ce57041bb2ee3c9b87f04b7139e29be7e99162'),
(1258, 106, 'iOS', '39b32bcfc37de205549b77a0e636c8b0c280cecd4bace8f71372d785f52eab87'),
(1275, 195, 'iOS', '31d9ada1b5a3da01e6a35587ae8457a5f90b240160e7f667667cd77b994c4237'),
(1302, 195, 'iOS', '7ff101c3e1940b1aab443034b35d9063e9ecea7e01c3542230cf0fa65cd9ecf8'),
(1333, 195, 'iOS', 'a82add46a84dce25564d66f1273ad218cd20e718f5fbeadcae7254ed3b068c28'),
(1347, 195, 'iOS', '54cb0aaffd9c7d192f748d3d2bbfe94ad3d44c302ea7bc2e4b73c0bc833908d0'),
(1355, 195, 'iOS', '0ca840f8b0f4fe761792744ce53f89c49816224ec33120354893bb2c30551895'),
(1366, 227, 'iOS', '54e5b27375c32e408a3987d470fe790883e5bbeaf8a3431862b1bc867a1423c0'),
(1368, 106, 'iOS', '5388ac49afb0f054a05c0c441192cb1554fd068480d56f9f751b187390a7f713'),
(1370, 106, 'iOS', '4df1658898149d453d8d3c7f588a7737b14d183867afee970f4944fb8838d2d6'),
(1371, 137, 'iOS', 'a96f16678f5207ae66de045e755696997dca712b33bd2374ae3c3264fe8429c9'),
(1374, 230, 'iOS', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbljobs`
--

CREATE TABLE IF NOT EXISTS `tbljobs` (
  `job_id` int(11) unsigned NOT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `employer_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `num_of_days` varchar(20) NOT NULL DEFAULT '0',
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `skill_id` int(11) DEFAULT NULL,
  `days_option` varchar(20) NOT NULL DEFAULT '1,2,3,4,5,6,7',
  `paid` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'The value chnages to 1 when the payment is released by the Admin so this has to be managed by CMS',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `rejected` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbljobs`
--

INSERT INTO `tbljobs` (`job_id`, `freelancer_id`, `employer_id`, `start_date`, `end_date`, `num_of_days`, `start_time`, `end_time`, `skill_id`, `days_option`, `paid`, `completed`, `accepted`, `rejected`) VALUES
(2, 1, 2, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(3, 105, 104, '2016-02-16', '2016-02-29', '10', '01:00:00', '02:00:00', 9, '1,2,3', 0, 1, 1, 1),
(4, 196, 122, '2016-02-16', '2016-02-29', '14', '01:00:00', '02:00:00', 34, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(5, 105, 148, '2016-02-15', '2016-03-15', '', '17:36:00', '19:36:00', 13, '2,3,4,5,6', 0, 1, 1, 0),
(6, 105, 148, '2016-03-15', '2016-04-15', '', '02:00:00', '03:00:00', 12, '4', 0, 1, 1, 0),
(7, 1, 2, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(8, 105, 148, '2016-02-15', '2016-02-23', '', '03:00:00', '04:00:00', 10, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(9, 105, 148, '2016-02-15', '2016-03-15', '', '04:00:00', '05:00:00', 10, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(10, 196, 104, '2016-02-17', '2016-02-29', '9', '01:00:00', '02:00:00', 10, '1,2,3,4,5', 0, 0, 0, 1),
(11, 170, 106, '2016-02-17', '2016-02-18', '2', '08:16:00', '10:16:00', 0, '1,2,3,4,5', 0, 0, 0, 1),
(12, 105, 166, '2016-02-16', '2016-03-17', '', '06:00:00', '07:00:00', 12, '2,4', 0, 1, 1, 0),
(13, 105, 160, '2016-02-16', '2016-03-16', '', '08:00:00', '09:00:00', 19, '3,5,7', 0, 1, 1, 0),
(14, 105, 191, '2016-05-01', '2016-05-16', '7', '10:00:00', '11:00:00', 10, '1,2,3', 0, 1, 1, 0),
(15, 105, 104, '2016-02-29', '2016-03-06', '7', '14:38:00', '15:38:00', 19, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(16, 105, 104, '2016-02-29', '2016-03-06', '7', '14:38:00', '15:38:00', 19, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(17, 105, 104, '2016-02-17', '2016-03-06', '19', '15:11:00', '16:11:00', 30, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(18, 196, 104, '2016-03-18', '2016-04-03', '17', '01:00:00', '02:00:00', 34, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(19, 180, 105, '2016-02-16', '2016-03-16', '8', '18:32:00', '19:32:00', 11, '2,4', 0, 1, 1, 0),
(20, 160, 105, '2016-02-17', '2016-03-17', '30', '11:30:00', '12:30:00', 9, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(21, 180, 104, '2016-05-01', '2016-05-31', '17', '12:00:00', '14:00:00', 85, '4,5,6,7', 0, 1, 1, 0),
(22, 195, 105, '2016-02-24', '2016-03-24', '22', '14:41:00', '15:41:00', 0, '2,3,4,5,6', 0, 0, 0, 1),
(23, 196, 195, '2016-02-26', '2016-09-30', '31', '15:09:00', '16:09:00', 34, '1', 0, 0, 0, 1),
(24, 195, 196, '2016-02-18', '2016-02-29', '12', '15:11:00', '16:11:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(25, 195, 196, '2016-02-18', '2016-02-29', '12', '15:17:00', '16:17:00', 0, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(26, 195, 2, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(27, 195, 2, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(28, 195, 2, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(29, 195, 2, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(30, 196, 104, '2016-02-18', '2016-02-29', '12', '15:21:00', '16:21:00', 31, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(31, 160, 195, '2016-02-18', '2016-02-29', '12', '18:21:00', '20:21:00', 31, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(32, 196, 195, '2016-02-25', '2016-02-29', '5', '17:00:00', '18:15:00', 31, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(33, 195, 2, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(34, 104, 2, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(35, 104, 5, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(36, 195, 5, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(37, 195, 5, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(38, 195, 5, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(39, 195, 5, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(40, 195, 5, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(41, 195, 5, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(42, 195, 5, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(43, 195, 5, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(44, 195, 5, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(47, 195, 196, '2016-02-19', '2016-02-29', '11', '09:55:00', '10:55:00', 0, '1,2,3,4,5,6,7', 1, 1, 1, 0),
(48, 196, 5, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(49, 195, 196, '2015-12-17', '2015-12-30', '14', '01:00:00', '02:00:00', 15, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(50, 196, 195, '2016-02-19', '2016-02-29', '11', '01:30:00', '02:40:00', 34, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(51, 196, 195, '2016-02-20', '2016-04-30', '71', '02:43:00', '03:43:00', 27, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(52, 15, 195, '2016-02-20', '2016-02-29', '6', '00:00:00', '01:00:00', 13, '1,2,3,4,5', 0, 1, 1, 0),
(53, 105, 148, '2016-03-19', '2016-05-19', '36', '18:02:00', '19:02:00', 12, '1,3,5,7', 0, 1, 1, 0),
(54, 177, 105, '2016-03-19', '2016-05-19', '35', '17:03:00', '18:03:00', 9, '1,4,6,7', 0, 0, 0, 1),
(55, 104, 105, '2016-03-19', '2016-05-19', '9', '18:04:00', '20:04:00', 9, '2', 0, 0, 0, 1),
(56, 160, 105, '2016-03-19', '2016-05-19', '44', '18:04:00', '19:04:00', 9, '2,3,4,5,6', 0, 0, 0, 1),
(57, 195, 104, '2016-01-01', '2016-01-31', '31', '10:30:00', '12:00:00', 0, '1,2,3,4,5,6,7', 1, 1, 1, 0),
(58, 196, 104, '2016-07-01', '2016-09-30', '92', '09:00:00', '11:00:00', 34, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(59, 149, 106, '2016-02-22', '2016-02-23', '1', '16:00:00', '17:00:00', 9, '1', 0, 0, 0, 1),
(60, 105, 196, '2016-02-25', '2016-02-29', '5', '04:29:00', '17:00:00', 30, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(61, 105, 148, '2016-02-23', '2016-03-23', '30', '16:40:00', '19:36:00', 13, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(62, 195, 196, '2016-02-25', '2016-03-25', '30', '21:30:00', '23:35:00', 0, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(63, 160, 191, '2016-03-01', '2016-03-20', '6', '00:00:00', '01:00:00', 9, '5,7', 0, 1, 1, 0),
(64, 160, 149, '2016-03-03', '2016-03-30', '12', '15:51:00', '16:21:00', 9, '3,5,7', 0, 1, 1, 0),
(65, 149, 191, '2016-03-01', '2016-03-24', '18', '15:58:00', '16:28:00', 11, '2,3,4,5,6', 0, 1, 1, 0),
(66, 160, 191, '2016-03-06', '2016-04-06', '4', '16:29:00', '16:59:00', 9, '6', 0, 1, 1, 0),
(67, 149, 105, '2016-02-29', '2016-03-29', '22', '22:35:00', '23:29:00', 9, '2,3,4,5,6', 0, 0, 0, 1),
(68, 149, 105, '2016-02-29', '2016-03-18', '19', '10:37:00', '12:37:00', 9, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(69, 149, 105, '2016-02-29', '2016-03-06', '7', '16:54:00', '17:54:00', 10, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(70, 180, 148, '2016-03-16', '2016-03-31', '11', '20:48:00', '21:40:00', 31, '1,2,3,4,7', 0, 1, 1, 0),
(71, 149, 106, '2016-03-03', '2016-03-04', '2', '19:16:00', '20:16:00', 9, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(72, 104, 105, '2016-03-04', '2016-03-14', '7', '16:29:00', '21:29:00', 11, '1,3,6,7', 0, 0, 0, 1),
(73, 105, 195, '2016-03-30', '2016-04-30', '32', '10:13:00', '12:13:00', 11, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(74, 196, 195, '2016-04-15', '2016-05-07', '23', '10:23:00', '12:23:00', 34, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(75, 163, 105, '2016-03-05', '2016-03-16', '6', '11:26:00', '11:58:00', 9, '2,4,7', 0, 0, 0, 1),
(76, 191, 106, '2016-03-07', '2016-03-08', '2', '13:18:00', '14:25:00', 68, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(77, 149, 191, '2016-03-07', '2016-03-07', '1', '09:38:00', '10:10:00', 9, '2', 0, 0, 0, 1),
(78, 149, 191, '2016-03-10', '2016-03-10', '1', '09:42:00', '10:12:00', 9, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(79, 196, 195, '2016-03-08', '2016-03-11', '4', '10:02:00', '11:02:00', 47, '1,2,3,4,5,6,7', 1, 1, 1, 0),
(80, 180, 195, '2016-03-08', '2016-03-08', '1', '10:00:00', '11:00:00', 32, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(81, 161, 191, '2016-03-08', '2016-03-30', '13', '10:55:00', '11:55:00', 11, '1,3,5,7', 0, 0, 0, 1),
(82, 180, 191, '2016-03-10', '2016-03-31', '22', '12:00:00', '13:00:00', 16, '1,2,3,4,5,6,7', 0, 1, 1, 1),
(83, 106, 137, '2016-03-08', '2016-03-09', '2', '13:40:00', '15:22:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(84, 153, 191, '2016-03-21', '2016-03-31', '11', '17:55:00', '18:55:00', 29, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(85, 122, 191, '2016-03-09', '2016-03-31', '7', '17:11:00', '18:11:00', 11, '4,7', 0, 0, 0, 1),
(86, 105, 191, '2016-03-09', '2016-03-16', '1', '17:42:00', '18:42:00', 0, '1', 0, 0, 0, 1),
(87, 180, 196, '2016-06-05', '2016-06-23', '19', '17:46:00', '18:46:00', 31, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(88, 127, 195, '2016-03-13', '2016-03-31', '19', '11:00:00', '12:00:00', 41, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(89, 104, 106, '2016-03-15', '2016-03-15', '1', '17:12:00', '18:12:00', 9, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(90, 106, 137, '2016-03-17', '2016-03-17', '1', '15:42:00', '17:37:00', 83, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(91, 105, 191, '2016-03-21', '2016-03-21', '1', '02:05:00', '03:05:00', 121, '2', 0, 1, 1, 0),
(92, 105, 191, '2016-03-21', '2016-03-31', '9', '01:00:00', '01:55:00', 119, '2,3,4,5,6', 0, 1, 1, 0),
(93, 105, 191, '2016-03-21', '2016-03-29', '3', '19:15:00', '20:15:00', 120, '3,5', 0, 0, 0, 1),
(94, 105, 191, '2016-03-21', '2016-03-21', '1', '03:10:00', '04:05:00', 121, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(95, 105, 191, '2016-03-22', '2016-03-29', '8', '11:34:00', '12:10:00', 119, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(96, 105, 191, '2016-03-22', '2016-03-25', '1', '20:15:00', '20:45:00', 120, '4', 0, 0, 0, 1),
(97, 105, 191, '2016-03-22', '2016-03-22', '1', '12:17:00', '12:50:00', 121, '3', 0, 0, 0, 1),
(98, 105, 191, '2016-03-22', '2016-03-22', '1', '12:19:00', '12:50:00', 121, '3', 0, 0, 0, 1),
(99, 209, 191, '2016-03-22', '2016-03-22', '1', '18:03:00', '19:03:00', 135, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(100, 105, 106, '2016-03-24', '2016-03-24', '1', '05:37:00', '16:37:00', 0, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(101, 105, 191, '2016-03-23', '2016-03-23', '1', '05:58:00', '10:58:00', 117, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(102, 105, 191, '2016-03-23', '2016-03-24', '2', '09:00:00', '09:50:00', 119, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(103, 105, 195, '2016-03-23', '2016-03-24', '2', '11:00:00', '12:27:00', 121, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(104, 105, 195, '2016-09-04', '2016-09-29', '26', '06:16:00', '07:16:00', 121, '1,2,3,4,5,6,7', 1, 1, 1, 0),
(106, 180, 195, '2016-03-23', '2016-03-31', '9', '00:19:00', '01:19:00', 33, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(107, 105, 191, '2016-03-23', '2016-03-24', '2', '16:47:00', '17:47:00', 121, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(108, 191, 105, '2016-03-25', '2016-03-26', '2', '15:49:00', '16:49:00', 300, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(109, 180, 195, '2016-09-03', '2016-09-30', '28', '10:23:00', '11:23:00', 33, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(110, 105, 191, '2016-03-23', '2016-03-23', '1', '16:15:00', '17:13:00', 123, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(111, 195, 180, '2017-06-04', '2017-07-14', '41', '11:16:00', '13:16:00', 83, '1,2,3,4,5,6,7', 0, 0, 1, 0),
(112, 105, 148, '2016-03-29', '2016-04-30', '5', '14:30:00', '15:30:00', 123, '6', 0, 1, 1, 0),
(113, 106, 137, '2016-03-31', '2016-04-02', '3', '13:04:00', '14:04:00', 550, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(114, 137, 106, '2016-03-30', '2016-03-30', '1', '12:07:00', '13:07:00', 0, '3', 0, 0, 0, 1),
(115, 137, 106, '2016-03-31', '2016-03-31', '1', '09:12:00', '14:24:00', 0, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(116, 106, 137, '2016-04-01', '2016-04-01', '1', '01:25:00', '05:36:00', 130, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(117, 106, 137, '2016-04-01', '2016-04-23', '23', '14:27:00', '16:58:00', 136, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(118, 137, 106, '2016-03-31', '2016-03-31', '1', '15:00:00', '16:00:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(119, 106, 137, '2016-04-02', '2016-04-16', '15', '16:31:00', '18:55:00', 130, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(120, 195, 191, '2016-04-11', '2016-04-29', '3', '05:48:00', '06:48:00', 41, '5', 0, 0, 0, 1),
(121, 195, 191, '2016-04-11', '2016-04-29', '2', '06:50:00', '07:50:00', 39, '7', 0, 1, 1, 0),
(122, 105, 191, '2016-04-11', '2016-04-30', '3', '08:23:00', '09:23:00', 121, '4', 0, 1, 1, 0),
(123, 191, 105, '2016-04-11', '2016-04-28', '5', '07:29:00', '08:29:00', 259, '4,7', 0, 0, 0, 1),
(124, 191, 105, '2016-04-11', '2016-04-13', '1', '08:30:00', '09:30:00', 263, '3', 0, 0, 0, 1),
(125, 191, 105, '2016-04-12', '2016-04-30', '3', '08:53:00', '09:53:00', 259, '5', 0, 0, 0, 1),
(126, 106, 137, '2016-04-15', '2016-04-16', '2', '17:44:00', '19:26:00', 168, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(127, 137, 106, '2016-04-18', '2016-04-18', '1', '15:00:00', '16:00:00', 0, '1', 0, 0, 0, 1),
(128, 106, 137, '2016-04-27', '2016-05-01', '5', '09:15:00', '14:22:00', 120, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(129, 106, 137, '2016-04-20', '2016-04-20', '1', '13:13:00', '15:24:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(130, 106, 137, '2016-04-20', '2016-04-22', '3', '14:08:00', '16:50:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(131, 106, 137, '2016-04-21', '2016-04-23', '3', '12:51:00', '14:06:00', 117, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(132, 106, 137, '2016-04-20', '2016-04-20', '1', '13:52:00', '16:52:00', 174, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(133, 180, 137, '2016-04-20', '2016-04-21', '2', '13:53:00', '17:13:00', 386, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(134, 196, 137, '2016-04-24', '2016-04-26', '3', '13:54:00', '16:54:00', 106, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(135, 166, 137, '2016-05-01', '2016-05-21', '21', '13:21:00', '16:19:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(136, 106, 137, '2016-04-20', '2016-04-20', '1', '13:24:00', '16:59:00', 362, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(137, 106, 137, '2016-04-20', '2016-04-20', '1', '15:00:00', '16:00:00', 117, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(138, 106, 137, '2016-04-20', '2016-04-20', '1', '15:00:00', '16:00:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(139, 137, 106, '2016-04-20', '2016-04-20', '1', '13:00:00', '14:00:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(140, 137, 106, '2016-04-20', '2016-04-20', '1', '13:00:00', '14:00:00', 0, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(141, 106, 137, '2016-04-22', '2016-04-22', '1', '12:30:00', '14:34:00', 118, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(142, 106, 137, '2016-04-28', '2016-04-29', '2', '01:17:00', '03:15:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(143, 106, 137, '2016-04-28', '2016-04-28', '1', '11:39:00', '13:39:00', 598, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(144, 106, 137, '2016-05-01', '2016-05-01', '1', '07:53:00', '10:26:00', 627, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(145, 221, 220, '2016-05-03', '2016-05-31', '29', '13:25:00', '14:25:00', 615, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(146, 196, 106, '2016-05-03', '2016-05-03', '1', '14:00:00', '15:00:00', 0, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(147, 106, 137, '2016-05-05', '2016-05-07', '3', '14:09:00', '16:29:00', 636, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(148, 106, 137, '2016-05-05', '2016-05-08', '4', '15:01:00', '17:30:00', 620, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(149, 106, 137, '2016-05-12', '2016-05-29', '18', '16:14:00', '19:14:00', 18, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(150, 106, 137, '2016-05-08', '2016-05-28', '21', '16:35:00', '19:49:00', 636, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(151, 106, 137, '2016-05-04', '2016-05-04', '1', '10:00:00', '12:00:00', 618, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(152, 106, 137, '2016-05-05', '2016-05-08', '2', '10:30:00', '12:30:00', 615, '1,4,7', 0, 0, 0, 1),
(153, 106, 137, '2016-05-07', '2016-05-07', '1', '23:44:00', '02:50:00', 22, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(154, 106, 137, '2016-05-07', '2016-05-07', '1', '22:50:00', '23:56:00', 618, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(155, 166, 137, '2016-05-15', '2016-05-17', '3', '00:18:00', '02:18:00', 623, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(156, 106, 137, '2016-05-13', '2016-05-13', '1', '12:04:00', '15:04:00', 615, '1,2,3,4,5', 0, 0, 0, 1),
(157, 106, 137, '2016-05-13', '2016-05-13', '1', '11:05:00', '12:17:00', 615, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(158, 221, 137, '2016-06-24', '2016-06-26', '3', '12:29:00', '14:29:00', 615, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(159, 106, 137, '2016-05-18', '2016-05-18', '1', '13:29:00', '16:30:00', 615, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(160, 106, 137, '2016-07-31', '2016-09-15', '47', '03:34:00', '19:27:00', 621, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(161, 166, 106, '2016-05-23', '2016-05-23', '1', '13:02:00', '14:02:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(162, 106, 223, '2016-05-23', '2016-05-23', '1', '14:55:00', '15:59:00', 615, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(163, 166, 137, '2016-05-24', '2016-05-24', '1', '19:53:00', '20:59:00', 615, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(164, 106, 137, '2016-06-02', '2016-06-03', '2', '10:15:00', '12:15:00', 615, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(165, 106, 137, '2016-06-03', '2016-06-05', '3', '00:08:00', '03:31:00', 618, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(166, 106, 137, '2016-06-04', '2016-06-04', '1', '00:28:00', '12:28:00', 615, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(167, 106, 137, '2016-06-04', '2016-06-04', '1', '14:08:00', '16:08:00', 616, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(168, 196, 106, '2016-06-17', '2016-06-17', '1', '13:05:00', '14:08:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(169, 166, 137, '2016-06-29', '2016-06-30', '2', '22:23:00', '00:27:00', 620, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(170, 106, 137, '2016-07-06', '2016-07-06', '1', '19:11:00', '20:11:00', 626, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(171, 180, 195, '2016-07-08', '2016-07-23', '16', '13:21:00', '14:21:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(172, 166, 224, '2016-07-12', '2016-07-19', '6', '04:30:00', '13:30:00', 21, '1,2,3,4,5', 0, 1, 1, 0),
(173, 106, 137, '2016-07-12', '2016-07-12', '1', '23:52:00', '01:52:00', 617, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(174, 105, 195, '2016-07-19', '2016-07-19', '1', '07:53:00', '09:49:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(175, 106, 137, '2016-07-29', '2016-07-29', '1', '14:30:00', '16:30:00', 621, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(176, 106, 137, '2016-07-29', '2016-07-30', '2', '11:26:00', '15:26:00', 625, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(177, 105, 195, '2016-08-01', '2016-08-01', '1', '10:26:00', '11:31:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(178, 195, 196, '2016-08-04', '2016-08-12', '7', '19:30:00', '12:30:00', 64, '1,2,3,4,5', 0, 1, 1, 0),
(179, 105, 195, '2016-08-02', '2016-08-02', '1', '07:18:00', '08:18:00', 0, '1,2,3,4,5', 0, 0, 0, 1),
(180, 105, 195, '2016-08-02', '2016-08-02', '1', '07:28:00', '08:28:00', 615, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(181, 105, 195, '2016-08-02', '2016-08-02', '1', '07:28:00', '08:28:00', 615, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(182, 196, 195, '2016-08-02', '2016-08-02', '1', '07:35:00', '09:23:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(183, 196, 195, '2016-08-02', '2016-08-02', '1', '07:36:00', '08:39:00', 117, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(194, 221, 195, '2016-08-09', '2016-08-13', '3', '06:40:00', '11:40:00', 623, '2,3,5', 0, 0, 0, 1),
(195, 221, 195, '2016-08-10', '2016-08-15', '6', '06:30:00', '13:30:00', 617, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(196, 195, 221, '2016-08-16', '2016-08-20', '5', '06:30:00', '13:30:00', 635, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(197, 166, 195, '2016-08-10', '2016-08-10', '1', '05:29:00', '06:29:00', 615, '3', 0, 0, 0, 1),
(198, 195, 106, '2016-08-10', '2016-08-10', '1', '13:58:00', '14:58:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(199, 106, 137, '2016-08-12', '2016-08-12', '1', '10:55:00', '12:26:00', 615, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(200, 106, 137, '2016-08-14', '2016-08-14', '1', '16:19:00', '17:19:00', 617, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(201, 106, 137, '2016-08-16', '2016-08-16', '1', '22:06:00', '23:06:00', 619, '2', 0, 0, 0, 1),
(202, 106, 137, '2016-08-16', '2016-08-16', '1', '22:11:00', '23:11:00', 620, '2', 0, 0, 0, 1),
(203, 106, 137, '2016-08-16', '2016-08-16', '1', '22:53:00', '23:53:00', 625, '2', 0, 0, 0, 1),
(204, 106, 137, '2016-08-16', '2016-08-16', '1', '15:57:00', '16:57:00', 624, '2', 0, 0, 0, 1),
(205, 106, 137, '2016-08-17', '2016-08-17', '1', '17:02:00', '18:02:00', 619, '3', 0, 0, 0, 1),
(206, 106, 137, '2016-08-17', '2016-08-17', '1', '19:41:00', '20:41:00', 619, '3', 0, 0, 0, 1),
(207, 106, 137, '2016-08-18', '2016-08-18', '1', '09:49:00', '10:49:00', 621, '4', 0, 0, 0, 1),
(208, 106, 137, '2016-08-18', '2016-08-18', '1', '09:49:00', '10:49:00', 615, '4', 0, 0, 0, 1),
(209, 106, 137, '2016-08-18', '2016-08-18', '1', '14:53:00', '15:53:00', 619, '4', 0, 0, 0, 1),
(210, 106, 137, '2016-08-19', '2016-08-19', '1', '18:36:00', '20:36:00', 620, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(211, 106, 137, '2016-08-19', '2016-08-19', '1', '11:33:00', '12:33:00', 619, '5', 0, 0, 0, 1),
(212, 106, 137, '2016-08-19', '2016-08-19', '1', '13:55:00', '14:55:00', 621, '5', 0, 0, 0, 1),
(213, 195, 106, '2016-08-20', '2016-08-20', '1', '13:57:00', '14:57:00', 0, '6', 0, 0, 0, 1),
(214, 195, 196, '2016-08-23', '2016-08-23', '1', '07:27:00', '08:27:00', 594, '2', 1, 1, 1, 0),
(215, 106, 137, '2016-08-25', '2016-08-25', '1', '08:44:00', '09:44:00', 616, '4', 0, 0, 0, 1),
(216, 196, 195, '2016-09-01', '2016-09-03', '3', '10:55:00', '13:30:00', 615, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(217, 106, 137, '2016-09-02', '2016-09-02', '1', '22:03:00', '23:03:00', 619, '5', 0, 0, 0, 1),
(219, 195, 196, '2016-09-02', '2016-09-02', '1', '05:35:00', '06:35:00', 622, '5', 0, 0, 0, 1),
(220, 106, 137, '2016-09-02', '2016-09-02', '1', '19:27:00', '20:27:00', 618, '5', 0, 0, 0, 1),
(221, 106, 137, '2016-09-03', '2016-09-03', '1', '18:46:00', '19:46:00', 619, '6', 0, 1, 1, 0),
(224, 195, 196, '2016-09-06', '2016-09-09', '4', '12:30:00', '16:30:00', 647, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(225, 195, 196, '2016-09-15', '2016-09-18', '4', '06:30:00', '12:30:00', 615, '1,2,3,4,5,6,7', 0, 1, 1, 0),
(226, 196, 195, '2016-09-22', '2016-09-24', '3', '10:45:00', '15:30:00', 647, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(227, 106, 137, '2016-09-08', '2016-09-08', '1', '17:32:00', '18:32:00', 18, '4', 0, 0, 0, 1),
(228, 106, 137, '2016-09-08', '2016-09-08', '1', '18:50:00', '19:50:00', 622, '4', 0, 0, 0, 1),
(229, 106, 137, '2016-09-22', '2016-09-23', '2', '18:14:00', '20:14:00', 0, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(230, 106, 137, '2016-09-24', '2016-09-24', '1', '16:50:00', '17:50:00', 615, '6', 0, 0, 0, 1),
(231, 106, 137, '2016-09-29', '2016-09-30', '2', '16:19:00', '17:19:00', 621, '1,2,3,4,5,6,7', 0, 0, 0, 1),
(232, 106, 137, '2016-09-26', '2016-09-26', '1', '22:51:00', '23:51:00', 624, '1', 0, 0, 0, 1),
(233, 106, 137, '2016-09-27', '2016-09-27', '1', '17:53:00', '18:53:00', 621, '2', 0, 0, 0, 1),
(234, 137, 106, '2016-09-30', '2016-09-30', '1', '02:53:00', '04:42:00', 615, '1,2,3,4,5,6,7', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblnotifications`
--

CREATE TABLE IF NOT EXISTS `tblnotifications` (
  `notification_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `notification_type` tinyint(1) NOT NULL COMMENT '0-Pending, 1-Completed',
  `reciever_type` tinyint(1) NOT NULL COMMENT '0-employer, 1-freelancer',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblnotifications`
--

INSERT INTO `tblnotifications` (`notification_id`, `sender_id`, `reciever_id`, `job_id`, `notification_type`, `reciever_type`, `created_date`) VALUES
(57, 196, 166, 223, 0, 1, '2016-09-05 10:11:07'),
(60, 195, 196, 226, 0, 1, '2016-09-07 10:47:30'),
(68, 106, 137, 234, 0, 1, '2016-09-29 06:15:16');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE IF NOT EXISTS `tblpayment` (
  `payment_id` int(11) unsigned NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `employer_id` int(11) DEFAULT NULL,
  `freelancer_id` int(11) NOT NULL,
  `payfort_id` varchar(20) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `paid_to_admin` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Here as the payment is done the value will change to 1 since the amount is paid to admin',
  `payment_requested` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Here as the job gets completed from freelancer side,freelancer will request employer for payment and so the value will change to 1',
  `release_requested` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Here employ eill request to Admin (CMS side) for releasing of payment, and so the value will change to 1 on request',
  `payment_release` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Here CMS side will chnage the value to 1 when payment is released by the Admin',
  `payment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'This will give the current date of payment done to the Admin',
  `payment_release_date` datetime DEFAULT NULL COMMENT 'This is will give the date when payment is released by the Admin so this has to be managed by CMS'
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpayment`
--

INSERT INTO `tblpayment` (`payment_id`, `job_id`, `employer_id`, `freelancer_id`, `payfort_id`, `amount`, `currency`, `paid_to_admin`, `payment_requested`, `release_requested`, `payment_release`, `payment_date`, `payment_release_date`) VALUES
(5, 104, 195, 105, '1468919731249', 1073, 'SAR', 1, 0, 1, 1, '2016-07-19 09:15:04', '2016-09-07 15:54:58'),
(6, 79, 195, 196, '123456789', 10, 'SAR', 1, 0, 1, 1, '2016-07-20 11:55:23', '2016-09-01 10:59:16'),
(7, 57, 104, 195, '987654', 20, 'SAR', 1, 1, 0, 1, '2016-07-20 11:59:27', '2016-09-01 10:55:57'),
(8, 62, 196, 195, '963258', 22, 'SAR', 1, 1, 0, 0, '2016-07-20 12:00:24', NULL),
(9, 47, 104, 195, '741258', 50, 'SAR', 1, 1, 1, 1, '2016-07-20 12:02:29', '2016-09-08 13:00:45'),
(10, 25, 196, 195, '753951', 89, 'SAR', 1, 1, 0, 0, '2016-07-20 12:02:29', NULL),
(15, 195, 195, 221, '1470738468331', 3938, 'SAR', 1, 1, 0, 0, '2016-08-09 10:26:52', NULL),
(16, 214, 196, 195, '1471935731755', 75, 'SAR', 1, 1, 1, 0, '2016-08-23 07:00:48', NULL),
(18, 216, 195, 196, '1472723552658', 844, 'SAR', 1, 0, 0, 0, '2016-09-01 09:50:50', NULL),
(19, 224, 196, 195, '1473082930446', 1200, 'SAR', 1, 0, 0, 0, '2016-09-05 13:40:25', NULL),
(20, 225, 196, 195, '1473156745853', 1800, 'SAR', 1, 0, 0, 0, '2016-09-06 10:11:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblreviews`
--

CREATE TABLE IF NOT EXISTS `tblreviews` (
  `review_id` int(11) unsigned NOT NULL,
  `job_id` int(11) NOT NULL DEFAULT '0',
  `reviewee_id` int(11) DEFAULT NULL,
  `reviewer_id` int(11) DEFAULT NULL,
  `ratings` float NOT NULL DEFAULT '0',
  `review_description` text,
  `date_added` text NOT NULL,
  `r1` float NOT NULL DEFAULT '0',
  `r2` float NOT NULL DEFAULT '0',
  `r3` float NOT NULL DEFAULT '0',
  `r4` float NOT NULL DEFAULT '0',
  `r5` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblreviews`
--

INSERT INTO `tblreviews` (`review_id`, `job_id`, `reviewee_id`, `reviewer_id`, `ratings`, `review_description`, `date_added`, `r1`, `r2`, `r3`, `r4`, `r5`) VALUES
(1, 57, 104, 195, 3.2, 'TmljZSB3b3JrISEh', '2016-04-14 11:24:22', 3, 4, 4, 2.5, 2.5),
(4, 79, 196, 195, 2.7, 'SHZnSG9nZw==', '2016-04-15 04:57:06', 2.5, 3, 2.5, 2, 3.5),
(5, 52, 15, 195, 3.2, 'w4HDomnDsWnDtvCfmIA=', '2016-04-15 04:59:40', 2.5, 5, 3, 3.5, 2),
(6, 62, 195, 196, 4.2, 'SnVzdCBhIGZldyB5ZWFycyBiYWNrIG9uIG15IHdheSBob21lIGZyb20gd29yayB0byBiZSB0aGUgZmlyc3QgaGFsZiBvZiB0aGUgZGF5IGJlZm9yZSBJIGdldCBhIGZvbGxvdyBiYWNr', '2016-04-18 09:29:48', 5, 4.5, 3, 4, 4.5),
(7, 49, 195, 196, 4.1, 'T2sgSSdtIGdvaW5nIG9uIGEgRnJpZGF5IGFmdGVybm9vbiBhdCBhIHRpbWUgd2hlbiB5b3UgYXJlIHNvIG11Y2ggZm9yIGEgbG9uZyB3YXk=', '2016-04-18 09:30:19', 4.5, 4, 5, 3.5, 3.5),
(8, 115, 137, 106, 3.8, 'R3JlYXQgd29yaw==', '2016-04-18 11:02:26', 4.5, 4, 4.5, 3.5, 2.5),
(9, 100, 105, 106, 4.6, 'R29vZCB3b3Jr', '2016-04-20 12:26:05', 3.5, 4.5, 5, 5, 5),
(10, 79, 195, 196, 3.5, '8J+RjfCfj7vwn5GN8J+Pu3VnZ3l1', '2016-05-26 09:22:10', 4.5, 3, 4, 2.5, 3.5),
(11, 162, 223, 106, 2.6, 'R29vZCBqb2I=', '2016-06-17 12:54:46', 3.5, 2.5, 2, 3, 2),
(12, 146, 196, 106, 2.3, 'R29vZCBqb2I=', '2016-06-17 12:55:11', 1, 2.5, 2, 3, 3),
(13, 172, 224, 166, 4.3, 'TmljZSBleHBlcmllbmNl', '2016-07-19 04:58:05', 4, 4, 4.5, 5, 4),
(14, 62, 196, 195, 3, 'R29vZA==', '2016-07-19 09:19:50', 3, 4, 1.5, 3, 3.5),
(20, 25, 196, 195, 3.2, 'R29vZCB3b3Jr', '2016-08-02 07:11:25', 2.5, 4, 4.5, 2, 3),
(22, 47, 195, 196, 4.3, 'SGk=', '2016-08-03 10:05:21', 4, 4, 4.5, 5, 4),
(25, 25, 195, 196, 3.1, 'SGk=', '2016-08-03 10:06:26', 2.5, 3.5, 3, 3.5, 3),
(29, 104, 105, 195, 2.2, 'SGhq', '2016-08-07 15:44:37', 1, 2, 1, 2, 5),
(30, 140, 137, 106, 2, '', '2016-08-10 11:54:56', 3, 3, 1, 1, 2),
(31, 150, 106, 137, 1, '', '2016-08-19 10:37:04', 4, 1, 0, 0, 0),
(32, 214, 195, 196, 3.6, 'aXQgd2FzIG5pY2Ugd29ya2luZyB3aXRoIHlvdS4gY29tcGxldGVkIGFsbCB0YXNrIG9uIHRpbWUud291bGQgbGlrZSB0byB3b3JrIHdpdGggaGltCmFnYWlu', '2016-08-24 04:06:33', 4, 3, 3, 5, 3),
(33, 214, 196, 195, 3.6, 'UGF5bWVudCBwcm9jZXNzIHdhcyB2ZXJ5IGZhc3QgYW5kIG9uIHRpbWUuIFdpbGwgZGVmaW5pdGVseSB3b3JrIGFnYWluLg==', '2016-08-24 04:09:01', 3, 3, 3, 4, 5),
(34, 178, 195, 196, 3.8, 'Z29vZCBqb2I=', '2016-08-24 04:39:00', 5, 4, 3, 4, 3),
(35, 146, 106, 196, 3.8, 'aQ==', '2016-08-24 04:40:47', 5, 3, 3, 4, 4),
(36, 140, 106, 137, 4.4, '', '2016-09-01 20:27:27', 3, 5, 4, 5, 5),
(37, 147, 106, 137, 2, '', '2016-09-01 20:33:01', 3, 4, 0, 0, 3),
(38, 115, 106, 137, 1.6, '', '2016-09-01 21:06:36', 4, 4, 0, 0, 0),
(39, 221, 106, 137, 2.6, '', '2016-09-11 16:14:55', 3, 5, 0, 5, 0),
(40, 150, 137, 106, 1.6, '', '2016-09-29 02:52:05', 5, 3, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblskills`
--

CREATE TABLE IF NOT EXISTS `tblskills` (
  `skill_id` int(11) unsigned NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `skill_description` text CHARACTER SET latin1,
  `skill_description_en` text NOT NULL COMMENT 'English language',
  `skill_description_ar` text COMMENT 'Arabic language',
  `skill_description_zh` text NOT NULL COMMENT 'Mandarin(Chinese) language',
  `skill_description_es` text NOT NULL COMMENT 'Spanish language',
  `skill_description_fr` text NOT NULL COMMENT 'French Language',
  `skill_description_hi` text NOT NULL COMMENT 'Hindi language',
  `img_icon` varchar(50) CHARACTER SET latin1 DEFAULT '',
  `priority` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=746 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblskills`
--

INSERT INTO `tblskills` (`skill_id`, `parent`, `skill_description`, `skill_description_en`, `skill_description_ar`, `skill_description_zh`, `skill_description_es`, `skill_description_fr`, `skill_description_hi`, `img_icon`, `priority`) VALUES
(0, 0, 'SuperHero', 'SuperHero', 'كل شيء', '超级英雄', 'superhéroe', '', '', '', 0),
(1, 0, 'Sport', 'Sport', 'رياضة', '', '', '', '', 'people_(2)1461836539.png', 1),
(2, 0, 'Photography', 'Photography', 'التصوير', '摄影', 'Fotografía', '', '', 'tool_(7)1461740655.png', 2),
(3, 0, 'Health Care', 'Health Care', 'الرعاىة الصحية', '卫生保健', '', '', '', 'tool_(8)1461741348.png', 3),
(5, 0, 'Babysitter', 'Babysitter', 'جليسه اطفال', '', '', '', '', 'people_(4)1461742388.png', 5),
(6, 1, 'Personal Trainers', 'Personal Trainers', 'المدربين الشخصية', '个人教练', '', '', '', 'people_(2)1461744996.png', 0),
(7, 1, 'Foot Ball (soccer)', 'Foot Ball (soccer)', 'كرة القدم', '', '', '', '', '', 0),
(8, 1, 'Basketball', 'Basketball', 'كره السله', '篮球', '', '', '', '', 0),
(17, 8, 'Algebra Basics', 'Algebra Basics', 'أساسيات الجبر', '', '', '', '', '', 0),
(18, 8, 'Differential Calculus', 'Differential Calculus', 'حساب التفاضل', '', '', '', '', '', 0),
(19, 8, 'Algebra 1', 'Algebra 1', 'الجبر 1', '', '', '', '', '', 0),
(20, 8, 'Integral Calculus', 'Integral Calculus', 'حساب التفاضل والتكامل لا يتجزأ', '', '', '', '', '', 0),
(21, 8, 'Geometry', 'Geometry', 'علم الهندسة', '', '', '', '', '', 0),
(22, 8, 'Multivariable Calculus', 'Multivariable Calculus', 'حساب التفاضل والتكامل متعدد المتغيرات\n', '', '', '', '', '', 0),
(23, 8, 'Algebra 2', 'Algebra 2', 'الجبر 2', '', '', '', '', '', 0),
(24, 8, 'Differential Equations', 'Differential Equations', 'المعادلات التفاضلية', '', '', '', '', '', 0),
(25, 8, 'Trigonometry', 'Trigonometry', 'علم المثلثات', '', '', '', '', '', 0),
(26, 2, 'Wedding', 'Wedding', 'زفاف', '', '', '', '', '', 0),
(35, 8, 'Linear Algebra', 'Linear Algebra', 'الجبر الخطي', '', '', '', '', '', 0),
(36, 8, 'Probability & Statistics', 'Probability & Statistics', 'احتمال والإحصاء', '', '', '', '', '', 0),
(38, 3, 'Doctors', 'Doctors', 'الأطباء', '', '', '', '', '', 0),
(45, 43, 'World History', 'World History', 'تاريخ العالم', '', '', '', '', '', 0),
(46, 43, 'Music', 'Music', 'موسيقى', '', '', '', '', '', 0),
(47, 44, 'Art history basics', 'Art history basics', 'أساسيات تاريخ الفن', '', '', '', '', '', 0),
(48, 44, 'Renaissance & Reformation in Europe', 'Renaissance & Reformation in Europe', 'نهضة و الاصلاح في أوروبا', '', '', '', '', '', 0),
(49, 44, 'Toward a global culture', 'Toward a global culture', 'نحو ثقافة عالمية', '', '', '', '', '', 0),
(50, 44, 'Prehistoric art in Europe & West Asia', 'Prehistoric art in Europe & West Asia', 'فن ما قبل التاريخ في أوروبا و غرب آسيا\n', '', '', '', '', '', 0),
(51, 44, 'Baroque,Rococo & Neoclassical art in Europe', 'Baroque,Rococo & Neoclassical art in Europe', 'الباروك ، الروكوكو و الكلاسيكية الجديدة الفن في أوروبا\n', '', '', '', '', '', 0),
(52, 44, 'Art of Asia', 'Art of Asia', 'فن آسيا', '', '', '', '', '', 0),
(53, 44, 'Ancient Mediterranean Art', 'Ancient Mediterranean Art', 'فن البحر الأبيض المتوسط ​​القديم', '', '', '', '', '', 0),
(54, 44, 'Americas to World War I Art', 'Americas to World War I Art', 'الأمريكتين إلى الحرب العالمية الأولى الفن\n', '', '', '', '', '', 0),
(55, 44, 'Art of Africa', 'Art of Africa', 'فن أفريقيا', '', '', '', '', '', 0),
(56, 44, 'Art of Medieval Europe', 'Art of Medieval Europe', 'فن أوروبا في العصور الوسطى', '', '', '', '', '', 0),
(57, 44, 'Art in 19th century Europe', 'Art in 19th century Europe', 'الفن في القرن ال19 أوروبا', '', '', '', '', '', 0),
(58, 44, 'Art of Oceania', 'Art of Oceania', 'فن أوقيانوسيا', '', '', '', '', '', 0),
(59, 44, 'Art of the Islamic world', 'Art of the Islamic world', 'الفن في العالم الإسلامي', '', '', '', '', '', 0),
(60, 44, 'Expressionism to Pop Art', 'Expressionism to Pop Art', 'التعبيرية إلى فن البوب', '', '', '', '', '', 0),
(62, 5, 'Subjects', 'Subjects', 'المواضيع', '', '', '', '', '', 0),
(63, 62, 'Computer Programming', 'Computer Programming', 'برمجة الحاسب الآلي', '', '', '', '', '', 0),
(64, 62, 'Computer Science', 'Computer Science', 'علوم الكمبيوتر', '', '', '', '', '', 0),
(66, 8, 'Precalculus', 'Precalculus', NULL, '', '', '', '', '', 0),
(70, 0, 'House Maintenance', 'House Maintenance', 'صيانة المنزل', '', '', '', '', 'wrench_(1)1461741379.png', 6),
(73, 72, 'MCAT', 'MCAT', 'مكت', '', '', '', '', '', 0),
(74, 71, 'Current SAT (through Jan ''16)', 'Current SAT (through Jan ''16)', NULL, '', '', '', '', '', 0),
(75, 71, 'New SAT(Starting Mar ''16)', 'New SAT(Starting Mar ''16)', NULL, '', '', '', '', '', 0),
(76, 72, 'GMAT', 'GMAT', NULL, '', '', '', '', '', 0),
(77, 72, 'IIT JEE', 'IIT JEE', NULL, '', '', '', '', '', 0),
(78, 72, 'NCLEX-RN', 'NCLEX-RN', NULL, '', '', '', '', '', 0),
(79, 72, 'CAHSEE', 'CAHSEE', NULL, '', '', '', '', '', 0),
(80, 72, 'AP* (Art History)', 'AP* (Art History)', NULL, '', '', '', '', '', 0),
(81, 0, 'Beauty Care', 'Beauty Care', 'العناية بالجمال', '', '', '', '', 'nature1461742221.png', 8),
(83, 82, 'Memorization', 'Memorization', 'التحفيظ', '', '', '', '', '', 0),
(84, 82, 'Recitation/Tajweed', 'Recitation/Tajweed', 'تلاوة / التجويد', '', '', '', '', '', 0),
(85, 82, 'Review', 'Review', 'مراجعة', '', '', '', '', '', 0),
(86, 0, 'Lawyers', 'Lawyers', 'المحامين', '', '', '', '', 'people_(3)1461742286.png', 9),
(88, 87, 'Arabic', 'Arabic', 'العربية', '', '', '', '', '', 0),
(89, 87, 'English', 'English', 'الإنجليزية', '', '', '', '', '', 0),
(90, 87, 'Mandarin', 'Mandarin', 'اليوسفي', '', '', '', '', '', 0),
(91, 87, 'Hindi', 'Hindi', 'الهندية', '', '', '', '', '', 0),
(92, 87, 'Spanish', 'Spanish', 'الأسبانية', '', '', '', '', '', 0),
(93, 87, 'French', 'French', 'اللغة الفرنسية', '', '', '', '', '', 0),
(94, 0, 'Designers', 'Designers', 'المصممين', '', '', '', '', 'education1461741400.png', 7),
(95, 94, 'Fashion ', 'Fashion ', 'موضة', '', '', '', '', '', 0),
(96, 527, 'Cluster ballooning', 'Cluster ballooning', 'تضخم الكتلة', '', '', '', '', '', 0),
(97, 527, 'Hopper ballooning', 'Hopper ballooning', 'النطاط المتضخم', '', '', '', '', '', 0),
(98, 528, 'Powered hang glider', 'Powered hang glider', 'تعمل بالطاقة شراعية', '', '', '', '', '', 0),
(99, 530, 'Banzai skydiving', 'Banzai skydiving', NULL, '', '', '', '', '', 0),
(100, 530, 'BASE jumping', 'BASE jumping', 'قاعدة القفز', '', '', '', '', '', 0),
(101, 530, 'Skydiving', 'Skydiving', 'القفز بالمظلات', '', '', '', '', '', 0),
(102, 530, 'Skyjumping', 'Skyjumping', NULL, '', '', '', '', '', 0),
(103, 530, 'Wingsuit flying', 'Wingsuit flying', NULL, '', '', '', '', '', 0),
(104, 531, 'Powered paragliding', 'Powered paragliding', 'بالمظلات تعمل بالطاقة', '', '', '', '', '', 0),
(106, 105, 'Aerobatics', 'Aerobatics', 'بهلوانات جوية', '', '', '', '', '', 0),
(107, 105, 'Air racing', 'Air racing', 'السباقات الجوية', '', '', '', '', '', 0),
(108, 105, 'Model aircraft', 'Model aircraft', 'نموذج طائرة', '', '', '', '', '', 0),
(109, 105, 'Paramotoring', 'Paramotoring', NULL, '', '', '', '', '', 0),
(110, 105, 'Ultralight aviation', 'Ultralight aviation', 'الطيران الخفيفة جدا', '', '', '', '', '', 0),
(111, 529, 'Select', 'Select', 'اختار', '', '', '', '', '', 0),
(112, 111, 'Field archery', 'Field archery', 'ميدان الرماية', '', '', '', '', '', 0),
(113, 111, 'Flight archery', 'Flight archery', 'الرماية رحلة', '', '', '', '', '', 0),
(114, 111, 'Gungdo', 'Gungdo', NULL, '', '', '', '', '', 0),
(115, 111, 'Indoor archery', 'Indoor archery', NULL, '', '', '', '', '', 0),
(116, 111, 'Popinjay', 'Popinjay', NULL, '', '', '', '', '', 0),
(117, 9, 'Measurement', 'Measurement', 'قياس', '', '', '', '', '', 0),
(118, 9, 'Probability', 'Probability', 'احتمال', '', '', '', '', '', 0),
(119, 9, 'Decimals', 'Decimals', 'الكسور العشرية', '', '', '', '', '', 0),
(120, 9, 'Place values and number sense', 'Place values and number sense', 'قيم المكان والشعور عدد', '', '', '', '', '', 0),
(121, 10, 'Whole numbers', 'Whole numbers', NULL, '', '', '', '', '', 0),
(122, 10, 'Expressions and properties', 'Expressions and properties', NULL, '', '', '', '', '', 0),
(123, 10, 'Operations with integers', 'Operations with integers', 'عمليات مع الأعداد الصحيحة', '', '', '', '', '', 0),
(124, 10, 'One-variable equations', 'One-variable equations', 'معادلات متغير واحد', '', '', '', '', '', 0),
(125, 10, 'Mixed operations', 'Mixed operations', 'عمليات مختلطة', '', '', '', '', '', 0),
(126, 10, 'Problem solving and estimation', 'Problem solving and estimation', 'حل مشكلة و تقدير', '', '', '', '', '', 0),
(127, 10, 'Ratios and proportions', 'Ratios and proportions', NULL, '', '', '', '', '', 0),
(128, 11, 'Exponents', 'Exponents', 'الدعاه', '', '', '', '', '', 0),
(129, 11, 'One-variable equations', 'One-variable equations', 'معادلات متغير واحد', '', '', '', '', '', 0),
(130, 11, 'Consumer maths', 'Consumer maths', 'الرياضيات المستهلك', '', '', '', '', '', 0),
(131, 12, 'Coordinate plane', 'Coordinate plane', 'خطة تنسيق', '', '', '', '', '', 0),
(132, 12, 'Exponents and roots', 'Exponents and roots', NULL, '', '', '', '', '', 0),
(133, 12, 'Monomials and polynomials', 'Monomials and polynomials', NULL, '', '', '', '', '', 0),
(134, 11, 'Rational numbers', 'Rational numbers', NULL, '', '', '', '', '', 0),
(135, 13, 'Counting', 'Counting', 'عد', '', '', '', '', '', 0),
(136, 13, 'Place value (tens and hundreds)', 'Place value (tens and hundreds)', 'مكان قيمة (عشرات ومئات )', '', '', '', '', '', 0),
(137, 13, 'Addition and subtraction within 20', 'Addition and subtraction within 20', 'الجمع والطرح في غضون 20\n', '', '', '', '', '', 0),
(138, 13, 'Addition and subtraction within 100', 'Addition and subtraction within 100', 'الجمع والطرح ضمن 100', '', '', '', '', '', 0),
(139, 13, 'Addition and subtraction within 1000', 'Addition and subtraction within 1000', 'الجمع والطرح في 1000', '', '', '', '', '', 0),
(140, 13, 'Measurement and data', 'Measurement and data', 'القياس و البيانات', '', '', '', '', '', 0),
(141, 13, 'Geometry', 'Geometry', NULL, '', '', '', '', '', 0),
(142, 14, 'Addition and subtraction\r\n', 'Addition and subtraction\r\n', 'جمع وطرح', '', '', '', '', '', 0),
(143, 14, 'Multiplication and division', 'Multiplication and division', 'الضرب والقسمة', '', '', '', '', '', 0),
(144, 14, 'Negative numbers and absolute value', 'Negative numbers and absolute value', 'الأرقام السالبة و القيمة المطلقة', '', '', '', '', '', 0),
(145, 14, 'Decimals', 'Decimals', 'الكسور العشرية', '', '', '', '', '', 0),
(146, 14, 'Fractions', 'Fractions', 'الكسور', '', '', '', '', '', 0),
(147, 14, 'Telling time', 'Telling time', NULL, '', '', '', '', '', 0),
(148, 15, 'Negative numbers and absolute value', 'Negative numbers and absolute value', 'الأرقام السالبة و القيمة المطلقة', '', '', '', '', '', 0),
(149, 15, 'Factors and multiples', 'Factors and multiples', NULL, '', '', '', '', '', 0),
(150, 15, 'Decimals\r\n', 'Decimals\r\n', 'الكسور العشرية', '', '', '', '', '', 0),
(151, 15, 'Fractions', 'Fractions', NULL, '', '', '', '', '', 0),
(152, 15, 'Ratios, proportions, units, and rates', 'Ratios, proportions, units, and rates', 'النسب، نسب ، وحدة، ومعدلات', '', '', '', '', '', 0),
(153, 15, 'Applying mathematical reasoning', 'Applying mathematical reasoning', NULL, '', '', '', '', '', 0),
(154, 15, 'Exponents, radicals, and scientific notation', 'Exponents, radicals, and scientific notation', NULL, '', '', '', '', '', 0),
(155, 15, 'Arithmetic properties', 'Arithmetic properties', NULL, '', '', '', '', '', 0),
(156, 15, 'Measurement', 'Measurement', 'قياس', '', '', '', '', '', 0),
(157, 16, 'Lines\r\n', 'Lines\r\n', 'خطوط', '', '', '', '', '', 0),
(158, 16, 'Angles', 'Angles', 'زوايا', '', '', '', '', '', 0),
(159, 16, 'Shapes', 'Shapes', 'الأشكال', '', '', '', '', '', 0),
(160, 16, 'The coordinate plane', 'The coordinate plane', 'على تنسيق الطائرة', '', '', '', '', '', 0),
(161, 16, 'Area and perimeter', 'Area and perimeter', 'منطقة و محيط', '', '', '', '', '', 0),
(162, 16, 'Volume and surface area', 'Volume and surface area', NULL, '', '', '', '', '', 0),
(163, 16, 'The Pythagorean theorem', 'The Pythagorean theorem', NULL, '', '', '', '', '', 0),
(164, 16, 'Transformations, congruence, & similarity', 'Transformations, congruence, & similarity', 'التحولات ، والتطابق ، و التشابه', '', '', '', '', '', 0),
(165, 17, 'Foundations\r\n', 'Foundations\r\n', 'أسس', '', '', '', '', '', 0),
(166, 17, 'Algebraic expressions', 'Algebraic expressions', 'عبارات جبرية', '', '', '', '', '', 0),
(167, 17, 'Linear equations and inequalities', 'Linear equations and inequalities', 'المعادلات الخطية وعدم المساواة', '', '', '', '', '', 0),
(168, 17, 'Graphing lines and slope', 'Graphing lines and slope', NULL, '', '', '', '', '', 0),
(169, 17, 'Systems of equations', 'Systems of equations', 'نظم المعادلات', '', '', '', '', '', 0),
(170, 17, 'Expressions with exponents', 'Expressions with exponents', NULL, '', '', '', '', '', 0),
(171, 17, 'Quadratics & polynomials Equations', 'Quadratics & polynomials Equations', NULL, '', '', '', '', '', 0),
(172, 18, 'Limits', 'Limits', 'حدود', '', '', '', '', '', 0),
(173, 18, 'Taking derivatives', 'Taking derivatives', 'أخذ المشتقات', '', '', '', '', '', 0),
(174, 18, 'Derivative applications', 'Derivative applications', 'تطبيقات المشتقة', '', '', '', '', '', 0),
(175, 19, 'Introduction to algebra', 'Introduction to algebra', 'مقدمة في الجبر', '', '', '', '', '', 0),
(176, 19, 'One-variable linear equations', 'One-variable linear equations', 'المعادلات الخطية متغير واحد', '', '', '', '', '', 0),
(177, 19, 'One-variable linear inequalities', 'One-variable linear inequalities', 'عدم المساواة الخطية متغير واحد', '', '', '', '', '', 0),
(178, 19, 'Units of measurement in modeling', 'Units of measurement in modeling', 'وحدات القياس في النمذجة', '', '', '', '', '', 0),
(179, 19, 'Two-variable linear equations', 'Two-variable linear equations', 'يومين متغير المعادلات الخطية', '', '', '', '', '', 0),
(180, 19, 'Functions', 'Functions', NULL, '', '', '', '', '', 0),
(181, 19, 'Linear equations and functions word problems', 'Linear equations and functions word problems', 'المعادلات الخطية والمشاكل وظائف كلمة\n', '', '', '', '', '', 0),
(182, 19, 'Systems of linear equations', 'Systems of linear equations', 'نظم المعادلات الخطية', '', '', '', '', '', 0),
(183, 19, 'Sequences', 'Sequences', 'متواليات', '', '', '', '', '', 0),
(184, 19, 'Two-variable linear inequalities', 'Two-variable linear inequalities', 'يومين متغير المتباينات الخطية', '', '', '', '', '', 0),
(185, 19, 'Rational exponents & radicals', 'Rational exponents & radicals', NULL, '', '', '', '', '', 0),
(186, 19, 'Introduction to exponential functions', 'Introduction to exponential functions', 'مقدمة في الدوال الأسية', '', '', '', '', '', 0),
(187, 19, 'Introduction to polynomials', 'Introduction to polynomials', 'مقدمة ل متعددو الحدود', '', '', '', '', '', 0),
(188, 19, 'Polynomial factorisation', 'Polynomial factorisation', NULL, '', '', '', '', '', 0),
(189, 19, 'Quadratic equations and functions', 'Quadratic equations and functions', 'المعادلات و الدوال التربيعية', '', '', '', '', '', 0),
(190, 19, 'Rational and irrational numbers', 'Rational and irrational numbers', 'أرقام العقلانية و اللاعقلانية', '', '', '', '', '', 0),
(191, 19, 'Seeing structure in expressions', 'Seeing structure in expressions', 'رؤية هيكل في التعبيرات', '', '', '', '', '', 0),
(192, 20, 'Integrals', 'Integrals', NULL, '', '', '', '', '', 0),
(193, 20, 'Integration techniques', 'Integration techniques', NULL, '', '', '', '', '', 0),
(194, 20, 'Integration applications', 'Integration applications', NULL, '', '', '', '', '', 0),
(195, 20, 'Sequences, series, & function approximation', 'Sequences, series, & function approximation', NULL, '', '', '', '', '', 0),
(196, 20, 'AP Calculus practice questions', 'AP Calculus practice questions', NULL, '', '', '', '', '', 0),
(197, 21, 'Tools of geometry', 'Tools of geometry', NULL, '', '', '', '', '', 0),
(198, 21, 'Angles & intersecting lines', 'Angles & intersecting lines', NULL, '', '', '', '', '', 0),
(199, 21, 'Special properties & parts of triangles', 'Special properties & parts of triangles', NULL, '', '', '', '', '', 0),
(200, 21, 'Quadrilaterals', 'Quadrilaterals', NULL, '', '', '', '', '', 0),
(201, 21, 'Transformations', 'Transformations', NULL, '', '', '', '', '', 0),
(202, 21, 'Congruence', 'Congruence', NULL, '', '', '', '', '', 0),
(203, 21, 'Similarity', 'Similarity', NULL, '', '', '', '', '', 0),
(204, 21, 'Right triangles and trigonometry', 'Right triangles and trigonometry', NULL, '', '', '', '', '', 0),
(205, 21, 'Circles', 'Circles', NULL, '', '', '', '', '', 0),
(206, 21, 'Perimeter, area, and volume', 'Perimeter, area, and volume', NULL, '', '', '', '', '', 0),
(207, 21, 'Analytic geometry', 'Analytic geometry', NULL, '', '', '', '', '', 0),
(208, 21, 'Geometric constructions', 'Geometric constructions', NULL, '', '', '', '', '', 0),
(209, 22, 'Thinking about multivariable functions', 'Thinking about multivariable functions', NULL, '', '', '', '', '', 0),
(210, 22, 'Derivatives of multivariable functions', 'Derivatives of multivariable functions', NULL, '', '', '', '', '', 0),
(211, 22, 'Applications of multivariable derivatives', 'Applications of multivariable derivatives', NULL, '', '', '', '', '', 0),
(212, 22, 'Integrating multivariable functions', 'Integrating multivariable functions', NULL, '', '', '', '', '', 0),
(213, 22, 'Green''s theorem and Stokes'' theorem', 'Green''s theorem and Stokes'' theorem', NULL, '', '', '', '', '', 0),
(214, 23, 'Manipulating functions', 'Manipulating functions', NULL, '', '', '', '', '', 0),
(215, 23, 'Introduction to complex numbers', 'Introduction to complex numbers', NULL, '', '', '', '', '', 0),
(216, 23, 'Arithmetic with polynomials', 'Arithmetic with polynomials', NULL, '', '', '', '', '', 0),
(217, 23, 'Polynomials, equations & functions', 'Polynomials, equations & functions', NULL, '', '', '', '', '', 0),
(218, 23, 'Radical equations & functions', 'Radical equations & functions', NULL, '', '', '', '', '', 0),
(219, 23, 'Rational expressions, equations, & functions', 'Rational expressions, equations, & functions', NULL, '', '', '', '', '', 0),
(220, 23, 'Exponential growth & decay', 'Exponential growth & decay', NULL, '', '', '', '', '', 0),
(221, 23, 'Exponential and logarithmic functions', 'Exponential and logarithmic functions', NULL, '', '', '', '', '', 0),
(222, 23, 'Trigonometric functions', 'Trigonometric functions', NULL, '', '', '', '', '', 0),
(223, 23, 'Advanced equations & inequalities', 'Advanced equations & inequalities', NULL, '', '', '', '', '', 0),
(224, 23, 'Advanced functions', 'Advanced functions', NULL, '', '', '', '', '', 0),
(225, 23, 'Sequences & series', 'Sequences & series', NULL, '', '', '', '', '', 0),
(226, 23, 'Modeling with algebra', 'Modeling with algebra', NULL, '', '', '', '', '', 0),
(227, 23, 'Introduction to conic sections', 'Introduction to conic sections', NULL, '', '', '', '', '', 0),
(228, 24, 'First order differential equations', 'First order differential equations', NULL, '', '', '', '', '', 0),
(229, 24, 'Second order linear equations', 'Second order linear equations', NULL, '', '', '', '', '', 0),
(230, 24, 'Laplace transform', 'Laplace transform', NULL, '', '', '', '', '', 0),
(231, 25, 'Trigonometry with right triangles', 'Trigonometry with right triangles', NULL, '', '', '', '', '', 0),
(232, 25, 'Trigonometry with general triangles', 'Trigonometry with general triangles', NULL, '', '', '', '', '', 0),
(233, 25, 'Definition of sine, cosine, & tangent', 'Definition of sine, cosine, & tangent', NULL, '', '', '', '', '', 0),
(234, 25, 'Graphs of trigonometric functions', 'Graphs of trigonometric functions', NULL, '', '', '', '', '', 0),
(235, 25, 'Trigonometric equations & identities', 'Trigonometric equations & identities', NULL, '', '', '', '', '', 0),
(236, 36, 'Independent & dependent events', 'Independent & dependent events', NULL, '', '', '', '', '', 0),
(237, 36, 'Probability & combinatorics', 'Probability & combinatorics', NULL, '', '', '', '', '', 0),
(238, 36, 'Statistical studies', 'Statistical studies', NULL, '', '', '', '', '', 0),
(239, 36, 'Descriptive statistics', 'Descriptive statistics', NULL, '', '', '', '', '', 0),
(240, 36, 'Random variables & probability distributions', 'Random variables & probability distributions', NULL, '', '', '', '', '', 0),
(241, 36, 'Regression', 'Regression', NULL, '', '', '', '', '', 0),
(242, 36, 'Inferential statistics', 'Inferential statistics', NULL, '', '', '', '', '', 0),
(243, 35, 'Vectors & spaces', 'Vectors & spaces', NULL, '', '', '', '', '', 0),
(244, 35, 'Matrix transformations', 'Matrix transformations', NULL, '', '', '', '', '', 0),
(245, 35, 'Alternate coordinate systems (bases)', 'Alternate coordinate systems (bases)', NULL, '', '', '', '', '', 0),
(246, 66, 'Trigonometric equations & identities', 'Trigonometric equations & identities', NULL, '', '', '', '', '', 0),
(247, 66, 'Conic sections\r\n', 'Conic sections\r\n', NULL, '', '', '', '', '', 0),
(248, 66, 'Vectors', 'Vectors', NULL, '', '', '', '', '', 0),
(249, 66, 'Matrices', 'Matrices', NULL, '', '', '', '', '', 0),
(250, 66, 'Imaginary and complex numbers', 'Imaginary and complex numbers', NULL, '', '', '', '', '', 0),
(251, 66, 'Parametric equations & polar coordinates', 'Parametric equations & polar coordinates', NULL, '', '', '', '', '', 0),
(252, 66, 'Probability & combinatorics', 'Probability & combinatorics', NULL, '', '', '', '', '', 0),
(253, 66, 'Sequences, series & induction', 'Sequences, series & induction', NULL, '', '', '', '', '', 0),
(254, 66, 'Partial fraction expansion\r\nLimits', 'Partial fraction expansion\r\nLimits', NULL, '', '', '', '', '', 0),
(255, 27, 'Intro to biology', 'Intro to biology', NULL, '', '', '', '', '', 0),
(256, 27, 'Chemistry of life', 'Chemistry of life', NULL, '', '', '', '', '', 0),
(257, 27, 'Water, acids, and bases', 'Water, acids, and bases', NULL, '', '', '', '', '', 0),
(258, 27, 'Properties of carbon', 'Properties of carbon', NULL, '', '', '', '', '', 0),
(259, 27, 'Macromolecules', 'Macromolecules', NULL, '', '', '', '', '', 0),
(260, 27, 'Energy & enzymes', 'Energy & enzymes', NULL, '', '', '', '', '', 0),
(261, 27, 'Structure of a cell', 'Structure of a cell', NULL, '', '', '', '', '', 0),
(262, 27, 'Membranes & transport', 'Membranes & transport', NULL, '', '', '', '', '', 0),
(263, 27, 'Cellular respiration', 'Cellular respiration', NULL, '', '', '', '', '', 0),
(264, 27, 'Photosynthesis', 'Photosynthesis', NULL, '', '', '', '', '', 0),
(265, 27, 'Cell signaling', 'Cell signaling', NULL, '', '', '', '', '', 0),
(266, 27, 'Cell division', 'Cell division', NULL, '', '', '', '', '', 0),
(267, 27, 'Classical & molecular genetics', 'Classical & molecular genetics', NULL, '', '', '', '', '', 0),
(268, 27, 'DNA as the genetic material', 'DNA as the genetic material', NULL, '', '', '', '', '', 0),
(269, 27, 'Central dogma', 'Central dogma', NULL, '', '', '', '', '', 0),
(270, 27, 'Evolution & the tree of life', 'Evolution & the tree of life', NULL, '', '', '', '', '', 0),
(271, 27, 'Human biology', 'Human biology', NULL, '', '', '', '', '', 0),
(272, 28, 'Atoms, compounds, & ions', 'Atoms, compounds, & ions', NULL, '', '', '', '', '', 0),
(273, 28, 'Chemical reactions & stoichiometry', 'Chemical reactions & stoichiometry', NULL, '', '', '', '', '', 0),
(274, 28, 'Electronic structure of atoms', 'Electronic structure of atoms', NULL, '', '', '', '', '', 0),
(275, 28, 'Periodic table', 'Periodic table', NULL, '', '', '', '', '', 0),
(276, 28, 'Chemical bonds', 'Chemical bonds', NULL, '', '', '', '', '', 0),
(277, 28, 'Gases & kinetic molecular theory', 'Gases & kinetic molecular theory', NULL, '', '', '', '', '', 0),
(278, 28, 'States of matter & intermolecular forces', 'States of matter & intermolecular forces', NULL, '', '', '', '', '', 0),
(279, 28, 'Chemical equilibrium', 'Chemical equilibrium', NULL, '', '', '', '', '', 0),
(280, 28, 'Acids & bases', 'Acids & bases', NULL, '', '', '', '', '', 0),
(281, 28, 'Buffers, titrations, & solubility equilibria', 'Buffers, titrations, & solubility equilibria', NULL, '', '', '', '', '', 0),
(282, 28, 'Thermodynamics', 'Thermodynamics', NULL, '', '', '', '', '', 0),
(283, 28, 'Redox reactions & electrochemistry', 'Redox reactions & electrochemistry', NULL, '', '', '', '', '', 0),
(284, 28, 'Kinetics', 'Kinetics', NULL, '', '', '', '', '', 0),
(285, 28, 'Nuclear chemistry', 'Nuclear chemistry', NULL, '', '', '', '', '', 0),
(286, 29, 'One-dimensional motion', 'One-dimensional motion', NULL, '', '', '', '', '', 0),
(287, 29, 'Two-dimensional motion', 'Two-dimensional motion', NULL, '', '', '', '', '', 0),
(288, 29, 'Forces and Newton''s laws of motion', 'Forces and Newton''s laws of motion', NULL, '', '', '', '', '', 0),
(289, 29, 'Centripetal force and gravitation', 'Centripetal force and gravitation', NULL, '', '', '', '', '', 0),
(290, 29, 'Work & energy', 'Work & energy', NULL, '', '', '', '', '', 0),
(291, 29, 'Impacts & linear momentum', 'Impacts & linear momentum', NULL, '', '', '', '', '', 0),
(292, 29, 'Moments, torque, & angular momentum', 'Moments, torque, & angular momentum', NULL, '', '', '', '', '', 0),
(293, 29, 'Oscillatory motion', 'Oscillatory motion', NULL, '', '', '', '', '', 0),
(294, 29, 'Fluids', 'Fluids', NULL, '', '', '', '', '', 0),
(295, 29, 'Thermodynamics', 'Thermodynamics', NULL, '', '', '', '', '', 0),
(296, 29, 'Electric charge, electric force & voltage', 'Electric charge, electric force & voltage', NULL, '', '', '', '', '', 0),
(297, 29, 'Circuits', 'Circuits', NULL, '', '', '', '', '', 0),
(298, 29, 'Magnetic forces/fields & Faraday''s law', 'Magnetic forces/fields & Faraday''s law', NULL, '', '', '', '', '', 0),
(299, 29, 'Mechanical waves & sound', 'Mechanical waves & sound', NULL, '', '', '', '', '', 0),
(300, 29, 'Light waves', 'Light waves', NULL, '', '', '', '', '', 0),
(301, 29, 'Geometric optics', 'Geometric optics', NULL, '', '', '', '', '', 0),
(302, 29, 'Special relativity', 'Special relativity', NULL, '', '', '', '', '', 0),
(303, 29, 'Discoveries & projects', 'Discoveries & projects', NULL, '', '', '', '', '', 0),
(304, 30, 'Structure and bonding', 'Structure and bonding', NULL, '', '', '', '', '', 0),
(305, 30, 'Resonance & acid-base chemistry', 'Resonance & acid-base chemistry', NULL, '', '', '', '', '', 0),
(306, 30, 'Alkanes, cycloalkanes & functional groups', 'Alkanes, cycloalkanes & functional groups', NULL, '', '', '', '', '', 0),
(307, 30, 'Stereochemistry', 'Stereochemistry', NULL, '', '', '', '', '', 0),
(308, 30, 'Substitution & elimination reactions', 'Substitution & elimination reactions', NULL, '', '', '', '', '', 0),
(309, 30, 'Alkenes & alkynes', 'Alkenes & alkynes', NULL, '', '', '', '', '', 0),
(310, 30, 'Alcohols, ethers, epoxides, sulfides', 'Alcohols, ethers, epoxides, sulfides', NULL, '', '', '', '', '', 0),
(311, 30, 'Conjugated systems & pericyclic reactions', 'Conjugated systems & pericyclic reactions', NULL, '', '', '', '', '', 0),
(312, 30, 'Aromatic compounds', 'Aromatic compounds', NULL, '', '', '', '', '', 0),
(313, 30, 'Aldehydes & ketones', 'Aldehydes & ketones', NULL, '', '', '', '', '', 0),
(314, 30, 'Carboxylic acids & derivatives', 'Carboxylic acids & derivatives', NULL, '', '', '', '', '', 0),
(315, 30, 'Alpha carbon chemistry', 'Alpha carbon chemistry', NULL, '', '', '', '', '', 0),
(316, 30, 'Amines', 'Amines', NULL, '', '', '', '', '', 0),
(317, 30, 'Spectroscopy', 'Spectroscopy', NULL, '', '', '', '', '', 0),
(318, 32, 'Scale of the universe', 'Scale of the universe', NULL, '', '', '', '', '', 0),
(319, 32, 'Stars, black holes & galaxies', 'Stars, black holes & galaxies', NULL, '', '', '', '', '', 0),
(320, 32, 'Earth geological & climatic history', 'Earth geological & climatic history', NULL, '', '', '', '', '', 0),
(321, 32, 'Life on earth & in the universe', 'Life on earth & in the universe', NULL, '', '', '', '', '', 0),
(322, 33, 'Human anatomy & physiology', 'Human anatomy & physiology', NULL, '', '', '', '', '', 0),
(323, 33, 'Advanced circulatory system physiology', 'Advanced circulatory system physiology', NULL, '', '', '', '', '', 0),
(324, 33, 'Circulatory system diseases', 'Circulatory system diseases', NULL, '', '', '', '', '', 0),
(325, 33, 'Advanced respiratory system physiology', 'Advanced respiratory system physiology', NULL, '', '', '', '', '', 0),
(326, 33, 'Respiratory system diseases', 'Respiratory system diseases', NULL, '', '', '', '', '', 0),
(327, 33, 'Advanced hematologic system physiology', 'Advanced hematologic system physiology', NULL, '', '', '', '', '', 0),
(328, 33, 'Hematologic system diseases', 'Hematologic system diseases', NULL, '', '', '', '', '', 0),
(329, 33, 'Advanced endocrine system physiology', 'Advanced endocrine system physiology', NULL, '', '', '', '', '', 0),
(330, 33, 'Endocrine system diseases', 'Endocrine system diseases', NULL, '', '', '', '', '', 0),
(331, 33, 'Advanced nervous system physiology', 'Advanced nervous system physiology', NULL, '', '', '', '', '', 0),
(332, 33, 'Nervous system diseases', 'Nervous system diseases', NULL, '', '', '', '', '', 0),
(333, 33, 'Advanced gastrointestinal physiology', 'Advanced gastrointestinal physiology', NULL, '', '', '', '', '', 0),
(334, 33, 'Advanced muscular-skeletal system physiology', 'Advanced muscular-skeletal system physiology', NULL, '', '', '', '', '', 0),
(335, 33, 'Muscular-skeletal diseases', 'Muscular-skeletal diseases', NULL, '', '', '', '', '', 0),
(336, 33, 'Executive systems of the brain', 'Executive systems of the brain', NULL, '', '', '', '', '', 0),
(337, 33, 'Infectious diseases', 'Infectious diseases', NULL, '', '', '', '', '', 0),
(338, 33, 'Lab values & concentrations', 'Lab values & concentrations', NULL, '', '', '', '', '', 0),
(339, 33, 'Current events in health & medicine', 'Current events in health & medicine', NULL, '', '', '', '', '', 0),
(340, 33, 'Health care system', 'Health care system', NULL, '', '', '', '', '', 0),
(341, 33, 'Gastrointestinal system diseases', 'Gastrointestinal system diseases', NULL, '', '', '', '', '', 0),
(342, 33, 'Mental health', 'Mental health', NULL, '', '', '', '', '', 0),
(343, 34, 'Introduction to electrical engineering', 'Introduction to electrical engineering', NULL, '', '', '', '', '', 0),
(344, 34, 'Circuit analysis', 'Circuit analysis', NULL, '', '', '', '', '', 0),
(345, 34, 'Electrostatics', 'Electrostatics', NULL, '', '', '', '', '', 0),
(346, 34, 'Home-made robots', 'Home-made robots', NULL, '', '', '', '', '', 0),
(347, 34, 'Lego robotics', 'Lego robotics', NULL, '', '', '', '', '', 0),
(348, 34, 'Reverse engineering', 'Reverse engineering', NULL, '', '', '', '', '', 0),
(349, 39, 'Supply, demand & market equilibrium', 'Supply, demand & market equilibrium', NULL, '', '', '', '', '', 0),
(350, 39, 'Elasticity', 'Elasticity', NULL, '', '', '', '', '', 0),
(351, 39, 'Consumer & producer surplus', 'Consumer & producer surplus', NULL, '', '', '', '', '', 0),
(352, 39, 'Scarcity, possibilities & preferences', 'Scarcity, possibilities & preferences', NULL, '', '', '', '', '', 0),
(353, 39, 'Production decisions & economic profit', 'Production decisions & economic profit', NULL, '', '', '', '', '', 0),
(354, 39, 'Forms of competition', 'Forms of competition', NULL, '', '', '', '', '', 0),
(355, 39, 'Game theory & Nash equilibrium', 'Game theory & Nash equilibrium', NULL, '', '', '', '', '', 0),
(356, 40, 'GDP: Measuring national income', 'GDP: Measuring national income', NULL, '', '', '', '', '', 0),
(357, 40, 'Inflation - measuring the cost of living', 'Inflation - measuring the cost of living', NULL, '', '', '', '', '', 0),
(358, 40, 'Aggregate demand & aggregate supply', 'Aggregate demand & aggregate supply', NULL, '', '', '', '', '', 0),
(359, 40, 'The monetary system', 'The monetary system', NULL, '', '', '', '', '', 0),
(360, 40, 'Income & expenditure', 'Income & expenditure', NULL, '', '', '', '', '', 0),
(361, 40, 'Foreign exchange & trade', 'Foreign exchange & trade', NULL, '', '', '', '', '', 0),
(362, 41, 'Interest & debt', 'Interest & debt', NULL, '', '', '', '', '', 0),
(363, 41, 'Housing', 'Housing', NULL, '', '', '', '', '', 0),
(364, 41, 'Inflation', 'Inflation', NULL, '', '', '', '', '', 0),
(365, 41, 'Taxes', 'Taxes', NULL, '', '', '', '', '', 0),
(366, 41, 'Accounting & financial statements', 'Accounting & financial statements', NULL, '', '', '', '', '', 0),
(367, 41, 'Stocks & bonds', 'Stocks & bonds', NULL, '', '', '', '', '', 0),
(368, 41, 'Investment vehicles, insurance, & retirement', 'Investment vehicles, insurance, & retirement', NULL, '', '', '', '', '', 0),
(369, 41, 'Money, banking & central banks', 'Money, banking & central banks', NULL, '', '', '', '', '', 0),
(370, 41, 'Options, swaps, futures, MBSs, CDOs', 'Options, swaps, futures, MBSs, CDOs', NULL, '', '', '', '', '', 0),
(371, 41, 'Current economics', 'Current economics', NULL, '', '', '', '', '', 0),
(372, 42, 'Interviews with entrepreneurs', 'Interviews with entrepreneurs', NULL, '', '', '', '', '', 0),
(373, NULL, NULL, '', NULL, '', '', '', '', '', 0),
(374, 45, 'The 20th century', 'The 20th century', NULL, '', '', '', '', '', 0),
(375, 45, 'Enlightenment & Revolution', 'Enlightenment & Revolution', NULL, '', '', '', '', '', 0),
(376, 45, 'Renaissance & Reformation', 'Renaissance & Reformation', NULL, '', '', '', '', '', 0),
(377, 45, 'Ancient & Medieval history', 'Ancient & Medieval history', NULL, '', '', '', '', '', 0),
(378, 46, 'Music basics', 'Music basics', NULL, '', '', '', '', '', 0),
(379, 46, 'Masterpieces old & new', 'Masterpieces old & new', NULL, '', '', '', '', '', 0),
(380, 46, 'Instruments of the orchestra', 'Instruments of the orchestra', NULL, '', '', '', '', '', 0),
(381, NULL, NULL, '', NULL, '', '', '', '', '', 0),
(382, 47, 'First things first', 'First things first', NULL, '', '', '', '', '', 0),
(383, 47, 'Tools for understanding art', 'Tools for understanding art', NULL, '', '', '', '', '', 0),
(384, 47, 'The materials & techniques artists use', 'The materials & techniques artists use', NULL, '', '', '', '', '', 0),
(385, 47, 'Art 1010', 'Art 1010', NULL, '', '', '', '', '', 0),
(386, 48, 'Late Gothic art in Italy', 'Late Gothic art in Italy', NULL, '', '', '', '', '', 0),
(387, 48, 'Northern Renaissance: the fifteenth century', 'Northern Renaissance: the fifteenth century', NULL, '', '', '', '', '', 0),
(388, 48, 'Early Renaissance in Italy: the 15th century', 'Early Renaissance in Italy: the 15th century', NULL, '', '', '', '', '', 0),
(389, 48, 'High Renaissance in Florence & Rome', 'High Renaissance in Florence & Rome', NULL, '', '', '', '', '', 0),
(390, 48, 'The Renaissance in Venice', 'The Renaissance in Venice', NULL, '', '', '', '', '', 0),
(391, 48, 'Reformation & Counter-Reformation', 'Reformation & Counter-Reformation', NULL, '', '', '', '', '', 0),
(392, 48, 'Northern Renaissance: the 16th century', 'Northern Renaissance: the 16th century', NULL, '', '', '', '', '', 0),
(393, 48, 'Mannerism', 'Mannerism', NULL, '', '', '', '', '', 0),
(394, 49, 'A beginner''s guide to contemporary art', 'A beginner''s guide to contemporary art', NULL, '', '', '', '', '', 0),
(395, 49, 'The body & the subversion of Modernism', 'The body & the subversion of Modernism', NULL, '', '', '', '', '', 0),
(396, 49, 'Conceptual & Performance art', 'Conceptual & Performance art', NULL, '', '', '', '', '', 0),
(397, 49, 'Global modernisms in the 21st century', 'Global modernisms in the 21st century', NULL, '', '', '', '', '', 0),
(398, 50, 'Paleolithic art', 'Paleolithic art', NULL, '', '', '', '', '', 0),
(399, 50, 'Neolithic art', 'Neolithic art', NULL, '', '', '', '', '', 0),
(400, 51, 'Baroque art', 'Baroque art', NULL, '', '', '', '', '', 0),
(401, 51, 'Rococo', 'Rococo', NULL, '', '', '', '', '', 0),
(402, 51, 'Neo-Classicism', 'Neo-Classicism', NULL, '', '', '', '', '', 0),
(403, 51, 'British art in the 18th century', 'British art in the 18th century', NULL, '', '', '', '', '', 0),
(404, 52, 'A beginner''s guide to Asian art & culture', 'A beginner''s guide to Asian art & culture', NULL, '', '', '', '', '', 0),
(405, 52, 'China', 'China', NULL, '', '', '', '', '', 0),
(406, 52, 'Korea', 'Korea', NULL, '', '', '', '', '', 0),
(407, 52, 'Japan', 'Japan', NULL, '', '', '', '', '', 0),
(408, 52, 'South Asia', 'South Asia', NULL, '', '', '', '', '', 0),
(409, 52, 'Southeast Asia', 'Southeast Asia', NULL, '', '', '', '', '', 0),
(410, 52, 'The Himalayas', 'The Himalayas', NULL, '', '', '', '', '', 0),
(411, 53, 'Ancient Near East', 'Ancient Near East', NULL, '', '', '', '', '', 0),
(412, 53, 'Egyptian art & culture', 'Egyptian art & culture', NULL, '', '', '', '', '', 0),
(413, 53, 'Aegean art', 'Aegean art', NULL, '', '', '', '', '', 0),
(414, 53, 'Greek art', 'Greek art', NULL, '', '', '', '', '', 0),
(415, 53, 'Nabataean', 'Nabataean', NULL, '', '', '', '', '', 0),
(416, 53, 'Etruscan', 'Etruscan', NULL, '', '', '', '', '', 0),
(417, 53, 'Roman', 'Roman', NULL, '', '', '', '', '', 0),
(418, 53, 'Palmyra', 'Palmyra', NULL, '', '', '', '', '', 0),
(419, 53, 'Judaism & art', 'Judaism & art', NULL, '', '', '', '', '', 0),
(420, 54, 'North America before European colonization', 'North America before European colonization', NULL, '', '', '', '', '', 0),
(421, 54, 'South America before European colonization', 'South America before European colonization', NULL, '', '', '', '', '', 0),
(422, 54, 'Spanish colonies in the Americas', 'Spanish colonies in the Americas', NULL, '', '', '', '', '', 0),
(423, 54, 'Native American art after 1600', 'Native American art after 1600', NULL, '', '', '', '', '', 0),
(424, 54, 'British Colonies to the Early Republic', 'British Colonies to the Early Republic', NULL, '', '', '', '', '', 0),
(425, 54, 'Art of the United States in the 19th century', 'Art of the United States in the 19th century', NULL, '', '', '', '', '', 0),
(426, 54, 'Art of Mexico in the 19th century', 'Art of Mexico in the 19th century', NULL, '', '', '', '', '', 0),
(427, 55, 'African art, an introduction', 'African art, an introduction', NULL, '', '', '', '', '', 0),
(428, 55, 'West Africa', 'West Africa', NULL, '', '', '', '', '', 0),
(429, 55, 'North Africa', 'North Africa', NULL, '', '', '', '', '', 0),
(430, 55, 'Central Africa', 'Central Africa', NULL, '', '', '', '', '', 0),
(431, 55, 'East Africa', 'East Africa', NULL, '', '', '', '', '', 0),
(432, 55, 'Southern Africa', 'Southern Africa', NULL, '', '', '', '', '', 0),
(433, 56, 'A beginner''s guide to medieval Europe', 'A beginner''s guide to medieval Europe', NULL, '', '', '', '', '', 0),
(434, 56, 'Books of knowledge in medieval Europe', 'Books of knowledge in medieval Europe', NULL, '', '', '', '', '', 0),
(435, 56, 'Early Christian', 'Early Christian', NULL, '', '', '', '', '', 0),
(436, 56, 'Byzantine (late Roman Empire)', 'Byzantine (late Roman Empire)', NULL, '', '', '', '', '', 0),
(437, 56, 'Latin (Western) Europe', 'Latin (Western) Europe', NULL, '', '', '', '', '', 0),
(438, 57, 'Introduction—Becoming Modern', 'Introduction—Becoming Modern', NULL, '', '', '', '', '', 0),
(439, 57, 'Romanticism', 'Romanticism', NULL, '', '', '', '', '', 0),
(440, 57, 'Early photography', 'Early photography', NULL, '', '', '', '', '', 0),
(441, 57, 'Victorian art & architecture', 'Victorian art & architecture', NULL, '', '', '', '', '', 0),
(442, 57, 'The avant-garde', 'The avant-garde', NULL, '', '', '', '', '', 0),
(443, 57, 'Symbolism & Art Nouveau', 'Symbolism & Art Nouveau', NULL, '', '', '', '', '', 0),
(444, 57, 'Russia: The Peredvizhniki (The Wanderers)', 'Russia: The Peredvizhniki (The Wanderers)', NULL, '', '', '', '', '', 0),
(445, 58, 'Polynesia', 'Polynesia', NULL, '', '', '', '', '', 0),
(446, 58, 'Melanesia', 'Melanesia', NULL, '', '', '', '', '', 0),
(447, 58, 'Micronesia', 'Micronesia', NULL, '', '', '', '', '', 0),
(448, 59, 'A beginner''s guide to the art of Islam', 'A beginner''s guide to the art of Islam', NULL, '', '', '', '', '', 0),
(449, 59, 'Early period', 'Early period', NULL, '', '', '', '', '', 0),
(450, 59, 'Medieval period', 'Medieval period', NULL, '', '', '', '', '', 0),
(451, 59, 'Late period', 'Late period', NULL, '', '', '', '', '', 0),
(452, 60, 'A beginner''s guide to 20th century art', 'A beginner''s guide to 20th century art', NULL, '', '', '', '', '', 0),
(453, 60, 'Early abstraction', 'Early abstraction', NULL, '', '', '', '', '', 0),
(454, 60, 'World War I, Futurism & Dada', 'World War I, Futurism & Dada', NULL, '', '', '', '', '', 0),
(455, 60, 'The avant-garde & the rise of totalitarianism', 'The avant-garde & the rise of totalitarianism', NULL, '', '', '', '', '', 0),
(456, 60, 'Figuration & abstraction in post-war Britain', 'Figuration & abstraction in post-war Britain', NULL, '', '', '', '', '', 0),
(457, 60, 'Abstract Expressionism & the NY School', 'Abstract Expressionism & the NY School', NULL, '', '', '', '', '', 0),
(458, 60, 'Pop', 'Pop', NULL, '', '', '', '', '', 0),
(459, 60, 'Minimalism & Earthworks', 'Minimalism & Earthworks', NULL, '', '', '', '', '', 0),
(460, 60, 'Architecture & design', 'Architecture & design', NULL, '', '', '', '', '', 0),
(461, 63, 'Intro to JS: Drawing & Animation', 'Intro to JS: Drawing & Animation', NULL, '', '', '', '', '', 0),
(462, 63, 'Intro to HTML/CSS: Making webpages', 'Intro to HTML/CSS: Making webpages', NULL, '', '', '', '', '', 0),
(463, 63, 'Intro to SQL: Querying & managing data', 'Intro to SQL: Querying & managing data', NULL, '', '', '', '', '', 0),
(464, 63, 'Advanced JS: Games & Visualizations', 'Advanced JS: Games & Visualizations', NULL, '', '', '', '', '', 0),
(465, 63, 'Advanced JS: Natural Simulations', 'Advanced JS: Natural Simulations', NULL, '', '', '', '', '', 0),
(466, 63, 'HTML/JS: Making webpages interactive', 'HTML/JS: Making webpages interactive', NULL, '', '', '', '', '', 0),
(467, 63, 'HTML/JS: jQuery', 'HTML/JS: jQuery', NULL, '', '', '', '', '', 0),
(468, 64, 'Algorithms', 'Algorithms', NULL, '', '', '', '', '', 0),
(469, 64, 'Journey into cryptography', 'Journey into cryptography', NULL, '', '', '', '', '', 0),
(470, 64, 'Journey into information theory', 'Journey into information theory', NULL, '', '', '', '', '', 0),
(471, 64, 'Internet 101', 'Internet 101', NULL, '', '', '', '', '', 0),
(472, 74, 'Full-length SAT', 'Full-length SAT', NULL, '', '', '', '', '', 0),
(473, 74, 'SAT Math practice', 'SAT Math practice', NULL, '', '', '', '', '', 0),
(474, 74, 'SAT Reading & Writing practice', 'SAT Reading & Writing practice', NULL, '', '', '', '', '', 0),
(475, 75, 'Math', 'Math', NULL, '', '', '', '', '', 0),
(476, 75, 'Reading & Writing', 'Reading & Writing', NULL, '', '', '', '', '', 0),
(477, 73, 'Critical analysis', 'Critical analysis', NULL, '', '', '', '', '', 0),
(478, 73, 'Living Systems Passages', 'Living Systems Passages', NULL, '', '', '', '', '', 0),
(479, 73, 'Biological Systems Passages', 'Biological Systems Passages', NULL, '', '', '', '', '', 0),
(480, 73, 'Behaviors Passages', 'Behaviors Passages', NULL, '', '', '', '', '', 0),
(481, 73, 'Biomolecules', 'Biomolecules', NULL, '', '', '', '', '', 0),
(482, 73, 'Cells', 'Cells', NULL, '', '', '', '', '', 0),
(483, 73, 'Organ systems', 'Organ systems', NULL, '', '', '', '', '', 0),
(484, 73, 'Physical processes', 'Physical processes', NULL, '', '', '', '', '', 0),
(485, 73, 'Chemical processes', 'Chemical processes', NULL, '', '', '', '', '', 0),
(486, 73, 'Processing the environment', 'Processing the environment', NULL, '', '', '', '', '', 0),
(487, 73, 'Behavior', 'Behavior', NULL, '', '', '', '', '', 0),
(488, 73, 'Individuals & society', 'Individuals & society', NULL, '', '', '', '', '', 0),
(489, 73, 'Society & culture', 'Society & culture', NULL, '', '', '', '', '', 0),
(490, 73, 'Social inequality', 'Social inequality', NULL, '', '', '', '', '', 0),
(491, 76, 'Problem Solving', 'Problem Solving', NULL, '', '', '', '', '', 0),
(492, 76, 'Data sufficiency', 'Data sufficiency', NULL, '', '', '', '', '', 0),
(493, 77, 'IIT JEE', 'IIT JEE', NULL, '', '', '', '', '', 0),
(494, 78, 'NCLEX-RN practice questions', 'NCLEX-RN practice questions', NULL, '', '', '', '', '', 0),
(495, 78, 'Circulatory system physiology', 'Circulatory system physiology', NULL, '', '', '', '', '', 0),
(496, 78, 'Circulatory system diseases', 'Circulatory system diseases', NULL, '', '', '', '', '', 0),
(497, 78, 'Respiratory system physiology', 'Respiratory system physiology', NULL, '', '', '', '', '', 0),
(498, 78, 'Respiratory system diseases', 'Respiratory system diseases', NULL, '', '', '', '', '', 0),
(499, 78, 'Hematologic system diseases', 'Hematologic system diseases', NULL, '', '', '', '', '', 0),
(500, 78, 'Endocrine system physiology', 'Endocrine system physiology', NULL, '', '', '', '', '', 0),
(501, 78, 'Endocrine system diseases', 'Endocrine system diseases', NULL, '', '', '', '', '', 0),
(502, 78, 'Lymphatic system physiology', 'Lymphatic system physiology', NULL, '', '', '', '', '', 0),
(503, 78, 'Immune system physiology', 'Immune system physiology', NULL, '', '', '', '', '', 0),
(504, 78, 'Renal system physiology', 'Renal system physiology', NULL, '', '', '', '', '', 0),
(505, 78, 'Gastrointestinal system physiology', 'Gastrointestinal system physiology', NULL, '', '', '', '', '', 0),
(506, 78, 'Gastrointestinal system diseases', 'Gastrointestinal system diseases', NULL, '', '', '', '', '', 0),
(507, 78, 'Muscular-skeletal system physiology', 'Muscular-skeletal system physiology', NULL, '', '', '', '', '', 0),
(508, 78, 'Muscular-skeletal diseases', 'Muscular-skeletal diseases', NULL, '', '', '', '', '', 0),
(509, 78, 'Nervous system physiology', 'Nervous system physiology', NULL, '', '', '', '', '', 0),
(510, 78, 'Nervous system diseases', 'Nervous system diseases', NULL, '', '', '', '', '', 0),
(511, 78, 'Integumentary system physiology', 'Integumentary system physiology', NULL, '', '', '', '', '', 0),
(512, 78, 'Reproductive system physiology', 'Reproductive system physiology', NULL, '', '', '', '', '', 0),
(513, 78, 'Infectious diseases', 'Infectious diseases', NULL, '', '', '', '', '', 0),
(514, 78, 'Mental health', 'Mental health', NULL, '', '', '', '', '', 0),
(515, 79, 'CAHSEE', 'CAHSEE', NULL, '', '', '', '', '', 0),
(516, 80, 'Intro to cultures & religions', 'Intro to cultures & religions', NULL, '', '', '', '', '', 0),
(517, 80, 'Global prehistory: 30,000-500 B.C.E.', 'Global prehistory: 30,000-500 B.C.E.', NULL, '', '', '', '', '', 0),
(518, 80, 'Ancient Mediterranean: 3500 B.C.E.-300 C.E.', 'Ancient Mediterranean: 3500 B.C.E.-300 C.E.', NULL, '', '', '', '', '', 0),
(519, 80, 'Early Europe & Colonial Americas', 'Early Europe & Colonial Americas', NULL, '', '', '', '', '', 0),
(520, 80, 'Later Europe & Americas: 1750-1980 C.E.', 'Later Europe & Americas: 1750-1980 C.E.', NULL, '', '', '', '', '', 0),
(521, 80, 'Indigenous Americas', 'Indigenous Americas', NULL, '', '', '', '', '', 0),
(522, 80, 'Africa: 1100-1980 C.E.', 'Africa: 1100-1980 C.E.', NULL, '', '', '', '', '', 0),
(523, 80, 'West & central Asia: 500 B.C.E.-1980 C.E.', 'West & central Asia: 500 B.C.E.-1980 C.E.', NULL, '', '', '', '', '', 0),
(524, 80, 'South, East & Southeast Asia', 'South, East & Southeast Asia', NULL, '', '', '', '', '', 0),
(525, 80, 'The Pacific', 'The Pacific', NULL, '', '', '', '', '', 0),
(526, 80, 'Global contemporary: 1980-present', 'Global contemporary: 1980-present', NULL, '', '', '', '', '', 0),
(529, 94, 'Graphics', 'Graphics', NULL, '', '', '', '', '', 0),
(532, 94, 'Architect', 'Architect', NULL, '', '', '', '', '', 0),
(533, 532, 'Select', 'Select', NULL, '', '', '', '', '', 0),
(534, 533, 'Basket Ball', 'Basket Ball', NULL, '', '', '', '', '', 0),
(535, 533, 'Hockey', 'Hockey', NULL, '', '', '', '', '', 0),
(536, 533, 'Foot Ball', 'Foot Ball', NULL, '', '', '', '', '', 0),
(537, 533, 'Cricket', 'Cricket', NULL, '', '', '', '', '', 0),
(549, 546, 'Grade11', 'Grade11', NULL, '', '', '', '', 'download-114539796851458648080.png', 0),
(550, 549, 'Grade12', 'Grade12', NULL, '', '', '', '', 'brain-hover14543929181458648172.png', 0),
(554, 553, 't1', 't1', NULL, '', '', '', '', 'brain-hover14539813561458705027.png', 0),
(555, 554, 'sub10 5th', 'sub10 5th', NULL, '', '', '', '', 'brain-hover14539813561458705079.png', 0),
(556, 555, '123', '123', NULL, '', '', '', '', 'brain-hover14543909501458705092.png', 0),
(558, 545, 'Grade1', 'Grade1', NULL, '', '', '', '', NULL, 0),
(559, 544, 'Math', 'Math', NULL, '', '', '', '', NULL, 0),
(560, 559, 'Grade1', 'Grade1', NULL, '', '', '', '', NULL, 0),
(561, 559, 'Grade2', 'Grade2', NULL, '', '', '', '', NULL, 0),
(562, 0, 'Teaching', 'Teaching', 'تعليم', '', '', '', '', 'school_(3)1461740742.png', 0),
(564, 563, 'Grade1', 'Grade1', NULL, '', '', '', '', NULL, 0),
(565, 563, 'Grade2', 'Grade2', NULL, '', '', '', '', NULL, 0),
(566, 562, 'Math', 'Math', NULL, '', '', '', '', NULL, 0),
(568, 0, 'Party Organizer ', 'Party Organizer ', 'حزب منظم', '', '', '', '', 'woman-with-headphones1461743400.png', 0),
(569, 0, 'Businesses ', 'Businesses ', 'الأعمال', '', '', '', '', 'money1461743744.png', 0),
(570, 1, 'Ballet', 'Ballet', 'رقص الباليه', '', '', '', '', NULL, 0),
(571, 1, 'Swimming', 'Swimming', 'سباحة', '', '', '', '', NULL, 0),
(572, 1, 'Karate', 'Karate', 'الكاراتيه', '', '', '', '', NULL, 0),
(573, 1, 'MMA', 'MMA', 'مجلس العمل المتحد', '', '', '', '', NULL, 0),
(574, 1, 'Gymnastics', 'Gymnastics', 'رياضة بدنية', '', '', '', '', NULL, 0),
(576, 562, 'Religion', 'Religion', NULL, '', '', '', '', NULL, 0),
(577, 562, 'Physics', 'Physics', NULL, '', '', '', '', NULL, 0),
(578, 562, 'Chemist', 'Chemist', NULL, '', '', '', '', NULL, 0),
(579, 562, 'Language', 'Language', NULL, '', '', '', '', NULL, 0),
(580, 562, 'Business', 'Business', NULL, '', '', '', '', NULL, 0),
(581, 562, 'Law', 'Law', NULL, '', '', '', '', NULL, 0),
(582, 579, 'Arabic', 'Arabic', NULL, '', '', '', '', NULL, 0),
(583, 579, 'English', 'English', NULL, '', '', '', '', NULL, 0),
(584, 579, 'French', 'French', NULL, '', '', '', '', NULL, 0),
(585, 579, 'Spanish', 'Spanish', NULL, '', '', '', '', NULL, 0),
(586, 579, 'Japanese', 'Japanese', NULL, '', '', '', '', NULL, 0),
(587, 579, 'Chinese', 'Chinese', NULL, '', '', '', '', NULL, 0),
(588, 579, 'Turkish', 'Turkish', NULL, '', '', '', '', NULL, 0),
(589, 579, 'Indian', 'Indian', NULL, '', '', '', '', NULL, 0),
(590, 566, 'Algebra', 'Algebra', NULL, '', '', '', '', NULL, 0),
(591, 566, 'Mathematics', 'Mathematics', NULL, '', '', '', '', NULL, 0),
(592, 576, 'Islam', 'Islam', NULL, '', '', '', '', NULL, 0),
(593, 576, 'Christianity', 'Christianity', NULL, '', '', '', '', NULL, 0),
(594, 582, 'Grammar', 'Grammar', NULL, '', '', '', '', NULL, 0),
(595, 582, 'Reading', 'Reading', NULL, '', '', '', '', NULL, 0),
(596, 582, 'Writing', 'Writing', NULL, '', '', '', '', NULL, 0),
(597, 582, 'Speaking', 'Speaking', NULL, '', '', '', '', NULL, 0),
(598, 583, 'Grammar', 'Grammar', NULL, '', '', '', '', NULL, 0);
INSERT INTO `tblskills` (`skill_id`, `parent`, `skill_description`, `skill_description_en`, `skill_description_ar`, `skill_description_zh`, `skill_description_es`, `skill_description_fr`, `skill_description_hi`, `img_icon`, `priority`) VALUES
(599, 583, 'Reading', 'Reading', NULL, '', '', '', '', NULL, 0),
(600, 583, 'Writing', 'Writing', NULL, '', '', '', '', NULL, 0),
(601, 583, 'Speaking', 'Speaking', NULL, '', '', '', '', NULL, 0),
(602, 584, 'Grammar', 'Grammar', NULL, '', '', '', '', NULL, 0),
(603, 584, 'Reading', 'Reading', NULL, '', '', '', '', NULL, 0),
(604, 584, 'Writing', 'Writing', NULL, '', '', '', '', NULL, 0),
(605, 584, 'Speaking', 'Speaking', NULL, '', '', '', '', NULL, 0),
(606, 585, 'Grammar', 'Grammar', NULL, '', '', '', '', NULL, 0),
(607, 585, 'Reading', 'Reading', NULL, '', '', '', '', NULL, 0),
(608, 585, 'Writing', 'Writing', NULL, '', '', '', '', NULL, 0),
(609, 585, 'Speaking', 'Speaking', NULL, '', '', '', '', NULL, 0),
(610, 586, 'Grammar', 'Grammar', NULL, '', '', '', '', NULL, 0),
(611, 586, 'Reading', 'Reading', NULL, '', '', '', '', NULL, 0),
(612, 586, 'Writing', 'Writing', NULL, '', '', '', '', NULL, 0),
(613, 586, 'Speaking', 'Speaking', NULL, '', '', '', '', NULL, 0),
(615, 590, 'Grade 1', 'Grade 1', NULL, '', '', '', '', NULL, 0),
(616, 590, 'Grade 2', 'Grade 2', NULL, '', '', '', '', NULL, 0),
(617, 590, 'Grade 3', 'Grade 3', NULL, '', '', '', '', NULL, 0),
(618, 590, 'Grade 4', 'Grade 4', NULL, '', '', '', '', NULL, 0),
(619, 590, 'Grade 5', 'Grade 5', NULL, '', '', '', '', NULL, 0),
(620, 590, 'Grade 6', 'Grade 6', NULL, '', '', '', '', NULL, 0),
(621, 590, 'Grade 7', 'Grade 7', NULL, '', '', '', '', NULL, 0),
(622, 590, 'Grade 8', 'Grade 8', NULL, '', '', '', '', NULL, 0),
(623, 590, 'Grade 9', 'Grade 9', NULL, '', '', '', '', NULL, 0),
(624, 590, 'Grade 10', 'Grade 10', NULL, '', '', '', '', NULL, 0),
(625, 590, 'Grade 11', 'Grade 11', NULL, '', '', '', '', NULL, 0),
(626, 590, 'Grade 12', 'Grade 12', NULL, '', '', '', '', NULL, 0),
(627, 590, 'High School', 'High School', NULL, '', '', '', '', NULL, 0),
(628, 590, 'College', 'College', NULL, '', '', '', '', NULL, 0),
(629, 581, 'Criminal Law', 'Criminal Law', NULL, '', '', '', '', NULL, 0),
(630, 581, 'Business Law', 'Business Law', NULL, '', '', '', '', NULL, 0),
(631, 581, 'International Law', 'International Law', NULL, '', '', '', '', NULL, 0),
(632, 581, 'General Law', 'General Law', NULL, '', '', '', '', NULL, 0),
(633, 581, 'Civil Law', 'Civil Law', NULL, '', '', '', '', NULL, 0),
(634, 580, 'Accounting ', 'Accounting ', NULL, '', '', '', '', NULL, 0),
(635, 592, 'Quran', 'Quran', NULL, '', '', '', '', NULL, 0),
(636, 592, 'Figh', 'Figh', NULL, '', '', '', '', NULL, 0),
(637, 568, 'Birthday', 'Birthday', NULL, '', '', '', '', NULL, 0),
(638, 568, 'wedding', 'wedding', NULL, '', '', '', '', NULL, 0),
(639, 568, 'Funeral', 'Funeral', NULL, '', '', '', '', NULL, 0),
(640, 568, 'Business Conference', 'Business Conference', NULL, '', '', '', '', NULL, 0),
(641, 568, 'Graduation party', 'Graduation party', NULL, '', '', '', '', NULL, 0),
(642, 637, 'Age1 to 5', 'Age1 to 5', NULL, '', '', '', '', NULL, 0),
(643, 637, 'Age 6 to 12', 'Age 6 to 12', NULL, '', '', '', '', NULL, 0),
(644, 637, 'Age 13 to17', 'Age 13 to17', NULL, '', '', '', '', NULL, 0),
(645, 637, 'Age 18 to 21', 'Age 18 to 21', NULL, '', '', '', '', NULL, 0),
(646, 637, 'Over 21', 'Over 21', NULL, '', '', '', '', NULL, 0),
(647, 642, 'Clown', 'Clown', NULL, '', '', '', '', NULL, 0),
(648, 642, 'Games', 'Games', NULL, '', '', '', '', NULL, 0),
(649, 643, 'Games', 'Games', NULL, '', '', '', '', NULL, 0),
(650, 646, 'DJ', 'DJ', NULL, '', '', '', '', NULL, 0),
(651, 646, 'Singer', 'Singer', NULL, '', '', '', '', NULL, 0),
(652, 94, 'Interior', 'Interior', NULL, '', '', '', '', NULL, 0),
(653, 95, 'clothes ', 'clothes ', NULL, '', '', '', '', NULL, 0),
(654, 6, 'Weight Lifting', 'Weight Lifting', 'رفع الاثقال', '', '', '', '', NULL, 0),
(655, 654, 'Beginner', 'Beginner', NULL, '', '', '', '', NULL, 0),
(656, 654, 'Advance', 'Advance', NULL, '', '', '', '', NULL, 0),
(657, 654, 'Professional', 'Professional', NULL, '', '', '', '', NULL, 0),
(658, 6, 'Fitness ', 'Fitness ', 'اللياقه البدنيه', '', '', '', '', NULL, 0),
(659, 658, 'Beginner', 'Beginner', NULL, '', '', '', '', NULL, 0),
(660, 658, 'Advance', 'Advance', NULL, '', '', '', '', NULL, 0),
(661, 658, 'Professional', 'Professional', NULL, '', '', '', '', NULL, 0),
(662, 638, 'Engagment Party', 'Engagment Party', NULL, '', '', '', '', NULL, 0),
(663, 662, 'Singer', 'Singer', NULL, '', '', '', '', NULL, 0),
(664, 662, 'Decoration ', 'Decoration ', NULL, '', '', '', '', NULL, 0),
(665, 662, 'Invitation cards', 'Invitation cards', NULL, '', '', '', '', NULL, 0),
(666, 662, 'Food And Beverage ', 'Food And Beverage ', NULL, '', '', '', '', NULL, 0),
(667, 662, 'waiters', 'waiters', NULL, '', '', '', '', NULL, 0),
(668, 644, 'Games', 'Games', NULL, '', '', '', '', NULL, 0),
(669, 645, 'Games', 'Games', NULL, '', '', '', '', NULL, 0),
(670, 645, 'D J', 'D J', NULL, '', '', '', '', NULL, 0),
(671, 638, 'Divorce ', 'Divorce ', NULL, '', '', '', '', NULL, 0),
(672, 638, 'Wedding', 'Wedding', NULL, '', '', '', '', NULL, 0),
(673, 672, 'Singer', 'Singer', NULL, '', '', '', '', NULL, 0),
(674, 672, 'Decoration ', 'Decoration ', NULL, '', '', '', '', NULL, 0),
(675, 569, 'Accounting ', 'Accounting ', NULL, '', '', '', '', NULL, 0),
(676, 569, 'Secretary', 'Secretary', NULL, '', '', '', '', NULL, 0),
(677, 569, 'Office Manger ', 'Office Manger ', NULL, '', '', '', '', NULL, 0),
(678, 569, 'I.T.', 'I.T.', NULL, '', '', '', '', NULL, 0),
(679, 569, 'Government Relations', 'Government Relations', NULL, '', '', '', '', NULL, 0),
(681, 569, 'Marketing', 'Marketing', NULL, '', '', '', '', NULL, 0),
(682, 3, 'Nurses', 'Nurses', 'الممرضات', '', '', '', '', NULL, 0),
(683, 38, 'Cardiologist ', 'Cardiologist ', NULL, '', '', '', '', NULL, 0),
(684, 38, 'Pediatrician ', 'Pediatrician ', NULL, '', '', '', '', NULL, 0),
(685, 38, 'Orthpoedic', 'Orthpoedic', NULL, '', '', '', '', NULL, 0),
(686, 38, 'Gynecologist ', 'Gynecologist ', NULL, '', '', '', '', NULL, 0),
(687, 2, 'Engagment Party', 'Engagment Party', 'حفل خطوبة', '', '', '', '', NULL, 0),
(688, 2, 'Funeral', 'Funeral', 'جنازة', '', '', '', '', NULL, 0),
(689, 2, 'Business Conference', 'Business Conference', 'مؤتمر رجال الأعمال', '', '', '', '', NULL, 0),
(690, 2, 'Birthday', 'Birthday', 'تاريخ الميلاد', '', '', '', '', NULL, 0),
(691, 26, 'Video filming', 'Video filming', NULL, '', '', '', '', NULL, 0),
(692, 3, 'Physician', 'Physician', 'الطبيب المعالج', '', '', '', '', NULL, 0),
(693, 86, 'Criminal Lawyer', 'Criminal Lawyer', NULL, '', '', '', '', NULL, 0),
(694, 86, 'Business Lawyer', 'Business Lawyer', NULL, '', '', '', '', NULL, 0),
(695, 86, 'International Lawyer', 'International Lawyer', NULL, '', '', '', '', NULL, 0),
(696, 86, 'General Lawyer', 'General Lawyer', NULL, '', '', '', '', NULL, 0),
(697, 86, 'Civil Lawer', 'Civil Lawer', NULL, '', '', '', '', NULL, 0),
(698, 683, 'consultant ', 'consultant ', NULL, '', '', '', '', NULL, 0),
(699, 683, 'Specialist', 'Specialist', NULL, '', '', '', '', NULL, 0),
(700, 684, 'Consultant ', 'Consultant ', NULL, '', '', '', '', NULL, 0),
(701, 684, 'Specialist', 'Specialist', NULL, '', '', '', '', NULL, 0),
(702, 685, 'Consultant ', 'Consultant ', NULL, '', '', '', '', NULL, 0),
(703, 685, 'Specialist', 'Specialist', NULL, '', '', '', '', NULL, 0),
(704, 686, 'Consultant ', 'Consultant ', NULL, '', '', '', '', NULL, 0),
(705, 686, 'Specialist', 'Specialist', NULL, '', '', '', '', NULL, 0),
(706, 591, 'Grade 1', 'Grade 1', NULL, '', '', '', '', NULL, 0),
(707, 591, 'Grade 2', 'Grade 2', NULL, '', '', '', '', NULL, 0),
(708, 675, 'Consultant ', 'Consultant ', NULL, '', '', '', '', NULL, 0),
(709, 675, 'Data Entry', 'Data Entry', NULL, '', '', '', '', NULL, 0),
(710, 81, 'Hire care', 'Hire care', NULL, '', '', '', '', NULL, 0),
(711, 81, 'Body care', 'Body care', NULL, '', '', '', '', NULL, 0),
(712, 81, 'Skin care ', 'Skin care ', NULL, '', '', '', '', NULL, 0),
(713, 710, 'Coloer', 'Coloer', NULL, '', '', '', '', NULL, 0),
(714, 710, 'Cuts', 'Cuts', NULL, '', '', '', '', NULL, 0),
(715, 713, 'HighLight', 'HighLight', NULL, '', '', '', '', NULL, 0),
(717, 710, 'Extensions ', 'Extensions ', NULL, '', '', '', '', NULL, 0),
(718, 713, 'Full', 'Full', NULL, '', '', '', '', NULL, 0),
(719, 714, 'Long', 'Long', NULL, '', '', '', '', NULL, 0),
(720, 714, 'Short', 'Short', NULL, '', '', '', '', NULL, 0),
(721, 714, 'Style', 'Style', NULL, '', '', '', '', NULL, 0),
(722, 714, 'Hire Dryer', 'Hire Dryer', NULL, '', '', '', '', NULL, 0),
(723, 717, 'Natural', 'Natural', NULL, '', '', '', '', NULL, 0),
(726, 0, 'testing skill', 'testing skill', 'اختبار المهارات', '', '', '', '', NULL, 0),
(727, 0, 'Friendly', 'Friendly', 'ودود', '', '', '', '', NULL, 0),
(728, 1, 'Neat and clean', 'Neat and clean', 'أنيق ونظيف', '', '', '', '', NULL, 0),
(729, 8, 'testing sub category', 'testing sub category', 'فئة فرعية اختبار', '', '', '', '', NULL, 0),
(730, 6, 'testing sub category', 'testing sub category', 'فئة فرعية اختبار', '', '', '', '', NULL, 0),
(731, 726, 'testing1', 'testing1', 'اختبار 1', '', '', '', '', NULL, 0),
(732, 731, 'testing subcategory 1', 'testing subcategory 1', 'اختبار فرعية 1', '', '', '', '', NULL, 0),
(733, 732, 'testing sub subcategory 1', 'testing sub subcategory 1', 'اختبار الفرعية فرعية 1', '', '', '', '', NULL, 0),
(734, 732, 'testing sub subcategory 2', 'testing sub subcategory 2', 'اختبار الفرعية فرعية 2', '', '', '', '', NULL, 0),
(739, 0, 'Drawing Test Skill 1', 'Drawing Test Skill 1', 'رسم اختبار المهارة 1', '绘制应试技能1', ' Dibujo Prueba de Habilidad 1', '', '', NULL, 0),
(740, 739, 'Drawing Test Category', 'Drawing Test Category', 'رسم اختبار الفئة', ' 绘图测试分类', ' Dibujo Categoría de prueba', '', '', NULL, 0),
(741, 740, 'Drawing Test sub Category', 'Drawing Test sub Category', 'رسم اختبار التصنيف الفرعي', ' 绘图测试子分类', 'Dibujo prueba sub Categoría', '', '', NULL, 0),
(742, 741, 'Drawing Test sub sub Category', 'Drawing Test sub sub Category', 'رسم الاختبار فرعية الفرعية الفئة', ' 绘图测试子子分类', 'Dibujo prueba sub sub Categoría', '', '', NULL, 0),
(743, 741, 'Drawing Test sub sub Category 2', 'Drawing Test sub sub Category 2', 'رسم الاختبار دون الفئة الفرعية 2', ' 绘图测试子子类别2', ' Dibujo sub prueba sub categoría 2', '', '', NULL, 0),
(744, 739, 'Drawing Test Category 1', 'Drawing Test Category 1', 'رسم اختبار الفئة 1', ' 绘图测试分类1', 'Dibujo Prueba de la categoría 1', '', '', NULL, 0),
(745, 740, 'Drawing Test sub Category 1', 'Drawing Test sub Category 1', 'رسم اختبار التصنيف الفرعي 1', ' 绘图测试子类别1', 'Dibujo prueba sub categoría 1', '', '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbluserdetails`
--

CREATE TABLE IF NOT EXISTS `tbluserdetails` (
  `user_id` int(11) unsigned NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `user_name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `facebook_id` text,
  `twitter_id` varchar(50) NOT NULL DEFAULT '',
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `dob` date NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `location` text,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL,
  `gender` varchar(10) NOT NULL DEFAULT 'male',
  `profile_pic` varchar(50) DEFAULT '',
  `cover_pic` varchar(100) NOT NULL,
  `college_name` varchar(50) DEFAULT NULL,
  `major` varchar(50) DEFAULT NULL,
  `degree` varchar(50) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `education_level` varchar(50) DEFAULT '',
  `class` varchar(50) NOT NULL DEFAULT '',
  `school_name` varchar(50) DEFAULT '',
  `average_ratings` float NOT NULL DEFAULT '0',
  `hourly_rate` float NOT NULL DEFAULT '0',
  `year_attained` varchar(25) DEFAULT NULL,
  `is_verified` tinyint(4) NOT NULL COMMENT '0 = not verified, 1 = verified'
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluserdetails`
--

INSERT INTO `tbluserdetails` (`user_id`, `type`, `user_name`, `email`, `password`, `facebook_id`, `twitter_id`, `first_name`, `last_name`, `dob`, `phone`, `location`, `latitude`, `longitude`, `gender`, `profile_pic`, `cover_pic`, `college_name`, `major`, `degree`, `experience`, `education_level`, `class`, `school_name`, `average_ratings`, `hourly_rate`, `year_attained`, `is_verified`) VALUES
(1, 1, 'alisha', 'an.narola@narolainfotech.com', 'c41b3d3461db3f23391f3a948d77d3b6', '1234567', '', 'Alisha', 'Narola123', '1990-10-07', NULL, '1-1', '', '', 'female', '1_20160109062154.png', '', 'test', 'SCET', 'Masters', NULL, '', '', NULL, 3.59992, 105.56, '2008', 1),
(2, 2, 'Alisha1', 'an.narola1@narolainfotech.com', '25d55ad283aa400af464c76d713c07ad', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 2.5, 0, NULL, 1),
(3, 1, 'Payal', 'pu.narola@narolainfotech.com', '64d8a47c30f84958c2cc2181e9382f35', '1234567890', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'female', '3_20151224132544.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 2.5, 0, NULL, 1),
(4, 1, 'kd', 'kd.narola@narolainfotech.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 1, 0, NULL, 1),
(5, 1, 'test', 'dsf@sdf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 1),
(6, 1, 'dsfds', 'hk@dsf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(7, 1, 'fd', 'dfgdfg@dsf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(8, 1, 'test1', 'test1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'test', NULL, '0000-00-00', NULL, NULL, '', '', 'male', '8_20151224064816.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(9, 1, 'test1', 'test2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(10, 1, 'test3', 'test3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 2.5, 0, NULL, 0),
(11, 1, 'test4', 'test4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 2.5, 0, NULL, 0),
(12, 1, 'test5', 'test5@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'test5fname', 'test5lname', '1985-11-15', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(13, 1, 'saloni6444', 'saloni@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'saloni', 'patel', '1996-04-14', '89456123', 'Surat', '', '', 'male', '', '', 'Auro', NULL, 'Bachelors', NULL, '', '', NULL, 3.2, 0, NULL, 0),
(14, 1, 'test6', 'test6@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'test6fname', 'test6lname', '1993-12-24', '55258066', 'dsfdsf', '', '', 'male', '', '', 'dsfsdf', 'dsfsdf', 'MD', NULL, '', '', NULL, 0, 0, NULL, 0),
(15, 1, 'alisha', 'alisha@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'Alisha', 'Narola', '1981-01-05', '545358113', 'L''Aquila', '42.399447', '13.525778', 'female', '15_20160503121809.png', '', NULL, NULL, 'PHD', NULL, '', '', NULL, 3.2, 50.5, '2008', 0),
(16, 1, 'test', 'testt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 2, 0, NULL, 0),
(17, 1, 'marry', 'marry@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '17_20160113082742.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 2.2, 0, NULL, 0),
(18, 1, 'maria', 'maria@gmail.com', '20e736eca09b1df940e7f594be3ffa07', '', '', 'Maria', 'Test123', '1983-05-31', '9874561230', 'Azoudange', '48.714128', '6.859980', 'female', '18_20160203131855.png', '', 'SCET', 'hfr', 'JD', NULL, '', '', NULL, 4, 60, NULL, 0),
(19, 1, 'test', 'sdf@sad.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(21, 1, 'gh', 'dfgdfsg@sdf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(23, 1, 'Payal', 'ku.narola@narolainfotech.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(31, 1, 'bk', 'bk@narola.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(32, 1, 'Payal', 'pu2.narola@narolainfotech.com', '', '12345678905', '12345678905', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(59, 1, 'asd', 'sadf@sdf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(60, 1, 'adsf', 'xcv@sdf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(61, 1, 'sadewr', 'sdf@sdf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(62, 1, 'dasf', 'dfsdaf@sdf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'df', 'dsf', '2006-01-05', NULL, NULL, '', '', 'female', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 512, NULL, 0),
(63, 1, 'Payal', 'pk.narola@narolainfotech.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(64, 1, 'saddasf', 'rwt@ewr.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(65, 1, 'abc', 'abc@gmail.com', '25d55ad283aa400af464c76d713c07ad', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(66, 1, 'abcd', 'abcd@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(67, 1, 'test', 'test@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(68, 1, 'vj1', 'vj.narola@narolainfotech.com', 'ccb02a24a4e10cb6d674fbef951d4f02', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(69, 1, 'abcdef', 'abcdef@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(70, 1, 'sdaf', 'dsfsf@sdf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'female', '', '', NULL, NULL, 'None', NULL, '', '', NULL, 0, 0, NULL, 0),
(71, 1, 'mitali', 'mt.narola@narolainfotech.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'Mitali', 'Trivedi', '1989-01-14', '1234567890', 'Surat', '', '', 'female', '71_20160107060231.png', '', 'Clg', 'Maj', 'Masters', NULL, '', '', NULL, 0, 52.6, NULL, 0),
(72, 1, 'kn1', 'kn.narola@narolainfotech.com', '20e736eca09b1df940e7f594be3ffa07', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(73, 1, 'bv1', 'bv.narola@narolainfotech.com', '20e736eca09b1df940e7f594be3ffa07', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(74, 1, 'mm1', 'mm.narola@narolainfotech.com', '20e736eca09b1df940e7f594be3ffa07', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(75, 1, 'asas', 'zxc@sd.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(78, 1, 'hb1', 'hb.narola@narolainfotech.com', '20e736eca09b1df940e7f594be3ffa07', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(79, 1, 'rt1', 'rt.narola@narolainfotech.com', '20e736eca09b1df940e7f594be3ffa07', '', '', 'Rajan', 'Tandel', '2016-01-01', NULL, 'India', '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(80, 1, 'mpa1', 'mpa.narola@narolainfotech.com', '20e736eca09b1df940e7f594be3ffa07', '', '', 'Monish', 'Painter', '2016-01-01', '1234567890', 'India', '', '', 'male', '', '', 'ABC', 'DEF', 'Bachelors', NULL, '', '', NULL, 0, 10, '2010', 0),
(87, 1, 'dk1', 'dk.narola@narolainfotech.com', '20e736eca09b1df940e7f594be3ffa07', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(88, 1, 'vj2', 'vj@gmail.com', '20e736eca09b1df940e7f594be3ffa07', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(89, 1, 'vj2', 'vj2@gmail.com', '20e736eca09b1df940e7f594be3ffa07', '', '', 'V', 'J', '2016-01-01', '12345', 'IND', '', '', 'male', '89_20160109073340.png', '', 'UTU', 'COMP', 'Bachelors', NULL, '', '', NULL, 0, 0, '2014', 0),
(90, 1, 'vj3', 'vj3@gmail.com', '20e736eca09b1df940e7f594be3ffa07', '', '', 'VJ', 'VJ', '0000-00-00', NULL, NULL, '', '', 'male', '90_20160109073616.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(92, 2, 'student', 'student@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'Student', NULL, '1990-01-09', '956554', 'surat', '', '', 'female', '92_20160109075955.png', '', NULL, NULL, 'Graduate Degree', NULL, '', '9th', NULL, 0, 0, '2012', 0),
(93, 2, 'ba', 'bhumika@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(94, 1, 'vj4', 'vj4@gmail.com', '20e736eca09b1df940e7f594be3ffa07', '', '', 'V', 'J', '0000-00-00', NULL, NULL, '', '', 'male', '94_20160111052611.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(95, 1, 'vj5', 'vj5@gmail.com', '20e736eca09b1df940e7f594be3ffa07', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(96, 1, 'vj6', 'vj6@gmail.com', '20e736eca09b1df940e7f594be3ffa07', '', '', 'Vaibhav', 'Jhaveri', '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(97, 1, 'vj7', 'vj7@gmail.com', '20e736eca09b1df940e7f594be3ffa07', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(98, 1, 'vj8', 'vj8@gmail.com', '20e736eca09b1df940e7f594be3ffa07', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(99, 1, 'vj9', 'vj9@gmail.com', 'e19d5cd5af0378da05f63f891c7467af', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(100, 1, 'vj10', 'vj10@gmail.com', '20e736eca09b1df940e7f594be3ffa07', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(101, 1, 'vj11', 'vj11@gmail.com', '20e736eca09b1df940e7f594be3ffa07', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(102, 1, 'vj12', 'vj12@gmail.com', '20e736eca09b1df940e7f594be3ffa07', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(103, 1, 'vj13', 'vj13@gmail.com', '20e736eca09b1df940e7f594be3ffa07', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(104, 1, 'vj14', 'vj14@gmail.com', '2cffcdc7f8dfe1b3a4c0f4a0e42738ed', '', '', NULL, NULL, '0000-00-00', NULL, 'NDE3LCBMYXVuaXUgU3QsIFdhaWtpa2ksIEhvbm9sdWx1LCBISSwgOTY4MTUsIFVuaXRlZCBTdGF0ZXMoVVMp', '21.282778', '-157.829444', 'female', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 3.2, 0, NULL, 0),
(105, 1, 'vj15', 'vj15@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', 'Vaibhav', 'Jhaveri', '0000-00-00', '9632587410', 'S2FuZGFoYXIsIEFmZ2hhbmlzdGFuKEFGKQ==', '30.854854', '65.161203', 'female', '105_20160204110647.png', '', NULL, NULL, 'Bachelors', NULL, '', '', NULL, 3.4, 11, NULL, 0),
(106, 1, 'abdooosh', 'hello@ps.sa', '398bbd37e37bec867f2880357c79ebdd', '', '', 'A', 'S', '1991-02-13', '05564646', '7832, Al Imam Al Hanafi, Jeddah, Makkah, 23434, Saudi Arabia(SA)', '21.564896', '39.165812', 'male', '106_20160922164422.png', 'cover_106_20160909160112.png', 'mbt', 'media', 'Graduate Degree', NULL, '', 'High', NULL, 2.56667, 50, '2005', 0),
(107, 2, 'test1', 'test1@mail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(108, 1, 'hssh', 'haah@jaja.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(110, 1, 'hjjk', 'zsd@dsf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'Sdfsdf', 'Sdfsdfdsf', '1998-01-15', NULL, 'Karnataka', '12.905579', '77.069472', 'female', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(111, 1, 'sadd', 'asas@asd.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, 'NgouniÃ©', '-1.978638', '11.250569', 'female', '111_20160118130921.png', '', 'SCET', 'Computer', 'Bachelors', NULL, '', '', NULL, 0, 50, '2010', 0),
(112, 1, 'saddsx', 'fsd@df.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(113, 1, 'ddsf', 'dsfd@sf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, 'Surat', '21.205445', '72.856164', 'female', '113_20160116065423.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(114, 1, 'maria', 'maria1@gmail.com', 'fe008700f25cb28940ca8ed91b23b354', '', '', NULL, NULL, '0000-00-00', NULL, '\n\n\n', '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 36, NULL, 0),
(115, 1, 'ehjssj', 'hsjs@hdhd.com', 'ef73781effc5774100f87fe2f437a435', '', '', 'tesy', NULL, '0000-00-00', '646464', NULL, '', '', 'male', '', '', 'test', NULL, 'JD', NULL, '', '', NULL, 0, 0, NULL, 0),
(116, 1, 'hsnsjz', 'gshs@jdjd.com', 'a141c47927929bc2d1fb6d336a256df4', '', '', 'test', NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(117, 1, 'jsbdjc', 'jdjdb@jejd.id', 'e99a18c428cb38d5f260853678922e03', '', '', 'Vaibhav', NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(118, 1, 'jdhdbf', 'hdhdhd@jdjdjf.cjc', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(119, 1, 'sdgsdg', 'fgjfj@wfh.dfh', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(120, 1, 'vj16', 'vj16@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(121, 1, 'dstsdt', 'sdgdsg@fbh.fgj', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(122, 2, 'st1', 'st1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '1990-02-05', NULL, 'Surat', '21.143453', '72.810021', 'female', '122_20160122100054.png', '', NULL, NULL, 'Some College', NULL, '', '', NULL, 1.66667, 62, NULL, 0),
(123, 2, 'st2', 'st2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, 'Bikaner', '27.943879', '73.310885', 'female', '123_20160118105745.png', '', NULL, NULL, 'College Degree', NULL, '', 'BE', NULL, 0, 0, '2012', 0),
(124, 2, 'st3', 'st3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, 'Amravati', '20.914358', '77.781764', 'female', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(125, 1, 'vj17', 'vj17@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', 'V', 'J', '2016-01-18', NULL, NULL, '', '', 'male', '', '', NULL, NULL, 'PHD', NULL, '', '', NULL, 0, 0, NULL, 0),
(126, 1, 'hjjk', 'xcv@sad.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(127, 1, 'abc', 'abc1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, 'Santipur', '23.187600', '88.670303', 'female', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 5, NULL, 0),
(128, 1, 'sdfsdf', 'dfdsf@dsz.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, 'Rajkot', '22.417947', '70.882279', 'female', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(129, 1, 'ugug', 'gu@uth.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(130, 2, 'jfjf', 'gugi@f.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(131, 2, 'test_st1', 'test_student@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'Test', 'Student', '1997-01-18', '214548466443', 'Yamunanagar', '30.111483', '77.395560', 'male', '', '', NULL, NULL, NULL, NULL, 'Graduate Degree', '3', NULL, 0, 0, '1908', 0),
(132, 1, 'vj19', 'vj19@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(133, 1, 'hrhd', 'dhdh@jsjs.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, 'Bhavnagar', '21.744814', '72.265827', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(134, 2, 'hbkl', 'sad@dsf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(135, 1, 'hm', 'asd@sadf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(136, 1, 'vj20', 'vj20@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(137, 1, 'ammar', 'amadab80@gmail.com', 'a86f5a41ee3bd59465f4d8573919f36e', '', '', 'Ammar', 'Abduljabbar', '1980-10-23', '+965546774444', 'Jeddah', '21.523415', '39.216341', 'male', '137_20160329144534.png', '', 'Ø§Ù?Ø¯Ù?Ù?Ø§', 'Ø·Ù?Ø§Ø±', 'Graduate Degree', NULL, '', 'Air Plane Captin', NULL, 2.46667, 300, '2000', 1),
(138, 2, 'student ', 'test@ps.sa', '398bbd37e37bec867f2880357c79ebdd', '', '', 'Ggg', 'Ghj', '2009-01-20', '85555', 'Makkah', '21.273238', '39.508039', 'female', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(139, 1, 'hhs', 'bsbs@shje.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, 'Gujarat', '21.095677', '72.991163', 'male', '139_20160120163941.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(140, 1, 'ads', 'sdfsdf@asd.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, 'Ahmednagar', '19.085673', '74.724602', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 5, 0, NULL, 0),
(141, 2, 'saf', 'sdf@df.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(142, 1, 'vj21', 'vj21@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(143, 1, 'vj22', 'vj22@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(144, 1, 'vj23', 'vj23@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(145, 1, 'vj24', 'vj24@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(146, 1, 'vj25', 'vj25@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(147, 1, 'vj26', 'vj26@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, 'Surat', '21.195961', '72.792584', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(148, 2, 'vj30', 'vj30@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', 'Krunal', 'Panchal', '1983-03-28', '9898989898', 'MjQsIFNocmVlIE5pa2V0YW4gU29jaWV0eSwgTmV3IFB1c2hwYWt1bmogU29jaWV0eSwgUGF0ZWwgTmFnYXIsIFN1cmF0LCBHdWphcmF0IDM5NTAwOCwgSW5kaWEu', '21.220611', '72.839149', 'male', '148_20160224083134.png', '', NULL, 'Computer Science', 'Masters', NULL, '', '', NULL, 1.72222, 15, NULL, 0),
(149, 1, 'vj27', 'vj27@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, 'Orientale', '3.5845154', '28.299435', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 4, 10, NULL, 0),
(150, 1, 'jfcu', 'igug@yghv.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(151, 1, 'hfuf', 'kgyfuo@iggi.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(152, 1, 'hdfu', 'jfgi@hdf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(153, 1, 'dsfgf', 'xcvx@dsfg.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, 'Tamanrasset', '22.416602', '1.756595', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(154, 2, 'asd', 'sdfxcv@sdf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(155, 1, 'asda', 'sdfer@sdf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(156, 1, 'asd1', 'sdf@asdasd.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(157, 1, 'sdfd', 'sdf@xf.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(158, 1, 'vj31', 'vj31@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(159, 1, 'vj32', 'vj32@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(160, 1, 'vj33', 'vj33@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, 'Bilma', '19.960070', '11.242205', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 4, 0, NULL, 0),
(161, 1, 'hb5', 'hb5@gmail.com', 'e99a18c428cb38d5f260853678922e03', '', '', NULL, NULL, '0000-00-00', NULL, 'Surat', '21.194356', '72.825664', 'Male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 2.5, 0, NULL, 0),
(163, 1, '@test_narola', 'demo.narolainfotech@gmail.com', '', '1793740234189180', 'D8B0D155-960E-4C66-81DE-4541205EE118', 'narola', 'test', '1977-01-28', NULL, 'Adrar', '24.191115', '-2.283573', 'male', '163_20160128085401.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 50, NULL, 0),
(164, 1, '@vj_narola', '', '', NULL, '673CDF1F-9AB4-4F90-9E52-FCB416B3AE41', NULL, NULL, '0000-00-00', NULL, 'Adrar', '19.298270', '3.337530', 'male', '164_20160128102637.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(165, 1, '@vj_narola', '', '', NULL, '3306536399', NULL, NULL, '0000-00-00', NULL, 'Namentenga', '12.717412', '-0.526978', 'male', '165_20160128110346.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(166, 1, 'test_narola', '', '', NULL, '627062476', 'Krunal', 'Panchal', '0000-00-00', '6242589631', 'RHIgVmlrcmFtIFNhcmFiaGFpIFJvYWQsIE5hdmthciBSZXNpZGVuY2UgQ29sb255LCBTdXJhdCwgR3VqYXJhdCwgMzk1MDA5LCBJbmRpYShJTik=', '21.195060', '72.785979', 'male', '166_20160830070922.png', 'cover_166_20160830070839.png', NULL, NULL, NULL, NULL, '', '', NULL, 3.5, 15, NULL, 0),
(167, 1, 'ankur_r_jagani', '', '', NULL, '3890903840', NULL, NULL, '0000-00-00', NULL, 'Sadakpor', '20.7357763', '73.0955224', 'Male', '167_20160129053846.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(168, 1, 'alisha1', 'alf.ff@drd.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(169, 1, 'hjhjk', 'sfdsf@dsf.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(170, 1, 'jbgkjh', 'ndsf@df.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '', NULL, NULL, '0000-00-00', NULL, 'Tasman Sea', '-39.742108', '151.081316', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 3.5, 0, NULL, 0),
(171, 1, 'hjikbk', 'gdsfg@dsf.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(172, 1, 'hj', 'asdasd@sd.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(173, 1, 'hjk ', 'sdd@sdf.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 5, NULL, 0),
(174, 1, 'hkjnjknj', 'dfdsf@dsf.com', '20e736eca09b1df940e7f594be3ffa07', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(175, 2, 'sdds', 'dfg@sdf.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '', NULL, NULL, '0000-00-00', NULL, 'Man Cheung Street, Central, Hong Kong, Hong Kong, Hong Kong(HK)', '22.284681', '114.158177', 'male', '175_20160316114557.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 45, NULL, 0),
(176, 1, 'adsasd', 'sdfzdxcf@sdf.com', '0d009da30dab32e1e27398604d63dd4d', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(177, 1, 'hb15', 'hb15@gmail.com', 'e99a18c428cb38d5f260853678922e03', NULL, '', NULL, NULL, '0000-00-00', NULL, 'Surat', '21.170976', '72.8314331', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(180, 1, 'NarolaDemo', 'demo.narola@gmail.com', '', '909113275831130', '', 'Narola', 'Demo', '1985-12-22', NULL, 'Victoria Road, Sydney, Huntleys Point, NSW, 2111, Australia(AU)', '-33.841366', '151.146935', 'female', '180_20160203075205.png', 'cover_180_20160830090549.png', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(181, 1, 'Monal', 'mg.narola@narolainfotech.com', 'a8b4fab1bed511ab6850908c72c547c9', NULL, '', 'Monal', 'Godiwala', '1990-12-23', '1234567890', 'Surat', '21.168605', '72.8349062', 'male', '181_20160204113101.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 15, NULL, 0),
(182, 1, 'Mital', 'ml.narola@narolainfotech.com', 'a8b4fab1bed511ab6850908c72c547c9', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(183, 1, 'aaaa', 'aa@hsh.com', 'e99a18c428cb38d5f260853678922e03', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '183_20160204062357.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(184, 1, 'aaa', 'jsjs@jsjs.com', '9cbf8a4dcb8e30682b927f352d6559a0', NULL, '', NULL, NULL, '0000-00-00', NULL, 'Portugal', '39.399872', '-8.224454', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(185, 1, 'hb20', 'hb20@mail.com', 'e99a18c428cb38d5f260853678922e03', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(186, 1, 'hb25', 'hb25@gmail.com', 'e99a18c428cb38d5f260853678922e03', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(187, 1, 'Krunal', 'narolainfotech.demo@gmail.com', 'a8b4fab1bed511ab6850908c72c547c9', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(188, 1, 'hb30', 'hb30@gmail.com', 'e99a18c428cb38d5f260853678922e03', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(189, 1, 'hb31', 'hb31@gmail.com', 'e99a18c428cb38d5f260853678922e03', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(190, 1, 'hb32', 'hb32@gmail.com', 'e99a18c428cb38d5f260853678922e03', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(191, 1, 'kpa', 'kpa.narola@narolainfotech.com', 'a8b4fab1bed511ab6850908c72c547c9', NULL, '', 'Krunal', 'Panchal', '2016-04-11', '5289637415', 'U2l2Y2hoYXlhIHNvY2lldHksIFZpc2hhbCBOYWdhciwgU3VyYXQsIEd1amFyYXQgMzk1MDA0LCBJbmRpYS4=', '21.222798', '72.822292', 'male', '191_20160405144926.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 3.25, 254, NULL, 0),
(192, 1, 'asdad', 'asd@asd.com', '0d009da30dab32e1e27398604d63dd4d', NULL, '', NULL, NULL, '0000-00-00', NULL, 'San Fernando', '-34.121870', '-58.403618', 'female', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 0, NULL, 0),
(193, 1, 'aln1', 'aln1@gmail.com', '2cffcdc7f8dfe1b3a4c0f4a0e42738ed', NULL, '', 'Alisha1', 'Narola1', '1984-02-11', '9878994560', 'Smith', '40.386388', '-80.340094', 'female', '193_20160211114352.png', '', NULL, NULL, NULL, NULL, '', '', NULL, 0, 50, NULL, 0),
(194, 1, 'aln2', 'aln2@gmail.com', '2cffcdc7f8dfe1b3a4c0f4a0e42738ed', NULL, '', 'Alisha2', 'Narola2', '1994-02-11', NULL, 'Raton', '36.586245', '-104.682525', 'female', '194_20160212055247.png', '', NULL, NULL, 'Some High School', NULL, '', '11th', NULL, 0, 14, '2015', 0),
(195, 1, 'narola1', 'narola@narola.com', '2cffcdc7f8dfe1b3a4c0f4a0e42738ed', NULL, '', 'Narola', NULL, '1979-02-24', NULL, 'S2FscGFuYSBDaGF3YWxhIFJvYWQsIFJld2EgTmFnYXIsIFN1cmF0LCBHdWphcmF0LCAzOTUwMDksIEluZGlhKElOKQ==', '21.195480', '72.793040', 'female', '195_20160314114121.png', 'cover_195_20160825085815.png', 'clg', 'mjr', 'Bachelors', NULL, '', '2', '', 3.8, 20, '2004', 0),
(196, 1, 'narola3', 'narola2@gmail.com', '2cffcdc7f8dfe1b3a4c0f4a0e42738ed', NULL, '', 'Narola Narola', NULL, '1966-02-15', NULL, 'TGFtYmUgSGFudW1hbiBSb2FkLCBHb2RhdmFyaSBOYWdhciwgU3VyYXQsIEd1amFyYXQsIDM5NTAwOCwgSW5kaWEoSU4p', '21.204097', '72.841043', 'female', '196_20160311121826.png', '', 'Auro', 'BBA', 'Masters', NULL, '', '', '', 2.96, 25, NULL, 0),
(197, 1, 'NarolaMobile Narola', 'narolamobile@gmail.com', '', '580275152136221', '', 'Narola', 'mobile', '0000-00-00', '9638527415', 'Surat', '21.1952288', '72.7914866', 'male', '', '', NULL, 'Masters', NULL, NULL, '', '', '', 0, 15, NULL, 0),
(198, 1, 'narola2', 'narola21@gmail.com', '2cffcdc7f8dfe1b3a4c0f4a0e42738ed', NULL, '', 'Sfdsfjo', NULL, '0000-00-00', NULL, 'Al Kufrah', '24.351248', '20.376497', 'female', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 60, NULL, 0),
(199, 1, 'demo_narola', '', '', NULL, '1285513675', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(200, 1, 'Krunal', 'kpa1@narolainfotech.com', 'd6f9e1f1055a20711e72155755e10e10', NULL, '', 'Krunal', 'Panchal', '0000-00-00', '9638527418', 'Surat', '21.1959873', '72.7934305', 'male', '', '', NULL, 'Computer science', 'Masters', NULL, '', '', '', 0, 14, NULL, 0),
(201, 1, 'narola4', 'narola4@gmail.com', '61bd60c60d9fb60cc8fc7767669d40a1', NULL, '', NULL, NULL, '0000-00-00', NULL, '654545, Adster Banjawarn Melrose Road, Lake Darlot Lane, WA, 64386523132, Australia(AU)', '-27.646037', '121.603771', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(202, 1, 'krunal', 'kpa@gmail.com', '150071a42ed0a72f552038d97e5d4eec', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(203, 1, 'hjgj', 'sdf@ewf.com', '61bd60c60d9fb60cc8fc7767669d40a1', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(204, 1, 'kpaTwitter', 'kpa.twitter@narolainfotech.com', '', NULL, '987564321', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(205, 1, 'kpaFB', 'kpa.facebook@narolainfotech.com', '', '369852147', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(206, 1, 'kppanchal30', '', '', NULL, '3071251604', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(207, 1, 'aaa', 'a@a.a', '61bd60c60d9fb60cc8fc7767669d40a1', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(208, 1, 'Kaushal', 'kaushal@gmail.com', '61bd60c60d9fb60cc8fc7767669d40a1', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(209, 1, 'kamal', 'kamal@gmail.com', '61bd60c60d9fb60cc8fc7767669d40a1', NULL, '', 'Kamal', 'Patel', '0000-00-00', NULL, 'R2hhbmNoaSBTdHJlZXQgTnVtYmVyIDEsIFphbXBhIEJhemFhciwgTWFoaWRoYXJwdXJhLCBCZWdhbXB1cmEsIFN1cmF0LCBHdWphcmF0IDM5NTAwMywgSW5kaWEu', '21.198467', '72.8316592', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 10, NULL, 0),
(210, 1, 'kpa', 'kpa1@gmail.com', 'c7a666d704869acce1012fc3da79318b', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(211, 1, 'narola5', 'narola5@gmail.com', '2cffcdc7f8dfe1b3a4c0f4a0e42738ed', NULL, '', 'Narola', 'Lname', '1981-03-28', '5847585614', 'V2FkaSBBbCBTaGF0aWksIExpYnlhKExZKQ==', '28.274592', '11.845969', 'male', '211_20160328140458.png', '', 'sadas', 'adfsd', 'MD', NULL, '', '', '', 0, 52, '2007', 0),
(212, 1, 'asdad', 'sdfdsf@daf.com', '61bd60c60d9fb60cc8fc7767669d40a1', NULL, '', NULL, NULL, '0000-00-00', NULL, 'Al Zaqaziq, Sharqia, Egypt(EG)', '30.429563', '32.145682', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(213, 1, 'kpa2', 'kpa2@gmail.com', 'c7a666d704869acce1012fc3da79318b', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(214, 1, 'kpa3', 'kpa3@gmail.com', 'c7a666d704869acce1012fc3da79318b', NULL, '', 'Krunal', 'Panchal', '1991-04-05', '9874563215', 'NiwgR2hhbnNoeWFtIE5hZ2FyIFNvY2lldHkgMiwgTWFuamFscHVyLCBWYWRvZGFyYSwgR3VqYXJhdCAzOTAwMTEsIEluZGlhLg==', '22.272233', '73.1880089', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 70, NULL, 0),
(215, 1, 'kpa5', 'kpa5@gmail.com', 'c7a666d704869acce1012fc3da79318b', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(216, 1, 'kpa4', 'kpa4@gmail.com', 'c7a666d704869acce1012fc3da79318b', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(217, 1, 'kpa6', 'kpa6@gmail.com', 'c7a666d704869acce1012fc3da79318b', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(218, 1, 'kpa7', 'kpa7@gmail.com', 'c7a666d704869acce1012fc3da79318b', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(219, 1, 'kpa8', 'kpa8@gmail.com', 'c7a666d704869acce1012fc3da79318b', NULL, '', 'Krunal', 'Panchal', '0000-00-00', NULL, 'RGFsdmlrLCBJY2VsYW5kLg==', '65.9707003', '-18.5326927', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(220, 1, 'employer', 'alisha710@gmail.com', '61bd60c60d9fb60cc8fc7767669d40a1', NULL, '', 'Alisha', 'Narola', '1990-10-07', '9909969779', 'Sri Sarvodaya Nagar, Surat, Gujarat, 395017, India(IN)', '21.169842', '72.816223', 'female', '220_20160503062127.png', '', 'SCET', 'CE', 'Bachelors', NULL, '', '', '', 0, 15, '2012', 0),
(221, 1, 'freelancer', 'test@test.com', '61bd60c60d9fb60cc8fc7767669d40a1', NULL, '', 'test', 'narola', '1966-05-03', NULL, 'Dahin Nagar, Surat, Gujarat, 395005, India(IN)', '21.238587', '72.782068', 'male', '221_20160503062425.png', '', NULL, NULL, NULL, NULL, '', '', '', 0, 25, NULL, 0),
(222, 1, 'pu', 'pu@adsad.com', '61bd60c60d9fb60cc8fc7767669d40a1', NULL, '', NULL, NULL, '0000-00-00', NULL, 'Tamanrasset, Algeria(DZ)', '27.976549', '5.621103', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(223, 1, 'Magdi', 'art.magdi@gmail.com', 'a1c3e5381ee357c436603ca98fbf0c5a', NULL, '', 'Magdi', 'Hamed', '1988-09-09', '00249922099969', 'Khartoum, Sudan(SD)', '15.548680', '33.270639', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 2.6, 0, NULL, 0),
(224, 1, 'Ruchi', 'rur@narola.email', '2cffcdc7f8dfe1b3a4c0f4a0e42738ed', NULL, '', 'Ruchi', 'Rajauria', '1992-06-22', '9876543210', 'Mi8xOTIzLCBNYWhlc2hiaGFpIERlc2FpIE1hcmcsIEFhbmphZGEgTmFnYXIsIFN1cmF0LCBHdWphcmF0LCAzOTUwMDIsIEluZGlhKElOKQ==', '21.182153', '72.823764', 'female', '224_20160825083622.png', 'cover_224_20160825082716.png', 'GTU', 'MCA', 'Masters', NULL, '', '', '', 4.3, 50, '2014', 0),
(225, 1, 'AmmarAbduljabbar', '', '', '1071430036243522', '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 1),
(227, 1, 'apps', 'application4expert@gmail.com', '0610e1ee9ce1fc5d307f7b48f562e6cd', NULL, '', 'Application', 'Expert', '1990-04-01', '9056581353', 'phase 8b, Mohali, Punjab', '30.717529', '76.703497', 'male', '', '', 'Abc', 'CSE', 'Bachelors', NULL, '', '', '', 0, 500, '2012', 0),
(228, 1, 'harishparas', 'harishparas@gmail.com', 'e20f517179e9cd52ae29dae43c121b95', NULL, '', NULL, NULL, '0000-00-00', NULL, NULL, '', '', 'male', '', '', NULL, NULL, NULL, NULL, '', '', '', 0, 0, NULL, 0),
(229, 1, 'AjayKumar', 'ajay.parastechnologies@gmail.com', '', '1711420172517386', '', 'Ajay', 'Kumar', '1987-10-07', '957845464', 'chandigarh', '30.732840', '76.690219', 'male', '229_20161007080514.png', '', NULL, NULL, NULL, NULL, '', '', '', 0, 100, NULL, 0),
(230, 1, 'ajay4991', 'tester@gmail.com', '8281eb1b518c4a9cac6dd22984b19de4', NULL, '', 'Tester', 'Tester', '1998-10-07', '897979789', 'Tselinograd, Kazakhstan(KZ)', '51.995061', '73.626553', 'male', '230_20161007125831.png', '', NULL, NULL, NULL, NULL, '', '', '', 0, 5, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbluserskills`
--

CREATE TABLE IF NOT EXISTS `tbluserskills` (
  `user_skill_id` int(11) unsigned NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `skill_id` text
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluserskills`
--

INSERT INTO `tbluserskills` (`user_skill_id`, `user_id`, `skill_id`) VALUES
(1, 1, '9,10,11,12,13,14,15,16'),
(2, 113, '13,15,21,41,63,31,29'),
(3, 15, '13,15,19,63,64,69'),
(4, 70, '13,15,21,41,63,31,29'),
(5, 71, '9,13,17,27,39,45,47,63'),
(6, 94, '1,2,3,4,5,6'),
(7, 110, '13,15,21,41,63,31,29'),
(8, 104, '9,10,11,12'),
(9, 105, '119,120,121,0'),
(10, 18, '27'),
(11, 128, '13,15,21,41,63,31,29'),
(12, 121, ''),
(13, 125, '9,12,11,10,13,16'),
(14, 127, '13,15,21,41,63,31,29'),
(15, 111, '13,15,21,41,63,31,29'),
(16, 106, '18,22,0,615,647,112'),
(17, 139, '9,10,11,36,22,18,65,35'),
(18, 140, '27,29,31,33,34,32,30,28'),
(19, 142, ''),
(20, 153, '29'),
(21, 149, '9,10,11,12'),
(22, 160, '9'),
(23, 161, '9,10,11,12'),
(25, 163, '9,10,11,12,13,14,15,16'),
(26, 165, '115,114,112,110'),
(27, 167, '88,89,91,11,12,13,15,18,19'),
(28, 170, '0'),
(29, 173, '0'),
(30, 177, '9'),
(31, 180, '11,12,32,33,0,117,118,119'),
(32, 122, '11,12,13,14,15,16'),
(33, 183, '9,11,12'),
(34, 184, '9,11'),
(35, 181, '15,13,19,18,69,64,63,89,91'),
(36, 195, '63,64,83,84,85,88,89,90,91,92,93,115,166,167,534,535,615,0,663,664'),
(37, 196, '29,30,32,33,34,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,0'),
(38, 191, '255,257,259,261,263,265'),
(39, 201, '0,9,10,11,12'),
(40, 166, '29,32,63,64,69,13,14,16,21,0'),
(41, 175, '117'),
(42, 137, '137,141,145,147,0'),
(43, 209, '135,136,140,141'),
(44, 148, '550,135,140,141,142,143,144'),
(45, 211, '117,119'),
(46, 221, '615,616,617,618,619,620,621,622,623,624,625,626,627,628,706,707'),
(47, 222, '615,616'),
(48, 3, ''),
(49, 224, '461,462,463,464,465,466,467,468,469,470,471');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladsimage`
--
ALTER TABLE `tbladsimage`
  ADD PRIMARY KEY (`adimage_id`);

--
-- Indexes for table `tblbankinfo`
--
ALTER TABLE `tblbankinfo`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `tblbanks`
--
ALTER TABLE `tblbanks`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `tblbranches`
--
ALTER TABLE `tblbranches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `tblcomplaints`
--
ALTER TABLE `tblcomplaints`
  ADD PRIMARY KEY (`complaints_id`);

--
-- Indexes for table `tblcountry`
--
ALTER TABLE `tblcountry`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `tblcustomads`
--
ALTER TABLE `tblcustomads`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `tbldevicetoken`
--
ALTER TABLE `tbldevicetoken`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbljobs`
--
ALTER TABLE `tbljobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `tblnotifications`
--
ALTER TABLE `tblnotifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tblreviews`
--
ALTER TABLE `tblreviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tblskills`
--
ALTER TABLE `tblskills`
  ADD PRIMARY KEY (`skill_id`);

--
-- Indexes for table `tbluserdetails`
--
ALTER TABLE `tbluserdetails`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbluserskills`
--
ALTER TABLE `tbluserskills`
  ADD PRIMARY KEY (`user_skill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbladsimage`
--
ALTER TABLE `tbladsimage`
  MODIFY `adimage_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblbankinfo`
--
ALTER TABLE `tblbankinfo`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblbanks`
--
ALTER TABLE `tblbanks`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `tblbranches`
--
ALTER TABLE `tblbranches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tblcomplaints`
--
ALTER TABLE `tblcomplaints`
  MODIFY `complaints_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tblcountry`
--
ALTER TABLE `tblcountry`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tblcustomads`
--
ALTER TABLE `tblcustomads`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbldevicetoken`
--
ALTER TABLE `tbldevicetoken`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1375;
--
-- AUTO_INCREMENT for table `tbljobs`
--
ALTER TABLE `tbljobs`
  MODIFY `job_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=235;
--
-- AUTO_INCREMENT for table `tblnotifications`
--
ALTER TABLE `tblnotifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `payment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tblreviews`
--
ALTER TABLE `tblreviews`
  MODIFY `review_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `tblskills`
--
ALTER TABLE `tblskills`
  MODIFY `skill_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=746;
--
-- AUTO_INCREMENT for table `tbluserdetails`
--
ALTER TABLE `tbluserdetails`
  MODIFY `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=231;
--
-- AUTO_INCREMENT for table `tbluserskills`
--
ALTER TABLE `tbluserskills`
  MODIFY `user_skill_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

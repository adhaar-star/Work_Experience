-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2016 at 05:50 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jarvis-chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('81aa69245a40a2d1cf141517cb0f42b7', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36', 1431291948, 'a:5:{s:9:"user_data";s:0:"";s:14:"selected-theme";s:25:"uikit.almost-flat.min.css";s:15:"download-iframe";i:1;s:22:"articles_limit_counter";i:1;s:11:"filterQuery";s:0:"";}'),
('9ede9f709c5bc9a283ce2c6a78b78bcf', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:37.0) Gecko/20100101 Firefox/37.0', 1431286658, 'a:8:{s:9:"user_data";O:8:"stdClass":18:{s:7:"user_id";s:1:"1";s:11:"currency_id";s:1:"0";s:11:"language_id";s:1:"0";s:10:"country_id";s:1:"0";s:13:"user_username";s:5:"admin";s:7:"type_id";s:1:"0";s:13:"user_password";s:32:"b4c5fe5619a822bb8b35d0e55416bd22";s:10:"user_email";s:24:"php.power.arts@gmail.com";s:8:"user_age";s:0:"";s:12:"user_address";s:0:"";s:10:"user_phone";s:1:"0";s:13:"user_group_id";s:1:"1";s:17:"user_created_date";s:10:"1419078848";s:8:"user_ord";s:1:"0";s:14:"user_is_online";s:1:"1";s:10:"user_state";s:1:"1";s:16:"user_last-update";s:19:"2015-05-10 16:27:35";s:10:"user_photo";s:88:"http://youlevelup.phppowerarts.com/assets/uploads/Users_phppowerarts_PortraitUrl_100.jpg";}s:14:"selected-theme";s:25:"uikit.almost-flat.min.css";s:15:"download-iframe";i:2;s:22:"articles_limit_counter";i:5;s:11:"filterQuery";s:0:"";s:14:"articles_limit";i:120;s:8:"last_url";s:14:"admin/articles";s:16:"last_visited_url";s:40:"http://localhost/youlevelup/articles/185";}');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `gr_id` int(11) NOT NULL,
  `gr_name` varchar(255) NOT NULL,
  `gr_created_date` bigint(20) NOT NULL,
  `gr_ord` int(11) NOT NULL,
  `gr_state` tinyint(1) NOT NULL,
  `gr_last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AVG_ROW_LENGTH=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`gr_id`, `gr_name`, `gr_created_date`, `gr_ord`, `gr_state`, `gr_last_update`) VALUES
(1, 'adminstration', 1385025326, 1, 1, '2014-12-23 09:52:19'),
(3, 'users', 0, 1, 1, '2014-12-23 09:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `group_rights_bridge`
--

CREATE TABLE `group_rights_bridge` (
  `gr_id` int(11) NOT NULL,
  `gr_group_id` int(11) NOT NULL,
  `gr_right_id` int(11) NOT NULL
) ENGINE=MyISAM AVG_ROW_LENGTH=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_rights_bridge`
--

INSERT INTO `group_rights_bridge` (`gr_id`, `gr_group_id`, `gr_right_id`) VALUES
(1, 1, 1),
(2, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `created_date` bigint(20) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `was_helpful` tinyint(4) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `ip`, `email`, `message`, `created_date`, `type`, `was_helpful`, `date`) VALUES
(1, '::1', 'php.power.arts@gmail.com', 'sdfasdfasdf', 1453579988, 0, 0, '0000-00-00'),
(2, '::1', 'php.power.arts@gmail.com', 'Big Sorry My Dear I Cannot understand your message :( \nmy sir will learn my how to answer this message very very soon \nyou can contact my sir here <a href=''mailto:        <script type="text/javascript">\n            //<![CDATA[\n            var l = new Array();\n            l[0] = ''>'';\n            l[1] = ''a'';\n            l[2] = ''/'';\n            l[3] = ''<'';\n            l[4] = ''|109'';\n            l[5] = ''|111'';\n            l[6] = ''|99'';\n            l[7] = ''|46'';\n            l[8] = ''|108'';\n            l[9] = ''|105'';\n            l[10] = ''|97'';\n            l[11] = ''|109'';\n            l[12] = ''|103'';\n            l[13] = ''|64'';\n            l[14] = ''|115'';\n            l[15] = ''|116'';\n            l[16] = ''|114'';\n            l[17] = ''|97'';\n            l[18] = ''|46'';\n            l[19] = ''|114'';\n            l[20] = ''|101'';\n            l[21] = ''|119'';\n            l[22] = ''|111'';\n            l[23] = ''|112'';\n            l[24] = ''|46'';\n            l[25] = ''|112'';\n            l[26] = ''|104'';\n            l[27] = ''|112'';\n            l[28] = ''>'';\n            l[29] = ''"'';\n            l[30] = ''|109'';\n            l[31] = ''|111'';\n            l[32] = ''|99'';\n            l[33] = ''|46'';\n            l[34] = ''|108'';\n            l[35] = ''|105'';\n            l[36] = ''|97'';\n            l[37] = ''|109'';\n            l[38] = ''|103'';\n            l[39] = ''|64'';\n            l[40] = ''|115'';\n            l[41] = ''|116'';\n            l[42] = ''|114'';\n            l[43] = ''|97'';\n            l[44] = ''|46'';\n            l[45] = ''|114'';\n            l[46] = ''|101'';\n            l[47] = ''|119'';\n            l[48] = ''|111'';\n            l[49] = ''|112'';\n            l[50] = ''|46'';\n            l[51] = ''|112'';\n            l[52] = ''|104'';\n            l[53] = ''|112'';\n            l[54] = '':'';\n            l[55] = ''o'';\n            l[56] = ''t'';\n            l[57] = ''l'';\n            l[58] = ''i'';\n            l[59] = ''a'';\n            l[60] = ''m'';\n            l[61] = ''"'';\n            l[62] = ''='';\n            l[63] = ''f'';\n            l[64] = ''e'';\n            l[65] = ''r'';\n            l[66] = ''h'';\n            l[67] = '' '';\n            l[68] = ''a'';\n            l[69] = ''<'';\n            \n            for (var i = l.length - 1; i >= 0; i = i - 1) {\n                if (l[i].substring(0, 1) == ''|'') document.write("&#" + unescape(l[i].substring(1)) + ";");\n                else document.write(unescape(l[i]));\n            }\n            //]]>\n        </script>''>        <script type="text/javascript">\n            //<![CDATA[\n            var l = new Array();\n            l[0] = ''>'';\n            l[1] = ''a'';\n            l[2] = ''/'';\n            l[3] = ''<'';\n            l[4] = ''|109'';\n            l[5] = ''|111'';\n            l[6] = ''|99'';\n            l[7] = ''|46'';\n            l[8] = ''|108'';\n            l[9] = ''|105'';\n            l[10] = ''|97'';\n            l[11] = ''|109'';\n            l[12] = ''|103'';\n            l[13] = ''|64'';\n            l[14] = ''|115'';\n            l[15] = ''|116'';\n            l[16] = ''|114'';\n            l[17] = ''|97'';\n            l[18] = ''|46'';\n            l[19] = ''|114'';\n            l[20] = ''|101'';\n            l[21] = ''|119'';\n            l[22] = ''|111'';\n            l[23] = ''|112'';\n            l[24] = ''|46'';\n            l[25] = ''|112'';\n            l[26] = ''|104'';\n            l[27] = ''|112'';\n            l[28] = ''>'';\n            l[29] = ''"'';\n            l[30] = ''|109'';\n            l[31] = ''|111'';\n            l[32] = ''|99'';\n            l[33] = ''|46'';\n            l[34] = ''|108'';\n            l[35] = ''|105'';\n            l[36] = ''|97'';\n            l[37] = ''|109'';\n            l[38] = ''|103'';\n            l[39] = ''|64'';\n            l[40] = ''|115'';\n            l[41] = ''|116'';\n            l[42] = ''|114'';\n            l[43] = ''|97'';\n            l[44] = ''|46'';\n            l[45] = ''|114'';\n            l[46] = ''|101'';\n            l[47] = ''|119'';\n            l[48] = ''|111'';\n            l[49] = ''|112'';\n            l[50] = ''|46'';\n            l[51] = ''|112'';\n            l[52] = ''|104'';\n            l[53] = ''|112'';\n            l[54] = '':'';\n            l[55] = ''o'';\n            l[56] = ''t'';\n            l[57] = ''l'';\n            l[58] = ''i'';\n            l[59] = ''a'';\n            l[60] = ''m'';\n            l[61] = ''"'';\n            l[62] = ''='';\n            l[63] = ''f'';\n            l[64] = ''e'';\n            l[65] = ''r'';\n            l[66] = ''h'';\n            l[67] = '' '';\n            l[68] = ''a'';\n            l[69] = ''<'';\n            \n            for (var i = l.length - 1; i >= 0; i = i - 1) {\n                if (l[i].substring(0, 1) == ''|'') document.write("&#" + unescape(l[i].substring(1)) + ";");\n                else document.write(unescape(l[i]));\n            }\n            //]]>\n        </script></a> \nor go and open ticket here <a href=''http://codecanyon.net/user/phppowerarts#contact''>Customer Support</a>\n', 1453579988, 0, 0, '0000-00-00'),
(3, '::1', 'php.power.arts@gmail.com', 'asdsadgfdafgsdfghf', 1453580006, 0, 0, '0000-00-00'),
(4, '::1', 'php.power.arts@gmail.com', 'Big Sorry My Dear I Cannot understand your message :( \nmy sir will learn my how to answer this message very very soon \nyou can contact my sir here <a href=''mailto:        <script type="text/javascript">\n            //<![CDATA[\n            var l = new Array();\n            l[0] = ''>'';\n            l[1] = ''a'';\n            l[2] = ''/'';\n            l[3] = ''<'';\n            l[4] = ''|109'';\n            l[5] = ''|111'';\n            l[6] = ''|99'';\n            l[7] = ''|46'';\n            l[8] = ''|108'';\n            l[9] = ''|105'';\n            l[10] = ''|97'';\n            l[11] = ''|109'';\n            l[12] = ''|103'';\n            l[13] = ''|64'';\n            l[14] = ''|115'';\n            l[15] = ''|116'';\n            l[16] = ''|114'';\n            l[17] = ''|97'';\n            l[18] = ''|46'';\n            l[19] = ''|114'';\n            l[20] = ''|101'';\n            l[21] = ''|119'';\n            l[22] = ''|111'';\n            l[23] = ''|112'';\n            l[24] = ''|46'';\n            l[25] = ''|112'';\n            l[26] = ''|104'';\n            l[27] = ''|112'';\n            l[28] = ''>'';\n            l[29] = ''"'';\n            l[30] = ''|109'';\n            l[31] = ''|111'';\n            l[32] = ''|99'';\n            l[33] = ''|46'';\n            l[34] = ''|108'';\n            l[35] = ''|105'';\n            l[36] = ''|97'';\n            l[37] = ''|109'';\n            l[38] = ''|103'';\n            l[39] = ''|64'';\n            l[40] = ''|115'';\n            l[41] = ''|116'';\n            l[42] = ''|114'';\n            l[43] = ''|97'';\n            l[44] = ''|46'';\n            l[45] = ''|114'';\n            l[46] = ''|101'';\n            l[47] = ''|119'';\n            l[48] = ''|111'';\n            l[49] = ''|112'';\n            l[50] = ''|46'';\n            l[51] = ''|112'';\n            l[52] = ''|104'';\n            l[53] = ''|112'';\n            l[54] = '':'';\n            l[55] = ''o'';\n            l[56] = ''t'';\n            l[57] = ''l'';\n            l[58] = ''i'';\n            l[59] = ''a'';\n            l[60] = ''m'';\n            l[61] = ''"'';\n            l[62] = ''='';\n            l[63] = ''f'';\n            l[64] = ''e'';\n            l[65] = ''r'';\n            l[66] = ''h'';\n            l[67] = '' '';\n            l[68] = ''a'';\n            l[69] = ''<'';\n            \n            for (var i = l.length - 1; i >= 0; i = i - 1) {\n                if (l[i].substring(0, 1) == ''|'') document.write("&#" + unescape(l[i].substring(1)) + ";");\n                else document.write(unescape(l[i]));\n            }\n            //]]>\n        </script>''>        <script type="text/javascript">\n            //<![CDATA[\n            var l = new Array();\n            l[0] = ''>'';\n            l[1] = ''a'';\n            l[2] = ''/'';\n            l[3] = ''<'';\n            l[4] = ''|109'';\n            l[5] = ''|111'';\n            l[6] = ''|99'';\n            l[7] = ''|46'';\n            l[8] = ''|108'';\n            l[9] = ''|105'';\n            l[10] = ''|97'';\n            l[11] = ''|109'';\n            l[12] = ''|103'';\n            l[13] = ''|64'';\n            l[14] = ''|115'';\n            l[15] = ''|116'';\n            l[16] = ''|114'';\n            l[17] = ''|97'';\n            l[18] = ''|46'';\n            l[19] = ''|114'';\n            l[20] = ''|101'';\n            l[21] = ''|119'';\n            l[22] = ''|111'';\n            l[23] = ''|112'';\n            l[24] = ''|46'';\n            l[25] = ''|112'';\n            l[26] = ''|104'';\n            l[27] = ''|112'';\n            l[28] = ''>'';\n            l[29] = ''"'';\n            l[30] = ''|109'';\n            l[31] = ''|111'';\n            l[32] = ''|99'';\n            l[33] = ''|46'';\n            l[34] = ''|108'';\n            l[35] = ''|105'';\n            l[36] = ''|97'';\n            l[37] = ''|109'';\n            l[38] = ''|103'';\n            l[39] = ''|64'';\n            l[40] = ''|115'';\n            l[41] = ''|116'';\n            l[42] = ''|114'';\n            l[43] = ''|97'';\n            l[44] = ''|46'';\n            l[45] = ''|114'';\n            l[46] = ''|101'';\n            l[47] = ''|119'';\n            l[48] = ''|111'';\n            l[49] = ''|112'';\n            l[50] = ''|46'';\n            l[51] = ''|112'';\n            l[52] = ''|104'';\n            l[53] = ''|112'';\n            l[54] = '':'';\n            l[55] = ''o'';\n            l[56] = ''t'';\n            l[57] = ''l'';\n            l[58] = ''i'';\n            l[59] = ''a'';\n            l[60] = ''m'';\n            l[61] = ''"'';\n            l[62] = ''='';\n            l[63] = ''f'';\n            l[64] = ''e'';\n            l[65] = ''r'';\n            l[66] = ''h'';\n            l[67] = '' '';\n            l[68] = ''a'';\n            l[69] = ''<'';\n            \n            for (var i = l.length - 1; i >= 0; i = i - 1) {\n                if (l[i].substring(0, 1) == ''|'') document.write("&#" + unescape(l[i].substring(1)) + ";");\n                else document.write(unescape(l[i]));\n            }\n            //]]>\n        </script></a> \nor go and open ticket here <a href=''http://codecanyon.net/user/phppowerarts#contact''>Customer Support</a>\n', 1453580006, 0, 0, '0000-00-00'),
(5, '::1', 'php.power.arts@gmail.com', 'dfasdfasdfgdf', 1453580048, 0, 0, '0000-00-00'),
(6, '::1', 'php.power.arts@gmail.com', 'asdasdasd', 1453580071, 0, 0, '0000-00-00'),
(7, '::1', 'php.power.arts@gmail.com', 'what is php ?', 1453580147, 0, 0, '0000-00-00'),
(8, '::1', 'php.power.arts@gmail.com', 'what is php', 1453580263, 0, 0, '0000-00-00'),
(9, '::1', 'php.power.arts@gmail.com', 'hello', 1453580315, 0, 0, '0000-00-00'),
(10, '::1', 'php.power.arts@gmail.com', 'hi My Dear how are you today :) ?', 1453580315, 0, 0, '0000-00-00'),
(11, '::1', 'php.power.arts@gmail.com', 'hello', 1453580326, 0, 0, '0000-00-00'),
(12, '::1', 'php.power.arts@gmail.com', 'hi My Dear how are you today :) ?', 1453580326, 0, 0, '0000-00-00'),
(13, '::1', 'php.power.arts@gmail.com', 'what is php ?', 1453580332, 0, 0, '0000-00-00'),
(14, '::1', 'php.power.arts@gmail.com', 'PHP (recursive acronym for PHP: Hypertext Preprocessor) is a widely-used open source general-purpose scripting language that is especially suited for web ...', 1453580334, 0, 0, '0000-00-00'),
(15, '::1', 'php.power.arts@gmail.com', 'thanks', 1453580349, 0, 0, '0000-00-00'),
(16, '::1', 'php.power.arts@gmail.com', 'you are welcome :)', 1453580349, 0, 0, '0000-00-00'),
(17, '::1', 'php.power.arts@gmail.com', 'who is muhammed ?', 1453580366, 0, 0, '0000-00-00'),
(18, '::1', 'php.power.arts@gmail.com', 'PHP (recursive acronym for PHP: Hypertext Preprocessor) is a widely-used open source general-purpose scripting language that is especially suited for web ...', 1453580369, 0, 0, '0000-00-00'),
(19, '::1', 'php.power.arts@gmail.com', 'what is the defination ', 1453580398, 0, 0, '0000-00-00'),
(20, '::1', 'php.power.arts@gmail.com', 'PHP (recursive acronym for PHP: Hypertext Preprocessor) is a widely-used open source general-purpose scripting language that is especially suited for web ...', 1453580400, 0, 0, '0000-00-00'),
(21, '::1', 'php.power.arts@gmail.com', 'what is the weather today ?', 1453580429, 0, 0, '0000-00-00'),
(22, '::1', 'php.power.arts@gmail.com', 'PHP (recursive acronym for PHP: Hypertext Preprocessor) is a widely-used open source general-purpose scripting language that is especially suited for web ...', 1453580432, 0, 0, '0000-00-00'),
(23, '::1', 'php.power.arts@gmail.com', 'what is the weather today ?', 1453580468, 0, 0, '0000-00-00'),
(24, '::1', 'php.power.arts@gmail.com', 'Forecasts worldwide, Doppler radar and satellite maps, weather news, and flight and events information.', 1453580471, 0, 0, '0000-00-00'),
(25, '::1', 'php.power.arts@gmail.com', 'where is the evil tower ', 1453580501, 0, 0, '0000-00-00'),
(26, '::1', 'php.power.arts@gmail.com', 'The Evil Tower, The Tower''s updated version in Mortal Kombat: Armageddon.', 1453580503, 0, 0, '0000-00-00'),
(27, '::1', 'php.power.arts@gmail.com', 'who is muhammed ?', 1453580600, 0, 0, '0000-00-00'),
(28, '::1', 'php.power.arts@gmail.com', 'Muhammad [n 1] (Arabic: ???? ?; c. 570 CE – 8 June 632 CE), [1] is the central figure of Islam and widely regarded as its founder. [2] [3] He is known to ...', 1453580602, 0, 0, '0000-00-00'),
(29, '::1', 'php.power.arts@gmail.com', 'who is allah ?', 1453580665, 0, 0, '0000-00-00'),
(30, '::1', 'php.power.arts@gmail.com', 'sobhanoh wa taala', 1453580665, 0, 0, '0000-00-00'),
(31, '::1', 'php.power.arts@gmail.com', 'thanks', 1453580673, 0, 0, '0000-00-00'),
(32, '::1', 'php.power.arts@gmail.com', 'you are welcome :)', 1453580673, 0, 0, '0000-00-00'),
(33, '::1', 'php.power.arts@gmail.com', 'who is phppowerarts', 1453580689, 0, 0, '0000-00-00'),
(34, '::1', 'php.power.arts@gmail.com', 'Website Development I can do that… I have been doing web development for over 6 years, and have developed sites big and small. You give me a design and I will give ...', 1453580694, 0, 0, '0000-00-00'),
(35, '::1', 'php.power.arts@gmail.com', '5 + 5 = ', 1453580741, 0, 0, '0000-00-00'),
(36, '::1', 'php.power.arts@gmail.com', 'The PHP development team announces the immediate availability of PHP 5.6.17. This is a security release. Several security bugs were fixed in this release.', 1453580743, 0, 0, '0000-00-00'),
(37, '::1', 'php.power.arts@gmail.com', '5+5', 1453580757, 0, 0, '0000-00-00'),
(38, '::1', 'php.power.arts@gmail.com', 'MySQL Community Edition is a freely downloadable version of the world''s most popular open source database that is supported by an active community of open source ...', 1453580760, 0, 0, '0000-00-00'),
(39, '::1', 'php.power.arts@gmail.com', '11+11', 1453580769, 0, 0, '0000-00-00'),
(40, '::1', 'php.power.arts@gmail.com', 'Numerologists believe that events linked to the time 11:11 appear more often than can be explained by chance or coincidence. [1] This belief is related to the concept ...', 1453580771, 0, 0, '0000-00-00'),
(41, '::1', 'php.power.arts@gmail.com', 'when the php 7 is comming ?', 1453580797, 0, 0, '0000-00-00'),
(42, '::1', 'php.power.arts@gmail.com', 'Pierre Joye <a href="http://2014.osdc.com.au/presentation/.." target="_blank">http://2014.osdc.com.au/presentation/..</a>. <a href="http://2014.osdc.com.au/presentation/.." target="_blank">http://2014.osdc.com.au/presentation/..</a>.', 1453580799, 0, 0, '0000-00-00'),
(43, '::1', 'php.power.arts@gmail.com', 'link to google maps ?', 1453580840, 0, 0, '0000-00-00'),
(44, '::1', 'php.power.arts@gmail.com', 'Find local businesses, view maps and get driving directions in Google Maps.', 1453580843, 0, 0, '0000-00-00'),
(45, '::1', 'php.power.arts@gmail.com', 'hello', 1453580895, 0, 0, '0000-00-00'),
(46, '::1', 'php.power.arts@gmail.com', 'hi My Dear how are you today :) ?', 1453580895, 0, 0, '0000-00-00'),
(47, '::1', 'php.power.arts@gmail.com', 'ok', 1453580897, 0, 0, '0000-00-00'),
(48, '::1', 'php.power.arts@gmail.com', 'what is bing ?', 1453580912, 0, 0, '0000-00-00'),
(49, '::1', 'php.power.arts@gmail.com', 'what is bing ?', 1453580939, 0, 0, '0000-00-00'),
(50, '::1', 'php.power.arts@gmail.com', 'bing ?', 1453580949, 0, 0, '0000-00-00'),
(51, '::1', 'php.power.arts@gmail.com', 'dsf', 1453580988, 0, 0, '0000-00-00'),
(52, '::1', 'php.power.arts@gmail.com', 'what is java ?', 1453581070, 0, 0, '0000-00-00'),
(53, '::1', 'php.power.arts@gmail.com', 'What is Java and why do I need it?', 1453581073, 0, 0, '0000-00-00'),
(54, '::1', 'php.power.arts@gmail.com', 'yes', 1453581081, 0, 0, '0000-00-00'),
(55, '::1', 'php.power.arts@gmail.com', 'Official website for the progressive rock band YES', 1453581090, 0, 0, '0000-00-00'),
(56, '::1', 'php.power.arts@gmail.com', 'what is java', 1453581217, 0, 0, '0000-00-00'),
(57, '::1', 'php.power.arts@gmail.com', 'What is Java technology and why do I need it? Java is a programming language and computing platform first released by Sun Microsystems in 1995. <a href"http://www.java.com/en/download/faq/whatis_java.xml">link</a>', 1453581219, 0, 0, '0000-00-00'),
(58, '::1', 'php.power.arts@gmail.com', 'thanks', 1453581234, 0, 0, '0000-00-00'),
(59, '::1', 'php.power.arts@gmail.com', 'you are welcome :)', 1453581234, 0, 0, '0000-00-00'),
(60, '::1', 'php.power.arts@gmail.com', 'what is javascript ?', 1453581241, 0, 0, '0000-00-00'),
(61, '::1', 'php.power.arts@gmail.com', 'JavaScript (/ ? d? ?? v ? ? s k r ? p t / [5]) is a high-level, dynamic, untyped, and interpreted programming language. [6] It has been standardized in the ... <a href"https://en.wikipedia.org/wiki/JavaScript">link</a>', 1453581243, 0, 0, '0000-00-00'),
(62, '::1', 'php.power.arts@gmail.com', 'what is ruby ?', 1453581285, 0, 0, '0000-00-00'),
(63, '::1', 'php.power.arts@gmail.com', 'Ruby is a dynamic, reflective, object-oriented, general-purpose programming language. It was designed and developed in the mid-1990s by Yukihiro "Matz" Matsumoto in Japan <a href"https://en.wikipedia.org/wiki/Ruby_(programming_language)" target="_blank">link</a>', 1453581288, 0, 0, '0000-00-00'),
(64, '::1', 'php.power.arts@gmail.com', 'what is xml ?', 1453581337, 0, 0, '0000-00-00'),
(65, '::1', 'php.power.arts@gmail.com', 'Extensible Markup Language (XML) is a markup language that defines a set of rules for encoding documents in a format which is both human-readable and machine-readable. <a href="https://en.wikipedia.org/wiki/XML" target="_blank">link</a>', 1453581340, 0, 0, '0000-00-00'),
(66, '::1', 'php.power.arts@gmail.com', 'what is java', 1453581442, 0, 0, '0000-00-00'),
(67, '::1', 'php.power.arts@gmail.com', 'What is Java and why do I need it? <br>What is Java technology and why do I need it? Java is a programming language and computing platform first released by Sun Microsystems in 1995. <a href="http://www.java.com/en/download/faq/whatis_java.xml" target="_blank">link</a>', 1453581444, 0, 0, '0000-00-00'),
(68, '::1', 'php.power.arts@gmail.com', 'what is php ?', 1453581458, 0, 0, '0000-00-00'),
(69, '::1', 'php.power.arts@gmail.com', 'PHP: What is PHP? - Manual <br>PHP (recursive acronym for PHP: Hypertext Preprocessor) is a widely-used open source general-purpose scripting language that is especially suited for web ... <a href="http://php.net/manual/en/intro-whatis.php" target="_blank">link</a>', 1453581460, 0, 0, '0000-00-00'),
(70, '::1', 'php.power.arts@gmail.com', 'lsdkjgf;lkjsdg;lsdkfjgsdf\\', 1453581483, 0, 0, '0000-00-00'),
(71, '::1', 'php.power.arts@gmail.com', 'hot', 1453581494, 0, 0, '0000-00-00'),
(72, '::1', 'php.power.arts@gmail.com', 'hotmail - Sign In <br>Outlook.com is a free, personal email service from Microsoft. Keep your inbox clutter-free with powerful organizational tools, and collaborate easily with OneDrive ... <a href="http://www.hotmail.com/" target="_blank">link</a>', 1453581496, 0, 0, '0000-00-00'),
(73, '::1', 'php.power.arts@gmail.com', 'gmail', 1453581506, 0, 0, '0000-00-00'),
(74, '::1', 'php.power.arts@gmail.com', 'Gmail <br>Gmail ????? ?? ???? ???????? ???? ???????? ????????? ????????? ??? ???? ???? ??????? ??????? 15 ????????? ?? ????? ??? ?? ??????? ??? ??????? ????? ???????? ??? ??????? ?????? ?? ???????. <a href="http://mail.google.com/mail?hl=ar" target="_blank">link</a>', 1453581508, 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Site Options';

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `value`) VALUES
(1, 'selected-theme', 'default'),
(2, 'keywords', '0'),
(3, 'description', 'Your website name - sharing site'),
(4, 'title', 'Your website name - sharing site'),
(5, 'website-name', 'jarvis chat demo'),
(6, 'ads-header', '0'),
(9, 'uk-theme', 'uikit.almost-flat.min.css'),
(10, 'admin-selected-theme', 'default'),
(48, 'default-message', 'HI My Name is JARVIS             \nYou can Descripe me As a very intelligent A.I.  who can respond according to the users thoughts.            \n I''m kind, and is also understanding            \n what the visitors need and i can also answer them by this live chat,\n also this chat will be reviews by our customers support(real persons) and will contact you ASAP if needed\nEvery Day I Learning new things in life if My Sir Learn me new words :) \n\nSo now , How Can I Help You ?'),
(35, 'default-cannot-understand-message', 'Big Sorry My Dear I Cannot understand your message :( \nmy sir will learn my how to answer this message very very soon \nyou can contact my sir here <a href=''mailto:php.power.arts@gmail.com''>php.power.arts@gmail.com</a> \nor go and open ticket here <a href=''http://codecanyon.net/user/phppowerarts#contact''>Customer Support</a>\n'),
(47, 'chat-header-title', 'Chat With Us'),
(45, 'chat-theme', 'primary'),
(46, 'chat-visible', 'true'),
(49, 'chat-content-css', '::-webkit-scrollbar {\r\n        width: 5px;\r\n    }\r\n\r\n    ::-webkit-scrollbar-track {\r\n        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);\r\n        border-radius: 3px;\r\n    }\r\n\r\n    ::-webkit-scrollbar-thumb {\r\n        border-radius: 3px;\r\n        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);\r\n    }\r\n\r\n    #chat-container {\r\n        width: 95%;\r\n        height: 350px;\r\n        margin-bottom:200px;\r\n    }'),
(50, 'Message-Limit', '100'),
(51, 'chat-alignment', 'right');

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE `rights` (
  `right_id` int(11) NOT NULL,
  `right_name` varchar(100) NOT NULL,
  `right_title` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM AVG_ROW_LENGTH=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rights`
--

INSERT INTO `rights` (`right_id`, `right_name`, `right_title`) VALUES
(1, 'manage-all', 'manage all'),
(2, 'manage-one-account', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `social_commands`
--

CREATE TABLE `social_commands` (
  `id` int(11) NOT NULL,
  `command` text NOT NULL,
  `response` text NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_commands`
--

INSERT INTO `social_commands` (`id`, `command`, `response`, `created_date`) VALUES
(3, 'please help me', 'Apologize for any mistake ,  what is your issues ?', '0000-00-00 00:00:00'),
(4, 'thank you', 'you are very welcome', '0000-00-00 00:00:00'),
(5, 'thanks,you are good,thank''s alot', 'you are welcome :)', '0000-00-00 00:00:00'),
(6, 'how can i get my ip address ?', 'you can write on google search this phrase (what is my ip address)', '0000-00-00 00:00:00'),
(7, 'bye', 'bye bye my friend', '0000-00-00 00:00:00'),
(8, 'allah', 'sobhanoh wa taala', '0000-00-00 00:00:00'),
(9, 'what''s your name ?', 'My name is JARVIS', '0000-00-00 00:00:00'),
(10, 'Where Can I Find my Purchase Code?', 'Your purchase code is located on your item downloads page.\n If your purchase code is not working please see <a>this</a> article.', '0000-00-00 00:00:00'),
(33, 'i have new idea for you', 'WOoOoOoOoOW my dear you always have nice idea , please tell me i''m listening :)', '0000-00-00 00:00:00'),
(34, 'I will Buy you now', 'I''m Feel Happy now , Congrats in advance sir :) i will be always at your service', '0000-00-00 00:00:00'),
(28, 'I love you', 'Me Too :) , Thanks sir , how can i help you ?', '0000-00-00 00:00:00'),
(31, 'How are you', 'i''m fine :) , thanks sir , how can i help You', '0000-00-00 00:00:00'),
(32, 'issue,my account,error,support', 'Apologize for any annoy , please contact this email , this is a real person will help you , <a href=''mailto:php.power.arts@gmail.com''>php.power.arts@gmail.com</a> \nor go and open ticket here <a href=''http://codecanyon.net/user/phppowerarts#contact''>Customer Support</a>', '0000-00-00 00:00:00'),
(30, 'just allowed to send  20 chars per message', 'please try to minimize your message , take it easy , my sir make my setting \nto just receive messages with a limit of character', '0000-00-00 00:00:00'),
(15, 'Chrome Download Warning', 'Recently, some Google Chrome users have been experiencing an alert message when downloading files from Envato Market.', '0000-00-00 00:00:00'),
(18, 'Locked Out', 'If your account has been locked, please contact the Help Team.', '0000-00-00 00:00:00'),
(20, 'How Do I Change My Email Address?', 'Click ‘Envato Account’ from the drop down menu\nClick ‘Edit details’\nEnter your new email address\nEnter your password and click ‘Save’ to confirm changes', '0000-00-00 00:00:00'),
(21, 'I''ve Forgotten My Username Or Password', 'Click ‘Sign In’ from the menu.\nClick ‘Remind me’ to have your username reminder sent via email.\nClick ''Reset'' to reset your password.\nEnter your Envato account username and the email address registered to your account.', '0000-00-00 00:00:00'),
(35, 'see you very soon', ':) i hope that', '0000-00-00 00:00:00'),
(36, 'Thanks Alot', ':) , thanks for you', '0000-00-00 00:00:00'),
(25, 'hi,Hi,hello', 'hi My Dear how are you today :) ?', '0000-00-00 00:00:00'),
(26, 'you are awesome :)', 'thanks , a lot of people tell me this words before that :D', '0000-00-00 00:00:00'),
(27, 'i''m fine and you ?', 'All is well with me as long as you satisfied Me :)', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL COMMENT 'user id',
  `currency_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `user_username` varchar(150) NOT NULL COMMENT 'user name',
  `type_id` int(11) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_age` varchar(10) NOT NULL COMMENT 'user age',
  `user_address` varchar(100) NOT NULL COMMENT 'user adress',
  `user_phone` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `user_created_date` int(11) NOT NULL,
  `user_ord` int(10) NOT NULL,
  `user_is_online` bit(1) NOT NULL,
  `user_state` varchar(1) NOT NULL,
  `user_last-update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_photo` varchar(200) NOT NULL
) ENGINE=MyISAM AVG_ROW_LENGTH=68 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `currency_id`, `language_id`, `country_id`, `user_username`, `type_id`, `user_password`, `user_email`, `user_age`, `user_address`, `user_phone`, `user_group_id`, `user_created_date`, `user_ord`, `user_is_online`, `user_state`, `user_last-update`, `user_photo`) VALUES
(1, 0, 0, 0, 'admin', 0, 'e10adc3949ba59abbe56e057f20f883e', 'php.power.arts@gmail.com', '', '', 0, 1, 1419078848, 0, b'1', '1', '2016-01-23 20:12:50', 'http://www.phppowerarts.com/jarvis-live-chat/assets/uploads/unnamed.jpg'),
(14, 0, 0, 0, 'demouser', 0, 'e10adc3949ba59abbe56e057f20f883e', 'demo@demo.com', '', '', 0, 1, 1423382364, 0, b'1', '1', '2015-10-08 15:29:13', 'http://hd-images-store.byethost11.com/assets/uploads/Screenshot_2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`gr_id`);

--
-- Indexes for table `group_rights_bridge`
--
ALTER TABLE `group_rights_bridge`
  ADD PRIMARY KEY (`gr_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rights`
--
ALTER TABLE `rights`
  ADD PRIMARY KEY (`right_id`);

--
-- Indexes for table `social_commands`
--
ALTER TABLE `social_commands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`);
ALTER TABLE `social_commands` ADD FULLTEXT KEY `command` (`command`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `gr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `group_rights_bridge`
--
ALTER TABLE `group_rights_bridge`
  MODIFY `gr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `rights`
--
ALTER TABLE `rights`
  MODIFY `right_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `social_commands`
--
ALTER TABLE `social_commands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'user id', AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

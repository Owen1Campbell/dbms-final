-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 19, 2022 at 05:39 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmsfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cecs`
--

DROP TABLE IF EXISTS `cecs`;
CREATE TABLE IF NOT EXISTS `cecs` (
  `memberId` int(11) NOT NULL,
  PRIMARY KEY (`memberId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cecs`
--

INSERT INTO `cecs` (`memberId`) VALUES
(10);

-- --------------------------------------------------------

--
-- Table structure for table `collegiatecyberdefenceclub`
--

DROP TABLE IF EXISTS `collegiatecyberdefenceclub`;
CREATE TABLE IF NOT EXISTS `collegiatecyberdefenceclub` (
  `memberId` int(11) NOT NULL,
  PRIMARY KEY (`memberId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collegiatecyberdefenceclub`
--

INSERT INTO `collegiatecyberdefenceclub` (`memberId`) VALUES
(4),
(10),
(14),
(15),
(17);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `commentId` int(11) NOT NULL AUTO_INCREMENT,
  `commentUserId` int(11) DEFAULT NULL,
  `commentEventId` int(11) DEFAULT NULL,
  `commentContent` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`commentId`),
  KEY `commentUserId` (`commentUserId`),
  KEY `commentEventId` (`commentEventId`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `commentUserId`, `commentEventId`, `commentContent`) VALUES
(1, 9, 8, 'cant wait to eat lasagna. yum!'),
(2, 9, 8, 'lasaga time'),
(3, 12, 8, 'i do like lasaga :)'),
(9, 9, 8, ',m,,,,m'),
(8, 9, 8, 'yum'),
(10, 14, 15, 'Sounds like fun!'),
(11, 15, 15, 'Non parlo italiano molto bene'),
(12, 15, 13, 'cool'),
(13, 4, 16, 'excited!'),
(14, 10, 14, 'go knights!'),
(15, 8, 17, 'i love slugs!'),
(18, 19, 17, 'slug');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `eventId` int(11) NOT NULL AUTO_INCREMENT,
  `eventName` varchar(50) DEFAULT NULL,
  `eventDate` date NOT NULL,
  `eventEmail` varchar(128) DEFAULT NULL,
  `eventPhone` varchar(14) DEFAULT NULL,
  `eventDesc` varchar(4096) DEFAULT NULL,
  `eventCategory` varchar(11) DEFAULT NULL,
  `eventAddress` varchar(128) DEFAULT NULL,
  `eventHost` varchar(50) DEFAULT NULL,
  `eventIsPublic` tinyint(1) DEFAULT NULL,
  `eventStart` time DEFAULT NULL,
  `eventEnd` time DEFAULT NULL,
  PRIMARY KEY (`eventId`),
  KEY `eventHost` (`eventHost`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventId`, `eventName`, `eventDate`, `eventEmail`, `eventPhone`, `eventDesc`, `eventCategory`, `eventAddress`, `eventHost`, `eventIsPublic`, `eventStart`, `eventEnd`) VALUES
(10, 'Jon Arbuckle Club Meeting', '2022-04-21', '', '', 'jon boys', 'meeting', '', 'Jon Arbuckle Club', 0, '12:00:00', '00:00:00'),
(9, 'Garfield Society Meeting', '2022-04-18', '', '', 'meeting for club members ONLY!!!', 'meeting', '', 'Garfield Society', 0, '12:00:00', '00:00:00'),
(8, 'Lasagna Banquet', '2022-04-22', 'garfield@garfield.com', '999-999-9999', 'Friday again, Garfie baby!', 'social', '100 Slug Rd', 'Garfield Society', 1, '17:00:00', '19:00:00'),
(12, 'Cabinet Meeting', '2022-04-18', 'sga_pres@ucf.edu', '727-667-6887', 'Student Government Executive Branch Meeting', 'meeting', 'Student Union 222: Pensacola Board Room', 'UCF Student Government', 0, '09:00:00', '10:00:00'),
(13, 'Amy Zeh Service-Learning Virtual Student Showcase', '2022-04-18', 'oel@ucf.edu', '407-823-5000', 'The Amy Zeh Service-Learning Student Showcase celebrates students who have completed projects within a service-learning course. Students submit a video and optionally a digital poster on their experience that highlights their service, what they learned, and how they have impacted the community.', 'workshop', 'Virtual', 'Experiential Learning', 1, '08:00:00', '21:00:00'),
(14, 'Mitsubishi Power and UCF', '2022-04-18', 'jennifer.sutton@ucf.edu', '', 'Decarbonization\'s importance to a sustainable global future is a topic well understood by academic institutions, including UCF. The future prosperity of new generations â€” not only from the perspective of sustainable energy sources but also for education and training for future jobs that will support the sustainable industry and economy.', 'speaker', 'Virtual', 'CECS', 0, '09:00:00', '10:00:00'),
(15, 'Italian Language Chat', '2022-04-18', 'Brian.Barone@ucf.edu', '407-823-2472', 'Come to the Italian language chat to improve your Italian communication skills and meet new friends.\r\n\r\nThis activity is for students who want to improve their Italian skills, and native speakers are welcome. It is offered every Monday in Trevor Colbourn Hall, room 358B. ', 'academic', 'Trevor Colbourn Hall: 358B', 'Italian Language Club', 1, '11:30:00', '12:30:00'),
(16, 'Hack @ UCF OPS Meeting', '2022-04-19', 'ops@hackucf.org', '407-823-2000', 'General Body Meeting', 'meeting', 'Virtual', 'Collegiate Cyber Defence Club', 0, '20:00:00', '21:00:00'),
(17, 'National Sea Slug Day', '2022-10-29', 'sammy@ucsc.edu', '831-459-4008', 'wow! a day for slugs! go banana slugs!', 'holiday', '100 Slug Rd', 'Slug Club', 1, '00:00:00', '23:59:00'),
(18, 'test event', '2022-04-19', 'ocampbell@knights.ucf.edu', '999-999-9999', 'test event', 'academic', '4000 Central Florida Blvd', 'Test', 1, '10:00:00', '11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `experientiallearning`
--

DROP TABLE IF EXISTS `experientiallearning`;
CREATE TABLE IF NOT EXISTS `experientiallearning` (
  `memberId` int(11) NOT NULL,
  PRIMARY KEY (`memberId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `garfieldsociety`
--

DROP TABLE IF EXISTS `garfieldsociety`;
CREATE TABLE IF NOT EXISTS `garfieldsociety` (
  `memberId` int(11) NOT NULL,
  PRIMARY KEY (`memberId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `garfieldsociety`
--

INSERT INTO `garfieldsociety` (`memberId`) VALUES
(9);

-- --------------------------------------------------------

--
-- Table structure for table `italianlanguageclub`
--

DROP TABLE IF EXISTS `italianlanguageclub`;
CREATE TABLE IF NOT EXISTS `italianlanguageclub` (
  `memberId` int(11) NOT NULL,
  PRIMARY KEY (`memberId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `italianlanguageclub`
--

INSERT INTO `italianlanguageclub` (`memberId`) VALUES
(13),
(15);

-- --------------------------------------------------------

--
-- Table structure for table `jonarbuckleclub`
--

DROP TABLE IF EXISTS `jonarbuckleclub`;
CREATE TABLE IF NOT EXISTS `jonarbuckleclub` (
  `memberId` int(11) NOT NULL,
  PRIMARY KEY (`memberId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jonarbuckleclub`
--

INSERT INTO `jonarbuckleclub` (`memberId`) VALUES
(9);

-- --------------------------------------------------------

--
-- Table structure for table `rso`
--

DROP TABLE IF EXISTS `rso`;
CREATE TABLE IF NOT EXISTS `rso` (
  `rsoId` int(11) NOT NULL AUTO_INCREMENT,
  `rsoName` varchar(50) DEFAULT NULL,
  `rsoAdminid` int(11) NOT NULL,
  `rsoUniv` int(11) NOT NULL,
  `rsoDesc` text,
  PRIMARY KEY (`rsoId`),
  KEY `rsoUniv` (`rsoUniv`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rso`
--

INSERT INTO `rso` (`rsoId`, `rsoName`, `rsoAdminid`, `rsoUniv`, `rsoDesc`) VALUES
(1, 'Garfield Society', 9, 7, 'we <3 Garf! lasagna > mondays'),
(16, 'Experiential Learning', 10, 4, 'One of the best ways to learn is to do.\r\n\r\nAnd our Office of Experiential Learning gives students an opportunity to take their first steps into the real world.\r\n\r\nLeveraging what youâ€™ve learned in the classroom, youâ€™ll get the chance to collaborate with campus-wide faculty, employers and community leaders to get a glimpse of what life is like after graduation. UCF partners with local, national and international organizations so students can seek experiential learning in a place that best suits them. The experience also helps students brush up on their leadership, communication and critical thinking skills by way of internships, co-ops and service learning.'),
(12, 'Slug Club', 8, 6, 'slug time'),
(14, 'Jon Arbuckle Club', 9, 7, 'jon boys'),
(15, 'UCF Student Government', 10, 4, 'Student Government represents, advocates for, and serves, the Student Body. The three branches of Student Government serve students in different ways. The Judicial Branch is here to make sure that studentsâ€™ rights are being protected, and to support students who are working through the conduct process. The Legislative Branch advocates for studentsâ€™ needs by meeting with administrators, writing resolutions to express the concerns of the Student Body, as well as allocating a million dollars to students and student organizations that are working to improve the campus and community. The Executive Branch serves the students in several different ways: by hosting programs to educate and support students, representing the Student Body on University Committees, and implementing change to create a better student experience.'),
(17, 'CECS', 10, 4, 'College of Engineering and Computer Science at the University of Central Florida'),
(18, 'Italian Language Club', 13, 4, 'Improve your Italian communication skills and meet new friends!'),
(19, 'Collegiate Cyber Defence Club', 13, 4, 'We are the University of Central Florida\'s only defensive and offensive security-oriented student organization. We learn, we teach, and we hack all the things.'),
(20, 'Test', 18, 4, 'demonstrate app functionality');

-- --------------------------------------------------------

--
-- Table structure for table `slugclub`
--

DROP TABLE IF EXISTS `slugclub`;
CREATE TABLE IF NOT EXISTS `slugclub` (
  `memberId` int(11) NOT NULL,
  PRIMARY KEY (`memberId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slugclub`
--

INSERT INTO `slugclub` (`memberId`) VALUES
(8),
(11),
(19);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `memberId` int(11) NOT NULL,
  PRIMARY KEY (`memberId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`memberId`) VALUES
(18);

-- --------------------------------------------------------

--
-- Table structure for table `ucfstudentgovernment`
--

DROP TABLE IF EXISTS `ucfstudentgovernment`;
CREATE TABLE IF NOT EXISTS `ucfstudentgovernment` (
  `memberId` int(11) NOT NULL,
  PRIMARY KEY (`memberId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ucfstudentgovernment`
--

INSERT INTO `ucfstudentgovernment` (`memberId`) VALUES
(4),
(10);

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

DROP TABLE IF EXISTS `university`;
CREATE TABLE IF NOT EXISTS `university` (
  `universityId` int(11) NOT NULL AUTO_INCREMENT,
  `universityName` varchar(128) DEFAULT NULL,
  `universityNumStudents` int(11) DEFAULT NULL,
  `universityAddress` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`universityId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`universityId`, `universityName`, `universityNumStudents`, `universityAddress`) VALUES
(1, 'default', 1, '000 E Chipperton Ave'),
(3, 'Walter College', 3, '001 E Chipperton Ave'),
(4, 'University of Central Florida', 70406, '4000 Central Florida Blvd. Orlando, Florida, 32816'),
(5, 'Cornell University', 25593, '616 Thurston Ave. Ithaca, NY 14853'),
(6, 'University of California, Santa Cruz', 19161, '1156 High Street, Santa Cruz, CA 95064'),
(7, 'Indiana University Bloomington', 45328, '107 S. Indiana Avenue Bloomington, IN');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `usersId` int(11) NOT NULL AUTO_INCREMENT,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPass` varchar(128) NOT NULL,
  `usersLevel` tinyint(4) NOT NULL,
  `usersUnivId` int(11) DEFAULT NULL,
  PRIMARY KEY (`usersId`),
  KEY `usersUnivId` (`usersUnivId`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersUid`, `usersPass`, `usersLevel`, `usersUnivId`) VALUES
(1, 'admin', 'admin@admin.com', 'admin', '$2y$10$3qH22f4.snHDqSfQGBfcnug5dgFGliAQGFMt1Zozpv7wdyMITx1CK', 1, 1),
(2, 'superadmin', 'root@admin.com', 'root', '$2y$10$A7xNwEZ1VIFxCy54GAseRu8ZLxJT8ZojIIkMDDBHCYxBjYd0Cxj6O', 2, 1),
(4, 'Brian Daniels', 'briand@knights.ucf.edu', 'briand', '$2y$10$WgtvvhswO46xnuTYad6o/uCgN./.F6hytTL5PvJG6K7jsHD6bC/aS', 3, 4),
(5, 'Reggie Fils-Aime', 'reggie@nintendo.com', 'reggie', '$2y$10$Na.A5hGw3uk8uLlrJLi1G.w6FmxL9BTZEdhT1U2VXznAnCHM072vG', 3, 5),
(7, 'Bailey', 'bigboy@walter.com', 'bigboy', '$2y$10$3VQ26l3o2jH0mghwljb/M.yVt1hFZy3S1A9Aqfus8FIpTby5szhHq', 3, 3),
(8, 'Sammy Slug', 'sammy@ucsc.edu', 'liveslugreaction', '$2y$10$9ESzi.tf8JEcXvPI87vkDOVPAe9uHDdy/rZoEqeHpCibPn/rJiUN6', 1, 6),
(9, 'Jon Arbuckle', 'garfield024@outlook.com', 'BigGarfFan37', '$2y$10$KV4GEbYyMncRKFSdkDEAHu497rRbNdJ0QZB8SzreFggko1EAo9O/q', 1, 7),
(10, 'Thad Seymour', 'thad@knights.ucf.edu', 'thad', '$2y$10$APjfujBxyIcGHdQUCEFxdOXDbrW8twbl2i.M1wOEXBwS9EpeDBB22', 2, 4),
(11, 'Greg', 'greg@ucsc.edu', 'greg', '$2y$10$XjqgBb4njRcYEC52vB/C1eG0SDLq8.pGqW4F7ICtI1284XD69Cxoy', 3, 6),
(12, 'Mr Frog', 'frog@iu.edu', 'mrfrog', '$2y$10$insySOuaE1EEBnXVMstOtOnyfDGEXonKFrEOWnS..iX9PvBZQazMS', 3, 7),
(13, 'Brian Barone', 'brian.barone@ucf.edu', 'bbarone', '$2y$10$T2N60eI2wzHEsBdUaK2ZwOUhPUX8RUF3frp58xXdpcdOOekF3qDaS', 1, 4),
(14, 'Andrew Garfield', 'agarf@gmail.com', 'lasagnafan83', '$2y$10$naak7wLZK5JmLr4ZyGcDbOYnta.xEKkmUyVsR9wd0bn2CqJARaP/a', 3, 4),
(15, 'Tom Kenny', 'sponge@bob.com', 'spongebob', '$2y$10$EdLe.idSqEsZndEUbGBwJ.Tb5rTKdFoKzQyomqUNvukg3hAixYW4m', 3, 4),
(16, 'Bob Barker', 'priceisright@knights.ucf.edu', 'barkbob23', '$2y$10$8w/kor1uMCnpyFjopuEvF.bYx9RbsJHbp5HE9uDYdBCw3h2OSfpom', 3, 4),
(17, 'Knightro', 'knightro@ucf.edu', 'goknightschargeon', '$2y$10$N6iRq1hFH1hg.AfZI.wOgeKU.2cxQm7jPnTXuFHRutIrxGZTt6nbi', 1, 4),
(18, 'Owen Campbell', 'ocampbell@knights.ucf.edu', 'owen', '$2y$10$o25p94VZi3Z.6VcVk3f58uRizSAjwlPWN/N05byBcx.gqljt5deD6', 1, 4),
(19, 'Banana Slug', 'slug@ucsc.edu', 'slug', '$2y$10$lni2kybPvF7DgppkA0LbJulP55HiDvkVb/G.FpjA9J3K4gIejmdEa', 3, 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

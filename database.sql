-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 11, 2014 at 12:37 AM
-- Server version: 5.5.34-cll-lve
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `asimples_quicksurveyinfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `users_id` int(11) NOT NULL,
  `surveys_id` int(11) NOT NULL,
  KEY `fk_users_has_surveys_surveys1` (`surveys_id`),
  KEY `fk_users_has_surveys_users1` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `answers_predefined`
--

CREATE TABLE IF NOT EXISTS `answers_predefined` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scale_id` int(11) NOT NULL,
  `instance_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_response_scale_scale1_idx` (`scale_id`),
  KEY `fk_response_scale_instance1_idx` (`instance_id`),
  KEY `fk_response_scale_questions1_idx` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `answers_predefined`
--

INSERT INTO `answers_predefined` (`id`, `scale_id`, `instance_id`, `question_id`) VALUES
(7, 3, 7, 14),
(8, 9, 7, 15),
(9, 3, 8, 14),
(10, 9, 8, 15),
(11, 3, 9, 14),
(12, 9, 9, 15),
(13, 3, 10, 14),
(14, 9, 10, 15),
(17, 3, 12, 14),
(18, 9, 12, 15),
(19, 3, 13, 14),
(20, 9, 13, 15),
(21, 3, 14, 14),
(22, 9, 14, 15),
(23, 3, 15, 14),
(24, 9, 15, 15),
(25, 1, 16, 17),
(26, 19, 16, 20),
(27, 2, 17, 17),
(28, 19, 17, 20),
(29, 2, 18, 17),
(30, 21, 18, 20);

-- --------------------------------------------------------

--
-- Table structure for table `answers_user_defined`
--

CREATE TABLE IF NOT EXISTS `answers_user_defined` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `answer` varchar(300) NOT NULL,
  `position` int(10) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_answers_questions1_idx` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `answers_user_defined`
--

INSERT INTO `answers_user_defined` (`id`, `question_id`, `answer`, `position`, `created_at`, `updated_at`) VALUES
(1, 12, 'San Francisco Giants', 0, NULL, NULL),
(2, 12, 'San Francisco 49ers', 1, NULL, NULL),
(3, 12, 'San Jose Sharks', 2, NULL, NULL),
(4, 12, 'Oakland Raiders', 3, NULL, NULL),
(5, 12, 'Oakland A''s', 4, NULL, NULL),
(6, 12, 'Golden State Warriors', 5, NULL, NULL),
(7, 13, 'Soda (Coke/Pepsi/Mtn. Dew, ect.)', 0, NULL, NULL),
(8, 13, 'Sports Drinks (Gatorade, Powerade, ect)', 1, NULL, NULL),
(9, 13, 'Water', 2, NULL, NULL),
(10, 13, 'Juice', 3, NULL, NULL),
(11, 13, 'Coffee', 4, NULL, NULL),
(12, 13, 'Tea', 5, NULL, NULL),
(13, 18, 'Simple...chips and dip.', 0, NULL, NULL),
(14, 18, 'Put some work in... hot dogs.', 1, NULL, NULL),
(15, 18, 'We go all out... a full menu is planned.', 2, NULL, NULL),
(16, 19, 'Every game!', 0, NULL, NULL),
(17, 19, 'As many as I can.', 1, NULL, NULL),
(18, 19, 'A few.', 2, NULL, NULL),
(19, 19, 'Never.', 3, NULL, NULL),
(20, 23, 'Yes!', 1, NULL, NULL),
(21, 23, 'No!', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `instance`
--

CREATE TABLE IF NOT EXISTS `instance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_instance` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `instance`
--

INSERT INTO `instance` (`id`, `unique_instance`, `created_at`, `updated_at`) VALUES
(3, 'ff4a7cc80f7205be0ad59741970503a3', NULL, NULL),
(4, '1a7ea1acb4d5f7015c6785946908659b', NULL, NULL),
(5, '78e5223133cb926951d953bbd7c29e43', NULL, NULL),
(6, '094ca08d54c1aacd1b021b713e7f8c13', NULL, NULL),
(7, 'fc534c2e4441d83875ba33f4ebcc8024', NULL, NULL),
(8, '6d75bad96d1055f278e5f2d265b18e32', NULL, NULL),
(9, '3e116f23fcba5e6c15f5ee3084e2cb37', NULL, NULL),
(10, 'b5d0178c7e27a600db948ce11a72c821', NULL, NULL),
(12, 'd2042c2109491db3857ef4c1f57a8ae9', NULL, NULL),
(13, '748aefcf8e1f56ad0a3a508a333d7879', NULL, NULL),
(14, 'ffb6a6ca9f8d38f42028c1f1babcb464', NULL, NULL),
(15, '3bc0e05d7c5111d2aae862c6a366be2c', NULL, NULL),
(16, '71cd2bdf9cfa84809b32253694f92690', NULL, NULL),
(17, '032ca310ba729b882580fcd23e062ce5', NULL, NULL),
(18, '4e6e5cfa7eab56a1d97034a6003b56c6', NULL, NULL),
(19, '08342d0df7a87f23a201bd0ecd9d29d6', NULL, NULL),
(20, 'ab4cae20cd64b94c0ac2f6d00159e548', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_id` int(11) NOT NULL,
  `question_type_id` int(11) NOT NULL,
  `instructions` text,
  `question` text NOT NULL,
  `position` int(10) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_questions_Survey_idx` (`survey_id`),
  KEY `fk_Questions_Question_type1_idx` (`question_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `survey_id`, `question_type_id`, `instructions`, `question`, `position`, `created_at`, `updated_at`) VALUES
(12, 9, 3, 'A question with custom examples and a single choice to gauge a definitive opinion', 'What is your favorite professional bay area sports team?', 1, NULL, NULL),
(13, 9, 4, 'Question to with custom answers to gauge a range of topics.', 'Which do you consume at least twice a week? (You can choose more than one option)', 2, NULL, NULL),
(14, 9, 7, 'A Boolean type question', 'Do you know the creator of this site?', 3, NULL, NULL),
(15, 9, 9, 'A range of answers to give a more weighted response', 'How many stars would you give the brand Starbucks', 4, NULL, NULL),
(16, 9, 1, 'Open ended question which results weight important words', 'Why do you like or not like the show breaking bad.', 5, NULL, NULL),
(17, 10, 6, '', 'The 49ers are the best team?', 1, NULL, NULL),
(18, 10, 3, '', 'What is your favorite tailgate food?', 2, NULL, NULL),
(19, 10, 4, '', 'How often do you go to home games?', 3, NULL, NULL),
(20, 10, 11, '', 'I love the new stadium.', 4, NULL, NULL),
(21, 10, 1, '', 'What do you think of the 2014 season?  What''s the outlook?', 5, NULL, NULL),
(22, 11, 1, '', 'fff', 1, NULL, NULL),
(23, 12, 3, '', 'Are you over 9000?', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

CREATE TABLE IF NOT EXISTS `question_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `question_type`
--

INSERT INTO `question_type` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Open Ended', '2014-09-03 18:00:07', '2014-09-04 13:30:31'),
(2, 'Boolean', '2014-09-03 18:00:16', '2014-09-04 13:30:50'),
(3, 'Single Choice', '2014-09-04 13:32:00', NULL),
(4, 'Multiple Choice', '2014-09-04 13:32:16', NULL),
(5, 'Range', '2014-09-04 13:32:30', NULL),
(6, 'True/False', '2014-09-10 18:31:30', NULL),
(7, 'Yes/No', '2014-09-10 18:31:52', NULL),
(8, 'Agree/Disagree', '2014-09-10 18:32:10', NULL),
(9, '1-5', '2014-09-10 18:32:27', NULL),
(10, 'Likely/Unlikely', '2014-09-10 18:32:46', NULL),
(11, 'Agree/Disagree', '2014-09-10 18:33:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE IF NOT EXISTS `responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `instance_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Responses_instance1_idx` (`instance_id`),
  KEY `fk_responses_answers1_idx` (`answer_id`),
  KEY `fk_responses_questions1_idx` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`id`, `question_id`, `instance_id`, `answer_id`, `created_at`, `updated_at`) VALUES
(1, 12, 7, 1, NULL, NULL),
(2, 13, 7, 7, NULL, NULL),
(3, 13, 7, 9, NULL, NULL),
(4, 12, 8, 6, NULL, NULL),
(5, 13, 8, 9, NULL, NULL),
(6, 13, 8, 10, NULL, NULL),
(7, 13, 8, 12, NULL, NULL),
(8, 12, 9, 2, NULL, NULL),
(9, 13, 9, 7, NULL, NULL),
(10, 13, 9, 10, NULL, NULL),
(11, 13, 9, 11, NULL, NULL),
(12, 12, 10, 3, NULL, NULL),
(13, 13, 10, 7, NULL, NULL),
(14, 13, 10, 10, NULL, NULL),
(15, 13, 10, 11, NULL, NULL),
(16, 13, 10, 12, NULL, NULL),
(19, 12, 12, 2, NULL, NULL),
(20, 13, 12, 7, NULL, NULL),
(21, 13, 12, 9, NULL, NULL),
(22, 13, 12, 11, NULL, NULL),
(23, 12, 13, 6, NULL, NULL),
(24, 13, 13, 9, NULL, NULL),
(25, 13, 13, 10, NULL, NULL),
(26, 12, 14, 1, NULL, NULL),
(27, 13, 14, 8, NULL, NULL),
(28, 13, 14, 9, NULL, NULL),
(29, 13, 14, 10, NULL, NULL),
(30, 13, 14, 11, NULL, NULL),
(31, 13, 14, 12, NULL, NULL),
(32, 12, 15, 2, NULL, NULL),
(33, 13, 15, 9, NULL, NULL),
(34, 13, 15, 11, NULL, NULL),
(35, 13, 15, 12, NULL, NULL),
(36, 18, 16, 13, NULL, NULL),
(37, 19, 16, 18, NULL, NULL),
(38, 18, 17, 13, NULL, NULL),
(39, 19, 17, 18, NULL, NULL),
(40, 18, 18, 14, NULL, NULL),
(41, 19, 18, 18, NULL, NULL),
(42, 23, 20, 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `response_text`
--

CREATE TABLE IF NOT EXISTS `response_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `instance_id` int(11) NOT NULL,
  `response_text` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Open_ended_Questions1_idx` (`question_id`),
  KEY `fk_Open_ended_instance1_idx` (`instance_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `response_text`
--

INSERT INTO `response_text` (`id`, `question_id`, `instance_id`, `response_text`, `created_at`, `updated_at`) VALUES
(1, 16, 7, 'because it has great actors, and is written well.  The actors give a deeper meaning to the plot.', NULL, NULL),
(2, 16, 8, 'I know it is a great show, but I haven''t watched it, because I don''t want to cultivate another "time sink"', NULL, NULL),
(3, 16, 9, 'I like meth and science bitch', NULL, NULL),
(4, 16, 10, 'I love science', NULL, NULL),
(6, 16, 12, 'I like it because of the great acting, crazy concept and suspense.', NULL, NULL),
(7, 16, 13, 'i learned a lot from the breaking bad documentaries', NULL, NULL),
(8, 16, 14, 'I actually thought it was pretty exceptional. The thing I didn''t like was the fact that everytime I watched it I''d find myself with a meth pipe in my mouth by the end if the hour. Great for productivity, not so great if you want a life, and to stay out of jail.', NULL, NULL),
(9, 16, 15, 'Never seen it', NULL, NULL),
(10, 21, 16, 'I am hopeful but worried.', NULL, NULL),
(11, 21, 17, 'I feel there are some good match ups but their have been some big blowouts as well.', NULL, NULL),
(12, 21, 18, 'Butthole', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scale`
--

CREATE TABLE IF NOT EXISTS `scale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_type_id` int(11) NOT NULL,
  `answer` varchar(45) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_scale_answer_question_type1_idx` (`question_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `scale`
--

INSERT INTO `scale` (`id`, `question_type_id`, `answer`, `position`) VALUES
(1, 6, 'True', 1),
(2, 6, 'False', 2),
(3, 7, 'Yes', 1),
(4, 7, 'No', 2),
(5, 8, 'Agree', 1),
(6, 8, 'Disagree', 2),
(7, 9, '1', 1),
(8, 9, '2', 2),
(9, 9, '3', 3),
(10, 9, '4', 4),
(11, 9, '5', 5),
(12, 10, 'Very Likely', 1),
(13, 10, 'Somewhat Likely', 2),
(14, 10, 'No Opinion', 3),
(15, 10, 'Somewhat Unlikely', 4),
(16, 10, 'Very Unlikely', 5),
(17, 11, 'Strongly Agree', 1),
(18, 11, 'Agree', 2),
(19, 11, 'No Opinion', 3),
(20, 11, 'Disagree', 4),
(21, 11, 'Strongly Disagree', 5);

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE IF NOT EXISTS `surveys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `description` text,
  `exit_message` text,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `results` tinyint(1) NOT NULL DEFAULT '0',
  `counter` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Survey_Users1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `user_id`, `title`, `description`, `exit_message`, `public`, `active`, `results`, `counter`, `created_at`, `updated_at`) VALUES
(9, 2, 'Example Survey', 'A quick survey to show functionality of this site.  So far this site has 9 question options, but you must signed in to create a survey.  All Questions must be answered.', 'Thanks for taking the time to take this survey.  I truly appreciate it.', 1, 1, 1, 8, NULL, NULL),
(10, 6, 'Tailgate Survey', 'Please take our tailgate survey.', '', 1, 1, 1, 3, NULL, NULL),
(11, 8, 'ddddddddddd', '', '', 1, 0, 1, 0, NULL, NULL),
(12, 9, 'Over 9000?', 'Choose wisely...', '', 1, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `user_level` tinyint(4) DEFAULT '1',
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_level`, `password`, `created_at`, `updated_at`) VALUES
(2, 'Tony', 'antfenech@yahoo.com', 1, '$2y$10$KRAus3n.yglufPnw.hAXsODkTju3Q8EyAg.7aietW5qBnguCYslt6', NULL, NULL),
(3, 'Anthony', 'antfenech@hotmail.com', 1, '$2y$10$WxLlNNdDciT7nSt2XABg..888.kcfTomBrF0Fj/5DTPp4QNQxwBkW', NULL, NULL),
(4, 'bigtrizzy', 'tbilz@swag.net', 1, '$2y$10$kd4BkQgYM2CsH85BEihNfekubBvcDJJtaLW9IqSX534qiOOkt6yzq', NULL, NULL),
(5, 'nosivadnomis', 'nosivadnomis@gmail.com', 1, '$2y$10$q0yjOteMlBdtc9ljrL8S8O5fIIpEWkKbV1FYwNkVkLsjk/YUOU8z2', NULL, NULL),
(6, 'zguy981', 'paulzellmer9@gmail.com', 1, '$2y$10$AfCWqOT/rgharpiR//Eh8OTZ/fh/InwP.XcLyYK2RhbhlREGlhmI6', NULL, NULL),
(7, 'example', 'example2@gmail.com', 1, '$2y$10$RmDIUI3fZYr9JJ8Ygu.Cy.yV1YvqPTp/CZYCJikiikDYfyC22e10S', NULL, NULL),
(8, 'tester', 'example@test.com', 1, '$2y$10$.k0MaGcNift0iXjAkVFDvOpnnAoB3DaPJTNkg.E66wgP23qzpIHE6', NULL, NULL),
(9, 'over9000', 'over9000@test.com', 1, '$2y$10$PnyKsjGol3T2XHpznoLTG.Nekxih5BCFSi23uzk.Zm339DwR/wz6S', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `fk_users_has_surveys_surveys1` FOREIGN KEY (`surveys_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_has_surveys_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `answers_predefined`
--
ALTER TABLE `answers_predefined`
  ADD CONSTRAINT `fk_response_scale_instance1` FOREIGN KEY (`instance_id`) REFERENCES `instance` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_response_scale_questions1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_response_scale_scale1` FOREIGN KEY (`scale_id`) REFERENCES `scale` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `answers_user_defined`
--
ALTER TABLE `answers_user_defined`
  ADD CONSTRAINT `fk_answers_questions1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_Questions_Question_type1` FOREIGN KEY (`question_type_id`) REFERENCES `question_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_questions_Survey` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `fk_responses_answers1` FOREIGN KEY (`answer_id`) REFERENCES `answers_user_defined` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Responses_instance1` FOREIGN KEY (`instance_id`) REFERENCES `instance` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_responses_questions1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `response_text`
--
ALTER TABLE `response_text`
  ADD CONSTRAINT `fk_Open_ended_instance1` FOREIGN KEY (`instance_id`) REFERENCES `instance` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Open_ended_Questions1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scale`
--
ALTER TABLE `scale`
  ADD CONSTRAINT `fk_scale_answer_question_type1` FOREIGN KEY (`question_type_id`) REFERENCES `question_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `fk_Survey_Users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

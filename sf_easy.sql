-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2020 at 09:55 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sf_easy`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `body_num` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `user_id`, `body_num`, `status`) VALUES
(2, 2, 'DSF23', 1),
(3, 8, 'asdsf', 1),
(4, 10, 'fsf3', 1),
(5, 13, 'sdfggre323', 1),
(6, 12, 'asdfgderre3243', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bus_route_update`
--

CREATE TABLE `bus_route_update` (
  `id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `web_coor` varchar(100) NOT NULL,
  `app_coor` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ch_logo`
--

CREATE TABLE `ch_logo` (
  `id` int(11) NOT NULL,
  `site_fk` int(11) DEFAULT NULL,
  `path` varchar(250) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ch_logo`
--

INSERT INTO `ch_logo` (`id`, `site_fk`, `path`, `status`, `timestamp`) VALUES
(1, 1, '51661729_1411132349023276_8325639407163932672_n.png', 1, '2019-11-29 14:58:43');

-- --------------------------------------------------------

--
-- Table structure for table `ch_site`
--

CREATE TABLE `ch_site` (
  `id` int(11) NOT NULL,
  `site_name` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ch_site`
--

INSERT INTO `ch_site` (`id`, `site_name`, `timestamp`) VALUES
(1, 'Easy Ride Terminal Hub', '2019-11-29 14:58:43');

-- --------------------------------------------------------

--
-- Table structure for table `dispatcher`
--

CREATE TABLE `dispatcher` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `terminal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dispatcher`
--

INSERT INTO `dispatcher` (`id`, `user_id`, `terminal_id`) VALUES
(7, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_receiver_id` int(11) DEFAULT NULL,
  `user_sender_id` int(11) DEFAULT NULL,
  `msg_content` text,
  `msg_date` varchar(50) DEFAULT NULL,
  `msg_time` varchar(100) NOT NULL,
  `delivered_status` tinyint(1) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_receiver_id`, `user_sender_id`, `msg_content`, `msg_date`, `msg_time`, `delivered_status`, `timestamp`) VALUES
(19, 3, 2, 'hahhaha mao ron', 'Dec. 09, 2019', '11:53 am', NULL, '2019-12-09 04:01:00'),
(20, 2, 3, 'hhhelkkwjjsjs', 'Dec. 09, 2019', '12:00 pm', NULL, '2019-12-09 04:00:15'),
(21, 3, 2, 'hello', 'Dec. 09, 2019', '01:31 pm', NULL, '2019-12-09 05:31:41'),
(22, 3, 2, 'make me cum', 'Dec. 09, 2019', '01:33 pm', NULL, '2019-12-09 05:33:13'),
(23, 3, 2, 'heelooo', 'Dec. 09, 2019', '01:33 pm', NULL, '2019-12-09 05:33:37'),
(24, 3, 2, 'hhhe nj', 'Dec. 09, 2019', '02:00 pm', NULL, '2019-12-09 06:00:51'),
(25, 3, 2, 'hgjvfh vjjj', 'Dec. 09, 2019', '02:03 pm', NULL, '2019-12-09 06:03:31'),
(26, 3, 2, 'hbn', 'Dec. 09, 2019', '02:03 pm', NULL, '2019-12-09 06:03:44'),
(27, 1, 2, 'bbn', 'Dec. 09, 2019', '02:03 pm', NULL, '2019-12-12 11:00:55'),
(28, 3, 2, 'hello dong musta dha?', 'Dec. 09, 2019', '02:06 pm', NULL, '2019-12-09 06:06:45'),
(29, 3, 2, 'heeellll', 'Dec. 09, 2019', '02:26 pm', NULL, '2019-12-09 06:26:06'),
(30, 3, 2, 'jjk', 'Dec. 09, 2019', '02:27 pm', NULL, '2019-12-09 06:27:20'),
(31, 1, 3, 'sir', 'Jan. 22, 2020', '11:48 am', NULL, '2020-01-22 03:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `places_attraction`
--

CREATE TABLE `places_attraction` (
  `id` int(11) NOT NULL,
  `terminal_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `coordinates` varchar(250) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `places_attraction`
--

INSERT INTO `places_attraction` (`id`, `terminal_id`, `name`, `address`, `coordinates`, `timestamp`) VALUES
(2, 4, 'Walra', 'Balugo International Network', '9.305815, 123.304314', '2019-12-03 02:12:31'),
(3, 11, 'Forest Camp', 'Valencia Palinpinun', '9.287871, 123.238803', '2019-12-07 13:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `place_image`
--

CREATE TABLE `place_image` (
  `id` int(11) NOT NULL,
  `place_id` int(11) DEFAULT NULL,
  `img_path` varchar(250) DEFAULT NULL,
  `profile_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `place_image`
--

INSERT INTO `place_image` (`id`, `place_id`, `img_path`, `profile_status`) VALUES
(1, 2, 'Annotation 2019-11-22 235841.png', 1),
(2, 3, '912d37287a3f2734ff5f5094fc7bb58f121b3b96_00.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `place_rating`
--

CREATE TABLE `place_rating` (
  `id` int(11) NOT NULL,
  `place_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `place_review`
--

CREATE TABLE `place_review` (
  `id` int(11) NOT NULL,
  `place_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating_id` int(11) DEFAULT NULL,
  `review_content` varchar(250) DEFAULT NULL,
  `date_sibmited` varchar(250) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `from_terminal` varchar(250) DEFAULT NULL,
  `to_terminal` varchar(250) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `name`, `from_terminal`, `to_terminal`, `timestamp`) VALUES
(9, 'Balugo To Valencia', '9.280717, 123.245202', '9.305794, 123.304336', '2019-12-09 01:27:12'),
(10, 'Sibulan to valencia', '9.303585, 123.305579', '9.305783, 123.304346', '2020-02-08 07:34:55');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `bus_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `depart_time` varchar(250) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `bus_id`, `route_id`, `depart_time`, `status`, `timestamp`) VALUES
(4, 2, 9, '04:00 PM', 0, '2019-12-09 01:54:55'),
(5, 4, 10, '08:30 AM', 0, '2020-02-08 07:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `terminal_loc`
--

CREATE TABLE `terminal_loc` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `latlong` varchar(250) DEFAULT NULL,
  `coordinate_mobile` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminal_loc`
--

INSERT INTO `terminal_loc` (`id`, `name`, `latlong`, `coordinate_mobile`, `timestamp`) VALUES
(1, 'Paradahan Valencia', '9.303585, 123.305579', ' 123.305579, 9.303585', '2019-12-05 03:43:17'),
(2, 'Dumaguete', '9.304708, 123.307468', '123.307468, 9.304708', '2019-12-05 03:43:39'),
(3, 'Sibulan', '9.305783, 123.304346', '123.304346, 9.305783', '2019-12-05 03:44:04'),
(4, 'Balugo', '9.305794, 123.304336', '123.304336, 9.305794', '2019-12-05 03:44:26'),
(10, 'Calindagan', '9.282166, 123.297152', '123.297152, 9.282166', '2019-12-05 03:44:44'),
(11, 'Valencia', '9.280717, 123.245202', '123.245202, 9.280717', '2019-12-05 03:45:00'),
(12, 'NorSu', '9.306819, 123.306033', '123.306033, 9.306819', '2020-01-22 08:06:20'),
(13, 'NOrsu Terminal', '9.312155, 123.302907', '123.302907, 9.312155', '2020-01-22 08:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `user_pass` varchar(250) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `user_availability` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `firstname`, `lastname`, `user_pass`, `user_type`, `is_admin`, `user_availability`) VALUES
(1, 'rJames', NULL, NULL, '$2y$10$QQ3pFwXcX7MZnpezVnaCZe99hT4CsJobeQ89Xw7V2w88Unw.f2gb.', 1, 1, NULL),
(2, 'John', NULL, NULL, '$2y$10$QQ3pFwXcX7MZnpezVnaCZe99hT4CsJobeQ89Xw7V2w88Unw.f2gb.', 3, NULL, NULL),
(3, 'Mike', NULL, NULL, '$2y$10$QQ3pFwXcX7MZnpezVnaCZe99hT4CsJobeQ89Xw7V2w88Unw.f2gb.', 2, NULL, NULL),
(9, 'Johnny', NULL, NULL, '$2y$10$2BfX3K1gIvq9ESSyBPH8wunSNfUib8t1L8UMTxul2YETO//hgLMAW', 3, NULL, NULL),
(10, 'Johnny', NULL, NULL, '$2y$10$Qfvle54cmWFnWmhKN3ZYOufBnPrE9VL9jB9H45x6Si8j0XUb4wb9W', 3, NULL, NULL),
(11, 'Michael', 'Michael', NULL, '$2y$10$hKx5Ag43dUacXKbl0X0nEeMKELiFek3aJatecC9zYg6DZ.r40Lh7y', 3, NULL, NULL),
(12, 'Jogn', 'Jogn', NULL, '$2y$10$gxj7sKFm8xTEC3uAfI5Zu.lKLX34O.bV8AoZcs1Vv9hqX0pD.1MeC', 3, NULL, NULL),
(13, 'asdfgfhjh', 'asdfgfhjh', NULL, '$2y$10$SMszsBkOBihasVMfglZbsOEOWOyZowJq0Yf2qQ52NmioCREcYMHgu', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_contact`
--

CREATE TABLE `user_contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_contact`
--

INSERT INTO `user_contact` (`id`, `user_id`, `contact`, `status`) VALUES
(1, 2, '09352758057', 1),
(2, 3, '2366', 1),
(3, 4, '746324', 1),
(4, 6, '3465432', 1),
(5, 7, '22366666', 1),
(6, 8, '3499', 1),
(7, 9, 'asdasd', 1),
(8, 10, 'asdasd', 1),
(9, 11, '45678', 1),
(10, 4, '233', 1),
(11, 5, 's3', 1),
(12, 6, '3224', 1),
(13, 7, 'asds', 1),
(14, 8, 'ss', 1),
(15, 9, '234445', 1),
(16, 10, '234445', 1),
(17, 11, '45633', 1),
(18, 12, '21324', 1),
(19, 13, '2456uy65432', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_email`
--

CREATE TABLE `user_email` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email_add` varchar(50) DEFAULT NULL,
  `email_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_email`
--

INSERT INTO `user_email` (`id`, `user_id`, `email_add`, `email_status`) VALUES
(1, 1, 'root@gmail.com', 1),
(2, 3, 'mike@gmail.com', 1),
(3, 2, 'john@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `img_path` varchar(250) DEFAULT NULL,
  `profile_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK` (`user_id`);

--
-- Indexes for table `bus_route_update`
--
ALTER TABLE `bus_route_update`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_logo`
--
ALTER TABLE `ch_logo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK` (`site_fk`);

--
-- Indexes for table `ch_site`
--
ALTER TABLE `ch_site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispatcher`
--
ALTER TABLE `dispatcher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places_attraction`
--
ALTER TABLE `places_attraction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK` (`terminal_id`);

--
-- Indexes for table `place_image`
--
ALTER TABLE `place_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK` (`place_id`);

--
-- Indexes for table `place_rating`
--
ALTER TABLE `place_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK` (`place_id`,`user_id`);

--
-- Indexes for table `place_review`
--
ALTER TABLE `place_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK` (`place_id`,`user_id`,`rating_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK` (`from_terminal`,`to_terminal`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK` (`bus_id`,`route_id`);

--
-- Indexes for table `terminal_loc`
--
ALTER TABLE `terminal_loc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_contact`
--
ALTER TABLE `user_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_email`
--
ALTER TABLE `user_email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK` (`user_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bus_route_update`
--
ALTER TABLE `bus_route_update`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ch_logo`
--
ALTER TABLE `ch_logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ch_site`
--
ALTER TABLE `ch_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dispatcher`
--
ALTER TABLE `dispatcher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `places_attraction`
--
ALTER TABLE `places_attraction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `place_image`
--
ALTER TABLE `place_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `place_rating`
--
ALTER TABLE `place_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `place_review`
--
ALTER TABLE `place_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `terminal_loc`
--
ALTER TABLE `terminal_loc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_contact`
--
ALTER TABLE `user_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_email`
--
ALTER TABLE `user_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

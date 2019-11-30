CREATE TABLE `user` (
  `id` int auto_increment,
  `username` varchar(50),
  `firstname` varchar(50),
  `lastname` varchar(50),
  `user_pass` varchar(250),
  `user_type` int(11),
  `is_admin` boolean,
  `user_availability` boolean,
  PRIMARY KEY (`id`)
);

CREATE TABLE `ch_site` (
  `id` int auto_increment,
  `site_name` varchar(50),
  `timestamp` timestamp,
  PRIMARY KEY (`id`)
);

CREATE TABLE `user_email` (
  `id` int auto_increment,
  `user_id` int(11),
  `email_add` varchar(50),
  `email_status` boolean,
  PRIMARY KEY (`id`),
  KEY `FK` (`user_id`)
);

CREATE TABLE `messages` (
  `id` int auto_increment,
  `user_receiver_id` int(11),
  `user_sender_id` int(11),
  `msg_content` text,
  `msg_date` varchar(50),
  `delivered_status` boolean,
  `timestamp` timestamp,
  PRIMARY KEY (`id`)
);

CREATE TABLE `user_profile` (
  `id` int auto_increment,
  `user_id` int(11),
  `img_path` varchar(250),
  `profile_status` boolean,
  PRIMARY KEY (`id`),
  KEY `FK` (`user_id`)
);

CREATE TABLE `bus` (
  `id` int auto_increment,
  `user_id` int,
  `body_num` varchar(50),
  PRIMARY KEY (`id`),
  KEY `FK` (`user_id`)
);

CREATE TABLE `places_attraction` (
  `id` int auto_increment,
  `terminal_id` int(11),
  `name` varchar(50),
  `address` varchar(250),
  `latitude` varchar(250),
  `longitude` varchar(250),
  `timestamp` timestamp,
  PRIMARY KEY (`id`),
  KEY `FK` (`terminal_id`)
);

CREATE TABLE `terminal_loc` (
  `id` int auto_increment,
  `name` varchar(50),
  `address` varchar(250),
  `latitude` varchar(250),
  `longitude` varchar(250),
  `timestamp` timestamp,
  PRIMARY KEY (`id`)
);

CREATE TABLE `schedules` (
  `id` int auto_increment,
  `bus_id` int(11),
  `route_id` int(11),
  `depart_time` varchar(250),
  `status` boolean,
  `timestamp` timestamp,
  PRIMARY KEY (`id`),
  KEY `FK` (`bus_id`, `route_id`)
);

CREATE TABLE `routes` (
  `id` int auto_increment,
  `from_terminal` int(11),
  `to_terminal` int(11),
  `timestamp` timestamp,
  PRIMARY KEY (`id`),
  KEY `FK` (`from_terminal`, `to_terminal`)
);

CREATE TABLE `place_image` (
  `id` int auto_increment,
  `place_id` int(11),
  `img_path` varchar(250),
  `profile_status` boolean,
  PRIMARY KEY (`id`),
  KEY `FK` (`place_id`)
);

CREATE TABLE `place_review` (
  `id` int auto_increment,
  `place_id` int(11),
  `user_id` int(11),
  `rating_id` int(11),
  `review_content` varchar(250),
  `date_sibmited` varchar(250),
  `timestamp` timestamp,
  PRIMARY KEY (`id`),
  KEY `FK` (`place_id`, `user_id`, `rating_id`)
);

CREATE TABLE `place_rating` (
  `id` int auto_increment,
  `place_id` int(11),
  `user_id` int(11),
  `rating` int(1),
  PRIMARY KEY (`id`),
  KEY `FK` (`place_id`, `user_id`)
);

CREATE TABLE `ch_logo` (
  `id` int auto_increment,
  `site_fk` int(11),
  `path` varchar(250),
  `status` boolean,
  `timestamp` timestamp,
  PRIMARY KEY (`id`),
  KEY `FK` (`site_fk`)
);


-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 25, 2020 at 06:44 PM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `codflix`
--

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Horreur'),
(3, 'Science-Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `finish_date` datetime DEFAULT NULL,
  `watch_duration` int(11) NOT NULL DEFAULT '0' COMMENT 'in seconds'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `release_date` date NOT NULL,
  `summary` longtext NOT NULL,
  `trailer_url` varchar(100) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `typeof` int(11) DEFAULT NULL,
  `saison` int(11) DEFAULT NULL,
  `episode1` varchar(255) DEFAULT NULL,
  `episode2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `genre_id`, `title`, `status`, `release_date`, `summary`, `trailer_url`, `duration`, `typeof`, `saison`, `episode1`, `episode2`) VALUES
(1, 1, 'Les indestructibles', 'test', '2004-11-24', 'Bob Paar était jadis l\'un des plus grands super-héros de la planète. Tout le monde connaissait MrIndestructible, le héros qui, chaque jour, sauvait des centaines de vies et combattait le mal', 'http://www.youtube.com/embed/uiKOvRIvV1Y', '1h 56m\r\n', 1, NULL, NULL, NULL),
(2, 1, 'Sonic', 'test', '2020-02-09', 'Les mésaventures de Sonic, alors qu\'il tente de naviguer dans la complexité de la vie sur Terre, aux côtés de son nouveau meilleur ami, Tom Wachowski, un humain.', 'http://www.youtube.com/embed/NCZTYdAP6w0', '1h 40m\r\n', 1, NULL, NULL, NULL),
(3, 1, '1917', 'test', '2020-01-15', 'Le film relate la journée de deux jeunes soldats anglais pris dans la tourmente de la Première Guerre Mondiale.', 'http://www.youtube.com/embed/NRN01ifgJ_U', '1h 59m', 1, NULL, NULL, NULL),
(4, 3, 'Stalk', 'test', '2020-03-13', 'Lucas alias Lux vient d’intégrer la meilleure école d’ingénieurs. Lors du WEI du BDE, il se fait humilier. En stalkant les responsables grâce à son talent informatique, il trouve le moyen de se venger. ', 'http://www.youtube.com/embed/iyBkyk2ra9E', '18m 55', 2, 1, 'http://www.youtube.com/embed/6sU1yYWCiic', 'http://www.youtube.com/embed/7ASLjOtO5jk'),
(6, 1, 'Validé', 'test', '2004-11-02', 'Validé est une série télévisée dramatique sur le rap français créée par Franck Gastambide, Charles Van Tieghem, Xavier Lacaille et Giulio Callegari. La première saison, diffusée sur Canal+, paraît sur la chaîne le 20 mars 2020.', 'http://www.youtube.com/embed/wYtOmqkWBXg', '30m 24', 2, 1, 'http://www.youtube.com/embed/QqvRwnpqUrE', 'http://www.youtube.com/embed/GMwJFoM3lds');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'film'),
(2, 'serie');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(80) NOT NULL,
  `keyEmail` varchar(255) DEFAULT NULL,
  `emailVerified` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `keyEmail`, `emailVerified`) VALUES
(1, 'coding@gmail.com', '123456', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_user_id_fk_media_id` (`user_id`),
  ADD KEY `history_media_id_fk_media_id` (`media_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_genre_id_fk_genre_id` (`genre_id`) USING BTREE,
  ADD KEY `media_type_id_fk_type_id` (`typeof`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_media_id_fk_media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_user_id_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_genre_id_b1257088_fk_genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`),
  ADD CONSTRAINT `media_type_id_fk_type_id` FOREIGN KEY (`typeof`) REFERENCES `type` (`id`);
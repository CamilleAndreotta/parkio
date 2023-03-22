-- Adminer 4.8.1 MySQL 8.0.32 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `computer`;
CREATE TABLE `computer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `computer` (`id`, `model`, `serial_number`, `password`, `purchase_date`, `status`) VALUES
(1,	'HP Z2 G9 Tour - Windows 10 Professionnel, i7, 16 Go, 1To SSD',	'1111-1111-1111-1111',	'mdp',	'2023-03-22',	'Available'),
(2,	'HP Z2 G9 Tour - Windows 10 Professionnel, i7, 16 Go, 1To SSD',	'2222-2222-2222-22222',	'mdp',	'2023-03-22',	'Available'),
(3,	'HP Z2 G9 Tour - Windows 10 Professionnel, i7, 16 Go, 1To SSD',	'3333-3333-3333-3333',	'mdp',	'2023-03-22',	'Available'),
(4,	'HP Z2 G9 Tour - Windows 10 Professionnel, i7, 16 Go, 1To SSD',	'4444-4444-4444-4444',	'mdp',	'2023-03-22',	'Available'),
(5,	'HP Z2 G9 Tour - Windows 10 Professionnel, i7, 16 Go, 1To SSD',	'5555-5555-5555-5555',	'mdp',	'2023-03-22',	'Available'),
(6,	'HP Z2 G9 Tour - Windows 10 Professionnel, i7, 16 Go, 1To SSD',	'6666-6666-6666-6666',	'mdp',	'2023-03-22',	'Available');

DROP TABLE IF EXISTS `external_location`;
CREATE TABLE `external_location` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `external_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `laptop_id` int DEFAULT NULL,
  `mouse_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B1923B38D59905E5` (`laptop_id`),
  UNIQUE KEY `UNIQ_B1923B3823574B71` (`mouse_id`),
  KEY `IDX_B1923B38A76ED395` (`user_id`),
  CONSTRAINT `FK_B1923B3823574B71` FOREIGN KEY (`mouse_id`) REFERENCES `mouse` (`id`),
  CONSTRAINT `FK_B1923B38A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_B1923B38D59905E5` FOREIGN KEY (`laptop_id`) REFERENCES `laptop` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `internal_location`;
CREATE TABLE `internal_location` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `date_start` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `information` longtext COLLATE utf8mb4_unicode_ci,
  `computer_id` int DEFAULT NULL,
  `laptop_id` int DEFAULT NULL,
  `monitor_id` int DEFAULT NULL,
  `videoprojector_id` int DEFAULT NULL,
  `mouse_id` int DEFAULT NULL,
  `keyboard_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_913C0413A426D518` (`computer_id`),
  UNIQUE KEY `UNIQ_913C0413D59905E5` (`laptop_id`),
  UNIQUE KEY `UNIQ_913C04134CE1C902` (`monitor_id`),
  UNIQUE KEY `UNIQ_913C04139DFDD8E8` (`videoprojector_id`),
  UNIQUE KEY `UNIQ_913C041323574B71` (`mouse_id`),
  UNIQUE KEY `UNIQ_913C0413F17292C6` (`keyboard_id`),
  KEY `IDX_913C0413A76ED395` (`user_id`),
  CONSTRAINT `FK_913C041323574B71` FOREIGN KEY (`mouse_id`) REFERENCES `mouse` (`id`),
  CONSTRAINT `FK_913C04134CE1C902` FOREIGN KEY (`monitor_id`) REFERENCES `monitor` (`id`),
  CONSTRAINT `FK_913C04139DFDD8E8` FOREIGN KEY (`videoprojector_id`) REFERENCES `videoprojector` (`id`),
  CONSTRAINT `FK_913C0413A426D518` FOREIGN KEY (`computer_id`) REFERENCES `computer` (`id`),
  CONSTRAINT `FK_913C0413A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_913C0413D59905E5` FOREIGN KEY (`laptop_id`) REFERENCES `laptop` (`id`),
  CONSTRAINT `FK_913C0413F17292C6` FOREIGN KEY (`keyboard_id`) REFERENCES `keyboard` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `keyboard`;
CREATE TABLE `keyboard` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `keyboard` (`id`, `model`, `status`) VALUES
(1,	'Clavier sans fil Logitech MX Keys Advanced Wireless Graphite',	'Available'),
(2,	'Clavier sans fil Logitech MX Keys Advanced Wireless Graphite',	'Available'),
(3,	'Clavier sans fil Logitech MX Keys Advanced Wireless Graphite',	'Available'),
(4,	'Clavier sans fil Logitech MX Keys Advanced Wireless Graphite',	'Available'),
(5,	'Clavier sans fil Logitech MX Keys Advanced Wireless Graphite',	'Available'),
(6,	'Clavier sans fil Logitech MX Keys Advanced Wireless Graphite',	'Available');

DROP TABLE IF EXISTS `laptop`;
CREATE TABLE `laptop` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `affectation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `laptop` (`id`, `model`, `serial_number`, `password`, `purchase_date`, `affectation`, `status`) VALUES
(1,	'HP EliteBook 840 G9, 14\" , Windows 10 Professionnel, i5, 16 Go, 512 Go SSD',	'1111-1111-1111-1111',	'mdp',	'2023-03-22',	'Interne',	'Available'),
(2,	'HP EliteBook 840 G9, 14\" , Windows 10 Professionnel, i5, 16 Go, 512 Go SSD',	'2222-2222-2222-2222',	'mdp',	'2023-03-22',	'Interne',	'Available'),
(3,	'HP EliteBook 840 G9, 14\" , Windows 10 Professionnel, i5, 16 Go, 512 Go SSD',	'3333-3333-3333-3333',	'mdp',	'2023-03-23',	'Interne',	'Available'),
(4,	'Asus Ordinateur portable 15.6\'\' FHD I5 8Go',	'4444-4444-4444-4444',	'mdp',	'2023-03-22',	'Externe',	'Available'),
(5,	'Asus Ordinateur portable 15.6\'\' FHD I5 8Go',	'5555-5555-5555-5555',	'mdp',	'2023-03-22',	'Externe',	'Available'),
(6,	'Asus Ordinateur portable 15.6\'\' FHD I5 8Go',	'6666-6666-6666-6666',	'mdp',	'2023-03-22',	'Externe',	'Available');

DROP TABLE IF EXISTS `monitor`;
CREATE TABLE `monitor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `monitor` (`id`, `model`, `purchase_date`, `status`) VALUES
(1,	'Ecran PC Aoc 27B2H/EU',	'2023-03-22',	'Available'),
(2,	'Ecran PC Aoc 27B2H/EU',	'2023-03-22',	'Available'),
(3,	'Ecran PC Aoc 27B2H/EU',	'2023-03-22',	'Available'),
(4,	'Ecran PC Aoc 27B2H/EU',	'2023-03-22',	'Available'),
(5,	'Ecran PC Aoc 27B2H/EU',	'2023-03-22',	'Available'),
(6,	'Ecran PC Aoc 27B2H/EU',	'2023-03-22',	'Available');

DROP TABLE IF EXISTS `mouse`;
CREATE TABLE `mouse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `affectation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `mouse` (`id`, `model`, `affectation`, `status`) VALUES
(1,	'Souris sans fil Logitech M330 SILENT PLUS Noir',	'Interne',	'Available'),
(2,	'Souris sans fil Logitech M330 SILENT PLUS Noir',	'Interne',	'Available'),
(3,	'Souris sans fil Logitech M330 SILENT PLUS Noir',	'Interne',	'Available'),
(4,	'Souris sans fil Logitech M330 SILENT PLUS Noir',	'Interne',	'Available'),
(5,	'Souris sans fil Logitech M330 SILENT PLUS Noir',	'Interne',	'Available'),
(6,	'Souris sans fil Logitech M330 SILENT PLUS Noir',	'Interne',	'Available'),
(7,	'Souris filaire Logitech M90',	'Externe',	'Available'),
(8,	'Souris filaire Logitech M90',	'Externe',	'Available'),
(9,	'Souris filaire Logitech M90',	'Externe',	'Available'),
(10,	'Souris filaire Logitech M90',	'Externe',	'Available'),
(11,	'Souris filaire Logitech M90',	'Externe',	'Available'),
(12,	'Souris filaire Logitech M90',	'Externe',	'Available');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `internal_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `internal_user`) VALUES
(1,	'camille@camille',	'[\"ROLE_USER\", \"ROLE_ADMIN\"]',	'$2y$13$X4Hi4SR8vZBr4by8l9CJ2eUA2QqoXLY7ddx85BBSsax8rvm9MMYwS',	'Andreotta Camille'),
(2,	'david.christophe@gmail.com',	'[]',	'$2y$13$9kctJdfMO6sNVH66h7v6ZemdU.URzgvTIq6AJKGXb3rGivYsyXDF.',	'David Christrophe'),
(3,	'berger.remi@gmail.com',	'[]',	'$2y$13$mDegVytJilaZ6dWB3X4P0O6UjNgeMcwO0BuzgF0K6dcOBlGU8qhPG',	'Berger Rémi'),
(4,	'landreau.stephanie@gmail.com',	'[]',	'$2y$13$EE9Rg9JCnEoqWBtbIe2EXuQQmdATgdFQTvETj92wycsH9Qk/9RAEC',	'Landreau Stéphanie');

DROP TABLE IF EXISTS `videoprojector`;
CREATE TABLE `videoprojector` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `videoprojector` (`id`, `model`, `purchase_date`, `status`) VALUES
(1,	'Vidéoprojecteur bureautique Benq MS536',	'2023-03-22',	'Available'),
(2,	'Vidéoprojecteur bureautique Benq MS536',	'2023-03-22',	'Available'),
(3,	'Vidéoprojecteur bureautique Benq MS536',	'2023-03-22',	'Available'),
(4,	'Vidéoprojecteur bureautique Benq MS536',	'2023-03-22',	'Available'),
(5,	'Vidéoprojecteur bureautique Benq MS536',	'2023-03-22',	'Available'),
(6,	'Vidéoprojecteur bureautique Benq MS536',	'2023-03-22',	'Available');

-- 2023-03-22 09:47:55
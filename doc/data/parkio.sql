-- Adminer 4.8.1 MySQL 8.0.32 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

INSERT INTO `computer` (`id`, `model`, `serial_number`, `password`, `purchase_date`, `status`) VALUES
(1,	'PC fixe interne disponible 1',	'1111-1111-1111-1111',	'psw',	'2023-03-13',	'available'),
(2,	'PC fixe interne disponible 2',	'2222-2222-2222-2222',	'psw',	'2023-03-13',	'available'),
(3,	'PC fixe interne disponible 3',	'3333-3333-3333-3333',	'psw',	'2023-03-13',	'available'),


DROP TABLE IF EXISTS `keyboard`;
CREATE TABLE `keyboard` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `affectation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `keyboard` (`id`, `model`, `status`) VALUES
(1,	'Clavier interne disponible 1',	'available'),
(2,	'Clavier interne disponible 2',	'available'),
(3,	'Clavier interne disponible 3',	'available'),

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
(1,	'Portable interne disponible 1',	'0000-0000-0000-0000',	'psw',	'2023-03-12',	'interne',	'available'),
(2,	'Portable interne disponible 2',	'1111-1111-1111-1111',	'psw',	'2023-03-12',	'interne',	'available'),
(3,	'Portable interne disponible 3',	'3333-3333-3333-3333',	'psw',	'2023-03-12',	'interne',	'available'),
(7,	'Portable externe disponible 1',	'1111-1111-1111-1111',	'psw',	'2023-03-12',	'externe',	'available'),
(8,	'Portable externe disponible 2',	'2222-2222-2222-2222',	'psw',	'2023-03-12',	'externe',	'available'),
(9,	'Portable externe disponible 3',	'3333-3333-3333-3333',	'psw',	'2023-03-12',	'externe',	'available'),


DROP TABLE IF EXISTS `monitor`;
CREATE TABLE `monitor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `monitor` (`id`, `model`, `purchase_date`, `status`) VALUES
(1,	'Moniteur disponible 1',	'2023-03-12',	'available'),
(2,	'Moniteur disponible 2',	'2023-03-12',	'available'),
(3,	'Moniteur disponible 3',	'2023-03-12',	'available'),

DROP TABLE IF EXISTS `mouse`;
CREATE TABLE `mouse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `affectation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `mouse` (`id`, `model`, `affectation`, `status`) VALUES
(1,	'Souris interne disponible 1',	'interne',	'available'),
(2,	'Souris interne disponible 2',	'interne',	'available'),
(3,	'Souris interne disponible 3',	'interne',	'available'),
(7,	'Souris externe disponible 1',	'externe',	'available'),
(8,	'Souris externe disponible 2',	'externe',	'available'),
(9,	'Souris externe disponible 3',	'externe',	'available'),


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


DROP TABLE IF EXISTS `videoprojector`;
CREATE TABLE `videoprojector` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `videoprojector` (`id`, `model`, `purchase_date`, `status`) VALUES
(1,	'Videoprojecteur disponible 1',	'1974-08-25',	'available'),
(2,	'Videoprojecteur disponible 2',	'2023-03-12',	'available'),
(3,	'Videoprojecteur disponible 3',	'2023-03-12',	'available'),


-- 2023-03-13 10:23:20

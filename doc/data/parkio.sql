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
(4,	'PC fixe interne indisponible 1',	'1111-1111-1111-1111',	'psw',	'2023-03-13',	'notAvailable'),
(5,	'PC fixe interne indisponible 3',	'3333-3333-3333-3333',	'psw',	'2023-03-13',	'notAvailable'),
(6,	'PC fixe interne indisponible 2',	'2222-2222-2222-2222',	'psw',	'2023-03-13',	'notAvailable'),


DROP TABLE IF EXISTS `keyboard`;
CREATE TABLE `keyboard` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `affectation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `keyboard` (`id`, `model`, `affectation`, `status`) VALUES
(1,	'Clavier interne disponible 1',	'interne',	'available'),
(2,	'Clavier interne disponible 2',	'interne',	'available'),
(3,	'Clavier interne disponible 3',	'interne',	'available'),
(4,	'Clavier interne indisponible 1',	'interne',	'notAvailable'),
(5,	'Clavier interne indisponible 2',	'interne',	'notAvailable'),
(6,	'Clavier interne indisponible 3',	'interne',	'notAvailable'),
(7,	'Clavier externe disponible 1',	'externe',	'available'),
(8,	'Clavier externe disponible 2',	'externe',	'available'),
(9,	'Clavier externe disponible 3',	'externe',	'available'),
(10,	'Clavier externe indisponible 1',	'externe',	'notAvailable'),
(11,	'Clavier externe indisponible 2',	'externe',	'notAvailable'),
(12,	'Clavier externe indisponible 3',	'externe',	'notAvailable');

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
(4,	'Portable interne indisponible 1',	'1111-1111-1111-1111',	'psw',	'2023-03-12',	'interne',	'notAvailable'),
(5,	'Portable interne indisponible 2',	'2222-2222-2222-2222',	'psw',	'2023-03-12',	'interne',	'notAvailable'),
(6,	'Portable interne indisponible 3',	'3333-3333-3333-3333',	'psw',	'2023-03-12',	'interne',	'notAvailable'),
(7,	'Portable externe disponible 1',	'1111-1111-1111-1111',	'psw',	'2023-03-12',	'externe',	'available'),
(8,	'Portable externe disponible 2',	'2222-2222-2222-2222',	'psw',	'2023-03-12',	'externe',	'available'),
(9,	'Portable externe disponible 3',	'3333-3333-3333-3333',	'psw',	'2023-03-12',	'externe',	'available'),
(10,	'Portable externe indisponible 1',	'1111-1111-1111-1111',	'psw',	'2023-03-12',	'externe',	'notAvailable'),
(11,	'Portable externe indisponible 2',	'2222-2222-2222-2222',	'psw',	'2023-03-12',	'externe',	'notAvailable'),
(12,	'Portable externe indisponible 3',	'3333-3333-3333-3333',	'psw',	'2023-03-12',	'externe',	'notAvailable');

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
(4,	'Moniteur indisponible 1',	'2023-03-12',	'notAvailable'),
(5,	'Moniteur indisponible 2',	'2023-03-12',	'notAvailable'),
(6,	'Moniteur indisponible 3',	'2023-03-12',	'notAvailable');

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
(4,	'Souris interne indisponible 1',	'interne',	'notAvailable'),
(5,	'Souris interne indisponible 2',	'interne',	'notAvailable'),
(6,	'Souris interne indisponible 3',	'interne',	'notAvailable'),
(7,	'Souris externe disponible 1',	'externe',	'available'),
(8,	'Souris externe disponible 2',	'externe',	'available'),
(9,	'Souris externe disponible 3',	'externe',	'available'),
(10,	'Souris externe indisponible 1',	'externe',	'notAvailable'),
(11,	'Souris externe indisponible 2',	'externe',	'notAvailable'),
(12,	'souris externe indisponible 3',	'externe',	'notAvailable');

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
(4,	'Videoprojecteur indisponible 1',	'2023-03-12',	'notAvailable'),
(5,	'Videoprojecteur indisponible 2',	'2023-03-12',	'notAvailable'),
(6,	'Videoprojecteur indisponible 3',	'2023-03-12',	'notAvailable');

-- 2023-03-13 10:23:20

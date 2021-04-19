-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `alarmes`;
CREATE TABLE `alarmes` (
                           `id` int(11) NOT NULL AUTO_INCREMENT,
                           `heures` varchar(100) NOT NULL,
                           `minutes` varchar(100) NOT NULL,
                           `message` varchar(255) CHARACTER SET utf8 NOT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2021-04-19 22:55:18
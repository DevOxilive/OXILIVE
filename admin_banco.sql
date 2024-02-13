-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para bdoxilive
DROP DATABASE IF EXISTS `bdoxilive`;
CREATE DATABASE IF NOT EXISTS `bdoxilive` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bdoxilive`;

-- Volcando estructura para tabla bdoxilive.administradora
DROP TABLE IF EXISTS `administradora`;
CREATE TABLE IF NOT EXISTS `administradora` (
  `id_administradora` int NOT NULL AUTO_INCREMENT,
  `Nombre_administradora` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_administradora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdoxilive.administradora: ~5 rows (aproximadamente)
DELETE FROM `administradora`;
INSERT INTO `administradora` (`id_administradora`, `Nombre_administradora`) VALUES
	(15, 'PROSESO'),
	(16, 'ASISMED'),
	(17, 'PUNTO PEN'),
	(18, 'OMA'),
	(19, 'PARTICULAR');

-- Volcando estructura para tabla bdoxilive.bancos
DROP TABLE IF EXISTS `bancos`;
CREATE TABLE IF NOT EXISTS `bancos` (
  `id_bancos` int NOT NULL AUTO_INCREMENT,
  `Nombre_banco` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `admi` int NOT NULL,
  PRIMARY KEY (`id_bancos`),
  KEY `admi` (`admi`),
  CONSTRAINT `FK1_admin` FOREIGN KEY (`admi`) REFERENCES `administradora` (`id_administradora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdoxilive.bancos: ~17 rows (aproximadamente)
DELETE FROM `bancos`;
INSERT INTO `bancos` (`id_bancos`, `Nombre_banco`, `admi`) VALUES
	(55, 'HSBC ACTIVOS', 15),
	(56, 'BANJERCITO', 15),
	(57, 'BIENESTAR', 15),
	(58, 'NAFIN', 15),
	(59, 'SHF', 15),
	(60, 'FONATUR', 16),
	(61, 'CONDUSEF', 16),
	(62, 'SANTANDER', 16),
	(63, 'ASISMED', 16),
	(64, 'HSBC JUBILADOS', 17),
	(65, 'INDEP', 18),
	(66, 'JLYF', 18),
	(67, 'BANOBRAS', 18),
	(68, 'OCEAS', 19),
	(69, 'PREVEM', 19),
	(70, 'MANEDIC AEROPUERTO TEXCOCO', 19),
	(71, 'MONTE DE PIEDAD', 19);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

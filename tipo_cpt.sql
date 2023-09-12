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
CREATE DATABASE IF NOT EXISTS `bdoxilive` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bdoxilive`;

-- Volcando estructura para tabla bdoxilive.tipo_cpt
CREATE TABLE IF NOT EXISTS `tipo_cpt` (
  `id_cpt` int NOT NULL AUTO_INCREMENT,
  `cpt` varchar(20) NOT NULL DEFAULT '0',
  `descripcion` varchar(150) NOT NULL DEFAULT '0',
  `unidades` varchar(150) NOT NULL DEFAULT '0',
  `fecha` date DEFAULT NULL,
  `id_aseguradora` int DEFAULT NULL,
  `id_administradora` int DEFAULT NULL,
  `Id_pacientes_oxigeno` int DEFAULT NULL,
  PRIMARY KEY (`id_cpt`),
  KEY `id_aseguradora` (`id_aseguradora`),
  KEY `id_administradora` (`id_administradora`),
  KEY `Id_pacientes_oxigeno` (`Id_pacientes_oxigeno`),
  CONSTRAINT `FK_id_administradora` FOREIGN KEY (`id_administradora`) REFERENCES `administradora` (`id_administradora`),
  CONSTRAINT `FK_id_aseguradora` FOREIGN KEY (`id_aseguradora`) REFERENCES `aseguradoras` (`id_aseguradora`),
  CONSTRAINT `FK_id_pacientes_oxigeno` FOREIGN KEY (`Id_pacientes_oxigeno`) REFERENCES `pacientes_oxigeno` (`id_pacientes`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.tipo_cpt: ~2 rows (aproximadamente)
DELETE FROM `tipo_cpt`;
INSERT INTO `tipo_cpt` (`id_cpt`, `cpt`, `descripcion`, `unidades`, `fecha`, `id_aseguradora`, `id_administradora`, `Id_pacientes_oxigeno`) VALUES
	(1, 'EN-BA-0555', 'Apoyo 5 Horas', 'Turno 5 Horas', '2023-09-12', NULL, NULL, NULL),
	(2, 'EN-BA-05', 'Apoyo 8 Horas', 'Turno 8 horas', '2023-09-12', NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

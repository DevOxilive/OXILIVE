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

-- Volcando estructura para tabla bdoxilive.cpts_administradora
CREATE TABLE IF NOT EXISTS `cpts_administradora` (
  `id_cpt` int NOT NULL AUTO_INCREMENT,
  `cpt` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `admi` int DEFAULT NULL,
  PRIMARY KEY (`id_cpt`),
  KEY `administradora` (`admi`) USING BTREE,
  CONSTRAINT `FK1_admi_cpt` FOREIGN KEY (`admi`) REFERENCES `administradora` (`id_administradora`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.cpts_administradora: ~9 rows (aproximadamente)
DELETE FROM `cpts_administradora`;
INSERT INTO `cpts_administradora` (`id_cpt`, `cpt`, `descripcion`, `unidad`, `fecha`, `admi`) VALUES
	(20, 'EN-BA-02', 'Apoyo General 8 Horas', 'Unidad 8 Horas', '2023-10-10', 1),
	(21, 'EN-BA-03', 'Apoyo General 9 Horas', 'Unidad 9 Horas', '2023-10-10', 1),
	(22, 'EN-BA-04', 'Apoyo General 10 Horas', 'Unidad 10Horas', '2023-10-10', 1),
	(23, 'CS-MN-10', 'Apoyo General 8 Horas', 'Unidad 8 Horas', '2023-10-10', 2),
	(24, 'CS-MN-10', 'Apoyo General 9 Horas', 'Unidad 9 Horas', '2023-10-10', 2),
	(25, 'HJ-GG-66', 'Apoyo General 8 Horas', 'Unidad 8 Horas', '2023-10-10', 3),
	(26, 'HJ-GG-66', 'Apoyo General 8 Horas', 'Unidad 8 Horas', '2023-10-10', 3),
	(27, 'HJ-GG-66', 'Apoyo General 8 Horas', 'Unidad 8 Horas', '2023-10-10', 3),
	(28, 'HJ-GG-66', 'Apoyo General 8 Horas', 'Unidad 8 Horas', '2023-10-10', 3);

-- Volcando estructura para tabla bdoxilive.procedimientos
CREATE TABLE IF NOT EXISTS `procedimientos` (
  `id_procedi` int NOT NULL AUTO_INCREMENT,
  `icd` varchar(50) DEFAULT NULL,
  `dx` varchar(50) DEFAULT NULL,
  `medico` int DEFAULT NULL,
  `pacienteYnomina` int DEFAULT NULL,
  `cpts` int DEFAULT NULL,
  PRIMARY KEY (`id_procedi`),
  KEY `medico` (`medico`),
  KEY `pacienteYnomina` (`pacienteYnomina`),
  KEY `cpts` (`cpts`),
  CONSTRAINT `FK1_medico` FOREIGN KEY (`medico`) REFERENCES `usuarios` (`id_usuarios`),
  CONSTRAINT `FK2_pacienteYnomina` FOREIGN KEY (`pacienteYnomina`) REFERENCES `pacientes_oxigeno` (`id_pacientes`),
  CONSTRAINT `FK3_cpt` FOREIGN KEY (`cpts`) REFERENCES `cpts_administradora` (`id_cpt`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.procedimientos: ~0 rows (aproximadamente)
DELETE FROM `procedimientos`;
INSERT INTO `procedimientos` (`id_procedi`, `icd`, `dx`, `medico`, `pacienteYnomina`, `cpts`) VALUES
	(5, '188.3/164', 'Cancer Rico / CR', 7, 29, 21),
	(6, '189.4/165', 'Pulmonia / PLMA', 9, 32, 25),
	(7, '199.6/130', 'Rico_Pollo / RP', 6, 33, 27);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.28-MariaDB - mariadb.org binary distribution
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
CREATE DATABASE IF NOT EXISTS `bdoxilive` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bdoxilive`;

-- Volcando estructura para tabla bdoxilive.pacientes_oxigeno
CREATE TABLE IF NOT EXISTS `pacientes_oxigeno` (
  `id_pacientes` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `genero` int(11) NOT NULL,
  `edad` varchar(5) NOT NULL,
  `tipoPaciente` int(10) DEFAULT 0,
  `telefono` varchar(10) NOT NULL,
  `telefonoDos` varchar(10) DEFAULT NULL,
  `colonia` int(10) NOT NULL DEFAULT 0,
  `calle` varchar(100) NOT NULL,
  `num_ext` varchar(50) NOT NULL,
  `num_int` varchar(50) DEFAULT NULL,
  `calleUno` varchar(50) NOT NULL,
  `calleDos` varchar(50) NOT NULL,
  `referencias` varchar(250) DEFAULT NULL,
  `administradora` int(11) DEFAULT NULL,
  `aseguradora` int(11) DEFAULT NULL,
  `banco` int(11) DEFAULT NULL,
  `Credencial_front` longblob DEFAULT NULL,
  `Credencial_post` longblob DEFAULT NULL,
  `Credencial_aseguradora` longblob DEFAULT NULL,
  `comprobante` longblob DEFAULT NULL,
  `Credencial_aseguradoras_post` longblob DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `rfc` varchar(50) DEFAULT NULL,
  `responsable` varchar(100) DEFAULT NULL,
  `Fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_pacientes`) USING BTREE,
  KEY `FK_pacientes_oxigeno_estado_paciente` (`estado`),
  KEY `FK1_genero_idx` (`genero`) USING BTREE,
  KEY `FK_tipoPaciente` (`tipoPaciente`),
  KEY `FK_colonia` (`colonia`),
  KEY `FK2_administradora_idx` (`administradora`) USING BTREE,
  KEY `FK4_banco_idx` (`banco`) USING BTREE,
  KEY `Aseguradora` (`aseguradora`) USING BTREE,
  CONSTRAINT `FK1_genero` FOREIGN KEY (`Genero`) REFERENCES `genero` (`id_genero`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_administradora` FOREIGN KEY (`administradora`) REFERENCES `administradora` (`id_administradora`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK4_banco` FOREIGN KEY (`banco`) REFERENCES `bancos` (`id_bancos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_colonia` FOREIGN KEY (`colonia`) REFERENCES `colonias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pacientes_oxigeno_aseguradoras` FOREIGN KEY (`aseguradora`) REFERENCES `aseguradoras` (`id_aseguradora`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_pacientes_oxigeno_estado_paciente` FOREIGN KEY (`estado`) REFERENCES `estado_paciente` (`id_estadop`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tipoPaciente` FOREIGN KEY (`tipoPaciente`) REFERENCES `tipo_pacientes` (`id_tipoPaciente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdoxilive.pacientes_oxigeno: ~0 rows (aproximadamente)
DELETE FROM `pacientes_oxigeno`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

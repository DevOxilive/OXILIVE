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

-- Volcando estructura para tabla bdoxilive.administradora
CREATE TABLE IF NOT EXISTS `administradora` (
  `id_administradora` int NOT NULL AUTO_INCREMENT,
  `Nombre_administradora` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `banco` int DEFAULT NULL,
  PRIMARY KEY (`id_administradora`),
  KEY `bancos` (`banco`) USING BTREE,
  CONSTRAINT `FK1_bancos` FOREIGN KEY (`banco`) REFERENCES `bancos` (`id_bancos`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.administradora: ~7 rows (aproximadamente)
DELETE FROM `administradora`;
INSERT INTO `administradora` (`id_administradora`, `Nombre_administradora`, `Fecha_registro`, `banco`) VALUES
	(1, 'AXA', '2023-08-15 22:35:42', 4),
	(2, 'ASISMED2', '2023-08-15 22:35:59', 1),
	(3, 'PUNTO PEN', '2023-08-15 22:36:09', 2),
	(4, 'PROCESOS', '2023-08-15 22:36:15', 3),
	(5, 'PARTICULAR', '2023-08-15 22:36:21', 1),
	(6, 'PARTICULAR', '2023-08-15 22:39:34', 2),
	(7, 'RICOPOLLO2', '2023-10-10 17:22:47', 4);

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
	(22, 'EN-BA-04', 'Apoyo Enfermeria General18 Horas', 'Unidad 10Horas', '2023-10-10', 1),
	(23, 'CS-MN-10', 'Apoyo General 8 Horas', 'Unidad 8 Horas', '2023-10-10', 2),
	(24, 'CS-MN-10', 'Apoyo General 9 Horas', 'Unidad 9 Horas', '2023-10-10', 2),
	(25, 'HJ-GG-66', 'Apoyo General 8 Horas', 'Unidad 8 Horas', '2023-10-10', 3),
	(26, 'HJ-GG-66', 'Apoyo General 8 Horas', 'Unidad 8 Horas', '2023-10-10', 3),
	(27, 'HJ-GG-66', 'Apoyo General 8 Horas', 'Unidad 8 Horas', '2023-10-10', 3),
	(28, 'HJ-GG-66', 'Apoyo General 8 Horas', 'Unidad 8 Horas', '2023-10-10', 3);

-- Volcando estructura para tabla bdoxilive.pacientes_oxigeno
CREATE TABLE IF NOT EXISTS `pacientes_oxigeno` (
  `id_pacientes` int NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Apellidos` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Genero` int NOT NULL,
  `Edad` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `calle` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `num_in` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `num_ext` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `colonia` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cp` int NOT NULL,
  `municipio` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado_direccion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Alcaldia` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Telefono` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Administradora` int NOT NULL,
  `Aseguradora` int NOT NULL,
  `Banco` int NOT NULL,
  `No_nomina` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Credencial_front` longblob,
  `Credencial_post` longblob,
  `Fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Credencial_aseguradora` longblob,
  `comprobante` longblob,
  `Credencial_aseguradoras_post` longblob,
  `referencias` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` int DEFAULT NULL,
  `rfc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `responsable` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_pacientes`,`Genero`,`Administradora`,`Banco`,`Aseguradora`) USING BTREE,
  KEY `FK1_genero_idx` (`Genero`) USING BTREE,
  KEY `FK2_administradora_idx` (`Administradora`) USING BTREE,
  KEY `FK4_banco_idx` (`Banco`) USING BTREE,
  KEY `Aseguradora` (`Aseguradora`),
  KEY `FK_pacientes_oxigeno_estado_paciente` (`estado`),
  CONSTRAINT `FK1_genero` FOREIGN KEY (`Genero`) REFERENCES `genero` (`id_genero`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_administradora` FOREIGN KEY (`Administradora`) REFERENCES `administradora` (`id_administradora`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK4_banco` FOREIGN KEY (`Banco`) REFERENCES `bancos` (`id_bancos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_pacientes_oxigeno_aseguradoras` FOREIGN KEY (`Aseguradora`) REFERENCES `aseguradoras` (`id_aseguradora`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_pacientes_oxigeno_estado_paciente` FOREIGN KEY (`estado`) REFERENCES `estado_paciente` (`id_estadop`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdoxilive.pacientes_oxigeno: ~10 rows (aproximadamente)
DELETE FROM `pacientes_oxigeno`;
INSERT INTO `pacientes_oxigeno` (`id_pacientes`, `Nombres`, `Apellidos`, `Genero`, `Edad`, `calle`, `num_in`, `num_ext`, `colonia`, `cp`, `municipio`, `estado_direccion`, `Alcaldia`, `Telefono`, `Administradora`, `Aseguradora`, `Banco`, `No_nomina`, `Credencial_front`, `Credencial_post`, `Fecha_registro`, `Credencial_aseguradora`, `comprobante`, `Credencial_aseguradoras_post`, `referencias`, `estado`, `rfc`, `responsable`) VALUES
	(24, 'oscar alan', 'perea', 1, '15', 'meneses', '3', '2', 'israel', 56345, 'chimalhuacan', 'méxico', 'CMDX', '5584454683', 6, 9, 1, '3', _binary 0x313639363935353735375f707275656261322e6a7067, _binary 0x313639353035363531325f7072756562612e6a7067, '2023-09-18 17:01:35', _binary 0x313639353035363531325f7072756562612e6a7067, _binary 0x313639353035363439355f313639323139373732315f62646f78696c697665202d44442e706466, _binary 0x313639353035363531325f7072756562612e6a7067, 'ruben y levy', 1, 'X0X0X0X0X0X0X0', ''),
	(25, 'Margarita', 'Mora Castro', 2, '15', 'meneses', '3', '2', 'israel', 56345, 'chimalhuacan', 'méxico', 'CMDX', '5584454683', 6, 10, 1, '5', _binary 0x313639353036323035315f7072756562612e6a7067, _binary 0x313639353036323035315f7072756562612e6a7067, '2023-09-18 18:34:12', _binary 0x313639353036323035315f7072756562612e6a7067, _binary 0x313639353036323035315f313639323139373732315f62646f78696c697665202d44442e706466, _binary 0x313639353036323035315f7072756562612e6a7067, 'ruben y levy', 1, 'X0X0X0X0X0X033', 'Pedro'),
	(26, 'kevin', 'vargas', 1, '22', 'meneses', '3', '2', 'israel', 56345, 'chimalhuacan', 'méxico', 'CMDX', '5584454683', 5, 10, 1, '3', _binary 0x313639353932313534315f707275656261322e6a7067, _binary 0x313639353932313534325f707275656261322e6a7067, '2023-09-28 17:18:39', _binary 0x313639353932313534325f707275656261322e6a7067, _binary 0x313639353932313531395f313639323139373732315f62646f78696c697665202d44442e706466, _binary 0x313639353932313534325f707275656261322e6a7067, 'ruben y levy', 1, 'X0X0X0X0X0X221', 'Pedro'),
	(27, 'maria', 'nelva', 2, '18', 'meneses', '3', '2', 'israel', 56345, 'chimalhuacan', 'méxico', 'CMDX', '5584454683', 4, 9, 1, '1', _binary 0x313639353932343633315f7072756562612e6a7067, _binary 0x313639353932343633315f707275656261322e6a7067, '2023-09-28 18:10:31', _binary 0x313639353932343633315f707275656261322e6a7067, _binary 0x313639353932343633315f313639323139373732315f62646f78696c697665202d44442e706466, _binary 0x313639353932343633315f707275656261322e6a7067, 'ruben y levy', 1, 'X0X0X0X0X0X099', 'Pedro'),
	(28, 'Neitar', 'sssss', 1, '15', 'meneses', '3', '2', 'israel', 56345, 'chimalhuacan', 'méxico', 'CMDX', '5584454683', 4, 7, 1, '2', _binary 0x313639353932363539365f7072756562612e6a7067, _binary 0x313639353932363539365f707275656261322e6a7067, '2023-09-28 18:43:16', _binary 0x313639353932363539365f7072756562612e6a7067, _binary 0x313639353932363539365f313639323139373732315f62646f78696c697665202d44442e706466, _binary 0x313639353932363539365f707275656261322e6a7067, 'ruben y levy', 1, 'X0X0X0X0X0X022', 'Pedrow'),
	(29, 'Conar', 'kkkk', 1, '15', 'meneses', '3', '2', 'israel', 56345, 'chimalhuacan', 'méxico', 'CMDX', '5584454683', 4, 6, 1, '1', _binary 0x313639353932363736345f7072756562612e6a7067, _binary 0x313639353932363736345f7072756562612e6a7067, '2023-09-28 18:46:04', _binary 0x313639353932363736345f707275656261322e6a7067, _binary 0x313639353932363736345f313639323139373732315f62646f78696c697665202d44442e706466, _binary 0x313639353932363736345f707275656261322e6a7067, 'ruben y levy', 1, 'X0X0X0X0X0X044', 'Pedro'),
	(30, 'Alfredo', 'vvvvv', 1, '15', 'meneses', '3', '2', 'israel', 56345, 'chimalhuacan', 'méxico', 'CMDX', '5584454683', 2, 4, 1, '4', _binary 0x313639353932363937355f7072756562612e6a7067, _binary 0x313639353932363937355f7072756562612e6a7067, '2023-09-28 18:49:35', _binary 0x313639353932363937355f707275656261322e6a7067, _binary 0x313639353932363937355f313639323139373732315f62646f78696c697665202d44442e706466, _binary 0x313639353932363937355f707275656261322e6a7067, 'ruben y levy', 1, 'X0X0X0X0X0X055', 'Pedro4'),
	(31, 'Diego', 'Montalbo', 1, '15', 'meneses', '3', '2', 'israel', 56344, 'chimalhuacan', 'méxico', 'CMDX', '5584454683', 1, 1, 1, '8', _binary 0x313639353932383737315f7072756562612e6a7067, _binary 0x313639353932383737315f7072756562612e6a7067, '2023-09-28 19:19:31', _binary 0x313639353932383737315f707275656261322e6a7067, _binary 0x313639353932383737315f313639323139373732315f62646f78696c697665202d44442e706466, _binary 0x313639353932383737315f707275656261322e6a7067, 'ruben y levy', 1, 'X0X0X0X0X0X066', 'Don paquis'),
	(32, 'Alexander', 'Malva', 1, '22', 'meneses', '4', '5', 'israele', 56345, 'chimalhuacan', 'méxico', 'CMDX', '5584454683', 2, 3, 1, '3', _binary 0x313639353932393132375f7072756562612e6a7067, _binary 0x313639353932393132375f7072756562612e6a7067, '2023-09-28 19:25:27', _binary 0x313639353932393132375f707275656261322e6a7067, _binary 0x313639353932393132375f313639323139373732315f62646f78696c697665202d44442e706466, _binary 0x313639353932393132375f707275656261322e6a7067, 'ruben y levy', 1, 'X0X0X088X0X0X0', 'Pedro'),
	(33, 'Brenda', 'Nuñes', 2, '30', 'meneses', '6', '4', 'israels', 56345, 'chimalhuacan', 'méxico', 'CMDX', '5584454683', 1, 2, 1, '3', _binary 0x313639353932393334375f7072756562612e6a7067, _binary 0x313639353932393334375f7072756562612e6a7067, '2023-09-28 19:29:07', _binary 0x313639353932393334375f7072756562612e6a7067, _binary 0x313639353932393334375f313639323139373732315f62646f78696c697665202d44442e706466, _binary 0x313639353932393334375f7072756562612e6a7067, 'ruben y levy', 1, 'X033X0X0X0X0X0', 'Pedro');

-- Volcando estructura para tabla bdoxilive.procedimientos
CREATE TABLE IF NOT EXISTS `procedimientos` (
  `id_procedi` int NOT NULL AUTO_INCREMENT,
  `icd` varchar(50) DEFAULT NULL,
  `dx` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `medico` int DEFAULT NULL,
  `pacienteYnomina` int DEFAULT NULL,
  `cpt` int DEFAULT NULL,
  PRIMARY KEY (`id_procedi`),
  KEY `medico` (`medico`),
  KEY `pacienteYnomina` (`pacienteYnomina`),
  KEY `cpts` (`cpt`) USING BTREE,
  CONSTRAINT `FK1_medico` FOREIGN KEY (`medico`) REFERENCES `usuarios` (`id_usuarios`),
  CONSTRAINT `FK2_pacienteYnomina` FOREIGN KEY (`pacienteYnomina`) REFERENCES `pacientes_oxigeno` (`id_pacientes`),
  CONSTRAINT `FK_procedimientos_cpts_administradora` FOREIGN KEY (`cpt`) REFERENCES `cpts_administradora` (`id_cpt`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.procedimientos: ~1 rows (aproximadamente)
DELETE FROM `procedimientos`;
INSERT INTO `procedimientos` (`id_procedi`, `icd`, `dx`, `fecha`, `medico`, `pacienteYnomina`, `cpt`) VALUES
	(47, '187 / 62', 'Adicto a sus beso2s 2 veces', '2023-10-12', 7, 27, 23);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

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
CREATE DATABASE IF NOT EXISTS `bdoxilive` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bdoxilive`;

-- Volcando estructura para tabla bdoxilive.empleados
CREATE TABLE IF NOT EXISTS `empleados` (
  `id_empleado` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `apellidos` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `genero` int NOT NULL,
  `telefonoUno` int DEFAULT NULL,
  `telefonoDos` int DEFAULT NULL,
  `correo` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `curp` varchar(18) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rfc` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `departamento` int NOT NULL,
  `calle` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numExt` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numInt` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `colonia` int DEFAULT NULL,
  `calleUno` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `calleDos` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `referenciasDireccion` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cuenta` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numCuenta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Cuenta,Tarjeta,Clave',
  `estudio` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Cedula,Bachillerato,Secundaria',
  `contrato` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Si contratado, No contratado',
  `nss` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipoLicencia` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `certificadoEstudios` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ineDoc` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `actaNacimiento` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comprobanteDomicilio` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nssDoc` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `curpDoc` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rfcDoc` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `referenciaLabUno` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `referenciaLabDos` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `licenciaUno` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usuarioSistema` int DEFAULT NULL,
  `fechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_empleado`),
  KEY `genero` (`genero`),
  KEY `departamento` (`departamento`),
  KEY `codigoPostal` (`colonia`),
  KEY `usuarioSistemas` (`usuarioSistema`) USING BTREE,
  CONSTRAINT `FK_colonia_empleados` FOREIGN KEY (`colonia`) REFERENCES `colonias` (`id`),
  CONSTRAINT `FK_departamento` FOREIGN KEY (`departamento`) REFERENCES `puestos` (`id_puestos`),
  CONSTRAINT `FK_genero` FOREIGN KEY (`genero`) REFERENCES `genero` (`id_genero`),
  CONSTRAINT `FK_usuarioSistema` FOREIGN KEY (`usuarioSistema`) REFERENCES `usuarios` (`id_usuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdoxilive.empleados: ~2 rows (aproximadamente)
DELETE FROM `empleados`;
INSERT INTO `empleados` (`id_empleado`, `nombres`, `apellidos`, `genero`, `telefonoUno`, `telefonoDos`, `correo`, `curp`, `rfc`, `departamento`, `calle`, `numExt`, `numInt`, `colonia`, `calleUno`, `calleDos`, `referenciasDireccion`, `cuenta`, `numCuenta`, `estudio`, `contrato`, `nss`, `tipoLicencia`, `certificadoEstudios`, `ineDoc`, `actaNacimiento`, `comprobanteDomicilio`, `nssDoc`, `curpDoc`, `rfcDoc`, `referenciaLabUno`, `referenciaLabDos`, `licenciaUno`, `usuarioSistema`, `fechaRegistro`) VALUES
	(9, 'CARLITOS', 'PICKLES', 1, 0, NULL, NULL, NULL, 'FIVA980720BN5', 1, 'Jabillos', '123', NULL, NULL, NULL, NULL, NULL, 'Cuenta,Tarjeta,Clave', NULL, NULL, 'SI', 'Si contratado, No contratado', NULL, '1231231', NULL, NULL, '12312', NULL, NULL, '1231231', NULL, NULL, NULL, 10, '2024-01-16 19:48:09');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

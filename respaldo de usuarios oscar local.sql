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

-- Volcando datos para la tabla bdoxilive.empleados: ~1 rows (aproximadamente)
DELETE FROM `empleados`;
INSERT INTO `empleados` (`id_empleado`, `nombres`, `apellidos`, `genero`, `telefonoUno`, `telefonoDos`, `correo`, `curp`, `rfc`, `departamento`, `calle`, `numExt`, `numInt`, `colonia`, `calleUno`, `calleDos`, `referenciasDireccion`, `cuenta`, `numCuenta`, `estudio`, `contrato`, `nss`, `tipoLicencia`, `certificadoEstudios`, `ineDoc`, `actaNacimiento`, `comprobanteDomicilio`, `nssDoc`, `curpDoc`, `rfcDoc`, `referenciaLabUno`, `referenciaLabDos`, `licenciaUno`, `usuarioSistema`, `fechaRegistro`) VALUES
	(9, 'OSCAR', 'LUIS ISLAS', 1, '5611494439', '5611494439', 'ofter3132@gmail.com', 'LUIO030928HMCSSSA2', 'LUIO030928DU6', 1, 'cda. santa maria', '51', '3', NULL, NULL, NULL, 'casa rica ', 'Cuenta,Tarjeta,Clave', NULL, NULL, 'SI', 'Si contratado, No contratado', NULL, '1231231', NULL, NULL, '12312', NULL, NULL, '1231231', NULL, NULL, NULL, 10, '2024-01-17 01:48:09');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

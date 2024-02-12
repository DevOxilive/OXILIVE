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
  `telefonoUno` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefonoDos` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `correo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `curp` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rfc` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `departamento` int NOT NULL,
  `calle` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numExt` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numInt` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `colonia` int DEFAULT NULL,
  `calleUno` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `calleDos` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `referenciasDireccion` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cuenta` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numCuenta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'CUENTA,TARJETA,CLAVE',
  `estudio` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'CEDULA,BACHILLERATO,SECUNDARIA',
  `especialidadEstudio` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contrato` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'SI CONTRATADO, NO CONTRATADO',
  `nss` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipoLicencia` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fechaAlta` date DEFAULT NULL,
  `tipoDeContrato` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'PLANTA,INDEFINIDO',
  `certificadoEstudios` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ineDoc` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `actaNacimiento` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comprobanteDomicilio` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nssDoc` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `curpDoc` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rfcDoc` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `referenciaLabUno` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `referenciaLabDos` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `licenciaUno` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdoxilive.empleados: ~2 rows (aproximadamente)
DELETE FROM `empleados`;
INSERT INTO `empleados` (`id_empleado`, `nombres`, `apellidos`, `genero`, `telefonoUno`, `telefonoDos`, `correo`, `curp`, `rfc`, `departamento`, `calle`, `numExt`, `numInt`, `colonia`, `calleUno`, `calleDos`, `referenciasDireccion`, `cuenta`, `numCuenta`, `estudio`, `especialidadEstudio`, `contrato`, `nss`, `tipoLicencia`, `fechaAlta`, `tipoDeContrato`, `certificadoEstudios`, `ineDoc`, `actaNacimiento`, `comprobanteDomicilio`, `nssDoc`, `curpDoc`, `rfcDoc`, `referenciaLabUno`, `referenciaLabDos`, `licenciaUno`, `usuarioSistema`, `fechaRegistro`) VALUES
	(9, 'CARLITOS', 'PICKLES', 1, '0', NULL, NULL, NULL, 'FIVA980720BN5', 1, 'Jabillos', '123', NULL, NULL, NULL, NULL, NULL, 'Cuenta,Tarjeta,Clave', NULL, NULL, 'AQUI DEBE HABER ALGO ', 'SI', 'Si contratado, No contratado', NULL, NULL, NULL, '1231231', NULL, NULL, '12312', NULL, NULL, '1231231', NULL, NULL, NULL, 10, '2024-01-16 19:48:09'),
	(79, 'KEVIN BRAYAN', 'GUTIERREZ VARGAS', 1, '22201312', NULL, 'kevin@gmail.com', 'GUVK001225HDFTRVA9', 'X2X2X2X2X2X22', 3, 'MENESES', 'MZ6', 'LT2', 150317205, 'MENDEXZ', 'ROJO', 'CALLE DORLORES', 'http://localhost:8080/OXILIVE/archvieroOxi/capitalHumano/GUVK001225HDFTRVA9 KEVIN BRAYAN/EstadoCuenta.png', '2323243456', 'CEDULA', 'ESPECIALISTA DE LA SALUD 22', 'SI CONTRATADO', '12345678987', 'B', '2024-02-08', 'PLANTA', 'http://localhost:8080/OXILIVE/archvieroOxi/capitalHumano/GUVK001225HDFTRVA9 KEVIN BRAYAN/curp-con-fotografia-como-es.jpg', 'http://localhost:8080/OXILIVE/archvieroOxi/capitalHumano/GUVK001225HDFTRVA9 KEVIN BRAYAN/RFC.jpg', 'http://localhost:8080/OXILIVE/archvieroOxi/capitalHumano/GUVK001225HDFTRVA9 KEVIN BRAYAN/Comprobante domicilio.jpg', 'http://localhost:8080/OXILIVE/archvieroOxi/capitalHumano/GUVK001225HDFTRVA9 KEVIN BRAYAN/CREDENCIALTRES.jpg', 'http://localhost:8080/OXILIVE/archvieroOxi/capitalHumano/GUVK001225HDFTRVA9 KEVIN BRAYAN/ESTUDIO SOCIOECONOMICO.jpg', 'http://localhost:8080/OXILIVE/archvieroOxi/capitalHumano/GUVK001225HDFTRVA9 KEVIN BRAYAN/INE.jpg', 'http://localhost:8080/OXILIVE/archvieroOxi/capitalHumano/GUVK001225HDFTRVA9 KEVIN BRAYAN/INEDOS.jpg', 'http://localhost:8080/OXILIVE/archvieroOxi/capitalHumano/GUVK001225HDFTRVA9 KEVIN BRAYAN/INE-REVERSO.png', 'http://localhost:8080/OXILIVE/archvieroOxi/capitalHumano/GUVK001225HDFTRVA9 KEVIN BRAYAN/REFERENCIA.png', 'http://localhost:8080/OXILIVE/archvieroOxi/capitalHumano/GUVK001225HDFTRVA9 KEVIN BRAYAN/LICENCIA B.jpg', NULL, '2024-02-08 23:03:49');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

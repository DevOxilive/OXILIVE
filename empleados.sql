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
  `telefonoUno` int NOT NULL,
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
  `numCuenta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Cuenta,Tarjeta,Clave',
  `estudio` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Cedula,Bachillerato,Secundaria',
  `contrato` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Si contratado, No contratado',
  `nss` varchar(30) COLLATE utf8mb4_general_ci DEFAULT 'Si contratado, No contratado',
  `certificadoEstudios` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ineAnverso` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ineReverso` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `actaNacimiento` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comprobanteDomicilio` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nssDoc` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `curpDoc` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rfcDoc` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `referenciaLabUno` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `referenciaLabDos` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `licenciaUno` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `licenciaDos` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `licenciaTres` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cuenta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdoxilive.empleados: ~2 rows (aproximadamente)
DELETE FROM `empleados`;
INSERT INTO `empleados` (`id_empleado`, `nombres`, `apellidos`, `genero`, `telefonoUno`, `telefonoDos`, `correo`, `curp`, `rfc`, `departamento`, `calle`, `numExt`, `numInt`, `colonia`, `calleUno`, `calleDos`, `referenciasDireccion`, `numCuenta`, `estudio`, `contrato`, `nss`, `certificadoEstudios`, `ineAnverso`, `ineReverso`, `actaNacimiento`, `comprobanteDomicilio`, `nssDoc`, `curpDoc`, `rfcDoc`, `referenciaLabUno`, `referenciaLabDos`, `licenciaUno`, `licenciaDos`, `licenciaTres`, `cuenta`, `usuarioSistema`, `fechaRegistro`) VALUES
	(9, 'CARLITOS', 'PICKLES', 1, 0, NULL, NULL, NULL, 'FIVA980720BN5', 1, 'Jabillos', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SI', 'Si contratado, No contratado', '1231231', NULL, NULL, NULL, '12312', NULL, NULL, '1231231', NULL, NULL, NULL, NULL, NULL, 'Cuenta,Tarjeta,Clave', 10, '2024-01-16 19:48:09'),
	(56, 'kevin brayan', 'GUTIERREZ VARGAS', 1, 22201312, NULL, 'kevin@gmail.com', 'GUVK001225HDFTRVA9', 'X2X2X2X2X2X22X2', 7, 'MENESES', 'MZ6', 'LT2', 150317205, 'MENDEXZ', 'ROJO', 'CALLE DORLORES', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/GUVK001225HDFTRVA9 kevin brayancomprobante.png', 'Cédula', 'NO', '12345678987', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/GUVK001225HDFTRVA9 kevin brayancedula-profesional.jpg', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/GUVK001225HDFTRVA9 kevin brayanINE.jpg', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/GUVK001225HDFTRVA9 kevin brayanINE-REVERSO.png', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/GUVK001225HDFTRVA9 kevin brayanacta-de-nacimiento.jpg', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/GUVK001225HDFTRVA9 kevin brayanComprobante domicilio.jpg', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/GUVK001225HDFTRVA9 kevin brayannss.jpg', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/GUVK001225HDFTRVA9 kevin brayancurp-con-fotografia-como-es.jpg', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/GUVK001225HDFTRVA9 kevin brayanRFC.jpg', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/GUVK001225HDFTRVA9 kevin brayanREFERENCIA.png', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/GUVK001225HDFTRVA9 kevin brayanREFERENCIA.png', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/GUVK001225HDFTRVA9 kevin brayanLICENCIA A.jpg', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/GUVK001225HDFTRVA9 kevin brayanLICENCIA B.jpg', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/GUVK001225HDFTRVA9 kevin brayanLICENCIA A.jpg', '2323243456', NULL, '2024-01-25 22:41:51');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

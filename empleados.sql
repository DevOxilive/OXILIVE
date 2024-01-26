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

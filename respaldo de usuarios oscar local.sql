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

-- Volcando datos para la tabla bdoxilive.empleados: ~4 rows (aproximadamente)
DELETE FROM `empleados`;
INSERT INTO `empleados` (`id_empleado`, `nombres`, `apellidos`, `genero`, `telefonoUno`, `telefonoDos`, `correo`, `curp`, `rfc`, `departamento`, `calle`, `numExt`, `numInt`, `colonia`, `calleUno`, `calleDos`, `referenciasDireccion`, `cuenta`, `numCuenta`, `estudio`, `contrato`, `nss`, `tipoLicencia`, `certificadoEstudios`, `ineDoc`, `actaNacimiento`, `comprobanteDomicilio`, `nssDoc`, `curpDoc`, `rfcDoc`, `referenciaLabUno`, `referenciaLabDos`, `licenciaUno`, `usuarioSistema`, `fechaRegistro`) VALUES
	(9, 'OSCAR', 'LUIS ISLAS', 1, '5611494439', NULL, 'ofter3132@gmail.com', 'LUIO030928HMCSSSA2', 'LUIO030928DU6', 1, 'cda. santa maria', '51', '3', NULL, NULL, NULL, 'casa rica ', 'Cuenta,Tarjeta,Clave', NULL, NULL, 'SI', 'Si contratado, No contratado', NULL, '1231231', NULL, NULL, '12312', NULL, NULL, '1231231', NULL, NULL, NULL, 10, '2024-01-16 19:48:09'),
	(10, 'bryan', 'LUIS ISLAS', 1, '5611494439', NULL, 'ofter3132@gmail.com', 'LUIO030928HMCSSSA2', 'LUIO030928DU6', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Cuenta,Tarjeta,Clave', 'Cedula,Bachillerato,Secundaria', 'Si contratado, No contratado', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-31 15:26:24'),
	(11, 'MARTHA', 'islas torres', 1, '5611494439', NULL, 'ofter3132@gmail.com', 'LUIB280903HMCSSSA2', 'ferferfre2323', 3, 'wefwefefwfwefwe', '22', '222', 150317298, 'dededewdedw', 'ewdwefewwefwef', 'ewfwefwefwefwefw', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/LUIB280903HMCSSSA2 MARTHAdescarga (1).jpg', '2313213123123123', '', 'SI', '12121222122', 'xx', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/LUIB280903HMCSSSA2 MARTHA/descarga (1).jpg', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/LUIB280903HMCSSSA2 MARTHA/descarga (1).jpg', 'http://localhost:8080/OXILIVE/secciones/chatNotifica/img/usuario.png', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/LUIB280903HMCSSSA2 MARTHA/descarga (1).jpg', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/LUIB280903HMCSSSA2 MARTHAdescarga (1).jpg', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/LUIB280903HMCSSSA2 MARTHAdescarga (1).jpg', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/LUIB280903HMCSSSA2 MARTHAdescarga (1).jpg', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/LUIB280903HMCSSSA2 MARTHAdescarga (1).jpg', 'http://localhost:8080/OXILIVE/secciones/OXILIVE/LUIB280903HMCSSSA2 MARTHAdescarga (1).jpg', 'http://localhost:8080/OXILIVE/secciones/chatNotifica/img/usuario.png', 61, '2024-01-31 15:48:26'),
	(14, 'RICO', 'luis islas', 1, '5611111111', NULL, 'ofter3132@gmail.com', 'RICO280309HMCSSSA2', 'rico280903du6', 1, 'fervrbtrbtr', '21212', '2121', 150317298, 'icewcuicweubub', 'iubububiubuiuib', 'iubiubiubuib', 'http://localhost:8080/OXILIVE/secciones/Capital_humano/empleados/OXILIVE/RICO280309HMCSSSA2 RICO/saitama.jpg', '12345678987654', '', 'SI', '32123432123', 'xx', 'http://localhost:8080/OXILIVE/secciones/Capital_humano/empleados/OXILIVE/RICO280309HMCSSSA2 RICO/saitama.jpg', 'http://localhost:8080/OXILIVE/secciones/Capital_humano/empleados/OXILIVE/RICO280309HMCSSSA2 RICO/saitama.jpg', 'http://localhost:8080/OXILIVE/secciones/chatNotifica/img/usuario.png', 'http://localhost:8080/OXILIVE/secciones/Capital_humano/empleados/OXILIVE/RICO280309HMCSSSA2 RICO/saitama.jpg', 'http://localhost:8080/OXILIVE/secciones/Capital_humano/empleados/OXILIVE/RICO280309HMCSSSA2 RICO/saitama.jpg', 'http://localhost:8080/OXILIVE/secciones/Capital_humano/empleados/OXILIVE/RICO280309HMCSSSA2 RICO/saitama.jpg', 'http://localhost:8080/OXILIVE/secciones/Capital_humano/empleados/OXILIVE/RICO280309HMCSSSA2 RICO/saitama.jpg', 'http://localhost:8080/OXILIVE/secciones/Capital_humano/empleados/OXILIVE/RICO280309HMCSSSA2 RICO/saitama.jpg', 'http://localhost:8080/OXILIVE/secciones/chatNotifica/img/usuario.png', 'http://localhost:8080/OXILIVE/secciones/chatNotifica/img/usuario.png', 60, '2024-01-31 16:18:55');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

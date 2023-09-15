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
CREATE DATABASE IF NOT EXISTS `bdoxilive` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bdoxilive`;

-- Volcando estructura para tabla bdoxilive.administradora
DROP TABLE IF EXISTS `administradora`;
CREATE TABLE IF NOT EXISTS `administradora` (
  `id_administradora` int NOT NULL AUTO_INCREMENT,
  `Nombre_administradora` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_administradora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.administradora: ~6 rows (aproximadamente)
INSERT IGNORE INTO `administradora` (`id_administradora`, `Nombre_administradora`, `Fecha_registro`) VALUES
	(1, 'AXA', '2023-08-15 16:35:42'),
	(2, 'ASISMED', '2023-08-15 16:35:59'),
	(3, 'PUNTO PEN', '2023-08-15 16:36:09'),
	(4, 'PROCESOS', '2023-08-15 16:36:15'),
	(5, 'PARTICULAR', '2023-08-15 16:36:21'),
	(6, 'PARTICULAR', '2023-08-15 16:39:34');

-- Volcando estructura para tabla bdoxilive.almacen
DROP TABLE IF EXISTS `almacen`;
CREATE TABLE IF NOT EXISTS `almacen` (
  `id_almacen` int NOT NULL AUTO_INCREMENT,
  `tipo_material` int NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `entrega` int NOT NULL,
  `recibe` int NOT NULL,
  `fecha_entrada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cantidad` int NOT NULL,
  `observaciones` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `estado` int NOT NULL,
  `cantidad_adecuada` int DEFAULT NULL,
  PRIMARY KEY (`id_almacen`),
  KEY `tipo_material` (`tipo_material`),
  KEY `FK_almacen_empleados` (`entrega`),
  KEY `FK_almacen_empleados_2` (`recibe`),
  KEY `FK_almacen_estado_material` (`estado`),
  CONSTRAINT `FK_almacen_empleados` FOREIGN KEY (`entrega`) REFERENCES `empleados` (`id_empleados`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_almacen_empleados_2` FOREIGN KEY (`recibe`) REFERENCES `empleados` (`id_empleados`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_almacen_estado_material` FOREIGN KEY (`estado`) REFERENCES `estado_material` (`id_estado`),
  CONSTRAINT `FK_almacen_tipo_material` FOREIGN KEY (`tipo_material`) REFERENCES `tipo_material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.almacen: ~5 rows (aproximadamente)
INSERT IGNORE INTO `almacen` (`id_almacen`, `tipo_material`, `nombre`, `entrega`, `recibe`, `fecha_entrada`, `cantidad`, `observaciones`, `estado`, `cantidad_adecuada`) VALUES
	(1, 2, 'PAPEL', 1, 2, '2023-08-21 15:37:18', 6, 'SON ROLLOS DE 1000 HOJAS', 2, 10),
	(2, 1, 'HOJA CARTA', 1, 1, '2023-08-21 16:42:46', 6, 'EL PRODUCTO VIENE EN CAJAS', 1, 15),
	(3, 3, 'MARTILLO', 1, 1, '2023-08-21 16:51:36', 6, 'ES UN MARTILLO NUEVO', 1, 1),
	(4, 4, 'ESCRITORIO', 1, 1, '2023-08-21 20:13:07', 3, 'ESCRITORIOS COMPLETOS, MESA DE CRISTAL', 2, 20),
	(5, 1, 'CLIPS', 1, 2, '2023-08-23 17:12:57', 6, 'CAJA DE CLIPS CON 100 PZ', 2, 20);

-- Volcando estructura para tabla bdoxilive.aseguradoras
DROP TABLE IF EXISTS `aseguradoras`;
CREATE TABLE IF NOT EXISTS `aseguradoras` (
  `id_aseguradora` int NOT NULL AUTO_INCREMENT,
  `Nombre_aseguradora` varchar(50) NOT NULL,
  `Fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `administradora` int NOT NULL,
  PRIMARY KEY (`id_aseguradora`,`administradora`) USING BTREE,
  KEY `administradora` (`administradora`),
  CONSTRAINT `FK_aseguradoras_administradora` FOREIGN KEY (`administradora`) REFERENCES `administradora` (`id_administradora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.aseguradoras: ~11 rows (aproximadamente)
INSERT IGNORE INTO `aseguradoras` (`id_aseguradora`, `Nombre_aseguradora`, `Fecha_registro`, `administradora`) VALUES
	(1, 'SANTANDER', '2023-07-28 23:45:16', 1),
	(2, 'HSBC ACTIVOS', '2023-07-28 23:45:29', 1),
	(3, 'CONDUSEF', '2023-07-28 23:45:41', 2),
	(4, 'FONATUR', '2023-07-28 23:46:06', 2),
	(5, 'HSBC JUBILADOS', '2023-07-28 23:46:18', 3),
	(6, 'JCLYFC', '2023-07-28 23:46:30', 4),
	(7, 'INDEP', '2023-07-28 23:46:44', 4),
	(8, 'NAFIN', '2023-07-28 23:46:53', 4),
	(9, 'BANCO DEL BIENESTAR', '2023-07-28 23:47:04', 5),
	(10, 'SHF', '2023-07-28 23:47:15', 5),
	(11, 'NINGUNA', '2023-08-13 09:27:30', 6);

-- Volcando estructura para tabla bdoxilive.asignacion_equipo
DROP TABLE IF EXISTS `asignacion_equipo`;
CREATE TABLE IF NOT EXISTS `asignacion_equipo` (
  `id_asignacion` int NOT NULL AUTO_INCREMENT,
  `nombreAsignado` int NOT NULL,
  `equipo` int NOT NULL,
  PRIMARY KEY (`id_asignacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.asignacion_equipo: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bdoxilive.asignacion_horarios
DROP TABLE IF EXISTS `asignacion_horarios`;
CREATE TABLE IF NOT EXISTS `asignacion_horarios` (
  `id_asignacionHorarios` int unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_tiposGuardias` int NOT NULL,
  `horarioEntrada` time NOT NULL,
  `horarioSalida` time NOT NULL,
  `fecha` date NOT NULL,
  `id_pacienteEnfermeria` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id_asignacionHorarios`) USING BTREE,
  KEY `FK_idUsuario` (`id_usuario`),
  KEY `FK_idPacienteEnfermeria` (`id_pacienteEnfermeria`),
  KEY `FK_idTiposGuardias` (`id_tiposGuardias`),
  CONSTRAINT `FK_idPacienteEnfermeria` FOREIGN KEY (`id_pacienteEnfermeria`) REFERENCES `pacientes_enfermeria` (`id_pacienteEnfermeria`),
  CONSTRAINT `FK_idTiposGuardias` FOREIGN KEY (`id_tiposGuardias`) REFERENCES `tipos_guardias` (`id_tiposGuardias`),
  CONSTRAINT `FK_idUsuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.asignacion_horarios: ~2 rows (aproximadamente)
INSERT IGNORE INTO `asignacion_horarios` (`id_asignacionHorarios`, `id_usuario`, `id_tiposGuardias`, `horarioEntrada`, `horarioSalida`, `fecha`, `id_pacienteEnfermeria`) VALUES
	(3, 8, 1, '08:00:00', '16:00:00', '2023-09-20', 0000000001),
	(4, 11, 1, '16:00:00', '00:00:00', '2023-09-20', 0000000001);

-- Volcando estructura para tabla bdoxilive.asistencias
DROP TABLE IF EXISTS `asistencias`;
CREATE TABLE IF NOT EXISTS `asistencias` (
  `id_asistencias` int unsigned NOT NULL AUTO_INCREMENT,
  `id_empleadoEnfermeria` int NOT NULL DEFAULT '0',
  `id_check` int unsigned NOT NULL DEFAULT '0',
  `checkTime` time NOT NULL DEFAULT '00:00:00',
  `checkUbicacion` point NOT NULL,
  `checkFotografia` longblob NOT NULL,
  PRIMARY KEY (`id_asistencias`),
  KEY `id_empleadoEnfermeria` (`id_empleadoEnfermeria`),
  KEY `id_check` (`id_check`),
  CONSTRAINT `FK_check` FOREIGN KEY (`id_check`) REFERENCES `check` (`id_check`),
  CONSTRAINT `FK_empleadoEnfermeria` FOREIGN KEY (`id_empleadoEnfermeria`) REFERENCES `usuarios` (`id_usuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.asistencias: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bdoxilive.bancos
DROP TABLE IF EXISTS `bancos`;
CREATE TABLE IF NOT EXISTS `bancos` (
  `id_bancos` int NOT NULL AUTO_INCREMENT,
  `Nombre_banco` varchar(50) NOT NULL,
  `Fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_bancos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.bancos: ~4 rows (aproximadamente)
INSERT IGNORE INTO `bancos` (`id_bancos`, `Nombre_banco`, `Fecha_registro`) VALUES
	(1, 'BANCOMER', '2023-06-02 02:25:50'),
	(2, 'SANTANDER', '2023-06-02 09:38:57'),
	(3, 'CITIBANAMEX', '2023-06-14 00:14:17'),
	(4, 'HSBC', '2023-07-29 00:07:07');

-- Volcando estructura para tabla bdoxilive.carrito
DROP TABLE IF EXISTS `carrito`;
CREATE TABLE IF NOT EXISTS `carrito` (
  `id_carrito` int unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_producto` int NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `precio_producto` double NOT NULL,
  `cantidad` int NOT NULL,
  `fecha_agregado` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_carrito`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE,
  CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_productos`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.carrito: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bdoxilive.carros
DROP TABLE IF EXISTS `carros`;
CREATE TABLE IF NOT EXISTS `carros` (
  `id_carro` int NOT NULL AUTO_INCREMENT,
  `Nombre_carro` varchar(50) NOT NULL,
  `modelo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `marca` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `placa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int NOT NULL,
  PRIMARY KEY (`id_carro`,`estado`) USING BTREE,
  KEY `FK6_estadoCar_idx` (`estado`),
  CONSTRAINT `FK6_estadoCar` FOREIGN KEY (`estado`) REFERENCES `estado_carro` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.carros: ~4 rows (aproximadamente)
INSERT IGNORE INTO `carros` (`id_carro`, `Nombre_carro`, `modelo`, `marca`, `placa`, `Fecha_registro`, `estado`) VALUES
	(1, 'TRANSPORTER 1', 'NISSAN ', 'X', 'XS', '2023-06-02 09:46:25', 1),
	(2, 'TRANSPORTER 2', 'NISSAN', 'NISSAN', '79854', '2023-06-14 01:43:35', 1),
	(3, 'TRANSPORTER 3', 'NISSAN', 'CHEVROLET', '78965', '2023-07-27 00:53:07', 1),
	(4, 'SIN CARRO', 'SN', 'SN', 'SN', '2023-08-14 22:54:11', 1);

-- Volcando estructura para tabla bdoxilive.check
DROP TABLE IF EXISTS `check`;
CREATE TABLE IF NOT EXISTS `check` (
  `id_check` int unsigned NOT NULL AUTO_INCREMENT,
  `checkName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_check`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.check: ~2 rows (aproximadamente)
INSERT IGNORE INTO `check` (`id_check`, `checkName`) VALUES
	(1, 'Check In'),
	(5, 'Check Out');

-- Volcando estructura para tabla bdoxilive.choferes
DROP TABLE IF EXISTS `choferes`;
CREATE TABLE IF NOT EXISTS `choferes` (
  `id_choferes` int NOT NULL AUTO_INCREMENT,
  `Nombre_completo` varchar(50) NOT NULL,
  `Fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int NOT NULL,
  `contador_seleccion` int NOT NULL,
  PRIMARY KEY (`id_choferes`,`estado`),
  KEY `FK7_estadoChof_idx` (`estado`),
  CONSTRAINT `FK7_estadoChof` FOREIGN KEY (`estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.choferes: ~6 rows (aproximadamente)
INSERT IGNORE INTO `choferes` (`id_choferes`, `Nombre_completo`, `Fecha_registro`, `estado`, `contador_seleccion`) VALUES
	(1, 'JUAN PEREZ', '2023-06-02 10:12:07', 1, 0),
	(2, 'PEDRO RUIZ CORTES', '2023-06-14 00:50:58', 1, 1),
	(3, 'CARLOS HERNANDEZ PEREZ', '2023-08-11 20:07:52', 1, 0),
	(4, 'PRUEBA DE ESTADO', '2023-08-11 20:09:49', 1, 0),
	(5, 'MOISES RIVERA', '2023-08-13 11:49:56', 1, 0),
	(6, 'SIN CHOFER', '2023-08-14 22:53:50', 1, 0);

-- Volcando estructura para tabla bdoxilive.empleados
DROP TABLE IF EXISTS `empleados`;
CREATE TABLE IF NOT EXISTS `empleados` (
  `id_empleados` int NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Apellidos` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Edad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Fecha_nacimiento` date NOT NULL,
  `Genero` int NOT NULL,
  `Telefono` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Seguro_social` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rfc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Acta_nacimiento` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Comprobante_domicilio` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Curp` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Titulo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Cedula` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Carta_recomendacion1` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Carta_recomendacion2` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ine` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Banco` int DEFAULT NULL,
  `No_cuenta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Puesto` int NOT NULL,
  PRIMARY KEY (`id_empleados`,`Puesto`) USING BTREE,
  KEY `FK_empleados_puestos` (`Puesto`),
  KEY `FK_empleados_genero` (`Genero`),
  KEY `FK_empleados_bancos` (`Banco`),
  CONSTRAINT `FK_empleados_bancos` FOREIGN KEY (`Banco`) REFERENCES `bancos` (`id_bancos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_empleados_genero` FOREIGN KEY (`Genero`) REFERENCES `genero` (`id_genero`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_empleados_puestos` FOREIGN KEY (`Puesto`) REFERENCES `puestos` (`id_puestos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdoxilive.empleados: ~2 rows (aproximadamente)
INSERT IGNORE INTO `empleados` (`id_empleados`, `Nombres`, `Apellidos`, `Edad`, `Fecha_nacimiento`, `Genero`, `Telefono`, `Seguro_social`, `rfc`, `Acta_nacimiento`, `Comprobante_domicilio`, `Curp`, `Titulo`, `Cedula`, `Carta_recomendacion1`, `Carta_recomendacion2`, `ine`, `Banco`, `No_cuenta`, `Fecha_registro`, `Puesto`) VALUES
	(1, 'PEDRO', 'MENDEZ GUAZMAN', '27', '1996-12-12', 1, '1234567890', '1692630795_1692240261_1.pdf', 'AJER123456', '1692630795_1692241981_1.pdf', '1692630795_1692241954_1 - copia (10).pdf', '1692630795_1691880683_1 - copia (10).pdf', '1692630795_1691879396_2.pdf', '1692630795_1691878815_3.pdf', '1692630795_1691878940_WhatsApp_Image_2023-08-12_at_1.58.05_PM-removebg-preview.png', '1692630795_1691878940_2269eb05d452a07b2af3e2f73ae641b8-removebg-preview.png', '1692630795_utn_256.png', 1, 'SJNSAIDSA', '2023-08-21 15:13:15', 3),
	(2, 'MARCO', 'RIVERA', '26', '1997-12-12', 1, '83959481', '1692631783_1.pdf', 'RIMA123455', '1692631783_2.pdf', '1692631783_3.pdf', '1692631783_4.pdf', '1692631783_5.pdf', '1692631783_6.pdf', '1692631783_7.pdf', '1692631783_8.pdf', '1692632025_10.pdf', 3, 'JHUJHUI', '2023-08-21 15:29:43', 4);

-- Volcando estructura para tabla bdoxilive.entrada_almacen
DROP TABLE IF EXISTS `entrada_almacen`;
CREATE TABLE IF NOT EXISTS `entrada_almacen` (
  `id_entrada` int NOT NULL AUTO_INCREMENT,
  `recibe_entrada` int NOT NULL,
  `pide_entrada` int NOT NULL,
  `cantidad_entrada` int NOT NULL,
  `fecha_entrada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo_mateentra` int DEFAULT NULL,
  `nombre_mateentra` varchar(150) NOT NULL,
  `observacionesentra` varchar(200) NOT NULL,
  `estado_entrada` int DEFAULT NULL,
  PRIMARY KEY (`id_entrada`) USING BTREE,
  KEY `FK_entrada_almacen_empleados` (`recibe_entrada`),
  KEY `FK_entrada_almacen_empleados_2` (`pide_entrada`),
  KEY `FK_entrada_almacen_salida_almacen` (`tipo_mateentra`),
  KEY `FK_entrada_almacen_salida_almacen_3` (`estado_entrada`),
  CONSTRAINT `FK_entrada_almacen_empleados` FOREIGN KEY (`recibe_entrada`) REFERENCES `empleados` (`id_empleados`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_entrada_almacen_empleados_2` FOREIGN KEY (`pide_entrada`) REFERENCES `empleados` (`id_empleados`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_entrada_almacen_salida_almacen` FOREIGN KEY (`tipo_mateentra`) REFERENCES `salida_almacen` (`tipo_matesali`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_entrada_almacen_salida_almacen_3` FOREIGN KEY (`estado_entrada`) REFERENCES `salida_almacen` (`estado_salida`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.entrada_almacen: ~10 rows (aproximadamente)
INSERT IGNORE INTO `entrada_almacen` (`id_entrada`, `recibe_entrada`, `pide_entrada`, `cantidad_entrada`, `fecha_entrada`, `tipo_mateentra`, `nombre_mateentra`, `observacionesentra`, `estado_entrada`) VALUES
	(1, 2, 1, 3, '2023-08-23 18:26:46', 4, 'ESCRITORIO', 'ENTRA SIN DETALLES', 2),
	(2, 1, 2, 1, '2023-08-23 19:58:50', 1, 'HOJA CARTA', 'ENTRA EN PAQUETE', 1),
	(3, 1, 2, 3, '2023-08-23 19:59:27', 1, 'HOJA CARTA', 'ENTRA EN PAQUETE', 1),
	(4, 2, 1, 5, '2023-08-23 20:02:23', 4, 'ESCRITORIO', 'KK', 2),
	(5, 2, 1, 5, '2023-08-23 20:10:39', 4, 'ESCRITORIO', 'KK', 2),
	(6, 1, 1, 5, '2023-08-23 20:11:58', 4, 'ESCRITORIO', 'ENTRA EN PAQUETE', 2),
	(7, 1, 1, 5, '2023-08-23 20:13:21', 4, 'ESCRITORIO', 'dsf', 2),
	(8, 1, 2, 2, '2023-08-23 21:36:21', 1, 'HOJA CARTA', 'efer', 1),
	(9, 1, 2, 3, '2023-08-23 21:40:42', 4, 'ESCRITORIO', 'gff', 2),
	(10, 2, 1, 3, '2023-08-23 21:43:02', 4, 'ESCRITORIO', 'vcd', 2);

-- Volcando estructura para tabla bdoxilive.equipo
DROP TABLE IF EXISTS `equipo`;
CREATE TABLE IF NOT EXISTS `equipo` (
  `id_equipo` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `tipo_equipo` int NOT NULL,
  `entrego` int NOT NULL,
  `recibio` int NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int NOT NULL,
  `no_serie` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `IMEI` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `autorizo` int NOT NULL,
  `observaciones` varchar(250) NOT NULL,
  PRIMARY KEY (`id_equipo`) USING BTREE,
  KEY `FK_equipo_empleados` (`entrego`),
  KEY `FK_equipo_empleados_2` (`recibio`),
  KEY `FK_equipo_estado_equipo` (`estado`),
  KEY `FK_equipo_empleados_3` (`autorizo`),
  KEY `FK_equipo_tipo_equipo` (`tipo_equipo`) USING BTREE,
  CONSTRAINT `FK_equipo_empleados` FOREIGN KEY (`entrego`) REFERENCES `empleados` (`id_empleados`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_equipo_empleados_2` FOREIGN KEY (`recibio`) REFERENCES `empleados` (`id_empleados`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_equipo_empleados_3` FOREIGN KEY (`autorizo`) REFERENCES `empleados` (`id_empleados`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_equipo_estado_equipo` FOREIGN KEY (`estado`) REFERENCES `estado_equipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_equipo_tipo_equipo` FOREIGN KEY (`tipo_equipo`) REFERENCES `tipo_equipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.equipo: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bdoxilive.estado
DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `Nombre_estado` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.estado: ~4 rows (aproximadamente)
INSERT IGNORE INTO `estado` (`id_estado`, `Nombre_estado`) VALUES
	(1, 'Activo'),
	(2, 'Suspendido'),
	(3, 'Baja'),
	(4, 'En ruta'),
	(5, 'En servicio');

-- Volcando estructura para tabla bdoxilive.estado_carro
DROP TABLE IF EXISTS `estado_carro`;
CREATE TABLE IF NOT EXISTS `estado_carro` (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `Nombre_estado` varchar(50) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.estado_carro: ~4 rows (aproximadamente)
INSERT IGNORE INTO `estado_carro` (`id_estado`, `Nombre_estado`) VALUES
	(1, 'ACTIVO'),
	(2, 'MANTENIMIENTO'),
	(3, 'USO'),
	(4, 'TALLER');

-- Volcando estructura para tabla bdoxilive.estado_equipo
DROP TABLE IF EXISTS `estado_equipo`;
CREATE TABLE IF NOT EXISTS `estado_equipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nombre_estado` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.estado_equipo: ~1 rows (aproximadamente)
INSERT IGNORE INTO `estado_equipo` (`id`, `Nombre_estado`) VALUES
	(1, 'FUNCIONAL');

-- Volcando estructura para tabla bdoxilive.estado_insumo
DROP TABLE IF EXISTS `estado_insumo`;
CREATE TABLE IF NOT EXISTS `estado_insumo` (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `estado_insumo` varchar(150) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.estado_insumo: ~1 rows (aproximadamente)
INSERT IGNORE INTO `estado_insumo` (`id_estado`, `estado_insumo`) VALUES
	(1, 'UTIL');

-- Volcando estructura para tabla bdoxilive.estado_material
DROP TABLE IF EXISTS `estado_material`;
CREATE TABLE IF NOT EXISTS `estado_material` (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `nombre_estado` varchar(250) NOT NULL,
  PRIMARY KEY (`id_estado`),
  KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.estado_material: ~8 rows (aproximadamente)
INSERT IGNORE INTO `estado_material` (`id_estado`, `nombre_estado`) VALUES
	(1, 'GUARDADO'),
	(2, 'INVENTARIO'),
	(3, 'SALE'),
	(4, 'MAL ESTADO'),
	(5, 'BUEN ESTADO'),
	(6, 'CON DETALLES'),
	(7, 'UNICO'),
	(8, 'PARA MANTENIMIENTO');

-- Volcando estructura para tabla bdoxilive.estado_paciente
DROP TABLE IF EXISTS `estado_paciente`;
CREATE TABLE IF NOT EXISTS `estado_paciente` (
  `id_estadop` int NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) NOT NULL,
  PRIMARY KEY (`id_estadop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.estado_paciente: ~5 rows (aproximadamente)
INSERT IGNORE INTO `estado_paciente` (`id_estadop`, `estado`) VALUES
	(1, 'ACTIVO'),
	(2, 'SIENDO ENRUTADO'),
	(3, 'FIRMA'),
	(4, 'TERMINADO'),
	(5, 'INACTIVO');

-- Volcando estructura para tabla bdoxilive.estado_ruta
DROP TABLE IF EXISTS `estado_ruta`;
CREATE TABLE IF NOT EXISTS `estado_ruta` (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.estado_ruta: ~3 rows (aproximadamente)
INSERT IGNORE INTO `estado_ruta` (`id_estado`, `estado`) VALUES
	(1, 'EN PROCESO'),
	(2, 'RECOLECCION FIRMA'),
	(3, 'TERMINADA');

-- Volcando estructura para tabla bdoxilive.estado_tanque
DROP TABLE IF EXISTS `estado_tanque`;
CREATE TABLE IF NOT EXISTS `estado_tanque` (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) NOT NULL,
  PRIMARY KEY (`id_estado`),
  KEY `estado` (`estado`),
  KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.estado_tanque: ~7 rows (aproximadamente)
INSERT IGNORE INTO `estado_tanque` (`id_estado`, `estado`) VALUES
	(1, 'ASIGNADO'),
	(2, 'DEFECTO'),
	(3, 'LLENANDO'),
	(4, 'LLENO'),
	(5, 'MANTENIMIENTO'),
	(6, 'POR DEFINIR'),
	(7, 'VACIO');

-- Volcando estructura para tabla bdoxilive.genero
DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `id_genero` int NOT NULL AUTO_INCREMENT,
  `genero` varchar(50) NOT NULL,
  PRIMARY KEY (`id_genero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.genero: ~2 rows (aproximadamente)
INSERT IGNORE INTO `genero` (`id_genero`, `genero`) VALUES
	(1, 'MASCULINO'),
	(2, 'FEMENINO');

-- Volcando estructura para tabla bdoxilive.insumos
DROP TABLE IF EXISTS `insumos`;
CREATE TABLE IF NOT EXISTS `insumos` (
  `id_insumo` int NOT NULL AUTO_INCREMENT,
  `cantidad_insumo` int NOT NULL,
  `marca_insumo` int NOT NULL,
  `tamano_insumo` int NOT NULL,
  `estado_insumo` int NOT NULL,
  PRIMARY KEY (`id_insumo`),
  KEY `id_insumo` (`id_insumo`),
  KEY `FK_insumos_marca_insumo` (`marca_insumo`),
  KEY `FK_insumos_estado_insumo` (`estado_insumo`),
  KEY `FK_insumos_tamano_insumo` (`tamano_insumo`) USING BTREE,
  CONSTRAINT `FK_insumos_estado_insumo` FOREIGN KEY (`estado_insumo`) REFERENCES `estado_insumo` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_insumos_marca_insumo` FOREIGN KEY (`marca_insumo`) REFERENCES `marca_insumo` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_insumos_tamano_insumo` FOREIGN KEY (`tamano_insumo`) REFERENCES `tamano_insumo` (`id_tamano`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.insumos: ~1 rows (aproximadamente)
INSERT IGNORE INTO `insumos` (`id_insumo`, `cantidad_insumo`, `marca_insumo`, `tamano_insumo`, `estado_insumo`) VALUES
	(1, 4, 1, 1, 1);

-- Volcando estructura para tabla bdoxilive.marca_insumo
DROP TABLE IF EXISTS `marca_insumo`;
CREATE TABLE IF NOT EXISTS `marca_insumo` (
  `id_marca` int NOT NULL AUTO_INCREMENT,
  `marca_insumo` varchar(150) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.marca_insumo: ~5 rows (aproximadamente)
INSERT IGNORE INTO `marca_insumo` (`id_marca`, `marca_insumo`) VALUES
	(1, 'EJEMPLO'),
	(2, 'EJEMPLO 2'),
	(3, 'VASO BORBOTEADOR'),
	(4, 'CANULA'),
	(5, 'MASCARILLA');

-- Volcando estructura para tabla bdoxilive.marca_tanque
DROP TABLE IF EXISTS `marca_tanque`;
CREATE TABLE IF NOT EXISTS `marca_tanque` (
  `id_marca` int NOT NULL AUTO_INCREMENT,
  `nombre_marca` varchar(50) NOT NULL,
  PRIMARY KEY (`id_marca`),
  KEY `nombre_marca` (`nombre_marca`),
  KEY `id_marca` (`id_marca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.marca_tanque: ~7 rows (aproximadamente)
INSERT IGNORE INTO `marca_tanque` (`id_marca`, `nombre_marca`) VALUES
	(4, 'CONCENTRADOR'),
	(7, 'PORTATILES'),
	(6, 'REGULADOR'),
	(3, 'TANQUE AEMEH'),
	(1, 'TANQUE INFRA'),
	(2, 'TANQUE OXILIVE'),
	(5, 'TANQUE VERDE');

-- Volcando estructura para tabla bdoxilive.mensajes
DROP TABLE IF EXISTS `mensajes`;
CREATE TABLE IF NOT EXISTS `mensajes` (
  `id_msg` int NOT NULL AUTO_INCREMENT,
  `msg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `fecha_hora` datetime DEFAULT NULL,
  `id_departamento` int DEFAULT NULL,
  PRIMARY KEY (`id_msg`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.mensajes: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bdoxilive.notificaciones
DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_destino` int NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `asunto` varchar(100) NOT NULL,
  `leida` tinyint(1) DEFAULT '0',
  `ruta_asociada` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_notificaciones_usuarios` (`usuario_destino`),
  CONSTRAINT `FK_notificaciones_puestos` FOREIGN KEY (`usuario_destino`) REFERENCES `puestos` (`id_puestos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.notificaciones: ~7 rows (aproximadamente)
INSERT IGNORE INTO `notificaciones` (`id`, `usuario_destino`, `mensaje`, `fecha`, `asunto`, `leida`, `ruta_asociada`) VALUES
	(6, 4, 'AXA generó una nueva ruta', '2023-08-22 16:35:18', 'NUEVA RUTA', 0, NULL),
	(8, 9, 'MARCO Te asigno una nueva ruta', '2023-08-22 16:43:43', 'NUEVA RUTA', 1, NULL),
	(10, 9, 'MARCO Te asigno una nueva ruta', '2023-08-23 16:03:38', 'NUEVA RUTA', 1, NULL),
	(11, 9, 'MARCO Te asigno una nueva ruta', '2023-08-23 22:03:00', 'NUEVA RUTA', 0, NULL),
	(12, 9, 'MARCO Te asigno una nueva ruta', '2023-08-23 22:31:37', 'NUEVA RUTA', 0, NULL),
	(13, 9, 'MARCO Te asigno una nueva ruta', '2023-08-23 22:32:33', 'NUEVA RUTA', 1, NULL),
	(14, 9, 'MARCO Te asigno una nueva ruta', '2023-09-02 20:49:33', 'NUEVA RUTA', 0, NULL);

-- Volcando estructura para tabla bdoxilive.pacientes_enfermeria
DROP TABLE IF EXISTS `pacientes_enfermeria`;
CREATE TABLE IF NOT EXISTS `pacientes_enfermeria` (
  `id_pacienteEnfermeria` int(10) unsigned zerofill NOT NULL,
  `nombre` varchar(100) NOT NULL DEFAULT '',
  `apellidos` varchar(100) NOT NULL DEFAULT '',
  `fechaNacimiento` date NOT NULL,
  PRIMARY KEY (`id_pacienteEnfermeria`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.pacientes_enfermeria: ~1 rows (aproximadamente)
INSERT IGNORE INTO `pacientes_enfermeria` (`id_pacienteEnfermeria`, `nombre`, `apellidos`, `fechaNacimiento`) VALUES
	(0000000001, 'John', 'Doe', '1990-07-20');

-- Volcando estructura para tabla bdoxilive.pacientes_oxigeno
DROP TABLE IF EXISTS `pacientes_oxigeno`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdoxilive.pacientes_oxigeno: ~2 rows (aproximadamente)
INSERT IGNORE INTO `pacientes_oxigeno` (`id_pacientes`, `Nombres`, `Apellidos`, `Genero`, `Edad`, `calle`, `num_in`, `num_ext`, `colonia`, `cp`, `municipio`, `estado_direccion`, `Alcaldia`, `Telefono`, `Administradora`, `Aseguradora`, `Banco`, `No_nomina`, `Credencial_front`, `Credencial_post`, `Fecha_registro`, `Credencial_aseguradora`, `comprobante`, `Credencial_aseguradoras_post`, `referencias`, `estado`, `rfc`, `responsable`) VALUES
	(1, 'MAURICIO', 'BELTRAN', 1, '89', 'ACONITO', '1', '1', 'TLAIXCO', 56337, 'CHIMALHUACAN', 'ESTADO DE MEXICO', 'KOKO', '87965132', 5, 11, 3, 'KOLO123459', _binary 0x313639323139373732315f646573636172676172202835292e6a7067, _binary 0x313639323139373732315f747265652d3733363838355f313238302e6a7067, '2023-08-16 14:55:21', _binary 0x313639323139373732315f313336365f323030302e6a706567, _binary 0x313639323139373732315f62646f78696c697665202d44442e706466, _binary 0x313639323139373732315f64657363617267612e6a7067, 'HHUGUI', 1, 'BEPM111216', 'YO'),
	(4, 'NOIN', 'NNKJ', 1, '21', 'KJKJN', 'KJNKJNKJK', 'JNKJNKJNJ', 'KJNKJNKJ', 12345, 'JNJ', 'JNJ', 'JNJN', 'JBHJB', 4, 7, 3, 'LO09', _binary 0x313639323733313236355f343837303038332e6a7067, _binary 0x313639323733313430345f313639323234303236315f576861747341707020496d61676520323032332d30382d313620617420332e30392e313620504d2e6a706567, '2023-08-22 19:07:45', _binary 0x313639323733313236355f4e61747572655f3130372e6a7067, _binary 0x313639323733313236355f616e65786f5f6d5f3030313133362e706466, _binary 0x313639323733313236355f3230313331302e6a7067, 'JHB', 1, 'KJNJ', 'JNJINJKK');

-- Volcando estructura para tabla bdoxilive.productos
DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id_productos` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `descripcion` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `imagen` longblob,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `categoria` varchar(50) DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `disponible` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_productos`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.productos: ~1 rows (aproximadamente)
INSERT IGNORE INTO `productos` (`id_productos`, `nombre`, `descripcion`, `precio`, `imagen`, `fecha_registro`, `categoria`, `cantidad`, `disponible`) VALUES
	(1, 'PRUEBA DE PRODUCTO', 'PRUEBA DE PRODUCTOP', 1250, _binary 0x313639323230313339395f747265652d3733363838355f313238302e6a7067, '2023-08-16 15:56:39', NULL, 25, 'DISPONIBLE');

-- Volcando estructura para tabla bdoxilive.puestos
DROP TABLE IF EXISTS `puestos`;
CREATE TABLE IF NOT EXISTS `puestos` (
  `id_puestos` int NOT NULL AUTO_INCREMENT,
  `Nombre_puestos` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_puestos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.puestos: ~10 rows (aproximadamente)
INSERT IGNORE INTO `puestos` (`id_puestos`, `Nombre_puestos`, `Fecha_registro`) VALUES
	(1, 'Administrador', '2023-05-30 19:31:17'),
	(2, 'Administradoras', '2023-05-23 04:37:11'),
	(3, 'Sistemas', '2023-05-17 03:19:15'),
	(4, 'Oxígeno', '2023-05-17 03:19:20'),
	(5, 'Call center', '2023-05-17 03:19:26'),
	(6, 'Enfermeria', '2023-05-17 03:19:31'),
	(7, 'Capital Humano', '2023-07-17 22:14:53'),
	(8, 'Almacen', '2023-07-17 22:16:42'),
	(9, 'Chofer', '2023-07-26 00:36:42'),
	(10, 'Cliente', '2023-05-23 06:18:06');

-- Volcando estructura para tabla bdoxilive.ruta_diaria_oxigeno
DROP TABLE IF EXISTS `ruta_diaria_oxigeno`;
CREATE TABLE IF NOT EXISTS `ruta_diaria_oxigeno` (
  `id_ruta` int NOT NULL AUTO_INCREMENT,
  `Fecha_agenda` date NOT NULL,
  `Paciente` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `Direccion` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Alcaldia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Aseguradora` int NOT NULL,
  `Telefono` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Carro` int NOT NULL,
  `Chofer` int NOT NULL,
  `Tanque` int DEFAULT NULL,
  `Regulador` int DEFAULT NULL,
  `Portatil` int DEFAULT NULL,
  `Concentrador` int DEFAULT NULL,
  `Aspirador` int DEFAULT NULL,
  `Cpac` int DEFAULT NULL,
  `Bipac` int DEFAULT NULL,
  `Agua` int DEFAULT NULL,
  `Puntas_n` int DEFAULT NULL,
  `Puntas_neon` int DEFAULT NULL,
  `Vaso_borb` int DEFAULT NULL,
  `Mascarilla` int DEFAULT NULL,
  `Canula` int DEFAULT NULL,
  `Recoleccion_tanque` int DEFAULT NULL,
  `Recoleccion_aspi` int DEFAULT NULL,
  `Recoleccion_concentrador` int DEFAULT NULL,
  `Nota` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Fecha_hora_entrega` datetime DEFAULT NULL,
  `estado` int NOT NULL,
  `Fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ruta`,`Carro`,`Chofer`,`estado`) USING BTREE,
  KEY `FK8_estadoEnt_idx` (`estado`),
  KEY `FK11_carroRut_idx` (`Carro`),
  KEY `FK12_choferRut_idx` (`Chofer`),
  KEY `FK_ruta_diaria_oxigeno_aseguradoras` (`Aseguradora`),
  CONSTRAINT `FK11_carroRut` FOREIGN KEY (`Carro`) REFERENCES `carros` (`id_carro`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK12_choferRut` FOREIGN KEY (`Chofer`) REFERENCES `choferes` (`id_choferes`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK8_estadoEnt` FOREIGN KEY (`estado`) REFERENCES `estado_ruta` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ruta_diaria_oxigeno_aseguradoras` FOREIGN KEY (`Aseguradora`) REFERENCES `aseguradoras` (`id_aseguradora`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdoxilive.ruta_diaria_oxigeno: ~1 rows (aproximadamente)
INSERT IGNORE INTO `ruta_diaria_oxigeno` (`id_ruta`, `Fecha_agenda`, `Paciente`, `Direccion`, `Alcaldia`, `Aseguradora`, `Telefono`, `Carro`, `Chofer`, `Tanque`, `Regulador`, `Portatil`, `Concentrador`, `Aspirador`, `Cpac`, `Bipac`, `Agua`, `Puntas_n`, `Puntas_neon`, `Vaso_borb`, `Mascarilla`, `Canula`, `Recoleccion_tanque`, `Recoleccion_aspi`, `Recoleccion_concentrador`, `Nota`, `Fecha_hora_entrega`, `estado`, `Fecha_registro`) VALUES
	(17, '2023-09-02', 'BELTRAN MAURICIO', 'CHIMALHUACAN', 'KOKO', 11, '87965132', 2, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ' SSSSSS', NULL, 1, '2023-09-02 20:49:33');

-- Volcando estructura para tabla bdoxilive.salida_almacen
DROP TABLE IF EXISTS `salida_almacen`;
CREATE TABLE IF NOT EXISTS `salida_almacen` (
  `id_salida` int NOT NULL AUTO_INCREMENT,
  `entrega_salida` int NOT NULL,
  `pide_salida` int NOT NULL,
  `cantidad_salida` int NOT NULL,
  `fecha_salida` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo_matesali` int DEFAULT NULL,
  `nombre_matesali` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `observacionessali` varchar(200) NOT NULL,
  `estado_salida` int DEFAULT NULL,
  PRIMARY KEY (`id_salida`),
  KEY `FK_salida_almacen_empleados` (`entrega_salida`),
  KEY `FK_salida_almacen_empleados_2` (`pide_salida`),
  KEY `FK_salida_almacen_almacen` (`tipo_matesali`) USING BTREE,
  KEY `FK_salida_almacen_almacen_2` (`nombre_matesali`) USING BTREE,
  KEY `FK_salida_almacen_almacen_3` (`observacionessali`) USING BTREE,
  KEY `FK_salida_almacen_almacen_4` (`estado_salida`) USING BTREE,
  CONSTRAINT `FK_salida_almacen_almacen` FOREIGN KEY (`tipo_matesali`) REFERENCES `almacen` (`id_almacen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_salida_almacen_almacen_4` FOREIGN KEY (`estado_salida`) REFERENCES `almacen` (`id_almacen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_salida_almacen_empleados` FOREIGN KEY (`entrega_salida`) REFERENCES `empleados` (`id_empleados`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_salida_almacen_empleados_2` FOREIGN KEY (`pide_salida`) REFERENCES `empleados` (`id_empleados`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.salida_almacen: ~5 rows (aproximadamente)
INSERT IGNORE INTO `salida_almacen` (`id_salida`, `entrega_salida`, `pide_salida`, `cantidad_salida`, `fecha_salida`, `tipo_matesali`, `nombre_matesali`, `observacionessali`, `estado_salida`) VALUES
	(5, 1, 2, 2, '2023-08-23 16:42:27', 1, 'HOJA CARTA', 'EL PRODUCTO VIENE EN CAJAS', 1),
	(6, 1, 2, 11, '2023-08-23 16:46:15', 1, 'HOJA CARTA', 'EL PRODUCTO VIENE EN CAJAS', 1),
	(7, 1, 1, 5, '2023-08-23 16:49:17', 4, 'ESCRITORIO', 'ESCRITORIOS COMPLETOS, MESA DE CRISTAL', 2),
	(8, 1, 2, 5, '2023-08-23 17:29:22', 1, 'HOJA CARTA', 'EL PRODUCTO VIENE EN CAJAS', 1),
	(9, 1, 2, 3, '2023-08-23 21:57:20', 4, 'ESCRITORIO', 'ESCRITORIOS COMPLETOS, MESA DE CRISTAL', 2);

-- Volcando estructura para tabla bdoxilive.tamano
DROP TABLE IF EXISTS `tamano`;
CREATE TABLE IF NOT EXISTS `tamano` (
  `id_tamano` int NOT NULL AUTO_INCREMENT,
  `tamano` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tamano`),
  KEY `id_tamano` (`id_tamano`),
  KEY `tamano` (`tamano`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.tamano: ~3 rows (aproximadamente)
INSERT IGNORE INTO `tamano` (`id_tamano`, `tamano`) VALUES
	(1, '10,000 L'),
	(3, '460'),
	(2, '9,500 L');

-- Volcando estructura para tabla bdoxilive.tamano_insumo
DROP TABLE IF EXISTS `tamano_insumo`;
CREATE TABLE IF NOT EXISTS `tamano_insumo` (
  `id_tamano` int NOT NULL AUTO_INCREMENT,
  `tamano_insumo` varchar(150) NOT NULL,
  PRIMARY KEY (`id_tamano`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.tamano_insumo: ~1 rows (aproximadamente)
INSERT IGNORE INTO `tamano_insumo` (`id_tamano`, `tamano_insumo`) VALUES
	(1, 'EJEMPLO');

-- Volcando estructura para tabla bdoxilive.tanques
DROP TABLE IF EXISTS `tanques`;
CREATE TABLE IF NOT EXISTS `tanques` (
  `id_tanques` int NOT NULL AUTO_INCREMENT,
  `marca` int NOT NULL,
  `estado_tanque` int NOT NULL,
  `tamano` int NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`id_tanques`),
  KEY `marca` (`marca`),
  KEY `estado_tanque` (`estado_tanque`),
  KEY `id_tanques` (`id_tanques`),
  KEY `cantidad` (`cantidad`),
  KEY `tamaño` (`tamano`) USING BTREE,
  CONSTRAINT `FK_tanques_estado_tanque` FOREIGN KEY (`estado_tanque`) REFERENCES `estado_tanque` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tanques_marca_tanque` FOREIGN KEY (`marca`) REFERENCES `marca_tanque` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tanques_tamano` FOREIGN KEY (`tamano`) REFERENCES `tamano` (`id_tamano`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.tanques: ~7 rows (aproximadamente)
INSERT IGNORE INTO `tanques` (`id_tanques`, `marca`, `estado_tanque`, `tamano`, `cantidad`) VALUES
	(1, 4, 4, 1, 23),
	(2, 1, 4, 2, 8),
	(3, 3, 4, 2, 5),
	(4, 5, 4, 2, 5),
	(5, 2, 4, 2, 3),
	(6, 4, 4, 1, 5),
	(7, 3, 1, 1, 2);

-- Volcando estructura para tabla bdoxilive.tipos_guardias
DROP TABLE IF EXISTS `tipos_guardias`;
CREATE TABLE IF NOT EXISTS `tipos_guardias` (
  `id_tiposGuardias` int NOT NULL AUTO_INCREMENT,
  `nombre_guardia` varchar(50) NOT NULL DEFAULT '',
  `horas_guardia` int(2) unsigned zerofill NOT NULL DEFAULT '00',
  `sueldo` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_tiposGuardias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.tipos_guardias: ~1 rows (aproximadamente)
INSERT IGNORE INTO `tipos_guardias` (`id_tiposGuardias`, `nombre_guardia`, `horas_guardia`, `sueldo`) VALUES
	(1, 'Guardia General', 08, 300);

-- Volcando estructura para tabla bdoxilive.tipo_cpt
DROP TABLE IF EXISTS `tipo_cpt`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.tipo_cpt: ~2 rows (aproximadamente)
INSERT IGNORE INTO `tipo_cpt` (`id_cpt`, `cpt`, `descripcion`, `unidades`, `fecha`, `id_aseguradora`, `id_administradora`, `Id_pacientes_oxigeno`) VALUES
	(1, 'EN-BA-0555', 'Apoyo 5 Horas', 'Turno 5 Horas', '2023-09-12', NULL, NULL, NULL),
	(2, 'EN-BA-05', 'Apoyo 8 Horas', 'Turno 8 horas', '2023-09-12', NULL, NULL, NULL);

-- Volcando estructura para tabla bdoxilive.tipo_equipo
DROP TABLE IF EXISTS `tipo_equipo`;
CREATE TABLE IF NOT EXISTS `tipo_equipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.tipo_equipo: ~14 rows (aproximadamente)
INSERT IGNORE INTO `tipo_equipo` (`id`, `tipo`) VALUES
	(1, 'CELULAR'),
	(2, 'LAPTOP'),
	(3, 'CPU'),
	(4, 'NO BREAK'),
	(5, 'MOUSE'),
	(6, 'TECLADO'),
	(7, 'MONITOR'),
	(8, 'PROYECTOR'),
	(9, 'CARGADOR LAPTOP'),
	(10, 'IMP/MULTIF'),
	(11, 'ESCANER'),
	(12, 'CAMARA F'),
	(13, 'CARGADOR CELULAR'),
	(14, 'OTRO');

-- Volcando estructura para tabla bdoxilive.tipo_material
DROP TABLE IF EXISTS `tipo_material`;
CREATE TABLE IF NOT EXISTS `tipo_material` (
  `id_material` int NOT NULL AUTO_INCREMENT,
  `nombre_material` varchar(250) NOT NULL,
  PRIMARY KEY (`id_material`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.tipo_material: ~4 rows (aproximadamente)
INSERT IGNORE INTO `tipo_material` (`id_material`, `nombre_material`) VALUES
	(1, 'PAPELERIA'),
	(2, 'HIGIENE'),
	(3, 'HERRAMIENTAS'),
	(4, 'OFICINA');

-- Volcando estructura para tabla bdoxilive.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuarios` int NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(50) NOT NULL,
  `paswword` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Nombres` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Genero` int NOT NULL,
  `Telefono` varchar(50) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Estado` int NOT NULL,
  `Foto_perfil` longblob,
  `id_departamentos` int NOT NULL,
  `Fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `rfc` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alcaldia` varchar(50) DEFAULT NULL,
  `calle` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `num_interior` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `num_exterior` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `codigo_postal` int DEFAULT NULL,
  `calleUno` varchar(50) DEFAULT NULL,
  `calleDos` varchar(50) DEFAULT NULL,
  `referencias` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `credencialFrente` longblob,
  `credencialAtras` longblob,
  `comprobante_domicilio` longblob,
  `inicios_sesion` int DEFAULT '0',
  `fecha_sesion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuarios`,`Estado`,`Genero`,`id_departamentos`),
  KEY `FK_estado_idx` (`Estado`),
  KEY `FK_genero_idx` (`Genero`),
  KEY `FK_departamento_idx` (`id_departamentos`),
  CONSTRAINT `FK_departamento` FOREIGN KEY (`id_departamentos`) REFERENCES `puestos` (`id_puestos`),
  CONSTRAINT `FK_estado` FOREIGN KEY (`Estado`) REFERENCES `estado` (`id_estado`),
  CONSTRAINT `FK_genero` FOREIGN KEY (`Genero`) REFERENCES `genero` (`id_genero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.usuarios: ~9 rows (aproximadamente)
INSERT IGNORE INTO `usuarios` (`id_usuarios`, `Usuario`, `paswword`, `Nombres`, `Apellidos`, `Genero`, `Telefono`, `Correo`, `Estado`, `Foto_perfil`, `id_departamentos`, `Fecha_registro`, `rfc`, `alcaldia`, `calle`, `num_interior`, `num_exterior`, `codigo_postal`, `calleUno`, `calleDos`, `referencias`, `credencialFrente`, `credencialAtras`, `comprobante_domicilio`, `inicios_sesion`, `fecha_sesion`) VALUES

	(1, 'admin', '$2y$10$grLCbK0VC5.v93cck.YVd.idrRZSBFk/8/IEVTpBKiEQmbZKyArAO', 'OXILIVE', 'OXILIVE', 2, '0000000000', 'sistemas@oxilive.com.mx', 1, _binary 0x313639323132333638315f6465736361726761722e6a7067, 1, '2023-08-15 18:21:21', 'MABY030624', 'CHIMALHUACAN', NULL, '1', '23', 56337, 'SAN FRANCISCO', 'OYAMEL', 'ENTRANDO POR BARRANCA LADO DERECHO, A UNA DISTANCIA DE 9 CASAS ', _binary 0x313639323132333638315f496d6167656e312e706e67, _binary 0x313639323132333638315f44422e706e67, _binary 0x313639323132333638315f4746442e706466, 65, '2023-08-15 18:21:21'),
	(2, 'DIEGO', '$2y$10$tlQTtD.PAtWv5KTQg723SOgz8X9A6ZE3j58ucsWZOmHIzIgZJkVQ2', 'DIEGO', 'COVARRUBIAS PONCE', 1, '5511794905', 'enfermeria@oxilive.com.mx', 1, _binary 0x313639323132333832345f616161612e6a7067, 3, '2023-08-15 18:23:44', 'COPD121199', 'IXTAPALUCA', NULL, '8', '8', 12345, 'JOSE BA', 'LAURELES', 'FRENTE A UNA TIENDA ', _binary 0x313639323132333832345f696d61676573202833292e6a7067, _binary 0x313639323132333832345f6465736361726761722e6a7067, _binary 0x313639323132333832345f312e706466, 1, '2023-08-15 18:23:44'),
	(3, 'AXA', '$2y$10$2OYqZjCb/KW8aICxL7MWe.W8d3wfU8jFXidyuqPC4xz5C/LtI/JGu', 'AXA', 'AXA', 2, '123456789', 'axa@axa.com.mx', 1, _binary 0x313639323132343136305f7072752e6a7067, 2, '2023-08-15 18:29:20', 'AXA12345', 'AXA', NULL, '5', '5', 85269, 'AXA', 'AXA', 'EN AXA', _binary 0x313639323132343136305f696d61676573202833292e6a7067, _binary 0x313639323132343136305f696d61676573202832292e6a7067, _binary 0x313639323132343136305f4746442e706466, 21, '2023-08-15 18:29:20'),
	(4, 'MARCO', '$2y$10$IEBgYWp6bHIDNiFPiVuAc.LTWxm2S1n5SOi/W/dG.bc27Eh0zkLh2', 'MARCO ADRIAN', 'RIVERA', 1, '123456789', 'oxigeno@oxilive.com.mx', 1, _binary 0x313639323132343332355f747265652d3733363838355f313238302e6a7067, 4, '2023-08-15 18:32:05', 'RIBM111296', 'NO', NULL, '8', '8', 98745, 'NO', 'NO', 'NO', _binary 0x313639323132343332355f313336365f323030302e6a706567, _binary 0x313639323132343332355f64657363617267612e6a7067, _binary 0x313639323132343332355f312e706466, 29, '2023-08-15 18:32:05'),
	(5, 'PEDRO RUIZ CORTES', '$2y$10$QkRKpOc8EORhrCFlYoDJjezvE0zbtB1/Rmtfct2Q7THJvTPkqcCSq', 'ALISON', 'ARGENT', 2, '5511794905', 'ali@gmail.com', 1, _binary 0x313639323230303039305f64657363617267612e6a7067, 9, '2023-08-16 15:34:50', 'ARGA121102', 'BUENA', NULL, '89', '5', 45632, 'SAN FRANCISCO', 'OYAMEL', ' FRENTE A TIENDA', _binary 0x313639323230303039305f747265652d3733363838355f313238302e6a7067, _binary 0x313639323230303039305f313336365f323030302e6a706567, _binary 0x313639323230303039305f4746442e706466, 14, '2023-08-16 15:34:50'),
	(6, 'PRUEBA', '$2y$10$SZXPwPZlxkXphBiONIiumeEO4zOW.F0FcM4.hderPbLR2RbsR46vi', 'PRUEBA', 'PRUEBA', 1, '12345678', 'prueba@gmail.com', 1, _binary 0x313639323239373232375f706e672e706e67, 10, '2023-08-17 18:33:47', 'PRUE123456', 'PRUEBA', NULL, '1', '1', 12345, 'PRUEBA', 'PRUEBA', 'PRUEBA ', _binary 0x313639323239373232375f6b69742e6a7067, _binary 0x313639323239373232375f5052554542412e6a7067, _binary 0x313639323239373232375f62646f78696c697665202d44442e706466, 1, '2023-08-17 18:33:47'),
	(7, 'ASISMED', '$2y$10$b4FgofQdC69pq4iGx59tyOJo2FXVX.yPY3pLXFbv8wujJgjfisRxW', 'ASISMED', 'ASISMED', 1, '123456789', 'asismed@gmail.com', 1, _binary 0x313639323530313738375f75746e5f3235362e706e67, 2, '2023-08-20 03:23:07', 'ASISMED123', 'ASISMED', NULL, '1', '1', 12345, 'ASISMED', 'ASISMED', 'ASISMED', _binary 0x313639323530313738375f313639323234303236315f33343064636430353436353961376135353030333465353632646631326139342e6a7067, _binary 0x313639323530313738375f313639323234303236315f576861747341707020496d61676520323032332d30382d313620617420332e30392e313620504d2e6a706567, _binary 0x313639323530313738375f313639323234303236315f312e706466, 5, '2023-08-20 03:23:07'),
	(8, 'iAlexWolf', '$2y$10$9wXbGaUHMN7PojhJb8Ht8.EhN5lPZXruyWj7gRzHQo4865KdY9J.e', 'Alfredo Alex', 'Fiesco Venegas', 1, '7894561231', 'alfredo@gmail.com', 1, _binary '', 6, '2023-09-05 20:09:41', 'FIVA980720BN', 'La Perla', 'Jabillos', '182', '0', 57820, 'Alamos', 'Escondida', 'Saguan café', _binary 0x313639333934343538315f616e766572736f2e6a7067, _binary 0x313639333934343538315f7265766572736f2e6a7067, _binary 0x313639333934343538315f756e647261775f70726f66696c655f332e737667, 1, '2023-09-05 20:09:41'),
	(11, 'okliokl', '$2y$10$8ChG7ggxKae67MlL1xOoL.XL0afS1acFmTslwl1yqlTIADYidMbz2', 'Jonatan', 'Bonilla', 1, '7894561236', 'aslkasda@asdas', 1, _binary '', 6, '2023-09-08 14:17:21', 'asdfghjk78', '', NULL, '', '', 78945, '', '', '', _binary 0x313639343138323634315f, _binary 0x313639343138323634315f, _binary 0x313639343138323634315f, 0, '2023-09-08 14:17:21'),
	(21, 'qwertyuiop', '$2y$10$I5NcPZFxP3DWhgdmEqbo2uSG1/URdTZgz//lGnfvzIaP7j5hdcuVC', 'ASDFGHJKL', 'ASDFGHJKL', 1, '123456789', '123456789@gij.com', 1, _binary 0x313639343732343837335f, 1, '2023-09-14 20:54:33', '123456789', '', '', '', '', 12345, '', '', '', _binary 0x313639343732343837335f, _binary 0x313639343732343837335f, _binary 0x313639343732343837335f, 0, '2023-09-14 20:54:33');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

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

-- Volcando estructura para tabla bdoxilive.asignacion_servicio
CREATE TABLE IF NOT EXISTS `asignacion_servicio` (
  `id_sv` int NOT NULL AUTO_INCREMENT,
  `num_paciente` int DEFAULT '0',
  `nom_solicitante` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `moti_consulta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `num_medico` int NOT NULL,
  `asignacion` int NOT NULL,
  PRIMARY KEY (`id_sv`),
  KEY `num_paciente` (`num_paciente`),
  KEY `num_medico` (`num_medico`),
  KEY `asignacion` (`asignacion`),
  CONSTRAINT `FK1_num_paciente` FOREIGN KEY (`num_paciente`) REFERENCES `pacientes_oxigeno` (`id_pacientes`),
  CONSTRAINT `FK2_num_medico` FOREIGN KEY (`num_medico`) REFERENCES `usuarios` (`id_departamentos`),
  CONSTRAINT `FK3_asignacion` FOREIGN KEY (`asignacion`) REFERENCES `estatus_callcenter` (`id_ets`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdoxilive.asignacion_servicio: ~2 rows (aproximadamente)
DELETE FROM `asignacion_servicio`;
INSERT INTO `asignacion_servicio` (`id_sv`, `num_paciente`, `nom_solicitante`, `fecha`, `hora`, `moti_consulta`, `num_medico`, `asignacion`) VALUES
	(1, 25, 'call_center', '2023-10-16', '00:00:00', 'Colillo Chino', 3, 1),
	(2, 27, 'axa', '2023-10-16', '00:00:00', 'Cholillo Europeo', 3, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

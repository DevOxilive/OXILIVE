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

-- Volcando datos para la tabla bdoxilive.asignacion_horarios: ~6 rows (aproximadamente)
INSERT INTO `asignacion_horarios` (`id_asignacionHorarios`, `id_usuario`, `id_tipoServicio`, `horarioEntrada`, `horarioSalida`, `fecha`, `id_pacienteEnfermeria`, `statusHorario`) VALUES
	(3, 8, 1, '08:00:00', '16:00:00', '2023-09-20', 1, 0),
	(4, 11, 1, '16:00:00', '00:00:00', '2023-09-20', 1, 0),
	(5, 18, 1, '14:00:00', '22:00:00', '2023-10-18', 1, 1),
	(6, 18, 1, '08:00:00', '16:00:00', '2023-10-19', 1, 0),
	(7, 18, 1, '10:00:00', '18:00:00', '2023-10-20', 1, 0),
	(8, 18, 1, '10:00:00', '18:00:00', '2023-10-07', 1, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

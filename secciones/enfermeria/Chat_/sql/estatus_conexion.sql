CREATE TABLE `estatus_conexion` (
	`id_estatus` INT(10) NOT NULL AUTO_INCREMENT,
	`estatus` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`id_estatus`) USING BTREE
);
CREATE TABLE `mensajes` (
	`id_msg` INT(10) NOT NULL AUTO_INCREMENT,
	`msg` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`fecha_hora` DATETIME NULL DEFAULT NULL,
	`id_departamento` INT(10) NULL DEFAULT NULL,
	PRIMARY KEY (`id_msg`) USING BTREE
);

/**
* @author OscarLDazz
* contenido sql de la tabla mensajes
* con referencia al puesto de los usuarios.
*
*/
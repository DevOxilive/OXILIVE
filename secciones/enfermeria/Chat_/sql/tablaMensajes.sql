CREATE TABLE `mensajes` (
	`id_msg` INT(10) NOT NULL AUTO_INCREMENT,
	`id_entrada` INT(10) NULL DEFAULT NULL,
	`id_salida` INT(10) NULL DEFAULT NULL,
	`msg` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fecha_hora` DATETIME NULL DEFAULT NULL,
	`persona` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`leido` VARCHAR(50) NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`id_msg`) USING BTREE,
	INDEX `enviaMensaje` (`id_entrada`) USING BTREE,
	INDEX `recibeMensaje` (`id_salida`) USING BTREE,
	CONSTRAINT `enviaMensaje` FOREIGN KEY (`id_entrada`) REFERENCES `usuarios` (`id_usuarios`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `recibeMensaje` FOREIGN KEY (`id_salida`) REFERENCES `usuarios` (`id_usuarios`) ON UPDATE NO ACTION ON DELETE NO ACTION
);
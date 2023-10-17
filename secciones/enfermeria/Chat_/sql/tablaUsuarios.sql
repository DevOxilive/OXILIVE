CREATE TABLE `usuarios` (
	`id_usuarios` INT(10) NOT NULL AUTO_INCREMENT,
	`Usuario` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`paswword` VARCHAR(250) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Nombres` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Apellidos` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Genero` INT(10) NOT NULL,
	`Telefono` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Correo` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Estado` INT(10) NOT NULL,
	`Foto_perfil` LONGBLOB NULL DEFAULT NULL,
	`id_departamentos` INT(10) NOT NULL,
	`Fecha_registro` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`rfc` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`alcaldia` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`num_interior` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`num_exterior` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`codigo_postal` INT(10) NULL DEFAULT NULL,
	`calleUno` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`calleDos` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`referencias` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`credencialFrente` LONGBLOB NULL DEFAULT NULL,
	`credencialAtras` LONGBLOB NULL DEFAULT NULL,
	`comprobante_domicilio` LONGBLOB NULL DEFAULT NULL,
	`inicios_sesion` INT(10) NULL DEFAULT '0',
	`fecha_sesion` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`estatus` VARCHAR(50) NULL DEFAULT '0' COLLATE 'utf8mb4_0900_ai_ci',
	`token` VARCHAR(64) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	PRIMARY KEY (`id_usuarios`, `Estado`, `Genero`, `id_departamentos`) USING BTREE,
	INDEX `FK_estado_idx` (`Estado`) USING BTREE,
	INDEX `FK_genero_idx` (`Genero`) USING BTREE,
	INDEX `FK_departamento_idx` (`id_departamentos`) USING BTREE,
	CONSTRAINT `FK_departamento` FOREIGN KEY (`id_departamentos`) REFERENCES `puestos` (`id_puestos`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK_estado` FOREIGN KEY (`Estado`) REFERENCES `estado` (`id_estado`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK_genero` FOREIGN KEY (`Genero`) REFERENCES `genero` (`id_genero`) ON UPDATE NO ACTION ON DELETE NO ACTION
)



ALTER TABLE usuarios
ADD COLUMN estatus VARCHAR(50) NULL DEFAULT '0'  ,
ADD COLUMN token VARCHAR(64) NULL DEFAULT NULL  ;

nuevos datos de la tabla :
CREATE TABLE `usuarios` (
	`id_usuarios` INT(10) NOT NULL AUTO_INCREMENT,
	`Usuario` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`paswword` VARCHAR(250) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Nombres` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Apellidos` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Genero` INT(10) NOT NULL,
	`Telefono` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Correo` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Estado` INT(10) NOT NULL,
	`id_departamentos` INT(10) NOT NULL,
	`Fecha_registro` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`rfc` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`alcaldia` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`num_interior` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`num_exterior` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`codigo_postal` INT(10) NULL DEFAULT NULL,
	`calleUno` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`calleDos` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`referencias` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`credencialFrente` LONGBLOB NULL DEFAULT NULL,
	`credencialAtras` LONGBLOB NULL DEFAULT NULL,
	`comprobante_domicilio` LONGBLOB NULL DEFAULT NULL,
	`inicios_sesion` INT(10) NULL DEFAULT '0',
	`fecha_sesion` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`estatus` VARCHAR(50) NULL DEFAULT '0' COLLATE 'utf8mb4_0900_ai_ci',
	`token` VARCHAR(64) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Foto_perfil` LONGBLOB NULL DEFAULT NULL,
	PRIMARY KEY (`id_usuarios`, `Estado`, `Genero`, `id_departamentos`) USING BTREE,
	INDEX `FK_estado_idx` (`Estado`) USING BTREE,
	INDEX `FK_genero_idx` (`Genero`) USING BTREE,
	INDEX `FK_departamento_idx` (`id_departamentos`) USING BTREE,
	CONSTRAINT `FK_departamento` FOREIGN KEY (`id_departamentos`) REFERENCES `puestos` (`id_puestos`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK_estado` FOREIGN KEY (`Estado`) REFERENCES `estado` (`id_estado`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK_genero` FOREIGN KEY (`Genero`) REFERENCES `genero` (`id_genero`) ON UPDATE NO ACTION ON DELETE NO ACTION

)


ALTER TABLE usuarios
ADD COLUMN estatus VARCHAR(50) NULL DEFAULT '0' COLLATE 'utf8mb4_0900_ai_ci',
ADD COLUMN token VARCHAR(64) NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
ADD COLUMN Foto_perfil LONGBLOB NULL DEFAULT NULL;

nota mejor integrar toda la base de datos..... de la tabla 


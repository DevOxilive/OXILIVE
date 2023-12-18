UPDATE usuarios
SET
    Foto_perfil = NULL,
    credencialFrente = NULL,
    credencialAtras = NULL,
    comprobante_domicilio = NULL;

ALTER TABLE usuarios MODIFY credencialFrente VARCHAR(255),
MODIFY credencialAtras VARCHAR(255),
MODIFY comprobante_domicilio VARCHAR(255),
MODIFY Foto_perfil VARCHAR(255);

UPDATE usuarios
SET
    Foto_perfil = 'http://localhost:8080/OXILIVE/secciones/chatNotifica/img/usuario.png',
    credencialFrente = 'http://localhost:8080/OXILIVE/secciones/chatNotifica/img/usuario.png',
    credencialAtras = 'http://localhost:8080/OXILIVE/secciones/chatNotifica/img/usuario.png',
    comprobante_domicilio = 'http://localhost:8080/OXILIVE/secciones/chatNotifica/img/usuario.png'
WHERE
    id_usuarios <> 10;

UPDATE usuarios
SET
    Foto_perfil = 'http://localhost:8080/OXILIVE/secciones/usuarios/OXILIVE/LUIS ISLAS OSCAR/1695318883_saitama.png',
    credencialFrente = 'http://localhost:8080/OXILIVE/secciones/chatNotifica/img/usuario.png',
    credencialAtras = 'http://localhost:8080/OXILIVE/secciones/chatNotifica/img/usuario.png',
    comprobante_domicilio = 'http://localhost:8080/OXILIVE/secciones/chatNotifica/img/usuario.png'
WHERE
    id_usuarios = 10;
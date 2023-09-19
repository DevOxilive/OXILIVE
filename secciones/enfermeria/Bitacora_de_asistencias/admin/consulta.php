<?php
    //Script listado de asistencias
    $sentenciaAsis = $con->prepare(
        'SELECT asis.*, u.nombres AS "nombreUsu", u.apellidos AS "apellidosUsu"
        FROM asistencias asis, usuarios u
        WHERE u.id_usuarios = asis.id_empleadoEnfermeria;'
    );
    $sentenciaAsis->execute();
    $lista_asistencias = $sentenciaAsis->fetchAll(PDO::FETCH_ASSOC);
?>
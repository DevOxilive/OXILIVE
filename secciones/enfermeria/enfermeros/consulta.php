<?php
    $sentencia = $con->prepare(
        "SELECT u.*, e.Nombre_estado as estado
        FROM usuarios u, estado e
        WHERE u.id_departamentos=6
        AND u.Estado = e.id_estado;"
    );
    $sentencia->execute();
    $lista_enfermeros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
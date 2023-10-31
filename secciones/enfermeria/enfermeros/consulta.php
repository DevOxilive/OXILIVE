<?php

    include("../../../connection/conexion.php");
    $sentencia = $con->prepare(
        "SELECT u.Nombres, u.Apellidos, u.id_usuarios, e.Nombre_estado as estado, e.id_estado
        FROM usuarios u, estado e
        WHERE u.id_departamentos=11
        AND u.Estado = e.id_estado;"
    );
    $sentencia->execute();
    $lista_enfermeros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $enfermeros = json_encode($lista_enfermeros);
    echo $enfermeros;
?>
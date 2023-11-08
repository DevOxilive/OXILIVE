<?php
$sentencia = $con -> prepare("SELECT * FROM asistencias;");
$sentencia -> execute();
$lista_asistencias = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
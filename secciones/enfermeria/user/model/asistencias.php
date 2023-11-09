<?php
$sentencia = $con -> prepare("SELECT * FROM asistencias WHERE id_asistencias = :id;");
$sentencia -> bindParam(":id", $id);
$sentencia -> execute();
$lista_asistencias = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
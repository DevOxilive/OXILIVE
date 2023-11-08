<?php
$sentencia = $con -> prepare("SELECT DISTINCT fechaAsis, id_asistencias FROM asistencias WHERE id_empleadoEnfermeria = :id;");
$sentencia -> bindParam(":id", $id);
$sentencia -> execute();
$lista_fechas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
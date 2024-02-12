<?php
$sentencia = $con -> prepare(
    "SELECT a.*, CONCAT(p.nombres, ' ', p.apellidos) AS 'nomPac' 
    FROM asistencias a, asignacion_horarios ah, pacientes_call_center p
    WHERE id_asistencias = :id
    AND a.id_horario = ah.id_asignacionHorarios
    AND ah.id_pacienteEnfermeria = p.id_pacientes"
);
$sentencia -> bindParam(":id", $id);
$sentencia -> execute();
$lista_asistencias = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
    include("../../../../../connection/conexion.php");
    $sentencia=$con->prepare("
    SELECT ah.id_asignacionHorarios as id, ah.statusHorario as id_est, e.estado
    FROM asignacion_horarios ah, estado_horarios e
    WHERE ah.statusHorario = e.id_estadoHorarios
    ");
    $sentencia->execute();
    $status = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($status);
?>
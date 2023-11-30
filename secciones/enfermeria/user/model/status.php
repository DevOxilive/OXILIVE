<?php
include("../../../../connection/conexion.php");
$data = json_decode(file_get_contents('php://input'), true);
$id = isset($data['id']) ? $data['id'] : NULL;
$sentencia = $con->prepare(
    "SELECT ah.id_asignacionHorarios as id, ah.statusHorario as id_est, e.estado
    FROM asignacion_horarios ah, estado_horarios e
    WHERE ah.statusHorario = e.id_estadoHorarios
    AND ah.id_usuario = :idus"
    );
    $sentencia->bindParam(':idus', $id);
    $sentencia->execute();
    $status = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($status);
?>
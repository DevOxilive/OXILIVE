<?php
include("../../../../../connection/conexion.php");
$data = json_decode(file_get_contents('php://input'), true);
$estado = isset($data['estado']) ? $data['estado'] : 0;
if ($estado != 0) {
    $sentencia = $con->prepare("
    SELECT ah.id_asignacionHorarios as id, ah.statusHorario as id_est, e.estado
    FROM asignacion_horarios ah, estado_horarios e
    WHERE ah.statusHorario = e.id_estadoHorarios
    AND ah.statusHorario = :num
    ");
    $sentencia->bindParam(':num', $estado);
    $sentencia->execute();
    $status = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($status);
} else {
    $sentencia = $con->prepare("
    SELECT ah.id_asignacionHorarios as id, ah.statusHorario as id_est, e.estado
    FROM asignacion_horarios ah, estado_horarios e
    WHERE ah.statusHorario = e.id_estadoHorarios
    AND ah.statusHorario != 4
    ");
    $sentencia->execute();
    $status = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($status);
}
?>

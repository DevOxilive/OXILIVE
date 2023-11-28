<?php
$data = json_decode(file_get_contents('php://input'), true);
include('../../../../connection/conexion.php');
$sentenciaStatus = $con -> prepare(
    "SELECT e.*
    FROM estado_horarios e, asignacion_horarios a
    WHERE a.statusHorario = e.id_estadoHorarios
    AND a.id_usuario = :id"
);
$id = $data['id'];
$sentenciaStatus -> bindParam(':id', $id);
$estados = $sentenciaStatus->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($estados);
?>
<?php
include("../../../../connection/conexion.php");
$data = json_decode(file_get_contents('php://input'), true);
$fecha = $data['fecha'];
$sentencia = $con -> prepare("
SELECT a.*, CONCAT(u.Nombres, ' ', u.Apellidos) enfermero, CONCAT(p.nombres, ' ', p.apellidos) paciente
FROM asistencias a, usuarios u, asignacion_horarios ah, pacientes_call_center p
WHERE a.id_empleadoEnfermeria = u.id_usuarios
AND a.id_horario = ah.id_asignacionHorarios
AND ah.id_pacienteEnfermeria = p.id_pacientes
AND a.fechaAsis = :fecha
");
$sentencia -> bindParam(":fecha", $fecha);
$sentencia -> execute();
$lista_timeline = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($lista_timeline);
?>
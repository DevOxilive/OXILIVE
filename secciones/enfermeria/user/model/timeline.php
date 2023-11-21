<?php
include("../../../../connection/conexion.php");
$data = json_decode(file_get_contents('php://input'), true);
$sentencia = $con -> prepare("
SELECT a.*, CONCAT(u.Nombres, ' ', u.Apellidos) enfermero, p.id_pacientes, CONCAT(p.nombres, ' ', p.apellidos) paciente, t.nombreServicio
FROM asistencias a, usuarios u, asignacion_horarios ah, pacientes_call_center p, tipos_servicios t
WHERE a.id_empleadoEnfermeria = u.id_usuarios
AND a.id_horario = ah.id_asignacionHorarios
AND ah.id_pacienteEnfermeria = p.id_pacientes
AND ah.id_tipoServicio = t.id_tipoServicio
AND u.id_usuarios = :idus
ORDER BY fechaAsis DESC, checkTime DESC
");
$sentencia -> bindParam(":idus", $id);
$sentencia -> execute();
$lista_timeline = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
?>
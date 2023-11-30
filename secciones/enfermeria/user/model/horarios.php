<?php
$data = json_decode(file_get_contents('php://input'), true);
include('../../../../connection/conexion.php');
$sentenciaHora = $con->prepare(
    "SELECT a.*, CONCAT(p.nombres, ' ', p.apellidos) AS 'nomPaciente', t.nombreServicio AS 'nomGuardia', e.estado
    FROM usuarios u, pacientes_call_center p, asignacion_horarios a, tipos_servicios t, estado_horarios e
    WHERE u.id_usuarios = :idUser
    AND u.id_usuarios = a.id_usuario
    AND p.id_pacientes = a.id_pacienteEnfermeria
    AND t.id_tipoServicio = a.id_tipoServicio
    AND a.statusHorario = e.id_estadoHorarios
    ORDER BY a.statusHorario ASC, a.fecha DESC, a.horarioEntrada DESC, a.horarioSalida DESC"
);
$iduser=$data['id'];
$sentenciaHora->bindParam(':idUser', $iduser);
$sentenciaHora->execute();
$lista_horarios = $sentenciaHora->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($lista_horarios);
?>
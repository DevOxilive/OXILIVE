<?php
    include ('../../../connection/conexion.php');
    $idMed = $_POST['id'];
    $sentencia = $con->prepare('SELECT a.id_sv, a.num_medico, u.Usuario, a.num_paciente, a.estado,
    a.fecha,a.moti_consulta,
    p.Nombres FROM asignacion_servicio a inner JOIN  usuarios u, pacientes_call_center p WHERE u.id_departamentos = 12 AND a.num_medico = u.id_usuarios AND a.num_paciente = p.id_pacientes AND u.id_usuarios = :idMed;');
    $sentencia->bindParam(':idMed', $idMed);
    $sentencia->execute();
    $lista = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($lista);
?>
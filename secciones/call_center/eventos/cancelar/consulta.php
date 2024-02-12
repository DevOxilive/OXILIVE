<?php
    include("../../../../connection/conexion.php");
    $sentecia = $con->prepare("SELECT a.*, e.estatus, u.Usuario, CONCAT(p.nombres, ' ', p.apellidos) AS paciente
    FROM asignacion_servicio a,estatus_callcenter e, usuarios u, pacientes_call_center p 
    WHERE u.id_usuarios = a.num_medico
    AND a.estado = e.id_ets
    AND p.id_pacientes = a.num_paciente
    AND u.id_departamentos = 12");
    $sentecia->execute();
    $listaServicios = $sentecia->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($listaServicios);

?>
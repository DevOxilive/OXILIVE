<?php
    include ('../../../connection/conexion.php');
    $sentencia = $con->prepare('SELECT a.id_sv, a.num_medico, u.Usuario, a.num_paciente,
    a.fecha,a.moti_consulta,
    p.Nombres FROM asignacion_servicio a inner JOIN  usuarios u, pacientes_oxigeno p WHERE u.id_departamentos = 12 AND a.num_medico = u.id_usuarios AND a.num_paciente = p.id_pacientes;');
    $sentencia->execute();
    $lista = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
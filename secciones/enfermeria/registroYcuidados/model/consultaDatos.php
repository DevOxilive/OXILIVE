<?php 


    $sentencia = $con->prepare("SELECT a.id_asignacionHorarios,
    CONCAT(p.nombres, ' ', p.apellidos) AS 'nombre del paciente',
    t.nombreServicio,
    p.responsable,
    p.edad,
    CONCAT(u.Nombres, ' ', u.Apellidos) AS 'nombre del enfermero',
    CONCAT(u2.Nombres, ' ', u2.Apellidos) AS 'nombre del medico', u.id_usuarios 
FROM pacientes_call_center p
INNER JOIN asignacion_horarios a ON p.id_pacientes = a.id_pacienteEnfermeria
INNER JOIN tipos_servicios t ON t.id_tipoServicio = a.id_tipoServicio
INNER JOIN usuarios u ON u.id_usuarios = a.id_usuario
INNER JOIN asignacion_servicio a2 ON a2.num_paciente = p.id_pacientes
INNER JOIN usuarios u2 ON u2.id_usuarios = a2.num_medico
LIMIT 1");

    $sentencia->execute();
    $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    

?>


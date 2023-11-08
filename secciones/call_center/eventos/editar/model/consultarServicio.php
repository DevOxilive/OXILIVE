<?php

     
    $numPaciente = 24;
    $fecha = '2023-11-05';
    $hora = '11:38:00';
    $sentenciaEdit = $con->prepare('
    
    SELECT a.*, CONCAT(p.nombres, " ", p.apellidos) AS nombreCompleto
                          FROM asignacion_servicio a
                          JOIN pacientes_call_center p ON a.num_paciente = p.id_pacientes
                          WHERE a.num_paciente = :numPaciente
                          AND a.fecha = :fecha
                          AND a.hora = :hora;

    ');

   
    

    
    $sentenciaEdit->bindParam(':numPaciente', $numPaciente);
    $sentenciaEdit->bindParam(':fecha', $fecha);
    $sentenciaEdit->bindParam(':hora', $hora);
    $sentenciaEdit->execute();
    $datosServicio = $sentenciaEdit->fetchAll(PDO::FETCH_ASSOC);


?>
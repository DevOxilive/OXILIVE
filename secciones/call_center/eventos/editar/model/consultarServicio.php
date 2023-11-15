<?php

     
    $id_sv = 1;

    $sentenciaEdit = $con->prepare('
    
    SELECT a.*, CONCAT(p.nombres, " ", p.apellidos) AS nombreCompleto
                          FROM asignacion_servicio a
                          JOIN pacientes_call_center p ON a.num_paciente = p.id_pacientes
                          WHERE id_sv = :id_sv;
                         

    ');

   
    

    
    $sentenciaEdit->bindParam(':id_sv', $id_sv);
    $sentenciaEdit->execute();
    $datosServicio = $sentenciaEdit->fetchAll(PDO::FETCH_ASSOC);


?>
<?php
    //Script listado de horario
    $sentenciaHor = $con->prepare(
        'SELECT ah.id_asignacionHorarios,
                ah.horarioEntrada,
                ah.horarioSalida,
                ah.fecha, u.Nombres AS "Nombres",
                u.Apellidos AS "Apellidos",
                CONCAT(pe.nombre, " ", pe.apellidos) AS "Paciente"
        FROM usuarios u, asignacion_horarios ah, pacientes_enfermeria pe
        WHERE ah.id_pacienteEnfermeria = pe.id_pacienteEnfermeria AND
        u.id_usuarios = ah.id_usuario AND
        u.id_departamentos = 6;'
    );
    $sentenciaHor->execute();
    $lista_horarios = $sentenciaHor->fetchAll(PDO::FETCH_ASSOC);
?>
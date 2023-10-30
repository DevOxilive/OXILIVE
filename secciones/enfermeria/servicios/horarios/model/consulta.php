<?php
    //Script listado de horario
    $sentenciaHor = $con->prepare(
        'SELECT ah.id_asignacionHorarios,
                ah.horarioEntrada,
                ah.horarioSalida,
                ah.fecha,
                CONCAT(U.Nombres, " ", u.Apellidos) AS "enfermero",
                CONCAT(pe.Nombres, " ", pe.Apellidos) AS "paciente",
                ah.statusHorario,
                e.estado
        FROM usuarios u, asignacion_horarios ah, pacientes_oxigeno pe, estado_horarios e
        WHERE ah.id_pacienteEnfermeria = pe.id_pacientes AND
        u.id_usuarios = ah.id_usuario AND
        ah.statusHorario = e.id_estadoHorarios AND
        u.id_departamentos = 11 AND
        ah.statusHorario != 4
        ORDER BY ah.statusHorario ASC, ah.fecha ASC, ah.horarioEntrada ASC
        ;'
    );
    $sentenciaHor->execute();
    $lista_horarios = $sentenciaHor->fetchAll(PDO::FETCH_ASSOC);

    $sentenciaCancel = $con->prepare(
        'SELECT ah.id_asignacionHorarios,
                ah.horarioEntrada,
                ah.horarioSalida,
                ah.fecha,
                CONCAT(U.Nombres, " ", u.Apellidos) AS "enfermero",
                CONCAT(pe.Nombres, " ", pe.Apellidos) AS "paciente",
                ah.statusHorario,
                e.estado
        FROM usuarios u, asignacion_horarios ah, pacientes_oxigeno pe, estado_horarios e
        WHERE ah.id_pacienteEnfermeria = pe.id_pacientes AND
        u.id_usuarios = ah.id_usuario AND
        ah.statusHorario = e.id_estadoHorarios AND
        u.id_departamentos = 11 AND
        ah.statusHorario = 4
        ;'
    );
    $sentenciaCancel->execute();
    $lista_cancelados = $sentenciaCancel->fetchAll(PDO::FETCH_ASSOC);
?>
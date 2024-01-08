<?php
//Script listado de horario
include("../../../../../connection/conexion.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);
    $num = $data['estado'];

    $sentencia = $con->prepare(
        'SELECT ah.id_asignacionHorarios AS id,
                ah.horarioEntrada,
                ah.horarioSalida,
                ah.fecha,
                CONCAT(u.Nombres, " ", u.Apellidos) AS "enfermero",
                CONCAT(pe.nombres, " ", pe.apellidos) AS "paciente",
                ah.statusHorario,
                e.estado
        FROM usuarios u, asignacion_horarios ah, pacientes_call_center pe, estado_horarios e
        WHERE ah.id_pacienteEnfermeria = pe.id_pacientes AND
        u.id_usuarios = ah.id_usuario AND
        ah.statusHorario = e.id_estadoHorarios AND
        u.id_departamentos = 11 AND
        ah.statusHorario = :num
        ORDER BY ah.statusHorario ASC, ah.fecha ASC, ah.horarioEntrada ASC'
    );
    
    $sentencia->bindParam(':num', $num);
    $sentencia->execute();
    $datos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);

} else {

    $sentenciaHor = $con->prepare(
        'SELECT ah.id_asignacionHorarios AS id,
                ah.horarioEntrada,
                ah.horarioSalida,
                ah.fecha,
                CONCAT(U.Nombres, " ", u.Apellidos) AS "enfermero",
                CONCAT(pe.nombres, " ", pe.apellidos) AS "paciente",
                ah.statusHorario,
                e.estado
        FROM usuarios u, asignacion_horarios ah, pacientes_call_center pe, estado_horarios e
        WHERE ah.id_pacienteEnfermeria = pe.id_pacientes AND
        u.id_usuarios = ah.id_usuario AND
        ah.statusHorario = e.id_estadoHorarios AND
        u.id_departamentos = 11 AND
        ah.statusHorario != 4
        ORDER BY ah.statusHorario ASC, ah.fecha ASC, ah.horarioEntrada ASC;'
    );
    
    $sentenciaHor->execute();
    $lista_horarios = $sentenciaHor->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($lista_horarios);

    $sentenciaCancel = $con->prepare(
        'SELECT ah.id_asignacionHorarios,
                ah.horarioEntrada,
                ah.horarioSalida,
                ah.fecha,
                CONCAT(U.Nombres, " ", u.Apellidos) AS "enfermero",
                CONCAT(pe.nombres, " ", pe.apellidos) AS "paciente",
                ah.statusHorario,
                e.estado
        FROM usuarios u, asignacion_horarios ah, pacientes_call_center pe, estado_horarios e
        WHERE ah.id_pacienteEnfermeria = pe.id_pacientes AND
        u.id_usuarios = ah.id_usuario AND
        ah.statusHorario = e.id_estadoHorarios AND
        u.id_departamentos = 11 AND
        ah.statusHorario = 4
        ;'
    );
    $sentenciaCancel->execute();
    $lista_cancelados = $sentenciaCancel->fetchAll(PDO::FETCH_ASSOC);
}


<?php
    include('../../../../connection/conexion.php');

    $secuenciaHoy = $con->prepare("
        SELECT *, HOUR(checkTime) AS 'hora', MINUTE(checkTime) AS 'minuto' FROM asistencias WHERE id_empleadoEnfermeria = :idus AND fechaAsis = :fechaActual
    ");
    $idUser = $_SESSION['idus'];
    $fechaActual = date('Y-m-d');
    $horaActual = date('H');
    $minutoActual = date('i');
    $secuenciaHoy -> bindParam(':idus', $idUser);
    $secuenciaHoy -> bindParam(':fechaActual', $fechaActual);
    $secuenciaHoy -> execute();
    $lista_hoy = $secuenciaHoy->fetchAll(PDO::FETCH_ASSOC);


    $secuenciaSemana = $con->prepare("
        SELECT * FROM asistencias WHERE id_empleadoEnfermeria = :idus AND fechaAsis >= :fechaSemana
    ");
    $fechaSemana = date('Y-m-d', strtotime('-1 week'));
    $secuenciaSemana -> bindParam(':idus', $idUser);
    $secuenciaSemana -> bindParam(':fechaSemana', $fechaSemana);
    $secuenciaSemana -> execute();
    $lista_semana = $secuenciaSemana->fetchAll(PDO::FETCH_ASSOC);

    // Obtener el día actual del mes
    $dia_actual = date('d');

    // Determinar la quincena en la que se encuentra el día actual
    if ($dia_actual <= 15) {
        // Primer quincena: del 1 al 15 del mes
        $fecha_inicio = date('Y-m-01');
        $fecha_fin = date('Y-m-15');
    } else {
        // Segunda quincena: del 16 al último día del mes
        $fecha_inicio = date('Y-m-16');
        $fecha_fin = date('Y-m-t');
    }
    $secuenciaQuincena = $con->prepare("
        SELECT * FROM asistencias WHERE id_empleadoEnfermeria = :idus AND fechaAsis BETWEEN :fecha_inicio AND :fecha_fin
    ");
    $secuenciaQuincena -> bindParam(':idus', $idUser);
    $secuenciaQuincena -> bindParam(':fecha_inicio', $fecha_inicio);
    $secuenciaQuincena -> bindParam(':fecha_fin', $fecha_fin);
    $secuenciaQuincena -> execute();
    $lista_quincena = $secuenciaQuincena->fetchAll(PDO::FETCH_ASSOC);
?>
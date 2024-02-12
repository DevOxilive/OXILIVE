<?php
include('../../../../connection/conexion.php');

$data = json_decode(file_get_contents('php://input'), true);

if(registrarAsis($con, $data)){
    exit ('Registro Exitoso');
}
else{
    exit ('No registra asistencia');
}

function registrarAsis($con, $data){
    $lon = $data['lon'];
    $lat = $data['lat'];
    $status = cambiarStatus($con, $data);
    $idUser = $data['idUser'];
    $idHor = $data['idHor'];
    $statusHor = $data['statusHor'];

    
    date_default_timezone_set('America/Mexico_City');
    $fechaActual = date("Y-m-d");
    $horaActual = date("h:i:s");
    
    $foto = $data['foto'];

    $regAsis = $con->prepare("
        INSERT INTO asistencias
        VALUES (NULL, :idus, :status, :idHor, :fecha, :time, :lat, :lon, :foto);
    ");

    $regAsis->bindParam(':idus', $idUser);
    $regAsis->bindParam(':status', $status);
    $regAsis->bindParam(':idHor', $idHor);
    $regAsis->bindParam(':fecha', $fechaActual);
    $regAsis->bindParam(':time', $horaActual);
    $regAsis->bindParam(':lat', $lat);
    $regAsis->bindParam(':lon', $lon);
    $regAsis->bindParam(':foto', $foto);

    $updateHorario = $con->prepare('
        UPDATE asignacion_horarios SET statusHorario = :statusHor WHERE id_asignacionHorarios = :idHor;
    ');

    $updateHorario->bindParam(':statusHor', $statusHor);
    $updateHorario->bindParam(':idHor', $idHor);

    if($regAsis->execute() && $updateHorario->execute()){
        return (true);
    }
}
function cambiarStatus($con, $data){
    $status = $data['status'];
    $idUser = $data['idUser'];
    $sentenciaStatus = $con->prepare('
        UPDATE usuarios 
        SET Estado =:estado WHERE id_usuarios=:idUser;
    ');
    $newStatus=0;
    if($status == 1){
        $newStatus = 5;
    }else if($status == 5){
        $newStatus = 1;
    }
    $sentenciaStatus->bindParam(':idUser', $idUser);
    $sentenciaStatus->bindParam(':estado', $newStatus);
    if($sentenciaStatus->execute()){
        return $status;
    }
}
?>
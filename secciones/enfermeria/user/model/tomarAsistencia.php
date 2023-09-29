<?php
include('../../../../connection/conexion.php');

$data = json_decode(file_get_contents('php://input'), true);

if(empty($data['nomFoto']) || $data['nomFoto'] == "") {
    $nomFoto = guardarFoto($data);
    exit ($nomFoto);
} else {
    if(registrarAsis($con, $data) && cambiarStatus($con, $data)){
        exit ('Registro Exitoso');
    } else {
        exit ('Registro Fallido');
    }
}

function registrarAsis($con, $data){
    $lon = $data['lon'];
    $lat = $data['lat'];
    $status = $data['status'];
    $idUser = $data['idUser'];
    
    date_default_timezone_set('America/Mazatlan');
    $fechaActual = date("Y-m-d");
    $horaActual = date("h:i:s");
    
    $fotoName = $data['nomFoto'];

    $regAsis = $con->prepare("
        INSERT INTO asistencias
        VALUES (NULL, :idus, :status, :fecha, :time, :lat, :lon, :foto);
    ");

    $regAsis->bindParam(':idus', $idUser);
    $regAsis->bindParam(':status', $status);
    $regAsis->bindParam(':fecha', $fechaActual);
    $regAsis->bindParam(':time', $horaActual);
    $regAsis->bindParam(':lat', $lat);
    $regAsis->bindParam(':lon', $lon);
    $regAsis->bindParam(':foto', $fotoName);
    $regAsis->execute();
}
function cambiarStatus($con, $data){
    $status = $data['status'];
    $idUser = $data['idUser'];
    $sentenciaStatus = $con->prepare('
        UPDATE usuarios 
        SET Estado =:estado WHERE id_usuarios=:idUser;
    ');
    if($status == 1){
        $newStatus = 5;
    }else if($status == 5){
        $newStatus = 1;
    }
    $sentenciaStatus->bindParam(':idUser', $idUser);
    $sentenciaStatus->bindParam(':estado', $newStatus);
    $sentenciaStatus->execute();
}
function guardarFoto($data){
    $fotoCod = $data['foto'];
    $idUser = $data['idUser'];
    $dir = '../img/asistencias/'.$idUser.'/';
    if(!is_dir($dir)){
        mkdir($dir);
    }
    //Valida que traiga una imágen
    if(strlen($fotoCod) <= 0) exit("No se recibió ninguna imagen");
    //La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
    $fotoCodWell = str_replace("data:image/png;base64,", "", urldecode($fotoCod));
    //Venía en base 64 y se decodifica para ser guardada
    $fotoDecod = base64_decode($fotoCodWell);
    //Calcular un nombre único
    $nombreImagenGuardada = $dir."foto_" . uniqid() . ".png";
    //Escribir el archivo
    file_put_contents($nombreImagenGuardada, $fotoDecod);
    return $nombreImagenGuardada;
}
?>
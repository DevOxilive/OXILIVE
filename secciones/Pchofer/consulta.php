<?php

$se = $con->prepare("SELECT * FROM `choferes` WHERE estado=1");
$se->execute();
$choA = $se->fetchAll(PDO::FETCH_ASSOC);


$nombre_de_usuario = $_SESSION['us'];
$consulta = "
SELECT ruta.*, estado_ruta.estado AS nombre_estado
FROM ruta_diaria_oxigeno AS ruta
INNER JOIN choferes AS chofer ON ruta.Chofer = chofer.id_choferes
INNER JOIN usuarios AS usuario ON chofer.Nombre_completo = usuario.Usuario
INNER JOIN estado_ruta ON ruta.estado = estado_ruta.id_estado
WHERE usuario.Usuario = :nombre_de_usuario;
";

$sentencia = $con->prepare($consulta);
$sentencia->bindParam(":nombre_de_usuario", $nombre_de_usuario);
$sentencia->execute();
$pacientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);

date_default_timezone_set('America/Mexico_City'); 
$fechaActual = date("Y-m-d"); 
$consuCou = "
SELECT COUNT(*) AS cantidad_rutas
FROM ruta_diaria_oxigeno AS ruta
INNER JOIN choferes AS chofer ON ruta.Chofer = chofer.id_choferes
INNER JOIN usuarios AS usuario ON chofer.Nombre_completo = usuario.Usuario
WHERE usuario.Usuario = :nombre_de_usuario AND ruta.Fecha_agenda = :fechaActual;
";
$senCoun = $con->prepare($consuCou);
$senCoun->bindParam(":nombre_de_usuario", $nombre_de_usuario);
$senCoun->bindParam(':fechaActual', $fechaActual);
$senCoun->execute();
$resultado = $senCoun->fetch(PDO::FETCH_ASSOC);
$cantidad_rutas = $resultado['cantidad_rutas'];



$consulta_estados = "SELECT * FROM estado_ruta";
$sentencia_estados = $con->prepare($consulta_estados);
$sentencia_estados->execute();
$lista_estado_entrega = $sentencia_estados->fetchAll(PDO::FETCH_ASSOC);
?>

<?php

include_once('/laragon/www/OXILIVE/connection/conexion.php');

$sentencia = $con->prepare("SELECT * FROM usuarios WHERE id_departamentos = '6'");
$sentencia->execute();
$valores = $sentencia->fetchAll(PDO::FETCH_ASSOC);
/** carga de mansajeria */
if (isset($_POST['mensaje'])) {
    $dateTime = date("Y-m-d H:i:s");
    $msg = $_POST['mensaje'];
    $puesto = $_POST['puesto'];
    $sentencia = $con->prepare("INSERT INTO mensajes (msg, fecha_hora, id_departamento) VALUES ('$msg', '$dateTime', '$puesto')");
    $sentencia->execute();
}

// INSERT INTO mensajes (msg, fecha_hora, id_departamento)
// VALUES ('hola', NOW(), 1);
/** vista de los mansajes */

$sentencia = $con->prepare("SELECT * FROM mensajes");
$sentencia->execute();
$verMensajes = $sentencia->fetchAll(PDO::FETCH_ASSOC);


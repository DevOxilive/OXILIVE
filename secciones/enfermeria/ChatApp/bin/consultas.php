<?php


if (isset($_POST['mensaje'])) {
    $msg = $_POST['mensaje'];
    $dateTime = date("Y-m-d H:i:s");
    $usuario = $_POST['usuario'];
    $sentensia = $con->prepare("INSERT INTO mensajes (msg, fecha_hora, usuario) VALUES ('$msg', '$dateTime', '$usuario')");
    $sentensia->execute();
}


$sentencia = $con->prepare("SELECT * FROM mensajes");
$sentencia->execute();
$mensajes = $sentencia->fetchAll(PDO::FETCH_ASSOC);



// if (isset($_POST['mensaje'])) {
//     $dateTime = date("Y-m-d H:i:s");
//     $msg = $_POST['mensaje'];
//     $puesto = $_POST['puesto'];
//     $sentencia = $con->prepare("INSERT INTO mensajes (msg, fecha_hora, id_departamento) VALUES ('$msg', '$dateTime', '$puesto')");
//     $sentencia->execute();
// }

<?php
include '../../../../connection/conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];
    $dateTime = date("Y-m-d H:i:s");
    $user = $_POST['user'];
    // Insertar el mensaje en la base de datos
    $sentencia = $con->prepare("INSERT INTO mensajes (usuario, msg, fecha_hora) VALUES ('$user', '$message', '$dateTime')");
    $sentencia->execute();
}

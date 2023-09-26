<?php
session_start();
include '../../../../connection/conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];
    $dateTime = date("Y-m-d H:i:s");
    $user = $_POST['user'];
    $salida = 313241095;
    // Insertar el mensaje en la base de datos
    $sentencia = $con->prepare("INSERT INTO mensajes (id_entrada, id_salida , msg, fecha_hora ,persona) VALUES ('{$_SESSION['idus']}', '$salida','$message', '$dateTime', '$user')");
    $sentencia->execute();
}

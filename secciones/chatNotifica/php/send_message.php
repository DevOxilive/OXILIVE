<?php
session_start();
include '../../../connection/conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    date_default_timezone_set('America/Mexico_City');
    $message = htmlspecialchars($_POST['message'], ENT_NOQUOTES, 'UTF-8');
    $dateTime = date("Y-m-d H:i:s");
    $user = $_POST['user'];
    $salida = $_POST['output'];
    // Insertar el mensaje en la base de datos
    $sentencia = $con->prepare("INSERT INTO mensajes (id_entrada, id_salida, msg, fecha_hora, persona) VALUES ('{$_SESSION['idus']}','$salida', '$message', '$dateTime', '$user')");
    $sentencia->execute();
}

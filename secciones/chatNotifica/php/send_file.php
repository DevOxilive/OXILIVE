<?php
// include '../../../../cargaDoc/control.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
//     $nombreArchivo = $_FILES['file']['name'];
//     $archivo = $_FILES['file']['tmp_name'];
//     $carpeta = 'documentos/';
//     guardarDocumento($con, $carpeta, $nombreArchivo, $archivo, $persona);
// }
include '../../../cargaDoc/control.php';
include '../../../connection/conexion.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $user = $_POST['user'];
    $output = $_POST['output'];
    $userC = $_POST['userC'];
    $dateTime = date("Y-m-d H:i:s");

    $nombreArchivo = $_FILES['file']['name'];
    $archivo  = $_FILES['file']['tmp_name'];
    $carpeta = 'documentos/';
    // Directorio donde se almacenarán los archivos
    $envio = $_SESSION['idus'];
    guardarDocumento($con, $carpeta, $nombreArchivo, $archivo, $envio, $output, $user);
    $sentencia = $con->prepare("INSERT INTO mensajes (id_entrada, id_salida, msg, fecha_hora, persona) VALUES ('{$_SESSION['idus']}','$output', '$nombreArchivo', '$dateTime', '$user')");
    $sentencia->execute();
}

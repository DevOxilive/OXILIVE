<?php
include_once 'C:\laragon\www\OXILIVE\connection/conexion.php';
$puesto_id = $_SESSION['puesto'];
$sentencia = $con->prepare("SELECT Nombre_puestos FROM puestos WHERE puestos.id_puestos='$puesto_id'");
$sentencia->execute();
$datos = $sentencia->fetch(PDO::FETCH_ASSOC);

?>
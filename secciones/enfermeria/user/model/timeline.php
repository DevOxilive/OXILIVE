<?php
include("../../../../connection/conexion.php");
$data = json_decode(file_get_contents('php://input'), true);
$fecha = $data['fecha'];
$sentencia = $con -> prepare("SELECT * ");
?>
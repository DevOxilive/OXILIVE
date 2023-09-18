<?php
include_once "../../../../connection/conexion.php";
$id_salida = $_SESSION['unique_id'];
$sentencia = $con->prepare("SELECT * FROM usuarios WHERE NOT id_usuarios = {$id_salida} ORDER BY id_usuarios DESC");
$sentencia->execute();
$valores = $sentencia->fetchAll(PDO::FETCH_ASSOC);
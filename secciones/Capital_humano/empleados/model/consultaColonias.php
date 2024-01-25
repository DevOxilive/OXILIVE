<?php
include ("../../../connection/conexion.php");
$lista_colonias = "SELECT * FROM colonias ";
$sentencia = $con->prepare($lista_colonias);
$sentencia->execute();
$colonias = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
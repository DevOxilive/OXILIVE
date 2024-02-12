<?php
include("../../connection/conexion.php");
$sentencia=$con->prepare("SELECT * from productos");
$sentencia->execute();
$listaproductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>



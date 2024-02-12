<?php 
include("../../../connection/conexion.php");
$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM `carros` WHERE id_carro=$eliminar");
?>
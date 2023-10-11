<?php 
include("../../../../connection/conexion.php");

$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM `aseguradoras` WHERE id_aseguradora=$eliminar");
?>
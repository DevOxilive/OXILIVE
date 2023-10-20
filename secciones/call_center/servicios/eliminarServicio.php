<?php 
include("../../../connection/conexion.php");
$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM `tipos_servicios_callcenter` WHERE idServicio=$eliminar");
?>
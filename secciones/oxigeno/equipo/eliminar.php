<?php 
include("../../../connection/conexion.php");
$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM `tanques` WHERE id_tanques=$eliminar");
?>
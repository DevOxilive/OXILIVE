<?php 
include("../../../connection/conexion.php");
$eliminar=$_POST['id'];

$senetencia=$con->query("DELETE FROM `usuarios` WHERE id_usuarios=$eliminar");

?>
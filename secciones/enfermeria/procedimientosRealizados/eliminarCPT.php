<?php 
include("../../../connection/conexion.php");
$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM `tipo_cpt` WHERE id_cpt=$eliminar");
?>  
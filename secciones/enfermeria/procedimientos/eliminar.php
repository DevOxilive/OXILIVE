<?php 
include("../../../connection/conexion.php");

$eliminar=$_POST['id'];

$sentencia=$con->query("DELETE FROM `proce_enfer` WHERE id_proce=$eliminar");


?>
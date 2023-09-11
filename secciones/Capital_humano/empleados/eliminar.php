<?php 
include("../../../connection/conexion.php");
$eliminar=$_POST['id'];
$senetencia=$con->query("DELETE FROM `empleados` WHERE id_empleados=$eliminar");

?>
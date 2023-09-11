<?php 
include("../../../connection/conexion.php");
$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM `pacientes_oxigeno` WHERE id_pacientes=$eliminar");
?>  
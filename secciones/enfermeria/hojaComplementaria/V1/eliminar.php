<?php 
include("../../../connection/conexion.php");
$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM `pacientes_call_center` WHERE id_pacientes=$eliminar");
?>  
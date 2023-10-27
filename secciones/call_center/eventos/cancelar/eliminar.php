<?php 
include("../../../../connection/conexion.php");
$valorid=$_POST['valorid'];
$sentencia=$con->query("UPDATE asignacion_servicio SET estado = 0 WHERE id_sv = $valorid");
?>
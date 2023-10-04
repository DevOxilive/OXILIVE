<?php 
include("../../../connection/conexion.php");

$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM `asegu_enfer` WHERE id_asegu_enfer=$eliminar");
?>
<?php 
include("../../../../connection/conexion.php");
// ELIMINA EL DATO DE LA BASE DE DATOS CORRESPONDIENTE AL ID AL QUE PERTENECE
$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM `administradora` WHERE id_administradora=$eliminar");
?>
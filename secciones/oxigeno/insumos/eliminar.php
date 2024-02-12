<?php 
include("../../../connection/conexion.php");
$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM `insumos` WHERE id_insumo=$eliminar");
?>
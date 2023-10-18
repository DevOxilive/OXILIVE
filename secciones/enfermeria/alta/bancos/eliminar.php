<?php 
include("../../../../connection/conexion.php");
$eliminar=$_POST['id'];

$sentencia=$con->query("DELETE FROM `bancos` WHERE id_bancos=$eliminar");



?>$
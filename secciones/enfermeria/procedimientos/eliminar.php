<?php 
include("../../../connection/conexion.php");

$eliminar=$_POST['id'];

$sentencia=$con->query("DELETE FROM `procedimientos` WHERE id_procedi=$eliminar");


?>
<?php
include("../../../connection/conexion.php");
$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM productos where id_productos=$eliminar");

?>
<?php
include("../../../connection/conexion.php");
$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM almacen where id_almacen=$eliminar");

?>
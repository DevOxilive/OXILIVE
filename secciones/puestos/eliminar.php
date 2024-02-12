<?php
include ("../../connection/conexion.php");
$eliminar= $_POST['id'];
$sentencia=$con->query("DELETE FROM `puestos` where id_puestos=$eliminar");



?>
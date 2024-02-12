<?php
include("../../../connection/conexion.php");
$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM `ruta_diaria_oxigeno` WHERE id_ruta=$eliminar");
?> 
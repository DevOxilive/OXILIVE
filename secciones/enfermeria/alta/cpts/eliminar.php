<?php
include("../../../../connection/conexion.php");
$eliminar= $_POST['id'];
$sentecia=$con->query("DELETE FROM cpts WHERE id_cpt = $eliminar");
?>
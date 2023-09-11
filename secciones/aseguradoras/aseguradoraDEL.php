<?php
include ("../../connection/conexion.php");

$eliminar=$_POST['id'];
  $sentencia=$con->prepare("DELETE FROM aseguradoras WHERE id_aseguradora=:$eliminar");
  $sentencia->bindParam(":id_aseguradora",$eliminar);
  $sentencia->execute();
 
?>
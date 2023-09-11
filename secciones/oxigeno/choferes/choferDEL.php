<?php
include ("../../../connection/conexion.php");


if(isset( $_GET['txtID'] )){

  $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

  $sentencia=$con->prepare("DELETE FROM choferes WHERE id_choferes=:id_choferes");
  $sentencia->bindParam(":id_choferes",$txtID);
  $sentencia->execute();
 
}
?> 
<?php
include ("../../connection/conexion.php");


if(isset( $_GET['txtID'] )){

  $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

  $sentencia=$con->prepare("DELETE FROM bancos WHERE id_bancos=:id_bancos");
  $sentencia->bindParam(":id_bancos",$txtID);
  $sentencia->execute();
 
}

?> 
<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';
if(isset( $_GET['txtID'] )){

  $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";  
  $sentencia=$con->prepare("SELECT * FROM tipos_servicios_callcenter WHERE idServicio=:idServicio");
  $sentencia->bindParam(":idServicio",$txtID);
  $sentencia->execute();
  $registro=$sentencia->fetch(PDO::FETCH_LAZY);
  $idServicio=$registro["idServicio"];
  $nombreServicio=$registro["nombreServicio"];
  $descripcionServicio=$registro["descripcionServicio"];
}
if($_POST){
  
 $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
 $nombreServicio=(isset($_POST["nombreServicio"])?$_POST["nombreServicio"]:"");
 $descripcionServicio=(isset($_POST["descripcionServicio"])?$_POST["descripcionServicio"]:"");

  $sentencia=$con->prepare("UPDATE tipos_servicios_callcenter 
  SET  nombreServicio=:nombreServicio, descripcionServicio=:descripcionServicio 
  WHERE idServicio=:idServicio");
  
  $sentencia->bindParam(":nombreServicio",$nombreServicio);
  $sentencia->bindParam(":descripcionServicio",$descripcionServicio);
  $sentencia->bindParam(":idServicio", $txtID);
  $sentencia->execute();
  echo '<script language="javascript"> ';
  echo 'Swal.fire({
        icon: "success",
        title: "DATOS GUARDADOS",
        text: "LOS DATOS SE GUARDARON CORRECTAMENTE",
        showConfirmButton: false,
        timer: 2000,
      }).then(function() {
        window.location = "./index.php";
        });';
  echo '</script>';
  
}
?>
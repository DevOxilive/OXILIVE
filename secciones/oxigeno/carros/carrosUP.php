<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';
if(isset( $_GET['txtID'] )){

  $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";  
  $sentencia=$con->prepare("SELECT * FROM carros WHERE id_carro=:id_carro");
  $sentencia->bindParam(":id_carro",$txtID);
  $sentencia->execute();
  $registro=$sentencia->fetch(PDO::FETCH_LAZY);
  $id_carro=$registro["id_carro"];
  $Nombre_carro=$registro["Nombre_carro"];
  $modelo=$registro["modelo"];
  $marca=$registro["marca"];
  $placa=$registro["placa"];
  $status=$registro["estado"];
}
if($_POST){
  
 $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
 $modelo=(isset($_POST["modelo"])?$_POST["modelo"]:"");
 $Nombre_carro=(isset($_POST["Nombre_carro"])?$_POST["Nombre_carro"]:"");
 $modelo=(isset($_POST["modelo"])?$_POST["modelo"]:"");
  $marca=(isset($_POST["marca"])?$_POST["marca"]:"");
  $placa=(isset($_POST["placa"])?$_POST["placa"]:"");
  $status=(isset($_POST["status"])?$_POST["status"]:"");

  $consulta = $con->prepare("SELECT * FROM carros WHERE Nombre_carro = '$Nombre_carro' and modelo ='$modelo' and marca = '$marca' and placa='$placa' and estado = '$status'");
  $consulta->execute();
  $resul = $consulta->rowCount();
  if ($resul > 0) {
      echo '<script language="javascript"> ';
      echo 'Swal.fire({
              icon: "warning",
              title: "DUPLICADO",
              text: "El dato ingresado ya existe",
              showConfirmButton: false,
              timer: 2000,
          }).then(function() {
              window.location = "index.php";
              });';
      echo '</script>';
  } else {
  $sentencia=$con->prepare("UPDATE carros 
  SET  Nombre_carro=:Nombre_carro, modelo=:modelo , marca=:marca , placa=:placa , estado=:status
              WHERE id_carro=:id_carro");
  
  $sentencia->bindParam(":Nombre_carro",$Nombre_carro);
  $sentencia->bindParam(":modelo",$modelo);
  $sentencia->bindParam(":marca", $marca );
  $sentencia->bindParam(":placa", $placa);
  $sentencia->bindParam(":status", $status);
  $sentencia->bindParam(":id_carro", $txtID);
  $sentencia->execute();
  echo '<script language="javascript"> ';
  echo 'Swal.fire({
        icon: "success",
        title: "DATOS GUARDADOS",
        text: "LOS DATOS SE GUARDARON CORRECTAMENTE",
        showConfirmButton: false,
        timer: 2000,
      }).then(function() {
        window.location = "index.php";
        });';
  echo '</script>';
  }
}
?>
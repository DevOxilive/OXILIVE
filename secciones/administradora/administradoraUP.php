<?php
include("../../connection/conexion.php");
include_once '../../templates/hea.php';

if (isset($_GET['txtID'])) {

  //CONSULTA LOS DATOS Y TRAE LOS DATOS DE LA BASE DE DATOS
  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
  $sentencia = $con->prepare("SELECT * FROM administradora WHERE id_administradora=:id_administradora");
  $sentencia->bindParam(":id_administradora", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
  $Nombre_administradora = $registro["Nombre_administradora"];
}

if ($_POST) {
  //PRIMERO VERIFICA SI EL DATO A EDITAR NO EXISTE
  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $Nombre_administradora = (isset($_POST["Nombre_administradora"]) ? $_POST["Nombre_administradora"] : "");    
  $consulta = $con->prepare("SELECT * FROM administradora WHERE Nombre_administradora = '$Nombre_administradora'");
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
    //SI NO EXISTE, ENTONCES SI PUEDE EDITAR EL DATO CON ESE NOMBRE. 
    $sentencia = $con->prepare("UPDATE administradora 
    SET Nombre_administradora=:Nombre_administradora
                WHERE id_administradora=:id_administradora");

    $sentencia->bindParam(":Nombre_administradora", $Nombre_administradora);
    $sentencia->bindParam(":id_administradora", $txtID);
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
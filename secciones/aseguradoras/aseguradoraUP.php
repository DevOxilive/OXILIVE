<?php
include("../../connection/conexion.php");
include_once '../../templates/hea.php';
if (isset($_GET['txtID'])) {

  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
  $sentencia = $con->prepare("SELECT * FROM aseguradoras WHERE id_aseguradora=:id_aseguradora");
  $sentencia->bindParam(":id_aseguradora", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
  $Nombre_aseguradora = $registro["Nombre_aseguradora"];
  $administradora = $registro["administradora"];
}

if ($_POST) {

  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $Nombre_aseguradora = (isset($_POST["Nombre_aseguradora"]) ? $_POST["Nombre_aseguradora"] : "");
  $administradora = (isset($_POST["administradora"]) ? $_POST["administradora"] : "");

  $consulta = $con->prepare("SELECT * FROM aseguradoras WHERE Nombre_aseguradora = '$Nombre_aseguradora' and administradora = '$administradora' ");
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
    $sentencia = $con->prepare("UPDATE aseguradoras 
    SET Nombre_aseguradora=:Nombre_aseguradora, administradora=:administradora
                WHERE id_aseguradora=:id_aseguradora");
    $sentencia->bindParam(":Nombre_aseguradora", $Nombre_aseguradora);
    $sentencia->bindParam(":administradora", $administradora);
    $sentencia->bindParam(":id_aseguradora", $txtID);
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
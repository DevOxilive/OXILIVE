<?php
include("../../connection/conexion.php");
include_once '../../templates/hea.php';
if (isset($_GET['txtID'])) {
  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
  $sentencia = $con->prepare("SELECT * FROM administradora WHERE id_administradora=:id_administradora");
  $sentencia->bindParam(":id_administradora", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
  $administradora = $registro["Nombre_administradora"];
}
if ($_POST) {
  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $administradora = (isset($_POST["Nombre_administradora"]) ? $_POST["Nombre_administradora"] : "");
  $consulta = $con->prepare("SELECT * FROM administradora WHERE id_administradora != :id_administradora AND Nombre_administradora = :administradora");
  $consulta->bindParam(":id_administradora", $txtID);
  $consulta->bindParam(":administradora", $administradora);
  $consulta->execute();  
  $resul = $consulta->rowCount();
  if ($resul > 0) {
    echo '<script language="javascript"> ';
    echo 'Swal.fire({
          icon: "warning",
          title: "DUPLICADO",
          text: "la administradora ingresado ya existe",
          showConfirmButton: false,
          timer: 2000,
       }).then(function() {
          window.location = "index.php";
          });';
    echo '</script>';
  } else {
    $sentencia = $con->prepare("UPDATE administradora 
    SET Nombre_administradora=:administradora
                WHERE id_administradora = :id_administradora");
    $sentencia->bindParam(":id_administradora", $txtID);
    $sentencia->bindParam(":administradora", $administradora);
    $sentencia->execute();
    echo '<script language="javascript"> ';
    echo 'Swal.fire({
          icon: "success",
          title: "DATOS GUARDADOS",
          text: "ADMINISTRADORA ACTUALIZADA CORRECTAMENTE",
          showConfirmButton: false,
          timer: 2000,
        }).then(function() {
          window.location = "index.php";
          });';
    echo '</script>';
  }
}

?>
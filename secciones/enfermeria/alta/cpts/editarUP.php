<?php
include("../../../../connection/conexion.php");
include_once '../../../../templates/hea.php';
if (isset($_GET['txtID'])) {

  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
  $sentencia = $con->prepare("SELECT * FROM cpts WHERE id_cpt=:id_cpt");
  $sentencia->bindParam(":id_cpt", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
  $cpt = $registro["cpt"];
  $administradora = $registro["administradora"];
}

if ($_POST) {

  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $cpt = (isset($_POST["cpt"]) ? $_POST["cpt"] : "");
  $administradora = (isset($_POST["administradora"]) ? $_POST["administradora"] : "");

  $consulta = $con->prepare("SELECT * FROM cpts WHERE cpt = '$cpt' and admi = '$administradora' ");
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
    $sentencia = $con->prepare("UPDATE cpts 
    SET cpt=:cpt, admi=:admi
                WHERE id_cpt=:id_cpt");
    $sentencia->bindParam(":id_cpt", $txtID);
    $sentencia->bindParam(":cpt", $cpt);
    $sentencia->bindParam(":admi", $administradora);
    $sentencia->execute();
    echo '<script language="javascript"> ';
    echo 'Swal.fire({
          icon: "success",
          title: "CPT EDITADO",
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
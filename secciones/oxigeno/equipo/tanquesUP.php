<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if (isset($_GET['txtID'])) {

  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
  $sentencia = $con->prepare("SELECT * FROM tanques WHERE id_tanques=:id_tanques");
  $sentencia->bindParam(":id_tanques", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
  $marca = $registro["marca"];
  $estado_tanque = $registro["estado_tanque"];
  $tamano = $registro["tamano"];
  $cantidad = $registro["cantidad"];
}

if ($_POST) {
  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $marca=(isset($_POST["marca"])?$_POST["marca"]:"");
  $estado_tanque=(isset($_POST["estado_tanque"])?$_POST["estado_tanque"]:"");
  $tamano=(isset($_POST["tamano"])?$_POST["tamano"]:"");
  $cantidad=(isset($_POST["cantidad"])?$_POST["cantidad"]:"");

    $sentencia = $con->prepare("UPDATE tanques 
    SET marca=:marca, estado_tanque= :estado_tanque,tamano=:tamano,cantidad=:cantidad
                WHERE id_tanques=:id_tanques");
    $sentencia->bindParam(":marca",$marca);
    $sentencia->bindParam(":estado_tanque",$estado_tanque);
    $sentencia->bindParam(":tamano",$tamano);
    $sentencia->bindParam(":cantidad",$cantidad);
    $sentencia->bindParam(":id_tanques", $txtID);
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

?>
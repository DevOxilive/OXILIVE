<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if (isset($_GET['txtID'])) {

  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
  $sentencia = $con->prepare("SELECT * FROM insumos WHERE id_insumo=:id_insumo");
  $sentencia->bindParam(":id_insumo", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
  $marca_insumo = $registro["marca_insumo"];
  $estado_insumo = $registro["estado_insumo"];
  $tamano_insumo = $registro["tamano_insumo"];
  $cantidad_insumo = $registro["cantidad_insumo"];
}

if ($_POST) {
  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $marca_insumo=(isset($_POST["marca_insumo"])?$_POST["marca_insumo"]:"");
  $estado_insumo=(isset($_POST["estado_insumo"])?$_POST["estado_insumo"]:"");
  $tamano_insumo=(isset($_POST["tamano_insumo"])?$_POST["tamano_insumo"]:"");
  $cantidad_insumo=(isset($_POST["cantidad_insumo"])?$_POST["cantidad_insumo"]:"");

    $sentencia = $con->prepare("UPDATE insumos 
    SET marca_insumo=:marca_insumo, estado_insumo= :estado_insumo,tamano_insumo=:tamano_insumo,cantidad_insumo=:cantidad_insumo
                WHERE id_insumo=:id_insumo");
    $sentencia->bindParam(":marca_insumo",$marca_insumo);
    $sentencia->bindParam(":estado_insumo",$estado_insumo);
    $sentencia->bindParam(":tamano_insumo",$tamano_insumo);
    $sentencia->bindParam(":cantidad_insumo",$cantidad_insumo);
    $sentencia->bindParam(":id_insumo", $txtID);
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
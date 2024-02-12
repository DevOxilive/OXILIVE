<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if (isset($_GET['txtID'])) {

  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
  $sentencia = $con->prepare("SELECT * FROM choferes WHERE id_choferes=:id_choferes");
  $sentencia->bindParam(":id_choferes", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
  $Nombre_completo = $registro["Nombre_completo"];
  $status = $registro["estado"];
}

if ($_POST) {
  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $Nombre_completo = (isset($_POST["Nombre_completo"]) ? $_POST["Nombre_completo"] : "");
  $status = (isset($_POST["status"]) ? $_POST["status"] : "");
  $consulta = $con->prepare("SELECT * FROM choferes WHERE Nombre_completo = '$Nombre_completo' and estado = '$status'");
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
    $sentencia = $con->prepare("UPDATE choferes 
    SET Nombre_completo=:Nombre_completo, estado= :status
                WHERE id_choferes=:id_choferes");
    $sentencia->bindParam(":Nombre_completo", $Nombre_completo);
    $sentencia->bindParam(":status", $status);
    $sentencia->bindParam(":id_choferes", $txtID);
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
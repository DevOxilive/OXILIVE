<?php
include("../../../../connection/conexion.php");
include_once '../../../../templates/hea.php';

if (isset($_GET['txtID'])) {

  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
  $sentencia = $con->prepare("SELECT * FROM bancos WHERE id_bancos=:id_bancos");
  $sentencia->bindParam(":id_bancos", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
  $Nombre_banco = $registro["Nombre_banco"];

}

if ($_POST) {

  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $Nombre_banco = (isset($_POST["Nombre_banco"]) ? $_POST["Nombre_banco"] : "");
  $consulta = $con->prepare("SELECT * FROM bancos WHERE Nombre_banco = '$Nombre_banco'");
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
    $sentencia = $con->prepare("UPDATE bancos 
    SET Nombre_banco=:Nombre_banco
                WHERE id_bancos=:id_bancos");
    $sentencia->bindParam(":Nombre_banco", $Nombre_banco);
    $sentencia->bindParam(":id_bancos", $txtID);
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
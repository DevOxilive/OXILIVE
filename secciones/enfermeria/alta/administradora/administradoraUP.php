<?php
include("../../../../connection/conexion.php");
include_once '../../../../templates/hea.php';

/*if (isset($_GET['txtID'])) {
  //CONSULTA LOS DATOS Y TRAE LOS DATOS DE LA BASE DE DATOS
  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
  //$administradora = (isset($_GET['adminis$administradora'])) ? $_GET['adminis$administradora'] : "";
  //$Nombre_banco = (isset($_GET['Nombre_banco'])) ? $_GET['Nombre_banco'] : "";

  $sentencia = $con->prepare("SELECT * FROM bancos WHERE id_bancos=:bancos");
  $sentencia->bindParam(":bancos", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetchAll(PDO::FETCH_ASSOC);
  $Nombre_banco = $registro["Nombre_banco"];
  $administradora = $registro["administradora"];
}*/

if ($_POST) {
  //PRIMERO VERIFICA SI EL DATO A EDITAR NO EXISTE
  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $administradora = (isset($_POST["administradora"]) ? $_POST["administradora"] : "");    
  $Nombre_banco = (isset($_POST["Nombre_banco"]) ? $_POST["Nombre_banco"] : ""); 
  $consulta = $con->prepare("SELECT * FROM bancos WHERE Nombre_banco = '$Nombre_banco'");
  $consulta->execute();
    $sentencia = $con->prepare("UPDATE bancos 
    SET Nombre_banco=:Nombre_banco , admi = :admi
                WHERE id_bancos=:id_banco");

    $sentencia->bindParam(":Nombre_banco", $Nombre_banco);
    $sentencia->bindParam(":admi", $administradora);
    $sentencia->bindParam(":id_banco", $txtID);
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
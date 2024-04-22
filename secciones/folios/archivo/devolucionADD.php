<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if ($_POST) {
  //PRIMERO VERIFICA SI EL DATO A EDITAR NO EXISTE
  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $folio = (isset($_POST["foliosB"]) ? $_POST["foliosB"] : "");    
  $estado = (isset($_POST["estatus"]) ? $_POST["estatus"] : ""); 

  $sentencia = $con->prepare("UPDATE folios 
    SET folio = :folio, estado = :estado
    WHERE id_folio = :id_folio");

  $sentencia->bindParam(":folio", $folio);
  $sentencia->bindParam(":estado", $estado);
  $sentencia->bindParam(":id_folio", $txtID);
  $sentencia->execute();

  echo '<script language="javascript"> ';
  echo 'Swal.fire({
        icon: "success",
        title: "FOLIO CANCELADO",
        text: "EL FOLIO A SIDO CANCELADO CORRECTAMENTE",
        showConfirmButton: false,
        timer: 2000,
      }).then(function() {
        window.location = "./archivoFolios.php";
        });';
  echo '</script>';
}

?>
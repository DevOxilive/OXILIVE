<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';
if (isset($_GET['txtID'])) {

  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
  $codigo_ICD = (isset($_GET["codigo_ICD"]) ? $_GET["codigo_ICD"] : "");
  $dx = (isset($_GET["dx"]) ? $_GET["dx"] : "");
  $medico = (isset($_GET['medico']) ? $_GET['medico'] : "");
  $sentencia = $con->prepare("SELECT * FROM proce_enfer WHERE id_proce=:id_proce");
  $sentencia->bindParam(":id_proce", $txtID);
  $sentencia->execute();

  $registro = $sentencia->fetch(PDO::FETCH_LAZY);
  $codigo_ICD = $registro["codigo_ICD"];
  $dx = $registro["dx"];
  $medico = $registro["medico"];

}

if ($_POST) {

  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $codigo_ICD = (isset($_POST["codigo_ICD"])) ? $_POST["codigo_ICD"] : "";
  $dx = (isset($_POST["dx"])) ? $_POST["dx"] : "";
  $medico = (isset($_POST['medico'])) ? $_POST['medico'] : "";
  
  // Preparar la consulta SQL con sentencias preparadas
  $consulta = $con->prepare("SELECT * FROM proce_enfer WHERE  codigo_ICD = :codigo_ICD AND dx = :dx AND medico = :medico");
  
  // Vincular los valores a los parámetros de la consulta
  $consulta->bindParam(":codigo_ICD", $codigo_ICD);
  $consulta->bindParam(":dx", $dx);
  $consulta->bindParam(":medico", $medico);
  
  // Ejecutar la consulta
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
    $sentencia = $con->prepare("UPDATE proce_enfer 
    SET codigo_ICD=:codigo_ICD , dx=:dx , medico=:medico
                WHERE id_proce=:id_proce");


  
    $sentencia->bindParam(":codigo_ICD", $codigo_ICD);
    $sentencia->bindParam(":dx", $dx);
    $sentencia->bindParam(":medico", $medico);


    $sentencia->bindParam(":id_proce",$txtID);
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
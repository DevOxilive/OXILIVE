<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if ($_POST) {
  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $paciente =  (isset($_POST['paciente'])) ? $_POST['paciente'] : "";
  $medico =  (isset($_POST['medico'])) ? $_POST['medico'] : "";
  $selectet_cpt =  (isset($_POST['cpt'])) ? $_POST['cpt'] : "";
  $select_icd = (isset($_POST['icd'])) ? $_POST['icd'] : "";
  $select_dx = (isset($_POST["dx"]) ? $_POST["dx"] : "");
  $select_fecha =  (isset($_POST['fecha'])) ? $_POST['fecha'] : "";  
  //Preparar la consulta SQL con sentencias preparadas
  $consulta = $con->prepare("SELECT * FROM procedimientos WHERE icd = :icd AND dx = :dx AND fecha = :fecha AND medico = :medico AND pacienteYnomina = :paciente
   AND cpt = :cpt");

  // Vincular los valores a los parámetros de la consulta
  $consulta->bindParam(":icd" , $select_icd);
  $consulta->bindParam(":dx", $select_dx);
  $consulta->bindParam(":fecha", $select_fecha);
  $consulta->bindParam(":medico", $medico);
  $consulta->bindParam(":paciente", $paciente);
  $consulta->bindParam(":cpt" , $selectet_cpt);
  $consulta->execute();
  $procedimiento = $consulta->rowCount();
  //Aquí mandamos la salida
  $sentencia = $con->prepare("UPDATE procedimientos SET icd = :icd, dx = :dx, fecha = :fecha, medico = :medico, pacienteYnomina = :paciente, cpt = :cpt WHERE id_procedi = :id_procedi");
    $sentencia->bindParam(":icd" , $select_icd);
    $sentencia->bindParam(":dx", $select_dx);
    $sentencia->bindParam(":fecha", $select_fecha);
    $sentencia->bindParam(":medico", $medico);
    $sentencia->bindParam(":paciente", $paciente);
    $sentencia->bindParam(":cpt" , $selectet_cpt);
    $sentencia->bindParam(":id_procedi",$txtID);
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
<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';
if (isset($_GET['txtID'])) {

  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
  $paciente =  (isset($_GET['paciente'])) ? $_GET['paciente'] : "";
  $administradora =  (isset($_GET['administradora'])) ? $_GET['administradora'] : "";
  $selected_cpt =  (isset($_GET['cpt'])) ? $_GET['cpt'] : "";
  $selected_descripcion =  (isset($_GET['descripcion'])) ? $_GET['descripcion'] : "";
  $selected_unidad =  (isset($_GET['unidad'])) ? $_GET['unidad'] : "";

  $selected_paciente =  (isset($_GET['paciente'])) ? $_GET['paciente'] : "";
  $selected_Medico =  (isset($_GET['medico'])) ? $_GET['medico'] : "";
  $selecd_icd = (isset($_GET['icd'])) ? $_GET['icd'] : "";
  $dx = (isset($_GET["dx"]) ? $_GET["dx"] : "");
  $fecha_select =  (isset($_GET['fecha'])) ? $_GET['fecha'] : "";

  // $consulta = $con->prepare("SELECT * FROM procedimientos WHERE icd = '$icd' and dx = '$icd'");
  //  $consulta = $con->prepare("SELECT * FROM aseguradoras WHERE Nombre_aseguradora = '$Nombre_aseguradora' and administradora = '$administradora' ");
  // $consulta->execute();
  // $resul = $consulta->rowCount();
}

// if ($_POST) {

//   $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
//   $codigo_ICD = (isset($_POST["codigo_ICD"])) ? $_POST["codigo_ICD"] : "";
//   $dx = (isset($_POST["dx"])) ? $_POST["dx"] : "";
//   $medico = (isset($_POST['medico'])) ? $_POST['medico'] : "";
  
//   // Preparar la consulta SQL con sentencias preparadas
//   $consulta = $con->prepare("SELECT * FROM proce_enfer WHERE  codigo_ICD = :codigo_ICD AND dx = :dx AND medico = :medico");
  
//   // Vincular los valores a los parámetros de la consulta
//   $consulta->bindParam(":codigo_ICD", $codigo_ICD);
//   $consulta->bindParam(":dx", $dx);
//   $consulta->bindParam(":medico", $medico);
  
//   // Ejecutar la consulta
//   $consulta->execute();
  

//   $resul = $consulta->rowCount();
  
//   if ($resul > 0) {
//     echo '<script language="javascript"> ';
//     echo 'Swal.fire({
//           icon: "warning",
//           title: "DUPLICADO",
//           text: "El dato ingresado ya existe",
//           showConfirmButton: false,
//           timer: 2000,
//        }).then(function() {
//           window.location = "index.php";
//           });';
//     echo '</script>';
//   } else {
//     $sentencia = $con->prepare("UPDATE proce_enfer 
//     SET codigo_ICD=:codigo_ICD , dx=:dx , medico=:medico
//                 WHERE id_proce=:id_proce");


  
//     $sentencia->bindParam(":codigo_ICD", $codigo_ICD);
//     $sentencia->bindParam(":dx", $dx);
//     $sentencia->bindParam(":medico", $medico);


//     $sentencia->bindParam(":id_proce",$txtID);
//     $sentencia->execute();
//     echo '<script language="javascript"> ';
//     echo 'Swal.fire({
//           icon: "success",
//           title: "DATOS GUARDADOS",
//           text: "LOS DATOS SE GUARDARON CORRECTAMENTE",
//           showConfirmButton: false,
//           timer: 2000,
//         }).then(function() {
//           window.location = "index.php";
//           });';
//     echo '</script>';
//   }
// }

?>
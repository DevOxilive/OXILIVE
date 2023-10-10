<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';
include("./consultaHoja.php");

if (isset($_GET['txtID'])) {

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $codigo_ICD = (isset($_GET["codigo_ICD"]) ? $_GET["codigo_ICD"] : "");
    $dx = (isset($_GET["dx"]) ? $_GET["dx"] : "");
    $medico = (isset($_GET['medico']) ? $_GET['medico'] : "");
    $sentencia = $con->prepare("SELECT * FROM proce_enfer WHERE id_proce=:id_proce");
    $sentencia->bindParam(":id_proce", $txtID);
    $sentencia->execute();
  
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $pacientes = $registro["pacientes"];
    $codigo_ICD = $registro["codigo_ICD"];
    $dx = $registro["dx"];
    $medico = $registro["medico"];
  
  }

if ($_POST) {
    $codigo_ICD = (isset($_POST["codigo_ICD"]) ? $_POST["codigo_ICD"] : "");
    $dx = (isset($_POST["dx"]) ? $_POST["dx"] : "");
    $medico = (isset($_POST['medico']) ? $_POST['medico'] : "");
    $pacientes = (isset($_POST["pacientes"]) ? $_POST["pacientes"] : "");
    $cpt_admi = (isset($_POST["cpt_admi"]) ? $_POST["cpt_admi"] : "");
    $des1= (isset($_POST["des1"]) ? $_POST["des1"] : "");
    $unidad = (isset($_POST["unidad"]) ? $_POST["unidad"] : "");
    $fecha = (isset($_POST["fecha"]) ? $_POST["fecha"] : "");
    $Nombre_admi = (isset($_POST["Nombre_admi"]) ? $_POST["Nombre_admi"] : "");

        $sentencia = $con->prepare("INSERT INTO proce_enfer (id_proce,codigo_ICD,dx,medico,pacientes,cpt, descripcion,fecha,unidad)
        VALUES (null,:codigo_ICD,:dx,:medico,:pacientes,:cpt,:descripcion,:fecha,:unidad)");

        $sentencia->bindParam(":codigo_ICD", $codigo_ICD);
        $sentencia->bindParam(":dx", $dx);
        $sentencia->bindParam(":medico", $medico);
        $sentencia->bindParam(":pacientes", $pacientes);        
        $sentencia->bindParam(":cpt", $cpt_admi);
        $sentencia->bindParam(":descripcion", $des1);
        $sentencia->bindParam(":fecha", $fecha);    
        $sentencia->bindParam(":unidad", $unidad);
        $sentencia->execute();

        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "Procedimiento Agregado",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    }
// }
?>
<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';
if ($_POST) {
    $medico = (isset($_POST["medico"]) ? $_POST["medico"] : "");
    $codigo_ICD = (isset($_POST["codigo_ICD"]) ? $_POST["codigo_ICD"] : "");
    $dx = (isset($_POST["dx"]) ? $_POST["dx"] : "");
    $fecha = (isset($_POST["fecha"]) ? $_POST["fecha"] : "");
    $paciente = (isset($_POST["paciente"]) ? $_POST["paciente"] : "");
    $codigo = (isset($_POST["codigo"]) ? $_POST["codigo"] : "");
    $cpt = (isset($_POST["cpt"]) ? $_POST["cpt"] : "");

    $consulta = $con->prepare("SELECT * FROM procedimientos  WHERE dx = '$dx' AND icd = '$codigo_ICD' AND 
    pacienteYnomina = '$paciente'");
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
        $sentencia = $con->prepare("INSERT INTO procedimientos (icd, dx, fecha, medico,pacienteYnomina, codigo, cpt) VALUES (:icd, :dx, :fecha, :medico,:paciente, :codigo, :cpt)");
        $sentencia->bindParam(":icd", $codigo_ICD);
        $sentencia->bindParam(":dx", $dx);
        $sentencia->bindParam(":fecha", $fecha);
        $sentencia->bindParam(":medico", $medico);
        $sentencia->bindParam(":paciente", $paciente);
        $sentencia->bindParam(":codigo", $codigo);
        $sentencia->bindParam(":cpt",$cpt);
        $sentencia->execute();


        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "PROCEDIMINETO CREADO",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    }
}
?>
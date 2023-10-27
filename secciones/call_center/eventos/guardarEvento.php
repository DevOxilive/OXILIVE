<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';
if ($_POST) {
    // $idPaciente=(isset($_POST["idPaciente"])?$_POST["idPaciente"]:"");
    $idPaciente = (isset($_POST["idPaciente"]) ? $_POST["idPaciente"] : NULL);
    $nomSolicitante = (isset($_POST["nomSolicitante"]) ? $_POST["nomSolicitante"] : "");
    $fechaServicio = (isset($_POST["fechaServicio"]) ? $_POST["fechaServicio"] : "");
    $horaEntrada = (isset($_POST["horaEntrada"]) ? $_POST["horaEntrada"] : "");
    $motivoConsulta = (isset($_POST["motivoConsulta"]) ? $_POST["motivoConsulta"] : "");
    $nAutorizacion = (isset($_POST["nAutorizacion"]) ? $_POST["nAutorizacion"] : "");
    $auEspecial = (isset($_POST["auEspecial"]) ? $_POST["auEspecial"] : "");
    $id_usuarios = (isset($_POST["asignarMedico"]) ? $_POST["asignarMedico"] : "");
    // $id_usuarios = (isset($_POST["id_usuarios"])) ? intval($_POST["id_usuarios"]) : 0;
    $idServicio = (isset($_POST["tipoServicio"]) ? $_POST["tipoServicio"] : []);

    //echo $idPaciente." ".$nomSolicitante." ".$fechaServicio." ".$motivoConsulta." ".$nAutorizacion." ".$auEspecial." ".$idServicio;


    $sentencia = $con->prepare("INSERT INTO asignacion_servicio
        VALUES (
            null,
            :idPaciente,
            :nomSolicitante,
            :fechaServicio,
            :horaEntrada,
            :motivoConsulta,
            :nAutorizacion,
            :auEspecial,
            :id_usuarios,
            :idServicio, 
            1
        )");
    $sentencia->bindParam(":idPaciente", $idPaciente);
    $sentencia->bindParam(":nomSolicitante", $nomSolicitante);
    $sentencia->bindParam(":fechaServicio", $fechaServicio);
    $sentencia->bindParam(":horaEntrada", $horaEntrada);
    $sentencia->bindParam(":motivoConsulta", $motivoConsulta);
    $sentencia->bindParam(":nAutorizacion", $nAutorizacion);
    $sentencia->bindParam(":auEspecial", $auEspecial);
    $sentencia->bindParam(":id_usuarios", $id_usuarios);
    foreach ($idServicio as $servicio) {
        $sentencia->bindparam(':idServicio', $servicio);
        if ($sentencia->execute()) {
            echo '<script language="javascript"> ';
            echo 'Swal.fire({
                icon: "success",
                title: "Servico Agregado",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                //window.location = "index.php";
                });';
            echo '</script>';
        } else {
            echo '<script language="javascript"> ';
            echo 'Swal.fire({
                        icon: "error",
                        title: "Error al agregar el servicio",
                        text: "Hubo errores en la inserción",
                        confirmButtonColor: "#d33",
                        confirmButtonText: "OK",
                    });';
            echo '</script>';
        }
    }
}

if (empty($errores)) {
    echo '<script language="javascript"> ';
    echo 'Swal.fire({
                icon: "success",
                title: "Servico Agregado",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
    echo '</script>';
} else {
    // Si hubo errores, puedes manejarlos aquí
    echo '<script language="javascript"> ';
    echo 'Swal.fire({
                icon: "error",
                title: "Error al agregar el servicio",
                text: "Hubo errores en la inserción",
                confirmButtonColor: "#d33",
                confirmButtonText: "OK",
            });';
    echo '</script>';
}

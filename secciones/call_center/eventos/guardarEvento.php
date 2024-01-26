<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';
if ($_POST) {
 
    $idPaciente = $_POST["idPaciente"];
    $nomSolicitante = $_POST["nomSolicitante"];
    $fechaServicio = $_POST["fechaServicio"];
    $horaEntrada = $_POST["horaEntrada"];
    $motivoConsulta = $_POST["motivoConsulta"];
    $nAutorizacion = $_POST["nAutorizacion"];
    $auEspecial = $_POST["auEspecial"];
    $id_usuarios = $_POST["asignarMedico"];
    $idServicio = $_POST["tipoServicio"];

//es para que los datos se vean en mayusculas  
    
    $nomSolicitante = strtoupper($nomSolicitante);
    $motivoConsulta = strtoupper($motivoConsulta);
    

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
                title: "Evento guardado",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "./cancelar/cancelar.php";
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
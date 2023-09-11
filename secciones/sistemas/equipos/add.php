<?php

include("../../../connection/conexion.php");
include("../../../templates/hea.php");
if ($_POST) {
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $tipo_equipo = isset($_POST["tipo_equipo"]) ? $_POST["tipo_equipo"] : array();
    $tipo_equipo = implode(',', $tipo_equipo);
    $entrego = isset($_POST["entrego"]) ? $_POST["entrego"] : "";
    $recibio = (isset($_POST["recibio"]) ? $_POST["recibio"] : "");
    $no_serie = (isset($_POST["no_serie"]) ? $_POST["no_serie"] : "");
    $IMEI = (isset($_POST["IMEI"]) ? $_POST["IMEI"] : "");
    $autorizo = (isset($_POST["autorizo"]) ? $_POST["autorizo"] : "");
    $observaciones = (isset($_POST["observaciones"]) ? $_POST["observaciones"] : "");


    $sentencia = $con->prepare("INSERT INTO equipo (id_equipo, nombre, tipo_equipo, entrego, recibio, estado, no_serie, IMEI, autorizo, observaciones) 
                            VALUES (Null, :nombre, :tipo_equipo, :entrego, :recibio, 1 , :no_serie, :IMEI, :autorizo, :observaciones);");

    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":tipo_equipo", $tipo_equipo);
    $sentencia->bindParam(":entrego", $entrego);
    $sentencia->bindParam(":recibio", $recibio);
    $sentencia->bindParam(":no_serie", $no_serie);
    $sentencia->bindParam(":IMEI", $IMEI);
    $sentencia->bindParam(":autorizo", $autorizo);
    $sentencia->bindParam(":observaciones", $observaciones);
    $sentencia->execute();
    echo '<script language="javascript"> ';
        echo 'Swal.fire({
            icon: "success",
           title: "RESPONSIVA CREADA",
           showConfirmButton: false,
           timer: 1500,
       }).then(function() {
   window.location = "index.php";
       });';
        echo '</script>';
}

?>
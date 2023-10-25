<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if(isset($_GET['txtID'])){
  //verifica los datos enviados con el metodo GET
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $con->prepare("SELECT * FROM tipos_servicios_callcenter WHERE idServicio=:idServicio");
    $sentencia->bindParam(":idServicio", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);
    $idServicio = $registro["idServicio"];
    $nombreServicio = $registro["nombreServicio"];
    $descripcionServicio = $registro["descripcionServicio"];
}

if($_POST){
  //solicita los datos por metodo POST antes de realizar la consulta
    $txtID = $_POST['txtID'];
    $nombreServicio = $_POST["nomServicio"];
    $descripcionServicio = $_POST["descripServicio"];
// Prepara la inserción con un UPDATE
    $sentencia = $con->prepare("UPDATE tipos_servicios_callcenter 
                                SET nombreServicio=:nombreServicio, descripcionServicio=:descripcionServicio 
                                WHERE idServicio=:idServicio");
// Con bindParam se vincula la variable al parámetro y en el momento 
// de hacer el execute es cuando se asigna realmente el valor de la variable a ese parámetro
    $sentencia->bindParam(":nombreServicio", $nombreServicio);
    $sentencia->bindParam(":descripcionServicio", $descripcionServicio);
    $sentencia->bindParam(":idServicio", $txtID);
    $sentencia->execute();

    echo '<script language="javascript"> ';
    echo 'Swal.fire({
            icon: "success",
            title: "DATOS GUARDADOS",
            text: "LOS DATOS SE GUARDARON CORRECTAMENTE",
            showConfirmButton: false,
            timer: 2000,
        }).then(function() {
            window.location = "./index.php";
        });';
    echo '</script>';
}
?>
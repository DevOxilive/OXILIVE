<?php 
include("../../../../connection/conexion.php");
include_once '../../../../templates/hea.php';

 
if($_POST){
// cacha los datos antes de realizar la inserción   
    $nomServicio=(isset($_POST["nomServicio"])?$_POST["nomServicio"]:"");
    $descripServicio=(isset($_POST["descripServicio"])?$_POST["descripServicio"]:"");

//es para que los datos se vean en mayusculas     
    $nomServicio = strtoupper($nomServicio);
    $descripServicio = strtoupper($descripServicio);
   
// realiza la inserción a la base de datos
    $sentencia=$con->prepare("INSERT INTO 
                            `tipos_servicios_callcenter` (`idServicio`, `nombreServicio`, `descripcionServicio`) 
                            VALUES (Null, :nomServicio ,:descripServicio);");
// con bindParam se vincula la variable al parámetro y en el momento 
// de hacer el execute es cuando se asigna realmente el valor de la variable a ese parámetro
    $sentencia->bindParam(":nomServicio",$nomServicio);
    $sentencia->bindParam(":descripServicio",$descripServicio);
    $sentencia->execute(); 
    echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "Servicio agregado correctamente ",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "../index.php";
                });';
        echo '</script>';
    
}   
?>
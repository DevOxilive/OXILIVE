<?php 
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';
if($_POST){
   
    $nomServicio=(isset($_POST["nomServicio"])?$_POST["nomServicio"]:"");
    $descripServicio=(isset($_POST["descripServicio"])?$_POST["descripServicio"]:"");

    $sentencia=$con->prepare("INSERT INTO 
                            `tipos_servicios_callcenter` (`idServicio`, `nombreServicio`, `descripcionServicio`) 
                            VALUES (Null, :nomServicio ,:descripServicio);");
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
                window.location = "./index.php";
                });';
        echo '</script>';
    
}   
?>
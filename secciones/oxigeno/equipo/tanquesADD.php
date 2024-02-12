<?php
include ("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if($_POST){
    
    $marca=(isset($_POST["marca"])?$_POST["marca"]:"");
    $estado_tanque=(isset($_POST["estado_tanque"])?$_POST["estado_tanque"]:"");
    $tamano=(isset($_POST["tamano"])?$_POST["tamano"]:"");
    $cantidad=(isset($_POST["cantidad"])?$_POST["cantidad"]:"");

    $sentencia=$con->prepare("INSERT INTO tanques(`id_tanques`, `marca`, `estado_tanque`, `tamano`, `cantidad`) VALUES (Null, :marca, :estado_tanque, :tamano, :cantidad)");
    $sentencia->bindParam(":marca",$marca);
    $sentencia->bindParam(":estado_tanque",$estado_tanque);
    $sentencia->bindParam(":tamano",$tamano);
    $sentencia->bindParam(":cantidad",$cantidad);
    $sentencia->execute();
    echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "EQUIPO AGREGADOS",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    }
?>
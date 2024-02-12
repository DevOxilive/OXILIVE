<?php
include ("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if($_POST){
    
    $marca_insumo=(isset($_POST["marca_insumo"])?$_POST["marca_insumo"]:"");
    $estado_insumo=(isset($_POST["estado_insumo"])?$_POST["estado_insumo"]:"");
    $tamano_insumo=(isset($_POST["tamano_insumo"])?$_POST["tamano_insumo"]:"");
    $cantidad_insumo=(isset($_POST["cantidad_insumo"])?$_POST["cantidad_insumo"]:"");

    $sentencia=$con->prepare("INSERT INTO insumos(`id_insumo`, `marca_insumo`, `estado_insumo`, `tamano_insumo`, `cantidad_insumo`) VALUES (Null, :marca_insumo, :estado_insumo, :tamano_insumo, :cantidad_insumo)");
    $sentencia->bindParam(":marca_insumo",$marca_insumo);
    $sentencia->bindParam(":estado_insumo",$estado_insumo);
    $sentencia->bindParam(":tamano_insumo",$tamano_insumo);
    $sentencia->bindParam(":cantidad_insumo",$cantidad_insumo);
    $sentencia->execute();
    echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "INSUMOS AGREGADOS",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    }
?>
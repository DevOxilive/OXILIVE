<?php
include ("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if($_POST){
    
    $nombres=(isset($_POST["nombres"])?$_POST["nombres"]:"");
    $consulta = $con->prepare("SELECT * FROM choferes WHERE Nombre_completo = '$nombres'");
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
    $sentencia=$con->prepare("INSERT INTO choferes(id_choferes,Nombre_completo, estado,contador_seleccion)
                VALUES (null, :nombres, 1,0)");
    $sentencia->bindParam(":nombres",$nombres);
    $sentencia->execute();
    echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "CHOFER AGREGADO",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    }
}
?>
<?php
include ("../../../connection/conexion.php");
include_once '../../../templates/hea.php';
if($_POST){

    $Nombre_banco=(isset($_POST["Nombre_banco"])?$_POST["Nombre_banco"]:"");
    $consulta = $con->prepare("SELECT * FROM bancos_enfer WHERE Nombre_banco = '$Nombre_banco'");
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
    $sentencia=$con->prepare("INSERT INTO bancos_enfer(id_bancos,Nombre_banco)
                VALUES (null, :Nombre_banco)");
    $sentencia->bindParam(":Nombre_banco",$Nombre_banco);
    $sentencia->execute();
    echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "BANCO AGREGADA",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    }
}
?>
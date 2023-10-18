<?php
include("../../../../connection/conexion.php");
include_once '../../../../templates/hea.php';
if ($_POST) {
    $Nombre_aseguradora = (isset($_POST["Nombre_aseguradora"]) ? $_POST["Nombre_aseguradora"] : "");
    $administradora = (isset($_POST["administradora"]) ? $_POST["administradora"] : "");
    $consulta = $con->prepare("SELECT * FROM aseguradoras WHERE Nombre_aseguradora = '$Nombre_aseguradora' and administradora = '$administradora'");
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
        $sentencia = $con->prepare("INSERT INTO aseguradoras(id_aseguradora,Nombre_aseguradora,administradora)
        VALUES (null, :Nombre_aseguradora, :administradora)");
        $sentencia->bindParam(":Nombre_aseguradora", $Nombre_aseguradora);
        $sentencia->bindParam(":administradora", $administradora);
        $sentencia->execute();
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "ADMINISTRADORA AGREGADO",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    }
}
?>
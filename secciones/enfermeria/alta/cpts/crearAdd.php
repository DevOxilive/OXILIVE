<?php
include("../../../../connection/conexion.php");
include_once '../../../../templates/hea.php';
if ($_POST) {
    $cpt = (isset($_POST["cpt"]) ? $_POST["cpt"] : "");
    $administradora = (isset($_POST["administradora"]) ? $_POST["administradora"] : "");
    $consulta = $con->prepare("SELECT * FROM cpts WHERE cpt = '$cpt' and admi = '$administradora'");
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
        $sentencia = $con->prepare("INSERT INTO cpts(id_cpt,cpt,admi)
        VALUES (null, :cpt, :admi)");
        $sentencia->bindParam(":cpt", $cpt);
        $sentencia->bindParam(":admi", $administradora);
        $sentencia->execute();
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "CPT AGREGADO",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    }
}
?>
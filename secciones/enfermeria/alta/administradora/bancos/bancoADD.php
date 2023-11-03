<?php
include("../../../../../connection/conexion.php");
include_once("../../../../../templates/hea.php");

if ($_POST) {
    $Nombre_banco = (isset($_POST["Nombre_banco"]) ? $_POST["Nombre_banco"] : []);
    $administradora = (isset($_POST["administradora"]) ? $_POST["administradora"] : "");

    $error = [];

    $sentencia = $con->prepare("INSERT INTO bancos (id_bancos, Nombre_banco, admi) VALUES (null, :bancos, :admi)");
    $sentencia->bindParam(":admi", $administradora);

    foreach ($Nombre_banco as $banco) {
        $sentencia->bindParam(':bancos', $banco);

        // Verificar si el banco ya existe en la base de datos
        $consulta = $con->prepare("SELECT COUNT(*) as count FROM bancos WHERE Nombre_banco = :bancos");
        $consulta->bindParam(":bancos", $banco);
        $consulta->execute();
        $result = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            $error[] = $banco;
        } else {
            if ($sentencia->execute()) {
                echo '<script language="javascript"> ';
                echo 'Swal.fire({
                    icon: "success",
                    title: "Servicio Agregado",
                    showConfirmButton: false,
                    timer: 1500,
                }).then(function() {
                    window.location = "../../administradora/index.php"; 
                });';
                echo '</script>';
            } else {
                echo '<script language="javascript"> ';
                echo 'Swal.fire({
                    icon: "error",
                    title: "Error al agregar el servicio",
                    text: "Hubo errores en la inserción",
                    confirmButtonColor: "#d33",
                    confirmButtonText: "OK",
                });';
                echo '</script>';
            }
        }
    }

    if (!empty($error)) {
        // Manejar bancos duplicados
        $duplicados = implode(', ', $error);
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
            icon: "error",
            title: "Bancos Duplicados",
            text: "Los siguientes bancos ya existen en la base de datos: ' . $duplicados . '",
            confirmButtonColor: "#d33",
            confirmButtonText: "OK",
        }).then(function() {
            window.location = "crear.php"; // Cambia la URL de redirección a "crear.php"
        });';
        echo '</script>';
    }
    
}
?>

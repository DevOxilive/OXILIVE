<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
   
} else {
    echo "Error en el sistema";
}

// Verifica si se ha enviado una solicitud POST desde el formulario
if ($_POST) {
    // Recupera los datos del formulario
   
    $cpt = (isset($_POST["cpt"]) ? $_POST["cpt"] : "");
    $descripcion = (isset($_POST["descripcion"]) ? $_POST["descripcion"] : "");
    $unidades = (isset($_POST["unidades"]) ? $_POST["unidades"] : "");
    $fecha = (isset($_POST["fecha"])? $_POST["fecha"] : "");

  
    // Realiza las operaciones de inserción en la base de datos o procesamiento según sea necesario
    $sentencia = $con->prepare("INSERT INTO `tipo_cpt` (`cpt`, `descripcion`, `unidades`, `fecha`) VALUES (:cpt, :descripcion, :unidades, :fecha)");

    $sentencia->bindParam(":cpt", $cpt);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":unidades", $unidades);
    $sentencia->bindParam(":fecha", $fecha);

    $sentencia->execute();

    echo '<script language="javascript"> ';
    echo 'Swal.fire({
            icon: "success",
            title: "Procedimientos Realizados",
            showConfirmButton: false,
            timer: 1500,
        }).then(function() {
            window.location = "index.php";
            });';
    echo '</script>';

    }
?>

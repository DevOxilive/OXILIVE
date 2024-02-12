<?php
include_once '../../../connection/conexion.php';
include_once '../../../templates/hea.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ruta_id = $_POST['ruta_id'];
    $nuevo_estado_id = $_POST['cbestado'];
        $consulta = "UPDATE ruta_diaria_oxigeno SET estado = :nuevo_estado WHERE id_ruta = :ruta_id";
        $sentencia = $con->prepare($consulta);
        $sentencia->bindParam(":nuevo_estado", $nuevo_estado_id, PDO::PARAM_INT);
        $sentencia->bindParam(":ruta_id", $ruta_id, PDO::PARAM_INT);
        $sentencia->execute();
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
            icon: "success",
            title: "ESTADO CAMBIADO",
            showConfirmButton: false,
            timer: 1500,
        }).then(function() {
            window.location = "index.php";
            });';
        echo '</script>';
        exit();
}

// Si no se envió un formulario POST, puedes redirigir a alguna otra página o mostrar un mensaje.
?>
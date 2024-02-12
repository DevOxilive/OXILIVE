<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';
if (isset($_GET['txtID'])) {

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $con->prepare("SELECT * FROM tipo_cpt WHERE id_cpt=:id_cpt");
    $sentencia->bindParam(":id_cpt", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $cpt = $registro["cpt"];

    //Traer los datos en la DB
    $descripcion = $registro["descripcion"];
    $unidades = $registro["unidades"];
    $fecha = $registro["fecha"];

   }
      
    
// Verifica si se ha enviado una solicitud POST desde el formulario
if ($_POST) {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $cpt = (isset($_POST["cpt"]) ? $_POST["cpt"] : "");
    $descripcion = (isset($_POST["descripcion"]) ? $_POST["descripcion"] : "");
    $unidades = (isset($_POST["unidades"]) ? $_POST["unidades"] : "");
    $fecha = (isset($_POST["fecha"]) ? $_POST["fecha"] : "");
  
    //Consulta para actualizar los datos
    $sentencia = $con->prepare("UPDATE tipo_cpt 
                            SET cpt=:cpt, descripcion=:descripcion, unidades=:unidades, fecha=:fecha
                            WHERE id_cpt=:id_cpt");

    $sentencia->bindParam(":cpt", $cpt);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":unidades", $unidades);
    $sentencia->bindParam(":fecha", $fecha);
    $sentencia->bindParam(":id_cpt", $txtID);

    if ($sentencia->execute()) {
        echo "Actualización exitosa";
    } else {
        echo "Error al actualizar: " . $sentencia->errorInfo()[2];
    }

    echo '<script language="javascript"> ';
    echo 'Swal.fire({
        icon: "success",
        title: "DATOS MODIFICADOS",
        showConfirmButton: false,
        timer: 1500,
    }).then(function() {
        window.location = "index.php";
    });';
    echo '</script>';
}

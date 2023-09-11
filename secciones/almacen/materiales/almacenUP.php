<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if (isset($_GET['txtID'])) {

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $con->prepare("SELECT * FROM almacen WHERE id_almacen=:id_almacen");
    $sentencia->bindParam(":id_almacen", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $nombre = $registro["nombre"];
    $tipo_material = $registro["tipo_material"];
    $entrega = $registro["entrega"];
    $recibe = $registro["recibe"];
    $cantidad = $registro["cantidad"];
    $estado = $registro["estado"];
    $observaciones = $registro["observaciones"];
    $fecha_entrada = $registro["fecha_entrada"];

}

if ($_POST) {

    //Recolectamos los datos del metodo POST
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $fecha_entrada = isset($_POST["fecha_entrada"]) ? $_POST["fecha_entrada"] : "";
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $tipo_material = isset($_POST["tipo_material"]) ? $_POST["tipo_material"] : "";
    $entrega = isset($_POST["entrega"]) ? $_POST["entrega"] : "";
    $recibe = (isset($_POST["recibe"]) ? $_POST["recibe"] : "");
    $cantidad = (isset($_POST["cantidad"]) ? $_POST["cantidad"] : "");
    $observaciones = (isset($_POST["observaciones"]) ? $_POST["observaciones"] : "");
    $estado = (isset($_POST["estado"]) ? $_POST["estado"] : "");
    
        $sentencia = $con->prepare("UPDATE almacen  SET nombre=:nombre, fecha_entrada=:fecha_entrada, tipo_material=:tipo_material, entrega=:entrega, recibe=:recibe, cantidad=:cantidad, observaciones=:observaciones, estado=:estado
                WHERE id_almacen=:id_almacen");

$sentencia->bindParam(":nombre", $nombre);
$sentencia->bindParam(":fecha_entrada", $fecha_entrada);
$sentencia->bindParam(":tipo_material", $tipo_material);
$sentencia->bindParam(":entrega", $entrega);
$sentencia->bindParam(":recibe", $recibe);
$sentencia->bindParam(":cantidad", $cantidad);
$sentencia->bindParam(":observaciones", $observaciones);
$sentencia->bindParam(":estado", $estado);
$sentencia->bindParam(":id_almacen", $txtID);
$sentencia->execute();
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
          icon: "success",
          title: "DATOS GUARDADOS",
          text: "LOS DATOS SE GUARDARON CORRECTAMENTE",
          showConfirmButton: false,
          timer: 2000,
        }).then(function() {
          window.location = "index.php";
          });';
        echo '</script>';
    }

?>
<?php
include("../../../connection/conexion.php");
include("../../../templates/hea.php");
if ($_POST) {
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $tipo_material = isset($_POST["tipo_material"]) ? $_POST["tipo_material"] : "";
    $entrega = isset($_POST["entrega"]) ? $_POST["entrega"] : "";
    $recibe = (isset($_POST["recibe"]) ? $_POST["recibe"] : "");
    $cantidad = (isset($_POST["cantidad"]) ? $_POST["cantidad"] : "");
    $cantidad_adecuada = (isset($_POST["cantidad_adecuada"]) ? $_POST["cantidad_adecuada"] : "");
    $observaciones = (isset($_POST["observaciones"]) ? $_POST["observaciones"] : "");
    $estado = (isset($_POST["estado"]) ? $_POST["estado"] : "");


    $sentencia = $con->prepare("INSERT INTO almacen (id_almacen, nombre, tipo_material, entrega, recibe, cantidad, observaciones, estado,cantidad_adecuada) 
                            VALUES (Null, :nombre, :tipo_material, :entrega, :recibe, :cantidad, :observaciones, :estado,:cantidad_adecuada);");

    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":tipo_material", $tipo_material);
    $sentencia->bindParam(":entrega", $entrega);
    $sentencia->bindParam(":recibe", $recibe);
    $sentencia->bindParam(":cantidad", $cantidad);
    $sentencia->bindParam(":cantidad_adecuada", $cantidad_adecuada);
    $sentencia->bindParam(":observaciones", $observaciones);
    $sentencia->bindParam(":estado", $estado);
    $sentencia->execute();
    echo '<script language="javascript"> ';
        echo 'Swal.fire({
            icon: "success",
           title: "RECURSO AGREGADO",
           showConfirmButton: false,
           timer: 1500,
       }).then(function() {
   window.location = "index.php";
       });';
        echo '</script>';
}
?>
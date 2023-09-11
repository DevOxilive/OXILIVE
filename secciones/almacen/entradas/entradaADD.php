<?php
include("../../../connection/conexion.php");
include("../../../templates/hea.php");

if ($_POST) {
    $recibe_entrada = (isset($_POST["recibe_entrada"]) ? $_POST["recibe_entrada"] : "");
    $pide_entrada = (isset($_POST["pide_entrada"]) ? $_POST["pide_entrada"] : "");
    $cantidad_entrada = (isset($_POST["cantidad_entrada"]) ? $_POST["cantidad_entrada"] : "");
    $observacionesentra = (isset($_POST["observacionesentra"]) ? $_POST["observacionesentra"] : "");
    $tipo_mateentra = (isset($_POST["tipo_mateentra"]) ? $_POST["tipo_mateentra"] : "");
    $estado_entrada = (isset($_POST["estado_entrada"]) ? $_POST["estado_entrada"] : "");
    $buscar_material_devolver = isset($_POST["buscar_material_devolver"]) ? $_POST["buscar_material_devolver"] : "";
    $id_salida = (isset($_POST["id_salida"]) ? $_POST["id_salida"] : "");

    // CANTIDAD EN ALMACEN
    $consulta_cantidad_disponible = $con->prepare("SELECT cantidad FROM almacen");
    
    $consulta_cantidad_disponible->execute();
    $cantidad_disponible = $consulta_cantidad_disponible->fetchColumn();

        
        $sentencia = $con->prepare("INSERT INTO entrada_almacen   
        (recibe_entrada, pide_entrada, cantidad_entrada, tipo_mateentra, nombre_mateentra, observacionesentra, estado_entrada) 
        VALUES 
        (:recibe_entrada, :pide_entrada, :cantidad_entrada, :tipo_mateentra, :nombre_mateentra, :observacionesentra, :estado_entrada)");
        $sentencia->bindParam(":pide_entrada", $pide_entrada);
        $sentencia->bindParam(":recibe_entrada", $recibe_entrada);
        $sentencia->bindParam(":cantidad_entrada", $cantidad_entrada);
        $sentencia->bindParam(":nombre_mateentra", $buscar_material_devolver);
        $sentencia->bindParam(":observacionesentra", $observacionesentra);
        $sentencia->bindParam(":tipo_mateentra", $tipo_mateentra);
        $sentencia->bindParam(":estado_entrada", $estado_entrada);

        $nueva_cantidad = $cantidad_disponible + $cantidad_entrada;
        $actualizar_cantidad = $con->prepare("UPDATE almacen SET cantidad = :nueva_cantidad");
        $actualizar_cantidad->bindParam(":nueva_cantidad", $nueva_cantidad);
        
        // $sentencia->execute();

        if ($sentencia->execute() && $actualizar_cantidad->execute()) {
            echo '<script language="javascript"> ';
            echo 'Swal.fire({
                icon: "success",
                title: "SE DEVOLVIERON LOS RECURSOS",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
            });';
            echo '</script>';
        } else {

            $con->rollBack();
            echo '<script language="javascript"> ';
            echo 'Swal.fire({
                icon: "error",
                title: "ERROR AL DEVOLVER EL RECURSO",
                text: "Ha ocurrido un error al agregar el recurso. Por favor, inténtalo de nuevo.",
            });';
            echo '</script>';
        }
    }
?>
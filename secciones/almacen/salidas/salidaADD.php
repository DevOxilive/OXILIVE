<?php
include("../../../connection/conexion.php");
include("../../../templates/hea.php");

if ($_POST) {

    //ME TRAE LOS DATOS DEL FORMULARIO
    $entrega_salida = (isset($_POST["entrega_salida"]) ? $_POST["entrega_salida"] : "");
    $pide_salida = (isset($_POST["pide_salida"]) ? $_POST["pide_salida"] : "");
    $cantidad_salida = (isset($_POST["cantidad_salida"]) ? $_POST["cantidad_salida"] : "");
    $observaciones = (isset($_POST["observaciones"]) ? $_POST["observaciones"] : "");
    $tipo_material = (isset($_POST["tipo_material"]) ? $_POST["tipo_material"] : "");
    $estado = (isset($_POST["estado"]) ? $_POST["estado"] : "");
    $buscar_material = isset($_POST["buscar_material"]) ? $_POST["buscar_material"] : "";
    $id_almacen = (isset($_POST["id_almacen"]) ? $_POST["id_almacen"] : "");

    // CANTIDAD EN ALMACEN
    $consulta_cantidad_disponible = $con->prepare("SELECT cantidad FROM almacen WHERE id_almacen = :id_almacen");
    $consulta_cantidad_disponible->bindParam(":id_almacen", $id_almacen);
    $consulta_cantidad_disponible->execute();
    $cantidad_disponible = $consulta_cantidad_disponible->fetchColumn();

    // ESTO ES PARA VER SI LA CANTIDAD QUE HAY ES CORRECTA O TIENE SUFICIENTES
    if ($cantidad_salida <= 0) {
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
            icon: "error",
            title: "ERROR",
            text: "La cantidad de salida debe ser mayor que cero.",
        }).then(function() {
            window.location = "index.php";
        });';
        echo '</script>';

        //VALIDA QUE SEA MAYOR A LO QUE HAY EN ALMACEN
    } elseif ($cantidad_salida > $cantidad_disponible) {
        echo '<script language="javascript"> ';
        echo 'Swal.fire({
            icon: "error",
            title: "ERROR",
            text: "La cantidad de salida es mayor que la cantidad disponible en el almacen.",
        }).then(function() {
            window.location = "index.php";
        });';
        echo '</script>';
    } else {

        //SI NO HAY ERROR CONTINUA CON LA INSERCION DE LOS DATOS
        $sentencia = $con->prepare("INSERT INTO salida_almacen   
        (entrega_salida, pide_salida, cantidad_salida, tipo_matesali, nombre_matesali, observacionessali, estado_salida) 
        VALUES 
        (:entrega_salida, :pide_salida, :cantidad_salida, :tipo_matesali, :nombre_matesali, :observacionessali, :estado_salida)");
        $sentencia->bindParam(":pide_salida", $pide_salida);
        $sentencia->bindParam(":entrega_salida", $entrega_salida);
        $sentencia->bindParam(":cantidad_salida", $cantidad_salida);
        $sentencia->bindParam(":nombre_matesali", $buscar_material);
        $sentencia->bindParam(":observacionessali", $observaciones);
        $sentencia->bindParam(":tipo_matesali", $tipo_material);
        $sentencia->bindParam(":estado_salida", $estado);

        //ACTUALIZARA LA NUEVA CANTIDAD DE MATERIALES
        $nueva_cantidad = $cantidad_disponible - $cantidad_salida;
        $actualizar_cantidad = $con->prepare("UPDATE almacen SET cantidad = :nueva_cantidad WHERE id_almacen = :id_almacen");
        $actualizar_cantidad->bindParam(":nueva_cantidad", $nueva_cantidad);
        $actualizar_cantidad->bindParam(":id_almacen", $id_almacen);

        if ($sentencia->execute() && $actualizar_cantidad->execute()) {
            echo '<script language="javascript"> ';
            echo 'Swal.fire({
                icon: "success",
                title: "SALIDA EXITOSA",
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
                title: "ERROR AL DAR SALIDA",
                text: "Ha ocurrido un error al agregar el recurso. Por favor, inténtalo de nuevo.",
            }).then(function() {
                window.location = "index.php";
            });';
            echo '</script>';
        }
    }
}
?>
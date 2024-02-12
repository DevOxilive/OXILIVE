<?php
session_start();
include("../../connection/conexion.php");
$productID = $_POST['id'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

if (isset($_SESSION['us']) && isset($_SESSION['us']['id_usuarios'])) {
    // Obtén el ID del usuario de la sesión
    $idUsuario = $_SESSION['us']['id_usuarios'];

    // Verifica si hay suficiente cantidad disponible en la tabla de productos
    $consulta = "SELECT cantidad FROM productos WHERE id_productos = :productID";
    $stmt = $con->prepare($consulta);
    $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $cantidadDisponible = $fila['cantidad'];

        if ($cantidad <= $cantidadDisponible) {
            if (isset($_SESSION['carrito'][$productID])) {
                $_SESSION['carrito'][$productID]['cantidad'] += $cantidad;
            } else {
                $_SESSION['carrito'][$productID] = array(
                    'id' => $productID,
                    'nombre' => $nombre,
                    'precio' => $precio,
                    'cantidad' => $cantidad
                );
            }

            $insertCarrito = "INSERT INTO carrito (id_usuario, id_producto, cantidad, nombre_producto, precio_producto) VALUES (:idUsuario, :productID, :cantidad, :nombreProducto, :precioProducto)";
            $stmtInsert = $con->prepare($insertCarrito);
            $stmtInsert->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $stmtInsert->bindParam(':productID', $productID, PDO::PARAM_INT);
            $stmtInsert->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $stmtInsert->bindParam(':nombreProducto', $nombre, PDO::PARAM_STR);
            $stmtInsert->bindParam(':precioProducto', $precio, PDO::PARAM_STR);

            if ($stmtInsert->execute()) {
                // Actualizar la cantidad disponible en la tabla de productos
                $updateProductosQuery = "UPDATE productos SET cantidad = cantidad - :cantidad WHERE id_productos = :productID";
                $stmtUpdateProductos = $con->prepare($updateProductosQuery);
                $stmtUpdateProductos->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
                $stmtUpdateProductos->bindParam(":productID", $productID, PDO::PARAM_INT);
                $stmtUpdateProductos->execute();
                $numProductosCarrito = count($_SESSION['carrito']);
                echo "success";
            } else {
                echo "error";
            }
        } else {
            echo "error_disponibilidad";
        }
    } else {
        echo "error";
    }
} else {
    echo "error_session";
}
?>

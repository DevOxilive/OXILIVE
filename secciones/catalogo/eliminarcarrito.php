
<?php
session_start();

if (isset($_POST['key'])) {
    $productKey = $_POST['key'];
    
    if (isset($_SESSION['carrito'][$productKey])) {
        $productID = $_SESSION['carrito'][$productKey]['id']; // Obtén el ID del producto
        
        // Elimina el producto del carrito en la sesión
        unset($_SESSION['carrito'][$productKey]);
        
        // Aquí debes agregar la lógica para eliminar el producto del carrito en la base de datos
        include("../connection/conexion.php"); // Incluye tu archivo de conexión
        
        $deleteCarritoQuery = "DELETE FROM carrito WHERE id_usuario = :id_usuario AND id_producto = :id_producto";
        $stmtDeleteCarrito = $con->prepare($deleteCarritoQuery);
        $stmtDeleteCarrito->bindParam(":id_usuario", $_SESSION['us']['id_usuarios']);
        $stmtDeleteCarrito->bindParam(":id_producto", $productID);
        
        if ($stmtDeleteCarrito->execute()) {
            echo "success";
        } else {
            echo "error";
        }
    }
}
?>

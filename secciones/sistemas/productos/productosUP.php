<?php
include("../../../connection/conexion.php");

if (isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];

    $sentencia = $con->prepare("SELECT * FROM productos WHERE id_productos=:id_productos");
    $sentencia->bindParam(":id_productos", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);
    $nombre = $registro["nombre"];
    $descripcion = $registro["descripcion"];
    $precio = $registro["precio"];
    $cantidad = $registro["cantidad"];
    $disponible = $registro["disponible"];
    $imagen = $registro["imagen"];
}

if ($_POST) {
    $txtID = isset($_POST['txtID']) ? $_POST['txtID'] : "";
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";
    $precio = isset($_POST["precio"]) ? $_POST["precio"] : "";
    $cantidad = isset($_POST["cantidad"]) ? $_POST["cantidad"] : "";
    $disponible = isset($_POST["disponible"]) ? $_POST["disponible"] : "";
    $imagen = isset($_FILES["imagen"]["name"]) ? $_FILES["imagen"]["name"] : "";

    // Verificar si se proporciona una nueva imagen
    if (!empty($imagen)) {
        // Validar la extensión de la imagen
        $imagen_extension = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));
        $extensiones_permitidas = array("jpg", "jpeg", "png");

        if (in_array($imagen_extension, $extensiones_permitidas)) {
            // Mover la nueva imagen al directorio de productos
            $carpeta_productos = "./productos/";
            if (!is_dir($carpeta_productos)) {
                mkdir($carpeta_productos);
            }

            $tmp_imagen = $_FILES["imagen"]["tmp_name"];
            move_uploaded_file($tmp_imagen, $carpeta_productos . "/" . $imagen);

            // Eliminar la imagen anterior si existe
            if (!empty($registro["imagen"]) && file_exists($carpeta_productos . "/" . $registro["imagen"])) {
                unlink($carpeta_productos . "/" . $registro["imagen"]);
            }

            // Actualizar el nombre de la nueva imagen en la base de datos
            $sentencia_actualizar_img = $con->prepare("UPDATE productos SET imagen=:imagen WHERE id_productos=:id_productos");
            $sentencia_actualizar_img->bindParam(":imagen", $imagen);
            $sentencia_actualizar_img->bindParam(":id_productos", $txtID);
            $sentencia_actualizar_img->execute();
        } else {
            // Mostrar mensaje de error si la extensión de la imagen no es válida
            echo "Error: Solo se permiten archivos JPG, JPEG y PNG.";
        }
    }

    // Actualizar el resto de los campos del producto
    $sentencia_actualizar = $con->prepare("UPDATE productos SET nombre=:nombre, descripcion=:descripcion, precio=:precio, cantidad=:cantidad, disponible=:disponible WHERE id_productos=:id_productos");
    $sentencia_actualizar->bindParam(":nombre", $nombre);
    $sentencia_actualizar->bindParam(":descripcion", $descripcion);
    $sentencia_actualizar->bindParam(":precio", $precio);
    $sentencia_actualizar->bindParam(":cantidad", $cantidad);
    $sentencia_actualizar->bindParam(":disponible", $disponible);
    $sentencia_actualizar->bindParam(":id_productos", $txtID);
    $sentencia_actualizar->execute();

    header("Location:index.php");
    exit();
}
?>

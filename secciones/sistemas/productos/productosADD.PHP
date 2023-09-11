<?php
include("../../../connection/conexion.php");
include("../../../templates/hea.php");
if ($_POST) {
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";
    $precio = isset($_POST["precio"]) ? $_POST["precio"] : "";
    $precio = is_numeric($precio) ? (int) $precio : 0;
    $cantidad = isset($_POST["cantidad"]) ? $_POST["cantidad"] : "";
    $disponible = isset($_POST["disponible"]) ? $_POST["disponible"] : "";
    $imagen = isset($_FILES["imagen"]["name"]) ? $_FILES["imagen"]["name"] : "";

    $imagen_extension = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));
    $extensiones_permitidas = array("jpg", "jpeg", "png", "jfif");

    if (in_array($imagen_extension, $extensiones_permitidas)) {
        $sentencia = $con->prepare("INSERT INTO productos(id_productos, nombre, descripcion, precio, cantidad, disponible, imagen) 
        VALUES(null, :nombre, :descripcion, :precio, :cantidad, :disponible, :imagen)");

        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->bindParam(":precio", $precio);
        $sentencia->bindParam(":cantidad", $cantidad);
        $sentencia->bindParam(":disponible", $disponible);
        $sentencia->bindParam(":imagen", $imagen);

        $carpeta_productos = "./productos/";
        if (!is_dir($carpeta_productos)) {
            mkdir($carpeta_productos);
        }

        $imagen_foto = new DateTime();
        $nombre_foto_orginal = $imagen_foto->getTimestamp() . "_" . $_FILES["imagen"]["name"];
        $tmp_imagen = $_FILES["imagen"]["tmp_name"];
        move_uploaded_file($tmp_imagen, $carpeta_productos . "/" . $nombre_foto_orginal);

        $imagen = $nombre_foto_orginal;

        $sentencia->execute();

        echo '<script language="javascript"> ';
        echo 'Swal.fire({
            icon: "success",
           title: "PRODUCTO AGREGADO",
           showConfirmButton: false,
           timer: 1500,
       }).then(function() {
   window.location = "index.php";
       });';
        echo '</script>';
        exit();
    } else {
        echo "Error: Solo se permiten archivos JPG, JPEG y PNG.";
    }
}
?>
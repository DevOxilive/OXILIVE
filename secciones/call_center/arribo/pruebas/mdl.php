<link rel="stylesheet" href="probar.css">
<?php
include 'control.php';

// comprobar que se encuentre un archivo en el envio del formulario
if (($_FILES['archivo']['error']) !== 4) {
    //guardamos el nombre y el contenido del archivo y le damos la carpeta a donde debe ir a guarda
    $nombreArchivo = $_FILES['archivo']['name'];
    $archivo = $_FILES['archivo']['tmp_name'];
    $carpeta = 'documentos/';

    // Invoca a la función para guardar la imagen
    guardarImagen($con, $carpeta, $nombreArchivo, $archivo);
} else {
    echo "No se subieron imágenes";
}

// Llama a mostrarImagen fuera del else para que siempre se ejecute
mostrarImagen($con);
?>
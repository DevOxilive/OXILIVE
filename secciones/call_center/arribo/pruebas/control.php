<?php
include '../../../../connection/conexion.php';

function guardarImagen($con, $carpeta, $nombre, $archivo)
{

    $archivoDestino = $carpeta . basename($nombre);
    if (move_uploaded_file($archivo, $archivoDestino)) {
        $stat = $con->prepare("INSERT INTO imgpruebas (nombreImg) VALUES ('$nombre')");
        $stat->execute();
        echo "El documento se ha cargado correctamente.";
    } else {
        echo "Hubo un error al cargar el documento.";
    }
}

function mostrarImagen($con)
{
    echo '<br>imagenes del directorio<br>';
    $sql = "SELECT * FROM imgpruebas";
    $stat = $con->prepare($sql);
    $stat->execute();
    $result = $stat->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $filas) {
        if (!strstr($filas['nombreImg'], ".pdf")) {
            # code...
            echo '<img src="documentos/' . $filas['nombreImg'] . '" alt="" class="imgPruebas"></img><br>';
        }
    }
}

function mostrarPDF($con, $ruta, $nombreArchivo)
{
    $sql = "SELECT * FROM imgpruebas WHERE nombreImg = '$nombreArchivo'";
    $stat = $con->prepare($sql);
    $stat->execute();
    $result = $stat->fetchAll(PDO::FETCH_ASSOC);
    if (count($result) > 0) {
        foreach ($result as $filas) {
            echo '<iframe src="' . $ruta . $filas['nombreImg'] . '" width="650" height="680" frameborder="0"></iframe>';
        }
    } else {
        echo "no existe el nombre";
    }
    // Ruta al archivo PDF
    // $pdf_file = 'Proyecto.pdf';
    // frameborder="0"
    // // Verificamos si el archivo existe
    // if (file_exists($pdf_file)) {
    //     // Configuramos las cabeceras para indicar que es un archivo PDF
    //     header('Content-Type: application/pdf');
    //     header('Content-Disposition: inline; filename="' . basename($pdf_file) . '"');
    //     header('Content-Transfer-Encoding: binary');
    //     header('Content-Length: ' . filesize($pdf_file));
    //     header('Accept-Ranges: bytes');

    //     // Leemos y mostramos el contenido del archivo PDF
    //     readfile($pdf_file);
    // } else {
    //     // Si el archivo no existe, puedes mostrar un mensaje de error
    //     echo 'El archivo PDF no se encontró.';
    // }
}

<?php
include '../../../../connection/conexion.php';
session_start();
function guardarDocumento($con, $carpeta, $nombre, $archivo, $envio, $recibe, $persona)
{

    $archivoDestino = $carpeta . basename($nombre);
    if (move_uploaded_file($archivo, $archivoDestino)) {
        $stat = $con->prepare("INSERT INTO documentos (nombreArchi, id_envia, id_recibe, persona) VALUES ('$nombre', '$envio', '$recibe','$persona')");
        $stat->execute();
        echo '<script>console.log("rico");</script>';
        echo "El documento se ha cargado correctamente.";
    } else {
        echo "Hubo un error al cargar el documento.";
    }
}

function mostrarPDF($con, $ruta, $recibe)
{
    echo '<tr class="encabezadoT">
                    <td>id</td>
                    <td>nombre del documento</td>
                    <td>responsable</td>';
    $sql = "SELECT * FROM documentos where (id_envia ={$_SESSION['idus']} and id_recibe = $recibe) or (id_envia =$recibe and id_recibe = {$_SESSION['idus']})";
    $stat = $con->prepare($sql);
    $stat->execute();
    $result = $stat->fetchAll(PDO::FETCH_ASSOC);
    if (count($result) > 0) {
        if ($_SESSION['puesto'] == 5) {
            echo '</tr>';
        } else if ($_SESSION['puesto'] == 1) {
            echo '<td>eliminar</td>
            </tr>';
        }
        foreach ($result as $key => $filas) {

            echo '<tr>
                    <td>
                        ' . $filas['id'] . '
                    </td>
                    <td>
                        <a href="' . $ruta . $filas['nombreArchi'] . '" target="_BLANK" style ="text-decoration: none;">' . $filas['nombreArchi'] . '</a>
                    </td>
                    <td>' . $filas['persona'] . '</td>';
            if ($_SESSION['puesto'] == 5) {
                echo '</tr>';
            } else if ($_SESSION['puesto'] == 1) {
                echo '<td>
                        <button class="eliminar-documento" data-documento-id="' . $filas['id'] . '"><i class="bi bi-trash-fill"></i></button>
                      </td>
                    </tr>';
            }
        }
    } else {
        echo "no hay documentos en la carpeta de este chat";
    }
}
    // function mostrarImagen($con)
    // {
    //     echo '<br>imagenes del directorio<br>';
    //     $sql = "SELECT * FROM imgpruebas";
    //     $stat = $con->prepare($sql);
    //     $stat->execute();
    //     $result = $stat->fetchAll(PDO::FETCH_ASSOC);

    //     foreach ($result as $filas) {
    //         if (!strstr($filas['nombreImg'], ".pdf")) {
    //             # code...
    //             echo '<img src="documentos/' . $filas['nombreImg'] . '" alt="" class="imgPruebas"></img><br>';
    //         }
    //     }
    // }

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

<?php

try {
    //code...

    include '../../../connection/conexion.php';
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
        if(!isset($_SESSION['idus'])){
            throw new Exception("   ");
            
        }
        echo '<tr class="encabezadoT">
                    <th>id</th>
                    <th>nombre del documento</th>
                    <th>responsable</th>';
        $sql = "SELECT * FROM documentos where (id_envia ={$_SESSION['idus']} and id_recibe = $recibe) or (id_envia =$recibe and id_recibe = {$_SESSION['idus']})";
        $stat = $con->prepare($sql);
        $stat->execute();
        $result = $stat->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            if ($_SESSION['puesto'] == 5) {
                echo '</tr>';
            } else if ($_SESSION['puesto'] == 1) {
                echo '<th>eliminar</th>
            </tr>';
            }
            foreach ($result as $key => $filas) {

                echo '<tr>
                    <td>
                        ' . $filas['id'] . '
                    </td>
                    <td>
                        <a href="' . $ruta . $filas['nombreArchi'] . '" target="_BLANK" style ="text-decoration: none;"><i class="bi bi-file-earmark-richtext"></i>' . $filas['nombreArchi'] . '</a>
                    </td>
                    <td>' . $filas['persona'] . '</td>';
                if ($_SESSION['puesto'] == 5) {
                    echo '</tr>';
                } else if ($_SESSION['puesto'] == 1) {
                    echo '<td>
                        <button name="documento_id" value="' . $filas['id'] . '"><i class="bi bi-trash-fill"></i></button>
                      </td>
                    </tr>';
                    // <i class="bi bi-trash-fill"></i>
                }
            }
        } else {
            echo "no hay documentos en la carpeta de este chat";
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

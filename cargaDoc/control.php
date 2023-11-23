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
        if (!isset($_SESSION['idus'])) {
            throw new Exception("   ");

        }
        $sql = "SELECT * FROM documentos where (id_envia ={$_SESSION['idus']} and id_recibe = $recibe) or (id_envia =$recibe and id_recibe = {$_SESSION['idus']}) order by id DESC";
        $stat = $con->prepare($sql);
        $stat->execute();
        $result = $stat->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            $cont = 0;
            foreach ($result as $key => $filas) {
                $cont++;
                if ($_SESSION['puesto'] !== 1) {
                    echo '<div class="archivos">    
                    <div class="mensaje-previo">' . $cont . '. ' . $filas['persona'] . '</div>
                    <a href="' . $ruta . $filas['nombreArchi'] . '">
                        <i class="bi bi-file-earmark-richtext" style="font-size: 6em;"></i>
                        <div class="mensaje-previo">
                        ' . $filas['nombreArchi'] . '
                        </div></a>
                    </div>';
                } else if ($_SESSION['puesto'] == 1) {
                    echo '<div class="archivos">    
                    <div class="mensaje-previo">' . $cont . '. ' . $filas['persona'] . '</div>
                    <button type="submit" name="documento_id" value="' . $filas['id'] . '"><i class="bi bi-trash-fill"></i></button>    
                    <a href="' . $ruta . $filas['nombreArchi'] . '">
                        <i class="bi bi-file-earmark-richtext" style="font-size: 6em;"></i>
                        <div class="mensaje-previo">
                        ' . $filas['nombreArchi'] . '
                        </div></a>
                    </div>';
                }
            }
        } else {
            echo "<div style='color: white;'>no hay documentos en la carpeta de este chat</div>";
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

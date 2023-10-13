<?php
include '../../../../connection/conexion.php';
session_start();

if (isset($_POST['documento_id'])) {
    $documentoID = $_POST['documento_id'];

    $stst = $con->prepare("SELECT * FROM documentos WHERE id = $documentoID");
    $stst->execute();
    $result = $stst->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $fila) {
        $nombreArchi = $fila['nombreArchi'];
    }
    $archivoAEliminar = 'documentos/' . $nombreArchi;

    if (file_exists($archivoAEliminar)) {
        if (unlink($archivoAEliminar)) {
            echo "El archivo se ha eliminado exitosamente.";
        } else {
            echo "Hubo un error al intentar eliminar el archivo.";
        }
    } else {
        echo "El archivo no existe en la ubicación especificada.";
    }

    // Realiza la eliminación del documento en la base de datos y en el sistema de archivos
    // Aquí debes implementar el código para eliminar el documento según su ID

    // Después de eliminar el documento, puedes responder con "success" si se eliminó con éxito
    echo "success";
} else {
    // Responde con un mensaje de error si no se proporcionó un ID válido
    echo "error";
}

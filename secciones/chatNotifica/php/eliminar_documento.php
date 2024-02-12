<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include '../../../connection/conexion.php';
    include("../../../templates/header.php");
} else {
    // esto queda pediente para mostrar una mejor vista al usuario y no se confunca sobre esto...
    echo "Error en el sistema";
}

if (isset($_POST['documento_id'])) {
    $documentoID = $_POST['documento_id'];
    echo $documentoID;
    $stst = $con->prepare("SELECT * FROM documentos WHERE id = $documentoID");
    $stst->execute();
    $result = $stst->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $fila) {
        $nombreArchi = $fila['nombreArchi'];
    }
    $archivoAEliminar = 'documentos/' . $nombreArchi;

    if (file_exists($archivoAEliminar)) {
        if (unlink($archivoAEliminar)) {
            $stst = $con->prepare("DELETE FROM documentos WHERE id = $documentoID");
            $stst->execute();
        } else {
            echo "Hubo un error al intentar eliminar el archivo.";
        }
    } else {
        echo "El archivo no existe en la ubicación especificada.";
    }
    // Realiza la eliminación del documento en la base de datos y en el sistema de archivos
    // Aquí debes implementar el código para eliminar el documento según su ID
    echo '<script>window.history.back()</script>';
    // Después de eliminar el documento, puedes responder con "success" si se eliminó con éxito
} else {
    // Responde con un mensaje de error si no se proporcionó un ID válido
    echo "no se resivio id";
}

<?php    
    $data = json_decode(file_get_contents('php://input'), true);

    $nomFoto = $data['nomFoto'];

    if (file_exists($nomFoto)) {
        if (unlink($nomFoto)) {
            echo "Foto eliminada con éxito";
        } else {
            echo "No se pudo eliminar la foto";
        }
    } else {
        echo "La foto no existe";
    }
?>
<?php
    include("../../../../connection/conexion.php");
    session_start();
    $sentenciaUsu = $con->prepare('
        SELECT * FROM usuarios WHERE id_usuarios = :idus
    ');
    $idUs=$_SESSION['idus'];
    $sentenciaUsu->bindParam(':idus', $idUs);
    $sentenciaUsu->execute();
    $datosUsu = $sentenciaUsu->fetchAll(PDO::FETCH_ASSOC);
    $datosUsu = json_encode($datosUsu);
    echo $datosUsu;
?>
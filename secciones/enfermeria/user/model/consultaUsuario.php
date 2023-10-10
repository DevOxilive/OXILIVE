<?php
    include("../../../../connection/conexion.php");
    session_start();
    $sentenciaUsu = $con->prepare('
        SELECT Estado FROM usuarios WHERE id_usuarios = :idus
    ');
    $idUsu=$_SESSION['idus'];
    $sentenciaUsu->bindParam(':idus', $idUsu);
    $sentenciaUsu->execute();
    $datosUsu = $sentenciaUsu->fetchAll(PDO::FETCH_ASSOC);
    $datosUsu = json_encode($datosUsu);
    echo $datosUsu;
?>
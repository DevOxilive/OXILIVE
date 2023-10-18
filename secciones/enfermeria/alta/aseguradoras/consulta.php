<?php
    include("../../../../connection/conexion.php");
    $sentencia = $con->prepare("SELECT * FROM `aseguradoras`");
    $sentencia->execute();
    $lista_aseguradoras = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
    include("../../../connection/conexion.php");
    $sentencia = $con->prepare("SELECT * FROM `bancos_enfer`");
    $sentencia->execute();
    $lista_bancos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
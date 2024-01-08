<?php
    include("../../connection/conexion.php");
    $sentencia = $con->prepare("SELECT * FROM `bancos`");
    $sentencia->execute();
    $lista_bancos = $sentencia->fetchAll(PDO::FETCH_ASSOC);


    //Esta consulta es para traer los datos de la administradora
    $admi=$con->prepare("SELECT * FROM `administradora`");
    $admi->execute();
    $lista_administradora=$admi->fetchAll(PDO::FETCH_ASSOC);
?>
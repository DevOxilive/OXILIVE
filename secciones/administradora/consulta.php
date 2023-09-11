<?php
    include ("../../connection/conexion.php");
    $sentencia=$con->prepare("SELECT * FROM `administradora`");
    $sentencia->execute();
    $lista_administradora=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
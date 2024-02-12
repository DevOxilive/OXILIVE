<?php
    $sentencia=$con->prepare("SELECT * FROM `puestos`");
    $sentencia->execute();
    $lista_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
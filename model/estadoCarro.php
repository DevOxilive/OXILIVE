<?php
$sentencia=$con->prepare("SELECT * FROM `estado_carro`");
$sentencia->execute();
$lista_carro=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
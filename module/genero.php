<?php
$sentencia=$con->prepare("SELECT * FROM `genero`");
$sentencia->execute();
$lista_genero=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
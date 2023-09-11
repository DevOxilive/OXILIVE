<?php
$sentencia=$con->prepare("SELECT * FROM `aseguradoras`");
$sentencia->execute();
$lista_ase=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php

$sentencia=$con->prepare("SELECT * FROM `estado`");
$sentencia->execute();
$lista_estado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
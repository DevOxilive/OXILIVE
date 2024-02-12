<?php
$sentencia=$con->prepare("SELECT * FROM `estado_ruta`");
$sentencia->execute();
$lista_estado_entrega=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
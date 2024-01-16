<?php
$sentencia=$con->prepare("SELECT * FROM tipo_paciente");
$sentencia->execute();
$lista_tiposPac=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
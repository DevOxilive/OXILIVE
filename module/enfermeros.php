<?php
$sentencia=$con->prepare("SELECT * FROM usuarios WHERE id_departamentos = 6");
$sentencia->execute();
$lista_enfermeros=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
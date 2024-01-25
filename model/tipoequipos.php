<?php
$sentencia=$con->prepare("SELECT * FROM `tipo_equipo`");
$sentencia->execute();
$tipos_equipo=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
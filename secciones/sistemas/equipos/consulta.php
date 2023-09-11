<?php
$sentencia=$con->prepare("SELECT *,(SELECT Nombres FROM empleados WHERE empleados.id_empleados=equipo.recibio LIMIT 1) AS reci FROM equipo");
$sentencia->execute();
$equiposLis=$sentencia->fetchAll(PDO::FETCH_ASSOC);


$sen=$con->prepare("SELECT *,(SELECT Nombres FROM empleados WHERE empleados.id_empleados=equipo.entrego LIMIT 1) AS entre FROM equipo");
$sen->execute();
$entre=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
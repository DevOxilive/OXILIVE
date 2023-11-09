<?php

$consulta = 'SELECT idServicio, nombreServicio, descripcionServicio 
FROM tipos_servicios_callcenter';
$sentencia = $con->prepare($consulta);
$sentencia->execute();
$datos_servicios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

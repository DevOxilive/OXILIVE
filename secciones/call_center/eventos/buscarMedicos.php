<?php
include("../../../connection/conexion.php");

$consulta = 'SELECT * 
FROM usuarios
WHERE id_departamentos = 12';
$sentencia = $con->prepare($consulta);
$sentencia->execute();
$datos_medicos = $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>

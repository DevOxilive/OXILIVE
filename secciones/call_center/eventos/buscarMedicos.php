<?php
include("../../../connection/conexion.php");

$consulta = 'SELECT * 
FROM usuarios u, empleados e
WHERE e.departamento = 12
AND u.id_usuarios = e.usuarioSistema';
$sentencia = $con->prepare($consulta);
$sentencia->execute();
$datos_medicos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
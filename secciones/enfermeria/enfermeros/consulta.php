<?php
include_once("../../../connection/conexion.php");
$sentencia = $con->prepare('SELECT *,g.genero , p.Nombre_puestos FROM empleados , genero g ,  puestos p
WHERE departamento = 11 AND 
empleados.genero = g.id_genero
AND empleados.departamento = p.id_puestos');
$sentencia->execute();
$listadoEnfermeros = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

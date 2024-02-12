<?php
include_once("../../../connection/conexion.php");
$sentencia = $con->prepare('SELECT e.*, CONCAT(e.nombres," ",e.apellidos) AS nombreE, p.id_puestos,p.Nombre_puestos FROM empleados e, puestos p
WHERE e.departamento = p.id_puestos');
$sentencia->execute();
$listadoEmpleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);



?>
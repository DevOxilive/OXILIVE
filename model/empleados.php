<?php
$sentencia = $con->prepare("SELECT * , (SELECT Nombre_puestos FROM puestos WHERE puestos.id_puestos=empleados.Puesto LIMIT 1) as p FROM empleados");
$sentencia->execute();
$lista_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
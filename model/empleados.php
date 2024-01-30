<?php
$sentencia = $con->prepare(
    "SELECT e.*, p.Nombre_puestos 
    FROM empleados e, puestos p
    WHERE e.departamento = p.id_puestos"
);
$sentencia->execute();
$listadoEmpleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
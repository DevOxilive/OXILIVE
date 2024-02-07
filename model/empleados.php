<?php
$sentencia = $con->prepare(
    'SELECT e.*, CONCAT(e.nombres," ",e.apellidos) AS nombreE, p.id_puestos, p.Nombre_puestos 
    FROM empleados e
    JOIN puestos p ON e.departamento = p.id_puestos
    WHERE e.departamento <> 11;'
);
$sentencia->execute();
$listadoEmpleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
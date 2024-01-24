<?php
$empleadosSin = $con->prepare("SELECT * FROM empleados WHERE usuarioSistema IS NULL");
$empleadosSin->execute();
$empleados = $empleadosSin->fetchAll(PDO::FETCH_ASSOC);

$empleadosCon = $con->prepare(
    "SELECT *, es.Nombre_estado 'estadoName', p.Nombre_puestos 'depto'
FROM empleados e, puestos p, estado es, usuarios u 
WHERE e.usuarioSistema IS NOT NULL 
AND e.usuarioSistema = u.id_usuarios
AND u.estadoUsuarios = es.id_estado
AND u.departamento = p.id_puestos"
);
$empleadosCon->execute();
$usuarios = $empleadosCon->fetchAll(PDO::FETCH_ASSOC);

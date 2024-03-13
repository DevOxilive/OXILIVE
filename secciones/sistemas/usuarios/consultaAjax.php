<?php
include("../../connection/conexion.php");

// Obtener el total de empleados
$sentenciaUsuarios = $con->prepare("SELECT COUNT(*) as total FROM empleados");
$sentenciaUsuarios->execute();
$consultaUsuarios = $sentenciaUsuarios->fetch(PDO::FETCH_ASSOC);
$datosUsuarios = intval($consultaUsuarios['total']);

// Obtener los datos de áreas
$sentenciaAreas = $con->prepare("SELECT p.Nombre_puestos AS nomPuesto, 
COUNT(e.id_empleado) AS total 
FROM empleados e JOIN puestos p 
ON e.departamento = p.id_puestos
GROUP BY p.Nombre_puestos");
$sentenciaAreas->execute();
$consultaAreas = $sentenciaAreas->fetchAll(PDO::FETCH_ASSOC);

$datosAreas = array(
    'series' => array(),
    'labels' => array()
);

foreach ($consultaAreas as $area) {
    array_push($datosAreas['series'], intval($area['total']));
    array_push($datosAreas['labels'], $area['nomPuesto']);
}
// Aquí creo mi arreglo
$datos = array(
    'datosUsuarios' => $datosUsuarios,
    'datosAreas' => $datosAreas
);
// Devolver los datos en formato JSON
echo json_encode($datos);









?>

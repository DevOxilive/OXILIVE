<?php 

include ("../../../connection/conexion.php");
//Consulta prueba para los informes
$consulta = "

    SELECT trabajador.*, puestos.Nombre_puestos 
    FROM usuarios AS trabajador 
    JOIN estado AS est ON trabajador.Estado = est.id_estado
    JOIN puestos ON trabajador.id_departamentos = puestos.id_puestos
    WHERE Nombre_puestos = 'Enfermeria'
";

$sentencia = $con->prepare($consulta);
$sentencia->execute();
$trabajador = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
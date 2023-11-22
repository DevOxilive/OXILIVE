<?php 
//Consulta prueba para los informes
include("../../../connection/conexion.php");

$consulta = "
SELECT u.id_usuarios, COUNT(statusHorario) AS numero_de_Asistencias, 
CONCAT(Nombres, ' ', Apellidos) AS NombreCompleto, nombreServicio, sueldo, horarioEntrada, checkTime
FROM asignacion_horarios sis, usuarios u, tipos_servicios t, asistencias a
WHERE sis.id_usuario = u.id_usuarios
AND a.id_empleadoEnfermeria = u.id_usuarios
AND a.id_horario = sis.id_asignacionHorarios 
AND  statusHorario = 3
AND id_check = 1
GROUP BY u.id_usuarios, Nombres, Apellidos, nombreServicio, sueldo, horarioEntrada, checkTime
";

$sentencia = $con->prepare($consulta);
$sentencia->execute();
$trabajador = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
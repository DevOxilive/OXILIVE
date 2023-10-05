<?php 
//Consulta prueba para los informes
include("../../../connection/conexion.php");

$consulta = "

SELECT A.id_empleadoEnfermeria, COUNT(*) AS asistencia, CONCAT(S.Nombres, ' ', S.Apellidos) AS 'Nombre completo', T.nombreServicio AS 'Tipo de guardia',
H.fecha AS 'Dias laborados', SUM(T.sueldo) * COUNT(A.id_asistencias)  AS 'Sueldo Total'
FROM usuarios S
JOIN asistencias A ON S.id_usuarios = A.id_empleadoEnfermeria
JOIN asignacion_horarios H ON S.id_usuarios = H.id_usuario
JOIN puestos P ON S.id_departamentos = P.id_puestos
JOIN tipos_servicios T ON T.id_tipoServicio = H.id_tipoServicio
JOIN checkk C ON C.id_check = A.id_check
JOIN estado E ON S.Estado = E.id_estado
WHERE id_puestos = 6
AND E.id_estado = 1
GROUP BY A.id_empleadoEnfermeria, CONCAT(S.Nombres, ' ', S.Apellidos), T.nombreServicio, H.fecha, T.sueldo; 


";

$sentencia = $con->prepare($consulta);
$sentencia->execute();
$trabajador = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
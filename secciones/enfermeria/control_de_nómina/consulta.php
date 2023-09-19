<?php 
//Consulta prueba para los informes

$consulta = "

SELECT COUNT(A.id_check) AS asistencias, A.id_check, CONCAT(S.Nombres, ' ', S.Apellidos) AS 'Nombre completo', T.nombre_guardia AS 'Tipo de guardia',
H.fecha AS 'Dias laborados', SUM(T.sueldo * A.id_check) AS 'Sueldo Total'
FROM usuarios S
JOIN asistencias A ON S.id_usuarios = A.id_empleadoEnfermeria
JOIN asignacion_horarios H ON S.id_usuarios = H.id_usuario
JOIN puestos P ON S.id_departamentos = P.id_puestos
JOIN tipos_guardias T ON T.id_tiposGuardias = H.id_tiposGuardias
JOIN checkK C ON C.id_check = A.id_check
JOIN empleados M ON M.Puesto = P.id_puestos
JOIN estado E ON S.Estado = E.id_estado
WHERE id_puestos = 6
GROUP BY A.id_check, CONCAT(S.Nombres, ' ', S.Apellidos), T.nombre_guardia, H.fecha;


";

$sentencia = $con->prepare($consulta);
$sentencia->execute();
$trabajador = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php 


$consulta = "
SELECT 
    u.id_usuarios, 
    COUNT(sis.statusHorario) AS numero_de_Asistencias,
    CONCAT(u.Nombres, ' ', u.Apellidos) AS NombreCompleto,
    SUM(t.sueldo) AS sueldo_total,
    COUNT(CASE WHEN TIMEDIFF(a.checkTime, sis.horarioEntrada) > '00:15:00' THEN 1 END) AS retardos
FROM 
    asignacion_horarios sis
    INNER JOIN usuarios u ON sis.id_usuario = u.id_usuarios
    INNER JOIN tipos_servicios t ON sis.id_tipoServicio = t.id_tipoServicio
    LEFT JOIN asistencias a ON a.id_empleadoEnfermeria = u.id_usuarios AND a.id_horario = sis.id_asignacionHorarios AND a.id_check = 1
WHERE 
    sis.statusHorario = 3
    AND MONTH(sis.fecha) = MONTH(CURRENT_DATE)
    AND YEAR(sis.fecha) = YEAR(CURRENT_DATE)
GROUP BY 
    u.id_usuarios, u.Nombres, u.Apellidos;

";

$sentencia = $con->prepare($consulta);
$sentencia->execute();
$trabajador = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<?php 


$consulta = "
SELECT 
    u.id_usuarios, 
    SUM(t.sueldo) AS sueldo_total
FROM 
    asignacion_horarios sis
    INNER JOIN usuarios u ON sis.id_usuario = u.id_usuarios
    INNER JOIN tipos_servicios t ON sis.id_tipoServicio = t.id_tipoServicio
WHERE 
    sis.statusHorario = 3
GROUP BY 
    u.id_usuarios;
";

$sentencia = $con->prepare($consulta);
$sentencia->execute();
$sueldo = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
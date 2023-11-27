<?php 


$consulta = "
SELECT id_usuarios, COUNT(statusHorario) AS numero_de_Asistencias, 
CONCAT(Nombres, ' ', Apellidos) AS NombreCompleto
FROM asignacion_horarios sis, usuarios u, tipos_servicios t
WHERE sis.id_usuario = u.id_usuarios
AND sis.id_tipoServicio = t.id_tipoServicio 
AND  statusHorario = 3
GROUP BY id_usuarios, Nombres, Apellidos
";

$sentencia = $con->prepare($consulta);
$sentencia->execute();
$trabajador = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
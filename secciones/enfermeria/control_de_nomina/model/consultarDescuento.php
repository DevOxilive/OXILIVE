<?php 


$consulta = "
SELECT sueldo, u.id_usuarios
FROM usuarios u
JOIN asignacion_horarios a ON a.id_usuario = u.id_usuarios
JOIN tipos_servicios t ON t.id_tipoServicio = a.id_tipoServicio
WHERE a.statusHorario = 3
ORDER BY sueldo ASC;
";

$sentencia = $con->prepare($consulta);
$sentencia->execute();
$descuento = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
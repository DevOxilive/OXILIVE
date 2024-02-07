<?php 
$sentencia = $con->prepare("SELECT *,g.genero , p.Nombre_puestos FROM empleados , genero g ,  puestos p
WHERE departamento = 6 AND 
empleados.genero = g.id_genero
AND empleados.departamento = p.id_puestos");
$sentencia->execute();
$lista = $sentencia->fetchAll(PDO::FETCH_ASSOC);


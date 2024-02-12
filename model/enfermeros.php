<?php
$sentencia=$con->prepare("SELECT CONCAT(e.nombres, ' ', e.apellidos) AS nombres_completo , e.* 
FROM empleados e 
JOIN puestos p ON e.departamento = p.id_puestos
WHERE p.id_puestos = 11;");
$sentencia->execute();
$lista_enfermeros=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
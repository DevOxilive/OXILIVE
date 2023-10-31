<?php
include("../../../../connection/conexion.php");
$sentencia = $con->prepare("
SELECT u.Estado, u.id_usuarios, e.Nombre_estado 
FROM usuarios u, estado e
WHERE e.id_estado=u.Estado
AND u.id_departamentos = 11;
");
$sentencia->execute();
$status=$sentencia->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($status);
?>
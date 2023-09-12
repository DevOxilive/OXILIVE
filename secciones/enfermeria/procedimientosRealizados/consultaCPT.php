<?php 
include ("../../../connection/conexion.php");
$consulta = "
SELECT 
T.*, 
P.Nombres,
P.Apellidos,
P.No_nomina,
A.Nombre_administradora,
S.Nombre_aseguradora
FROM
administradora A,
aseguradoras S,
pacientes_oxigeno P,
tipo_cpt T
WHERE
A.id_administradora = P.Administradora
AND S.id_aseguradora = P.Aseguradora;
";

$sentencia = $con->prepare($consulta);
$sentencia->execute();
$cpt = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
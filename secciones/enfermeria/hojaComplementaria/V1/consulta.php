<?php 
include ("../../../connection/conexion.php");
$consulta = "SELECT *, bc.id_bancos,bc.Nombre_banco ,bc.admi, ad.Nombre_administradora
FROM pacientes_call_center pc , bancos bc , administradora ad WHERE 
pc.bancosAdmi = bc.id_bancos AND bc.admi = ad.id_administradora";
$sentencia = $con->prepare($consulta);
$sentencia->execute();
$pacientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
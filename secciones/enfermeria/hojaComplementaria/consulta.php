<?php 
include ("../../../connection/conexion.php");
$consulta = "
    SELECT pacientes.*, aseguradoras.Nombre_aseguradora
    FROM pacientes_oxigeno AS pacientes
    JOIN administradora AS admin ON pacientes.Administradora = admin.id_administradora
    JOIN aseguradoras ON pacientes.Aseguradora = aseguradoras.id_aseguradora
";
$sentencia = $con->prepare($consulta);
$sentencia->execute();
$pacientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
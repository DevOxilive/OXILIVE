<?php
include("../../../connection/conexion.php");
//Este es para traer la información de los pacientes
$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
$idPaciente = $con->prepare("SELECT p.id_procedi, p.icd, p.dx, p.pacienteYnomina, 
u.id_usuarios, CONCAT(u.Nombres, ' ', u.Apellidos) AS Medico,
po.id_pacientes, CONCAT(po.Nombres, ' ', po.Apellidos) AS Paciente,po.No_nomina,
po.Fecha_registro, po.Edad,po.municipio,po.colonia,po.rfc,
cp.id_cpt, cp.cpt , cp.descripcion, cp.unidad
FROM procedimientos p, usuarios u, 
pacientes_oxigeno po , cpts_administradora cp
WHERE p.medico = u.id_usuarios
AND p.pacienteYnomina = po.id_pacientes
AND p.cpt = cp.id_cpt AND p.pacienteYnomina = :paciente;");
$idPaciente->bindParam(":paciente",$txtID);
$idPaciente->execute();
$idLista = $idPaciente->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta es para traer solo los datos en tabla 
$sentencia = $con->prepare("SELECT p.id_procedi, p.icd, p.dx, p.fecha, p.pacienteYnomina, 
CONCAT(u.Nombres, ' ', u.Apellidos) AS Medico,
CONCAT(po.Nombres, ' ', po.Apellidos) AS Paciente,po.No_nomina,
cp.cpt , cp.descripcion, cp.unidad, ad.Nombre_administradora
FROM procedimientos p, usuarios u, 
pacientes_oxigeno po , cpts_administradora cp , administradora ad
WHERE p.medico = u.id_usuarios
AND p.pacienteYnomina = po.id_pacientes
AND p.cpt = cp.id_cpt AND cp.admi = ad.id_administradora");
$sentencia->execute();
$listaProce = $sentencia->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta es para acceder a los id de los procedimientos
$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
$im = $con->prepare("SELECT p.id_procedi, p.icd, p.dx, p.pacienteYnomina, 
u.id_usuarios, CONCAT(u.Nombres, ' ', u.Apellidos) AS Medico,
po.id_pacientes, CONCAT(po.Nombres, ' ', po.Apellidos) AS Paciente,po.No_nomina,
po.Fecha_registro, po.Edad,po.municipio,po.colonia,po.rfc,
cp.id_cpt, cp.cpt , cp.descripcion, cp.unidad
FROM procedimientos p, usuarios u, 
pacientes_oxigeno po , cpts_administradora cp
WHERE p.medico = u.id_usuarios
AND p.pacienteYnomina = po.id_pacientes
AND p.cpt = cp.id_cpt AND p.pacienteYnomina = :paciente;");
$im->bindParam(":paciente",$txtID);
$im->execute();
$imprime = $im->fetchAll(PDO::FETCH_ASSOC);

?>

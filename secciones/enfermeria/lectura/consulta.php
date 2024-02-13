<?php
include("../../../connection/conexion.php");
//Este es para traer la información de los pacientes
$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
$idPaciente = $con->prepare("SELECT p.id_procedi, p.icd, p.dx, p.pacienteYnomina, 
u.id_usuarios, u.usuario,
po.id_pacientes, CONCAT(po.Nombres, ' ', po.Apellidos) AS Paciente,po.No_nomina,
po.Fecha_registro, po.Edad,po.colonia,po.rfc,
codigo.id_codigo, codigo.codigo , codigo.descripcion, codigo.unidad
FROM procedimientos p, usuarios u, 
pacientes_call_center po , codigo_administradora codigo
WHERE p.medico = u.id_usuarios
AND p.pacienteYnomina = po.id_pacientes
AND p.codigo = codigo.id_codigo AND p.pacienteYnomina = :paciente;");
$idPaciente->bindParam(":paciente",$txtID);
$idPaciente->execute();
$idLista = $idPaciente->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta es para traer solo los datos en tabla 
$sentencia = $con->prepare("SELECT p.id_procedi, p.icd,
p.dx, p.fecha, p.pacienteYnomina,u.usuario,
CONCAT(po.Nombres, ' ', po.Apellidos) AS Paciente,po.No_nomina,
codigo.codigo , codigo.descripcion, codigo.unidad, ad.Nombre_administradora
FROM procedimientos p, usuarios u, 
pacientes_call_center po , codigo_administradora codigo , administradora ad
WHERE p.medico = u.id_usuarios
AND p.pacienteYnomina = po.id_pacientes
AND p.codigo = codigo.id_codigo AND codigo.admi = ad.id_administradora");
$sentencia->execute();
$listaProce = $sentencia->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta es para acceder a los id de los procedimientos
$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
$im = $con->prepare("SELECT p.id_procedi, p.icd, p.dx, p.pacienteYnomina, 
u.id_usuarios,u.usuario,
po.id_pacientes, CONCAT(po.Nombres, ' ', po.Apellidos) AS Paciente,po.No_nomina,
po.Fecha_registro, po.Edad,po.colonia,po.rfc,
cp.id_codigo, cp.codigo , cp.descripcion, cp.unidad
FROM procedimientos p, usuarios u, 
pacientes_call_center po , codigo_administradora cp
WHERE p.medico = u.id_usuarios
AND p.pacienteYnomina = po.id_pacientes
AND p.codigo = cp.id_codigo AND p.pacienteYnomina = :paciente;");
$im->bindParam(":paciente",$txtID);
$im->execute();
$imprime = $im->fetchAll(PDO::FETCH_ASSOC);

?>

<?php
include("../../../connection/conexion.php");
//Este es para traer la información de los pacientes
$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
$idPaciente = $con->prepare("SELECT p.id_procedi, p.icd, p.dx, p.fecha, p.pacienteYnomina, 
u.id_usuarios, CONCAT(u.Nombres, ' ', u.Apellidos) AS Medico,
po.id_pacientes, CONCAT(po.Nombres, ' ', po.Apellidos) AS Paciente,po.No_nomina,
cp.id_cpt, cp.cpt , cp.descripcion, cp.unidad
FROM procedimientos p, usuarios u, 
pacientes_oxigeno po , cpts_administradora cp
WHERE p.medico = u.id_usuarios
AND p.pacienteYnomina = po.id_pacientes
AND p.cpt = cp.id_cpt AND p.pacienteYnomina = :paciente;");
$idPaciente->bindParam(":paciente",$txtID);
$idPaciente->execute();
$idLista = $idPaciente->fetchAll(PDO::FETCH_ASSOC);
















//Procedimientos
$procedimientos = $con->prepare("SELECT * FROM procedimientos");
$procedimientos->execute();
$procedimientos = $procedimientos->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta es para traer solo los datos en tabla 
$sentencia = $con->prepare("SELECT p.id_procedi, p.icd, p.dx, p.fecha, p.pacienteYnomina, 
CONCAT(u.Nombres, ' ', u.Apellidos) AS Medico,
CONCAT(po.Nombres, ' ', po.Apellidos) AS Paciente,po.No_nomina,
cp.cpt , cp.descripcion, cp.unidad
FROM procedimientos p, usuarios u, 
pacientes_oxigeno po , cpts_administradora cp
WHERE p.medico = u.id_usuarios
AND p.pacienteYnomina = po.id_pacientes
AND p.cpt = cp.id_cpt");
$sentencia->execute();
$listaProce = $sentencia->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta seria para medico
$usuarios = $con->prepare("SELECT *, CONCAT (u.Nombres ,' ' ,u.Apellidos ) AS medico FROM usuarios u WHERE u.id_departamentos = 5");
$usuarios->execute();
$medico = $usuarios->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta seria para pacientes
$oxigeno = $con->prepare("SELECT id_pacientes, CONCAT(Nombres, ' ', Apellidos) AS paciente,No_nomina FROM pacientes_oxigeno ");
$oxigeno->execute();
$datosPacientes = $oxigeno->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta es para la administradora
$administradora = $con->prepare("SELECT Nombre_administradora, id_administradora FROM administradora;");
$administradora->execute();
$listaCPTS = $administradora->fetchAll(PDO::FETCH_ASSOC);




//Esta consulta es para acceder a los id de los procedimientos
$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
$im = $con->prepare("SELECT p.id_procedi,CONCAT(po.Nombres, ' ', po.Apellidos)AS Paciente,po.No_nomina,
CONCAT(u.Nombres, ' ', u.Apellidos) AS Medico ,
 p.icd, p.dx, p.fecha, p.pacienteYnomina 
FROM procedimientos p, usuarios u, 
pacientes_oxigeno po 
WHERE p.medico = u.id_usuarios
AND p.pacienteYnomina = po.id_pacientes 
AND p.pacienteYnomina = :paciente LIMIT 1;");
$im->bindParam(":paciente",$txtID);
$im->execute();
$imprime = $im->fetchAll(PDO::FETCH_ASSOC);

?>

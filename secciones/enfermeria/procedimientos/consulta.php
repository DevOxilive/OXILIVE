<?php
include("../../../connection/conexion.php");
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

//Procedimientos
$procedimientos = $con->prepare("SELECT * FROM procedimientos");
$procedimientos->execute();
$procedimientos = $procedimientos->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta seria para ENFERMERO
$usuarios = $con->prepare("SELECT *, CONCAT (u.Nombres ,' ' ,u.Apellidos ) AS medico FROM usuarios u WHERE u.id_departamentos = 11");
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

//Esta consulta es para traer los cpts
$cpts_admi = $con->prepare("SELECT * FROM cpts_administradora");
$cpts_admi->execute();
$cptLista = $cpts_admi->fetchAll(PDO::FETCH_ASSOC);



?>

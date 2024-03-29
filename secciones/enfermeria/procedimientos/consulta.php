<?php
include("../../../connection/conexion.php");
//Esta consulta es para traer solo los datos en tabla 
$sentencia = $con->prepare("SELECT p.id_procedi,c.cpt,p.icd,
p.dx, p.fecha, p.pacienteYnomina, 
u.usuario,CONCAT(po.Nombres, ' ', po.Apellidos) AS Paciente,
po.No_nomina,cg.codigo , cg.descripcion, cg.unidad
FROM procedimientos p, usuarios u, 
pacientes_call_center po , codigo_administradora cg , cpts c
WHERE p.medico = u.id_usuarios
AND p.pacienteYnomina = po.id_pacientes
AND p.codigo = cg.id_codigo AND p.cpt = c.id_cpt");
$sentencia->execute();
$listaProce = $sentencia->fetchAll(PDO::FETCH_ASSOC);

//Procedimientos
$procedimientos = $con->prepare("SELECT * FROM procedimientos");
$procedimientos->execute();
$procedimientos = $procedimientos->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta seria para ENFERMERO
$usuarios = $con->prepare("SELECT *, u.usuario FROM usuarios u WHERE u.id_usuarios = 11");
$usuarios->execute();
$medico = $usuarios->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta seria para pacientes
$oxigeno = $con->prepare("SELECT id_pacientes, CONCAT(Nombres, ' ', Apellidos) AS paciente,No_nomina FROM pacientes_call_center");
$oxigeno->execute();
$datosPacientes = $oxigeno->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta es para la administradora
$administradora = $con->prepare("SELECT Nombre_administradora, id_administradora FROM administradora;");
$administradora->execute();
$listaCodigo = $administradora->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta es para traer los codigo
$codigo_admi = $con->prepare("SELECT * FROM codigo_administradora");
$codigo_admi->execute();
$codigoLista = $codigo_admi->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta es para traer los cpts 
$cpt = $con->prepare("SELECT * FROM cpts");
$cpt->execute();
$cpt_list = $cpt->fetchAll(PDO::FETCH_ASSOC);

?>

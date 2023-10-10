<?php 
$sentencia = $con->prepare("SELECT id_usuarios,p.id_procedi  AS procedimiento,id_departamentos , p.icd, p.dx, medico, u.Nombres AS Medico, po.id_pacientes,CONCAT(po.Nombres, ' ', po.Apellidos) AS 'nomPaciente', po.No_nomina, s.cpt , s.id_cpt
FROM usuarios u, procedimientos p, pacientes_oxigeno po, cpts_administradora s
WHERE u.id_departamentos = 5
AND p.medico = u.id_usuarios
AND po.id_pacientes = p.pacienteYnomina
AND s.id_cpt = p.cpts;");
$sentencia->execute();
$procedimientos = $sentencia->fetchAll(PDO::FETCH_ASSOC);


// $sentencia = $con->prepare("SELECT id_cpt,cpt,descripcion,unidad,admi, Nombre_administradora, id_administradora
// FROM cpts_administradora, administradora  WHERE 
// admi=id_administradora ;");
$sentencia = $con->prepare("SELECT Nombre_administradora, id_administradora FROM administradora;");
$sentencia->execute();
$listaCPTS = $sentencia->fetchAll(PDO::FETCH_ASSOC);



?>

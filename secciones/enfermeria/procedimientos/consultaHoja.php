<?php
include ("../../../connection/conexion.php");
/*Esta consulta es para el registro de los procedifientos finales*/
$txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
/*$sentencia2 = $con->prepare("SELECT * FROM admi_enfer WHERE id_admi_enfer=:id_admi_enfer ");*/
$sentencia2 = $con->prepare("SELECT * , (SELECT Nombres FROM pacientes_oxigeno WHERE pacientes_oxigeno.id_pacientes=proce_enfer.pacientes LIMIT 1) as pc FROM proce_enfer WHERE id_proce=:id_proce");
$sentencia2->bindParam(":id_proce", $txtID);
$sentencia2->execute();
$cpts = $sentencia2->fetchAll(PDO::FETCH_ASSOC);

/*Esta consulta es para traer los datos del PCT DE LA TBLA*/
$sentencia4 = $con->prepare("SELECT * , (SELECT cpt_admi FROM admi_enfer WHERE admi_enfer.id_admi_enfer=cpts_enfer.admi_cpt  LIMIT 1) as r FROM cpts_enfer");
/*$consulta = "SELECT * FROM cpts_enfer"; */
$sentencia4->execute();
$res = $sentencia4->fetchAll(PDO::FETCH_ASSOC);


$conAdmiEnfer=$con->prepare("SELECT * FROM admi_enfer");
$conAdmiEnfer->execute();
$listaAdmi_enfer=$conAdmiEnfer->fetchAll(PDO::FETCH_ASSOC);

?>
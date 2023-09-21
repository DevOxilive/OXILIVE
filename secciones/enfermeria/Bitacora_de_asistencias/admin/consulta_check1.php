<?php
//Consulta prueba para los informes
include("../../../../connection/conexion.php");

$check1 = "
SELECT * FROM asistencias WHERE id_check = 1 AND id_empleadoEnfermeria=:iduser
ORDER BY fechaAsis DESC
LIMIT 1
";

$idUser = $_SESSION['idus'];
$sentencia = $con->prepare($check1);
$sentencia->bindParam(':iduser', $idUser);
$sentencia->execute();
$concheck1 = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

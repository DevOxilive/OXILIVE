

<?php
//Consulta prueba para los informes
include("../../../../connection/conexion.php");

$check2 = "
SELECT * FROM asistencias WHERE id_check = 5 AND id_empleadoEnfermeria=:iduser
ORDER BY fechaAsis DESC
LIMIT 1
";

$idUser = $_SESSION['idus'];
$sentencia = $con->prepare($check2);
$sentencia->bindParam(':iduser', $idUser);
$sentencia->execute();
$concheck2 = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

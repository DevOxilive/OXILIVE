<?php
include_once('../connection/conexion.php');
session_start();

$consultaStatus= $con->prepare("SELECT Estado FROM usuarios WHERE id_usuario = :iduser;");
$iduser = $_SESSION['idus'];
$consultaStatus->bindParam(':iduser', $iduser);
$consultaStatus->execute();
$newEstado = $consultaStatus->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['estado'] = $newEstado['Estado'];

session_write_close();
echo $_SESSION['estado'];
?>
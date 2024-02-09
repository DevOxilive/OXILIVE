<?php
include_once('../connection/conexion.php');
session_start();

$consultaStatus = $con->prepare("SELECT estadoUsuarios FROM usuarios WHERE id_usuarios = :iduser;");
$iduser = $_SESSION['idus'];
$consultaStatus->bindParam(':iduser', $iduser);
$consultaStatus->execute();
$newEstado = $consultaStatus->fetchAll(PDO::FETCH_ASSOC);

foreach($newEstado as $ne){
    $_SESSION['estado'] = $ne['Estado'];
}

session_write_close();
echo $_SESSION['estado'];
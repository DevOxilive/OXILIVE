<?php
include("../../../connection/conexion.php");
$id = $_POST['id'];
$sentDel = $con->prepare("DELETE FROM usuarios WHERE id_usuarios = :id ");
$sentUpp = $con->prepare("UPDATE empleados e SET e.usuarioSistema = NULL WHERE e.usuarioSistema = :id");

$sentDel->bindParam(":id", $id);
$sentUpp->bindParam(":id", $id);

$sentUpp->execute();
$sentDell->execute();

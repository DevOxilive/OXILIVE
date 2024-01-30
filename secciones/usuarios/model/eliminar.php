<?php
include("../../../connection/conexion.php");
$id = $_POST['id'];
$sentUpp = $con->prepare("UPDATE empleados e SET e.usuarioSistema = NULL WHERE e.usuarioSistema = :id");
$sentUpp->bindParam(":id", $id);
$sentUpp->execute();
$sentDel = $con->prepare("DELETE FROM usuarios WHERE id_usuarios = :id ");
$sentDel->bindParam(":id", $id);
$sentDel->execute();

<?php
session_start();
include 'connection/conexion.php';
$sentensia2 = $con->prepare("UPDATE usuarios SET estatus = '0' WHERE id_usuarios = '{$_SESSION['idus']}' ");
$sentensia2->execute();
session_destroy();
header('Location: login.php');

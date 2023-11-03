<?php 
include("../../../../connection/conexion.php");
$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM `codigo_administradora` WHERE id_codigo=$eliminar");


$delateList = $_POST['id'];
$sentencia = $con->query("DELETE FROM `codigo_administradora` WHERE admi='$delateList'");



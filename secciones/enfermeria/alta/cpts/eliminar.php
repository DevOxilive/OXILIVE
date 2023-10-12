<?php 
include("../../../../connection/conexion.php");
$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM `cpts_administradora` WHERE id_cpt=$eliminar");


$delateList = $_POST['id'];
$sentencia = $con->query("DELETE FROM `cpts_administradora` WHERE admi='$delateList'");



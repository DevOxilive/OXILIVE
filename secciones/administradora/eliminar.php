<?php 
include("../../connection/conexion.php");
// ELIMINA EL DATO DE LA BASE DE DATOS CORRESPONDIENTE AL ID AL QUE PERTENECE
$delate=$_POST['id'];
$consulta=$con->query("DELETE FROM administradora WHERE id_administradora=$delate");
?>
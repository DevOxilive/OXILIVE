<?php 
include("../../../connection/conexion.php");

$eliminar=$_POST['id'];
$sentencia=$con->query("DELETE FROM `procedimientos` WHERE id_procedi=$eliminar");

//Esta es para eliminar todo
$eliminar=$_POST['id'];
$delate=$con->prepare("SELECT id_procedi FROM procedimientos WHERE pacienteYnomina = :eliminar");
$delate->bindParam(':eliminar', $eliminar);
$delate->execute();
$lista_procedimientos = $delate->fetchAll(PDO::FETCH_ASSOC);
$senDel=$con->prepare("DELETE FROM procedimientos WHERE id_procedi=:proce");
foreach($lista_procedimientos as $proce){
    $senDel->bindParam(':proce',$proce['id_procedi']);
    $senDel->execute();
}

?>
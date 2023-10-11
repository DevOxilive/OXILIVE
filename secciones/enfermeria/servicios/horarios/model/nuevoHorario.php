<?php
include('../../../../../connection/conexion.php');

$nom = $_POST['nombres'];
$paci = $_POST['paciente'];
$serv = $_POST['servicio'];
$fechaServ = $_POST['fechaServicio'];
$horEntr = $_POST['horaEntrada'];
$horSal = $_POST['horaSalida'];

$sentenciaHorario = $con->prepare(
    'INSERT INTO asignacion_horarios 
    VALUES (NULL, :nom, :serv, :horEntr, :horSal, :fechaServ, :paci, 0);'
);

$sentenciaHorario->bindParam(':nom', $nom);
$sentenciaHorario->bindParam(':serv', $serv);
$sentenciaHorario->bindParam(':horEntr', $horEntr);
$sentenciaHorario->bindParam(':horSal', $horSal);
$sentenciaHorario->bindParam(':fechaServ', $fechaServ);
$sentenciaHorario->bindParam(':paci', $paci);
$sentenciaHorario->execute();
?>
<?php
include('../../../../../connection/conexion.php');

$nom = $_POST['nombres'];
$paci = $_POST['paciente'];
$serv = $_POST['servicio'];
$fechaServ = $_POST['fechaServicio'];
$horEntr = $_POST['horaEntrada'];
$horSal = $_POST['horaSalida'];
$id = $_POST['idHor'];

$sentenciaHorario = $con->prepare(
    "UPDATE asignacion_horarios
    SET
    id_usuario=:nom,
    id_tipoServicio=:serv,
    horarioEntrada=:horEntr,
    horarioSalida=:horSal,
    fecha=:fechaServ,
    id_pacienteEnfermeria=:paci
    WHERE id_asignacionHorarios=:id;
    "
);

$sentenciaHorario->bindParam(':nom', $nom);
$sentenciaHorario->bindParam(':serv', $serv);
$sentenciaHorario->bindParam(':horEntr', $horEntr);
$sentenciaHorario->bindParam(':horSal', $horSal);
$sentenciaHorario->bindParam(':fechaServ', $fechaServ);
$sentenciaHorario->bindParam(':paci', $paci);
$sentenciaHorario->bindParam(':id', $id);
$sentenciaHorario->execute();
?>
<?php
    include("../../../../connection/conexion.php");
    session_start();
    $datos = json_decode(file_get_contents("php://input"), true);
    $paciente = $datos['idPac'];
    $consultaPaciente=$con->prepare("
        SELECT * FROM pacientes_enfermeria WHERE id_pacienteEnfermeria = :pac;
    ");
    $consultaPaciente->bindParam(':pac', $paciente);
    $consultaPaciente->execute();
    $datosPaciente=$consultaPaciente->fetchAll(PDO::FETCH_ASSOC);
    $datosPaciente=json_encode($datosPaciente);
    echo $datosPaciente;
?>
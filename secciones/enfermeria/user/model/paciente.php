<?php
$idUs = $_SESSION['idus'];
$consultaPaciente = $con->prepare("
            SELECT DISTINCT p.nombres, p.apellidos, p.id_pacientes
            FROM pacientes_call_center p, asignacion_horarios a
            WHERE a.id_usuario = :idus
            AND a.id_pacienteEnfermeria = p.id_pacientes
        ");
$consultaPaciente->bindParam(':idus', $idUs);
$consultaPaciente->execute();
$datosPaciente = $consultaPaciente->fetchAll(PDO::FETCH_ASSOC);
?>
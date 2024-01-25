<?php
    $sentencia = $con->prepare("
    SELECT p.*, p.tipoPaciente as idTipoPac, t.tipoPaciente
    FROM pacientes_call_center p, tipo_paciente t
    WHERE p.tipoPaciente = t.id_tipoPaciente
    ORDER BY Fecha_registro DESC");
    $sentencia->execute();
    $pacientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
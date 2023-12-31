<?php
    $sentenciaServ = $con->prepare(
        "SELECT a.*, p.id_pacientes, CONCAT(p.nombres, ' ', p.apellidos) AS 'nomPaciente', t.nombreServicio AS 'nomGuardia'
        FROM usuarios u, pacientes_call_center p, asignacion_horarios a, tipos_servicios t
        WHERE u.id_usuarios = :idUser
        AND u.id_usuarios = a.id_usuario
        AND p.id_pacientes = a.id_pacienteEnfermeria
        AND t.id_tipoServicio = a.id_tipoServicio
        AND (a.statusHorario = 1 OR a.statusHorario = 2)
        ORDER BY a.fecha ASC
        LIMIT 1;"
    );
    $iduser=$_SESSION['idus'];
    $sentenciaServ->bindParam(':idUser', $iduser);
    $sentenciaServ->execute();
    $lista_servicios = $sentenciaServ->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
    $sentenciaServ = $con->prepare(
        "SELECT a.*, CONCAT(p.nombre, ' ', p.apellidos) AS 'nomPaciente', t.nombreServicio AS 'nomGuardia'
        FROM usuarios u, pacientes_enfermeria p, asignacion_horarios a, tipos_servicios t
        WHERE u.id_usuarios = :idUser
        AND u.id_usuarios = a.id_usuario
        AND p.id_pacienteEnfermeria = a.id_pacienteEnfermeria
        AND t.id_tiposGuardias = a.id_tiposGuardias
        ORDER BY a.fecha ASC
        LIMIT 1;"
    );
    $iduser=$_SESSION['idus'];
    $sentenciaServ->bindParam(':idUser', $iduser);
    $sentenciaServ->execute();
    $lista_servicios = $sentenciaServ->fetchAll(PDO::FETCH_ASSOC);
?>
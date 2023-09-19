<?php
    $sentenciaHora = $con->prepare(
        "SELECT a.*, CONCAT(p.nombre, ' ', p.apellidos) AS 'nomPaciente', t.nombre_guardia AS 'nomGuardia'
        FROM usuarios u, pacientes_enfermeria p, asignacion_horarios a, tipos_guardias t
        WHERE u.id_usuarios = :idUser
        AND u.id_usuarios = a.id_usuario
        AND p.id_pacienteEnfermeria = a.id_pacienteEnfermeria
        AND t.id_tiposGuardias = a.id_tiposGuardias
        ORDER BY a.fecha ASC
        LIMIT 3;"
    );
    $iduser=$_SESSION['idus'];
    $sentenciaHora->bindParam(':idUser', $iduser);
    $sentenciaHora->execute();
    $lista_horarios = $sentenciaHora->fetchAll(PDO::FETCH_ASSOC);
?>
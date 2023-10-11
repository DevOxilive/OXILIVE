<?php
    $sentenciaHora = $con->prepare(
        "SELECT a.*, CONCAT(p.Nombres, ' ', p.Apellidos) AS 'nomPaciente', t.nombreServicio AS 'nomGuardia'
        FROM usuarios u, pacientes_oxigeno p, asignacion_horarios a, tipos_servicios t
        WHERE u.id_usuarios = :idUser
        AND u.id_usuarios = a.id_usuario
        AND p.id_pacientes = a.id_pacienteEnfermeria
        AND t.id_tipoServicio = a.id_tipoServicio
        ORDER BY a.fecha ASC;"
    );
    $iduser=$_SESSION['idus'];
    $sentenciaHora->bindParam(':idUser', $iduser);
    $sentenciaHora->execute();
    $lista_horarios = $sentenciaHora->fetchAll(PDO::FETCH_ASSOC);
?>
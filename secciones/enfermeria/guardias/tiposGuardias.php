<?php
    $sentenciaGuardias = $con->prepare(
        'SELECT * FROM tipos_servicios;'
    );
    $sentenciaGuardias->execute();
    $lista_guardias = $sentenciaGuardias->fetchAll(PDO::FETCH_ASSOC);
?>
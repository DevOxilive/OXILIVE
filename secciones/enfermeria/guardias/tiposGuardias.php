<?php
    $sentenciaGuardias = $con->prepare(
        'SELECT * FROM tipos_guardias;'
    );
    $sentenciaGuardias->execute();
    $lista_guardias = $sentenciaGuardias->fetchAll(PDO::FETCH_ASSOC);
?>
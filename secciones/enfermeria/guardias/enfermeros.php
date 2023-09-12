<?php
    $sentenciaEnf = $con->prepare(
        'SELECT * FROM usuarios WHERE id_departamentos = 6;'
    );
    $sentenciaEnf->execute();
    $lista_enfermeros = $sentenciaEnf->fetchAll(PDO::FETCH_ASSOC);
?>
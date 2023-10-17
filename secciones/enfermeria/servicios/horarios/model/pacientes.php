<?php
    $sentenciaPac = $con->prepare(
        'SELECT * FROM pacientes_oxigeno;'
    );
    $sentenciaPac->execute();
    $lista_pacientes = $sentenciaPac->fetchAll(PDO::FETCH_ASSOC);
?>
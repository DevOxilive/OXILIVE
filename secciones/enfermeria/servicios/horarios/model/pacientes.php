<?php
    $sentenciaPac = $con->prepare(
        'SELECT * FROM pacientes_enfermeria;'
    );
    $sentenciaPac->execute();
    $lista_pacientes = $sentenciaPac->fetchAll(PDO::FETCH_ASSOC);
?>
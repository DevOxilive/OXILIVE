<?php 
$sentenciaTipos = $con->prepare('
    SELECT * FROM tipos_servicios;
');
$sentenciaTipos->execute();
$lista_tipos = $sentenciaTipos->fetchAll(PDO::FETCH_ASSOC);
?>
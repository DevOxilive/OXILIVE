<?php
   $sentencia=$con->prepare("SELECT * FROM tipos_servicios_callcenter");
   $sentencia->execute();
   $listacarros=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
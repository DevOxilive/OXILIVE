<?php
   $sentencia=$con->prepare("SELECT * FROM carros");
   $sentencia->execute();
   $listacarros=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
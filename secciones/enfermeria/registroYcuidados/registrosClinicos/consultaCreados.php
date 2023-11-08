<?php
 include("../../../../connection/conexion.php");
 $sentecia=$con->prepare("SELECT * FROM regisclinicos_cuidagenerales");
 $sentecia->execute();
 $lisClinica = $sentecia->fetchAll(PDO::FETCH_ASSOC);
?>
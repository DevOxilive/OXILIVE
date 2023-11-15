<?php
 include("../../../../connection/conexion.php");
 $sentecia=$con->prepare("SELECT * FROM registro_clinico");
 $sentecia->execute();
 $lisClinica = $sentecia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php 
include("../../../connection/conexion.php");
    $btnId = (isset($_GET['btnId'])) ? $_GET['btnId'] : "";
    $sentecia = $con->prepare("SELECT * FROM regisclinicos_cuidagenerales WHERE id_RC = :id_rc");
    $sentecia->bindParam(":id_rc",$btnId);
    $sentencia->execute();
    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

?>
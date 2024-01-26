<?php
include_once '../connection/conexion.php';
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["administradoraId"])) {
    $administradoraId = $_POST["administradoraId"];
        $consulta_aseguradoras = "SELECT id_aseguradora, Nombre_aseguradora FROM aseguradoras WHERE administradora = :administradoraId";
        $sentencia = $con->prepare($consulta_aseguradoras);
        $sentencia->bindParam(":administradoraId", $administradoraId, PDO::PARAM_INT);
        $sentencia->execute();
        $aseguradoras = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        
        header("Content-Type: application/json");
        echo json_encode($aseguradoras);
}
?>
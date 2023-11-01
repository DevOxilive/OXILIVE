<?php
include_once '../../../connection/conexion.php';
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["Nombre_admi"]) ) {
    $Nombre_admi = $_POST["Nombre_admi"];
        $consultacodigo = "SELECT * FROM codigo_administradora WHERE admi = :id_admi_enfer";
        $sencodigo = $con->prepare($consultacodigo);
        $sencodigo->bindParam(":id_admi_enfer", $Nombre_admi, PDO::PARAM_INT);
        $sencodigo->execute();
        $codigosob = $sencodigo->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($codigosob);
}
?>
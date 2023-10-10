<?php
include_once '../../../connection/conexion.php';
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["Nombre_admi"]) ) {
    $Nombre_admi = $_POST["Nombre_admi"];

        $consultaCPT = "SELECT * FROM cpts_administradora WHERE admi = :id_admi_enfer";
        $senCPT = $con->prepare($consultaCPT);
        $senCPT->bindParam(":id_admi_enfer", $Nombre_admi, PDO::PARAM_INT);
        $senCPT->execute();
        $cptsob = $senCPT->fetchAll(PDO::FETCH_ASSOC);
        
        header("Content-Type: application/json");
        echo json_encode($cptsob);
}
?>
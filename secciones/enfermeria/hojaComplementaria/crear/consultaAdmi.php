<?php 
    include("../../../../connection/conexion.php");
    if (isset($_GET['banco_id'])){
        $bancoId = $_GET['banco_id'];
        $sentencia=$con->prepare("SELECT ad.Nombre_administradora
        FROM bancos bc JOIN administradora ad ON bc.admi = ad.id_administradora
        WHERE bc.id_bancos = :banco_id");
        $sentencia->bindParam(":banco_id",$bancoId);
        $sentencia->execute();
        $consultaBanco = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        if($consultaBanco){
            header('Content-Type: application/json');
            echo json_encode($consultaBanco[0]);
        }else{
            header("HTTP/1.1 404 Not Found");
            echo json_encode(["error" => "Administradora no encontrada..:("]);
        }
    }else{
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["error" => "Falta el parámetro 'banco_id'"]);
    }
?>
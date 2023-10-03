<?php 
    include('../../../../../connection/conexion.php');

    $nomServ = $_POST['nomServ'];
    $horasServ = $_POST['horasServ'];
    $sueldo = $_POST['sueldo'];
    $id = $_POST['id'];
    
    $sentenciaTServicio = $con->prepare("
        UPDATE tipos_servicios
        SET nombreServicio=:nomServ,
            horasServicio=:horasServ,
            sueldo=:sueldo
        WHERE id_tipoServicio=:id;
        ");
    //Se convierten todos estos valores en mayusculas o minusculas (según sea el caso)
    //para que quede unificada en la base de datos
        
    $nomServ=strtoupper($nomServ);
    
    $sentenciaTServicio->bindParam(':nomServ', $nomServ);
    $sentenciaTServicio->bindParam(':horasServ', $horasServ);
    $sentenciaTServicio->bindParam(':sueldo', $sueldo);
    $sentenciaTServicio->bindParam(':id', $id);
    $sentenciaTServicio->execute();
?>
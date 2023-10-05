<?php 

if(empty($_GET['id']) || $_GET['id']==""){
    $sentenciaTipos = $con->prepare('
        SELECT * FROM tipos_servicios;
    ');
    $sentenciaTipos->execute();
    $lista_tipos = $sentenciaTipos->fetchAll(PDO::FETCH_ASSOC);
} else {
    $id = $_GET['id'];
    $sentenciaTipos = $con->prepare('
        SELECT * FROM tipos_servicios WHERE id_tipoServicio=:id;
    ');
    $sentenciaTipos->bindParam(':id',$id);
    $sentenciaTipos->execute();
    $lista_tipos = $sentenciaTipos->fetchAll(PDO::FETCH_ASSOC);
}

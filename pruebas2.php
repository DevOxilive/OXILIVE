<?php
include('connection/conexion.php');
$data = $con->prepare("SELECT * FROM notificaciones");
$data->execute();
$notifi = $data->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($notifi);

// mostrara el json
echo $json;

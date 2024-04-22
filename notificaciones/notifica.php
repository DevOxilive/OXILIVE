<?php
session_start();
include('control/notificacion.php');
include('../connection/conexion.php');
$sql = "SELECT * FROM notificaciones WHERE id_recibe = :idus AND estatus = 0";
$notifi = $con->prepare($sql);
$notifi->bindParam(':idus', $_SESSION['idus']);
$notifi->execute();
$cantNoti = $notifi->rowCount();

if ($cantNoti > 0) {
    $datos = $notifi->fetchAll(PDO::FETCH_ASSOC);
    foreach ($datos as $content) {

        $obj = new Notificacion($content['titulo'], $content['texto']);
        if ($content['tipo'] == 'sys' || $content['tipo'] == 'msg' && $content['estatus'] == 0) {
            $response = $obj->notificar() . '<br>';
            echo $response;
            $sql = "UPDATE notificaciones SET estatus = 1 WHERE id_notifi = :id";
            $notifi = $con->prepare($sql);
            $notifi->bindParam(':id', $content['id_notifi']);
            $notifi->execute();
        }
    }
}



// genera tu QUERY o INSERT para tu notificacion

$sql = "INSERT INTO notificaciones (titulo, texto, fecha_hora, tipo, id_recibe, estatus) 
        VALUES ('hola mundo', 'NOTIFICACION DE PRUEBA', NOW(), 'sys', 10, 0);";

/**
 * identificadores de notificaciones tipo:
 * 
 * chat
 * sys
 * others
 * 
 * evita un error CONSTRAINT
 */

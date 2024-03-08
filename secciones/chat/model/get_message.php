<?php
include('../control/Chat.php');
include('../../../connection/conexion.php');
$token =  $_POST['view'];
$getMessages = new Chat();
$data = $getMessages->getMessage($token, $con);
if (count($data) > 0) {
    foreach ($data as $key => $value) {
        if ($_SESSION['idus'] == $value['id_envia']) {
            echo "mensaje de:" . $value['persona'] . " texto: " . $value['msg'] . " estatus del mensaje: " . $value['estatus'] . " lectura del mensaje: " . $value['leido'] . " <br>";
        } else {
            if ($value['estatus'] == 0) {
                $notifi = new Chat();
                echo $notifi->notificacion($value['msg'], $value['persona'], $value['id_msg'], $con);
            }
            $sql = "UPDATE mensajes SET leido = 1 WHERE id_msg = {$value['id_msg']}";
            $update = $con->prepare($sql);
            $update->execute();
            echo "mensaje de:" . $value['persona'] . " texto: " . $value['msg'] . " estatus del mensaje: " . $value['estatus'] . " lectura del mensaje: " . $value['leido'] . " <br>";
        }
    }
} else {
    echo "NO HAY MENSAJES EN ESTA CHAT";
}

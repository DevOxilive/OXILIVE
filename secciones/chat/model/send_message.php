<?php
include('../../../connection/conexion.php');
include('../control/Chat.php');
$message = new Chat();
// enviar mensajes
if (isset($_FILES['doc']) && $_FILES['doc']['error'] === UPLOAD_ERR_OK) {
    $doc = $_FILES['doc'];
} else {
    $doc = null;
}
// testing of send message, return true or false. 
$message->sendMessage($con, $_POST['text'], $_POST['view'], $doc);

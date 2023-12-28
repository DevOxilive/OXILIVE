<?php

try {
    //code...

    session_start();

    include '../../../config/baseDatos.php';
    if (!isset($_SESSION['id'])) {
        throw new Exception(":D ");
    }

    // Consulta para obtener los mensajes
    $salida = $_POST['output'];
    $sentensia = $con->prepare("SELECT *, DATE_FORMAT(fecha_hora, '%H:%i') AS hora_minuto FROM mensajes WHERE id_salida = {$_SESSION['id']} AND id_entrada = {$salida} OR id_entrada = {$_SESSION['id']} AND id_salida = {$salida} ORDER BY id_msg ASC");
    $sentensia->execute();
    $resultado = $sentensia->fetchAll(PDO::FETCH_ASSOC);
    // comprueba que tenga filas la consulta si las tiene carga el chat
    if (count($resultado) > 0) {
        foreach ($resultado as $fila) {
            $mensaje = $fila['msg'];
            if ($fila['leido'] == '1') {
                $leido = '<i class="bi bi-check2-all"></i>';
            } else {
                $leido = '<i class="bi bi-check2"></i>';
            }
            if ($_SESSION['id'] === $fila['id_entrada']) {

                echo '<div class="burbuja-you">' . $mensaje . " " . $leido .  '.' . '</div>';
            } else {
                $sent = $con->prepare("UPDATE mensajes SET leido = '1' WHERE id_msg={$fila['id_msg']}");
                $sent->execute();
                echo '<div class="burbuja">' . $mensaje . ' .<br>' . $fila['hora_minuto'] . '</div>';
            }
        }
    } else {
        // si no envia el mensaje de comenzar chat
        echo '<center><div class="burbuja">Comenzar conversacion.<div><center>';
    }
} catch (Exception $e) {
    echo '<center><div class="burbuja">' . $e->getMessage() . '</div><center>';
}

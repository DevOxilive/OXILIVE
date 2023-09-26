<?php

try {
    //code...

    session_start();
    // Conexión a la base de datos (ajusta los valores según tu configuración)
    include '../../../../connection/conexion.php';
    if (!isset($_SESSION['idus'])) {
        throw new Exception(":D ");
    }
    // Consulta para obtener los mensajes
    $salida = $_POST['output'];
    $sentensia = $con->prepare("SELECT * FROM mensajes WHERE id_salida = {$_SESSION['idus']} AND id_entrada = {$salida} OR id_entrada = {$_SESSION['idus']} AND id_salida = {$salida} ORDER BY id_msg ASC");
    $sentensia->execute();
    $resultado = $sentensia->fetchAll(PDO::FETCH_ASSOC);
    // comprueba que tenga filas la consulta si las tiene carga el chat
    if (count($resultado) > 0) {
        foreach ($resultado as $fila) {

            if ($_SESSION['idus'] === $fila['id_entrada']) {
                echo '<div class="burbuja-you"><b>' . $fila['persona'] . ':</b> ' . $fila['msg'] . '<br></div>';
            } else {
                echo '<div class="burbuja"><b>' . $fila['persona'] . ':</b> ' . $fila['msg'] . '<br></div>';
            }
        }
    } else {
        // si no envia el mensaje de comenzar chat
        echo '<center><div class="burbuja">Comenzar conversacion.<div><center>';
    }
} catch (Exception $e) {
    echo '<center><div class="burbuja">' . $e->getMessage() . '<div><center>';
}

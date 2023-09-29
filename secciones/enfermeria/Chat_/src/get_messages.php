<?php
try {
    //code...

    // Conexión a la base de datos (ajusta los valores según tu configuración)
    include '../../../../connection/conexion.php';
    session_start();

      if(!isset($_SESSION['idus'])){
        throw new Exception(":D");
        
      } $idus = $_SESSION['idus'];
    // Consulta para obtener los mensajes
    $sentensia = $con->prepare("SELECT * FROM mensajes WHERE id_salida = 313241095 ORDER BY id_msg ASC");
    $sentensia->execute();
    $resultado = $sentensia->fetchAll(PDO::FETCH_ASSOC);

    // comprueba que tenga filas la consulta si las tiene carga el chat
    if (count($resultado) > 0) {
        foreach ($resultado as $fila) {
            if ($idus === $fila['id_entrada']) {
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
    echo '<center><div class="burbuja">'. $e->getMessage() .'<div><center>';
}

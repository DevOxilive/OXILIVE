<?php
try {
    //code...
    session_start();
    if (!isset($_SESSION['idus'])) {
        throw new Exception(":D ");
    }
    $idus = $_SESSION['idus'];

    include '../../../../connection/conexion.php';
    $sentencia = $con->prepare("SELECT * FROM usuarios WHERE id_usuarios != $idus AND (id_departamentos = 1 OR id_departamentos =6)");
    $sentencia->execute();
    $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);


    echo '<a href="src/chat.php" target="_blank" rel="noopener noreferrer">
            <li>
                <img src="img/grupo.png" alt="img perfil"><b>Chat general</b>
            </li>
      </a>';
    if (count($resultado) > 0) {
        foreach ($resultado as $fila) {
            $sql2 = "SELECT * FROM mensajes WHERE (id_salida = {$idus} AND id_entrada = {$fila['id_usuarios']}) OR (id_entrada = {$idus} AND id_salida = {$fila['id_usuarios']}) ORDER BY id_msg desc limit 1";
            $sent = $con->prepare($sql2);
            $sent->execute();
            $lasMessage = $sent->fetch(PDO::FETCH_ASSOC);

            $result = ($lasMessage) ? $lasMessage['msg'] : $result = "No hay mensajes disponibles";


            if ($fila['estatus'] == 1) {
                $conectado = 'en linea<img id="conexion" src="img/enLinea.png" alt="">';
            } else if ($fila['estatus'] == 0) {
                $conectado = 'desconectado<img id="conexion" src="img/sinLinea.png" alt="">';
            }

            echo '<a href="php/chat.php?chat=' . $fila['id_usuarios'] . '" target="_blank" rel="noopener noreferrer">
                <li>
                    <img src="img/usuario.png" alt="img perfil"><b>' . $fila['Usuario'] . '</b><span>: ' . $result . '<span><br> ' . $conectado . '
                </li>
              </a>';
        }
    } else {
        // si no envia el mensaje de comenzar chat
        echo '<li></b>Aún no hay personas registradas</b><li>';
    }
} catch (Exception $e) {
    echo $e->getMessage();   //throw $th;
}

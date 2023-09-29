<?php
try {
    //code...
    session_start();
    if (!isset($_SESSION['idus'])) {
        throw new Exception(":D ");
    }
    $userP = $_SESSION['us'];
    $idus = $_SESSION['idus'];

    include '../../../../connection/conexion.php';
    $sentencia = $con->prepare("SELECT id_usuarios, Usuario, token, estatus FROM usuarios WHERE id_usuarios != $idus AND (id_departamentos = 1 OR id_departamentos =6)");
    $sentencia->execute();
    $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);


    echo '<a href="src/chat.php" target="_blank" rel="noopener noreferrer">
            <li>
                <img src="img/grupo.png" alt="img perfil"><b>Chat general</b>
            </li>
      </a>';
    if (count($resultado) > 0) {
        foreach ($resultado as $fila) {
            $sql2 = "SELECT * FROM mensajes WHERE (id_salida = {$idus} AND id_entrada = {$fila['id_usuarios']}) OR (id_entrada = {$idus} AND id_salida = {$fila['id_usuarios']}) ORDER BY id_msg DESC limit 1";
            //  OR (id_entrada = {$idus} AND id_salida = {$fila['id_usuarios']}) por si algo falla aqui esta un posible solucion en la consulta....
            $sent = $con->prepare($sql2);
            $sent->execute();
            $lastMessage = $sent->fetch(PDO::FETCH_ASSOC);
            $result = ($lastMessage) ? $lastMessage['msg'] : $result = 'No hay mensajes disponibles <i class="bi bi-chat-left-text"></i>';
            $leido = ($lastMessage && $lastMessage['leido'] == '1') ? ' <i class="bi bi-check2-all" style="color:blue"></i>' : '<i class="bi bi-check2"></i>';
            $por = ($lastMessage && $lastMessage['persona'] == $userP) ? ' <b>tu:</b> ' : ':';
            if ($result === 'No hay mensajes disponibles <i class="bi bi-chat-left-text"></i>') {
                $estatusMensaje = '<span> ' . $result . '<span>';
            } else {
                $estatusMensaje = '<span> ' . $result . '<span>' . $leido;
            }

            if ($fila['estatus'] == 1) {
                $conectado = 'en linea<img id="conexion" src="img/enLinea.png" alt="">';
            } else if ($fila['estatus'] == 0) {
                $conectado = 'desconectado<img id="conexion" src="img/sinLinea.png" alt="">';
            }
            echo '<a href="php/chat.php?chat=' . $fila['token'] . '">
                <li>
                    <img src="img/usuario.png" alt="img perfil"><b>' . $fila['Usuario'] . '</b>' . $por . $estatusMensaje . '<br> ' . $conectado . '
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

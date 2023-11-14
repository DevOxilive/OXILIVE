<?php
try {
    //code...
    session_start();
    if (!isset($_SESSION['idus'])) {
        throw new Exception(":D ");
    }
    $userP = $_SESSION['us'];
    $idus = $_SESSION['idus'];

    include '../../../connection/conexion.php';
    $sentencia = $con->prepare("SELECT id_usuarios, Usuario, token, estatus, Foto_perfil FROM usuarios WHERE id_usuarios != $idus AND (id_departamentos = 1 OR id_departamentos =5 OR id_departamentos = 12) order by id_usuarios asc");
    $sentencia->execute();
    $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    if (count($resultado) > 0) {
        foreach ($resultado as $fila) {
            $sql2 = "SELECT * FROM mensajes WHERE (id_salida = {$idus} AND id_entrada = {$fila['id_usuarios']}) OR (id_entrada = {$idus} AND id_salida = {$fila['id_usuarios']}) ORDER BY id_msg DESC limit 1";

            //  OR (id_entrada = {$idus} AND id_salida = {$fila['id_usuarios']}) por si algo falla aqui esta un posible solucion en la consulta....
            $sent = $con->prepare($sql2);
            $sent->execute();
            $lastMessage = $sent->fetch(PDO::FETCH_ASSOC);
            $result = ($lastMessage) ? $lastMessage['msg'] : $result = 'No hay mensajes disponibles';
            $leido = ($lastMessage && $lastMessage['leido'] == '1') ? '<i class="bi bi-check2-all" style="color:blue"></i>' : '<i class="bi bi-check2"></i>';
            $por = ($lastMessage && $lastMessage['persona'] == $userP) ? ' <b>tú:</b> ' : '';
            if ($result === 'No hay mensajes disponibles') {
                $estatusMensaje = '<span> ' . $result . '<span>';
            } else {
                $estatusMensaje = $leido . '<span> ' . $result . '<span>';
            }

            if ($fila['estatus'] == 1) {
                $conectado = '<img id="conexion" src="img/enLinea.png" alt="">';
            } else if ($fila['estatus'] == 0) {
                $conectado = '<img id="conexion" src="img/sinLinea.png" alt="">';
            }
            if ($leido == '<i class="bi bi-check2"></i>' && $result != 'No hay mensajes disponibles' && $por != ' <b>tú:</b> ') {
                $clase = ' style="font-weight: bold;"';
            } else {
                $clase = '';
            }
            echo '<a href="php/chat.php?chat=' . $fila['token'] . '" ' . $clase . '><li>
                <img src="data:image/jpg/png;base64,' . base64_encode($fila['Foto_perfil']) . '" alt="img perfil"><b>' . $fila['Usuario'] . '</b> ' . $conectado . '<br><div class="mensaje-previo"> ' . $por . $estatusMensaje . '</div></li>
                </a>';
        }
    } else {
        // si no envia el mensaje de comenzar chat
        echo '<li></b>Aún no hay personas registradas</b><li>';
    }
} catch (Exception $e) {
    echo $e->getMessage();   //throw $th;
}

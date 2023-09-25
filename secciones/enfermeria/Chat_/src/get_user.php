<?php
include '../../../../connection/conexion.php';

session_start();
$sentencia = $con->prepare("SELECT
u.id_usuarios,
u.Usuario,
u.estatus,
IFNULL(m.Mensaje, 'sin mensajes') AS UltimoMensaje
FROM
usuarios u
LEFT JOIN (
SELECT
    id_salida,
    msg AS Mensaje
FROM
    mensajes
WHERE
    id_salida = {$_SESSION['idus']}
) m ON u.id_usuarios = m.id_salida
WHERE (u.id_departamentos = 1 OR u.id_departamentos = 6) AND u.id_usuarios <> {$_SESSION['idus']};");
$sentencia->execute();
$resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);


echo '<a href="src/chat.php" target="_blank" rel="noopener noreferrer">
            <li>
                <img src="img/grupo.png" alt="img perfil"><b>Chat general</b>
            </li>
      </a>';
if (count($resultado) > 0) {
    foreach ($resultado as $fila) {
        
        if ($fila['estatus'] == 1) {
            $conectado = 'en linea<img id="conexion" src="img/enLinea.png" alt="">';
        } else if ($fila['estatus'] == 0) {
            $conectado = 'desconectado<img id="conexion" src="img/sinLinea.png" alt="">';
        }

        echo '<a href="php/chat.php?chat=' . $fila['id_usuarios'] . '" target="_blank" rel="noopener noreferrer">
                <li>
                    <img src="img/usuario.png" alt="img perfil"><b>' . $fila['Usuario'] . '</b><span>: ' . $fila['UltimoMensaje'] . '<span><br> ' . $conectado . '
                </li>
              </a>';
    }
} else {
    // si no envia el mensaje de comenzar chat
    echo '<li></b>Aún no hay personas registradas</b><li>';
}

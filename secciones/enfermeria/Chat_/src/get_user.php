<?php
include '../../../../connection/conexion.php';

session_start();
$sentencia = $con->prepare("SELECT * FROM usuarios WHERE id_usuarios != {$_SESSION['idus']} AND (id_departamentos = 6 OR id_departamentos = 1) ORDER BY id_usuarios DESC");
$sentencia->execute();
$resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

echo '<a href="src/chat.php" target="_blank" rel="noopener noreferrer">
<li><b>Chat general</b></li>
</a>';
if (count($resultado) > 0) {
    foreach ($resultado as $fila) {
        echo '<a href="php/chat.php?chat=' . $fila['id_usuarios'] . '" target="_blank" rel="noopener noreferrer"><li><b>' . $fila['Usuario'] . '</b></li></a>';
    }
} else {
    // si no envia el mensaje de comenzar chat
    echo '<li></b>Aún no hay personas registradas</b><li>';
}

<?php
include '../../../../connection/conexion.php';

session_start();
<<<<<<< HEAD
$sentencia = $con->prepare("SELECT *  FROM usuarios WHERE id_usuarios != {$_SESSION['idus']} AND (id_departamentos = 6 OR id_departamentos = 1);");
=======
$sentencia = $con->prepare("SELECT * FROM usuarios WHERE id_usuarios != {$_SESSION['idus']} AND (id_departamentos = 6 OR id_departamentos = 1) ORDER BY id_usuarios DESC");
>>>>>>> 6d5dbd6d0de6675092181156e46e7ed9c17e6ff9
$sentencia->execute();
$resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

echo '<a href="src/chat.php" target="_blank" rel="noopener noreferrer">
<<<<<<< HEAD
            <li>
                <img src="img/grupo.png" alt="img perfil"><b>Chat general</b>
            </li>
      </a>';
if (count($resultado) > 0) {
    foreach ($resultado as $fila) {
        echo '<a href="php/chat.php?chat=' . $fila['id_usuarios'] . '" target="_blank" rel="noopener noreferrer">
                <li>
                    <img src="data:image/jpg/png;base64'. base64_encode($fila['Foto_perfil']) .'" alt="img perfil"><b>' . $fila['Usuario'] . '</b>
                </li>
              </a>';
=======
<li><b>Chat general</b></li>
</a>';
if (count($resultado) > 0) {
    foreach ($resultado as $fila) {
        echo '<a href="php/chat.php?chat=' . $fila['id_usuarios'] . '" target="_blank" rel="noopener noreferrer"><li><b>' . $fila['Usuario'] . '</b></li></a>';
>>>>>>> 6d5dbd6d0de6675092181156e46e7ed9c17e6ff9
    }
} else {
    // si no envia el mensaje de comenzar chat
    echo '<li></b>Aún no hay personas registradas</b><li>';
}
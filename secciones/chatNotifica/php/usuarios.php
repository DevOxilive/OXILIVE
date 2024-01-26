<?php
// este archivo busca un usuario en especifico para poder mandar mensajes
session_start();
$id_sesionActual = $_SESSION["idus"];
include('../../../connection/conexion.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['buscar'];

    //busqueda con OR agrupado y la condicion para evitar mostrar contenido
    $sql = "SELECT estatus, id_usuarios,Foto_perfil, Nombres, Apellidos, Usuario, token FROM usuarios 
    WHERE (CONCAT(Nombres, ' ', Apellidos, ' ') LIKE '%$usuario%' 
    OR CONCAT(Apellidos, ' ' ,Nombres, ' ') LIKE '%$usuario%' 
    OR (Nombres LIKE '%$usuario%'
    OR Apellidos LIKE '%$usuario%' 
    OR Usuario LIKE '%$usuario%'))
    AND id_usuarios <> $id_sesionActual;";

    $stmt = $con->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($resultado) > 0) {
        foreach ($resultado as $key => $value) {
            if ($value['estatus'] == 1) {
                $conectado = '<img id="conexion" src="img/enLinea.png" alt="">';
            } else if ($value['estatus'] == 0) {
                $conectado = '<img id="conexion" src="img/sinLinea.png" alt="">';
            }
            echo '<div class="opcion">
                    <a href="php/chat.php?chat=' . $value['token'] . '">
                        <div class="cuentas">
                            <div class="foto">
                                <img src="' . $value['Foto_perfil'] . '" alt="img perfil" id="fotoPerfil">
                            </div>
                            <div class="usuario">
                                <b>' . $value['Usuario'] . ': ' . $value['Nombres'] . ' ' . $value['Apellidos'] . '</b>
                                <span>' . $conectado . '</span>
                            </div>
                        </div>
                    </a>
                </div>';
        }
    } else {
        echo '<h1>No se encontraron resultados<br>:(</h1>';
    }
}

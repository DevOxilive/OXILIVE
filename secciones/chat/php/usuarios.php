<?php
// este archivo busca un usuario en especifico para poder mandar mensajes
session_start();
$id_sesionActual = $_SESSION["id"];
include('../../../config/baseDatos.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['buscar'];

    //busqueda con OR agrupado y la condicion para evitar mostrar contenido
    $sql = "SELECT id_usuarios, Nombres, Apellidos, Usuario, token FROM usuarios 
    WHERE (CONCAT(Nombres, ' ', Apellidos) LIKE '%$usuario%' 
    OR CONCAT(Apellidos, ' ' ,Nombres) LIKE '%$usuario%' 
    OR (Nombres LIKE '%$usuario%'
    OR Apellidos LIKE '%$usuario%' 
    OR Usuario LIKE '%$usuario%'))
    AND id_usuarios <> $id_sesionActual;";

    $stmt = $con->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultado as $key => $value) {
        echo '<a href="php/chat.php?id=' . $value['token'] . '">' . $value['Usuario'] . ': ' . $value['Nombres'] . ' ' . $value['Apellidos'] . '</a>';
    }
}

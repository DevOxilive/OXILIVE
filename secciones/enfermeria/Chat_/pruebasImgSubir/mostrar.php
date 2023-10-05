<?php
include '../../../../connection/conexion.php';

$sql = "SELECT * FROM usuarios WHERE id_usuarios = 10";
$consulta = $con->prepare($sql);
$consulta->execute();
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultado as $fila) {
    echo 'nombre : ' . $fila['Usuario']. '<img src="data:image/jpg/png;base64,'. base64_encode($fila['Foto_perfil']).'" alt="perfilUser" id="foto"><br>';
}
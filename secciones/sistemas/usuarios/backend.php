<?php
include("../../connection/conexion.php");
include("../../ctrlArchivos/control/Archivero.php");

$archivero = new Archivero();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doc[] = $_FILES['Foto_perfil']['name'];
    $doc[] = $_FILES['comprobante_domicilio']['name'];
    $doc[] = $_FILES['credencialFrente']['name'];
    $doc[] = $_FILES['credencialAtras']['name'];

    $Contenido[] = $_FILES['Foto_perfil']['tmp_name'];
    $Contenido[] = $_FILES['comprobante_domicilio']['tmp_name'];
    $Contenido[] = $_FILES['credencialFrente']['tmp_name'];
    $Contenido[] = $_FILES['credencialAtras']['tmp_name'];

    

    echo $archivero->crearCarpeta("OXILIVE/", "GISELLE");
    echo "<br>";
    for ($i = 0; $i < count($Contenido); $i++) {
        echo $archivero->guardarArchivo($doc[$i], $Contenido[$i], "OXILIVE/GISELLE") . "<br>";
    }


} else {
    echo "error en el sistema mi bro";
}

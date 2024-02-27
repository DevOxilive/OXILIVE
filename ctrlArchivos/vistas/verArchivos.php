<?php
// se incluye el archivero.
include("../control/Archivero.php");

// se instancia un objeto.
$objeto =  new Archivero();

// declarar las variables
$ruta = "../../../"; # A donde ira a guardar el archivo desde 
$nombreArchivo = $_FILES['nombredelPost']['name']; # Nombre de la carpeta
$archivoTmp = $_FILES['nombredelPost']['tmp_name']; # contenido del archivo temporal.

$objeto->eliminarArchivo($ruta . $nombreArchivo); # aqui va concatenada la ruta y el nombre

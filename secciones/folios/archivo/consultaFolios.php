<?php

use SebastianBergmann\Environment\Console;

include("../../../connection/conexion.php");
//Esta consulta es para el index
$sentencia=$con->prepare("SELECT 
fs.*, 
f.estatus
FROM 
folios fs
INNER JOIN 
folio_estatus f ON fs.estado = f.id_estatus 
WHERE 
fs.estado = 10
AND (fs.tipo = 'Receta' OR fs.tipo = 'Consulta')
AND fs.id_folio IN (
    SELECT MIN(id_folio)
    FROM folios
    WHERE estado = 10
    GROUP BY tipo
);");
$sentencia->execute();
$listaArchivoFolio=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//Consulta para traerme los bancos
$bancos = $con->prepare("SELECT DISTINCT(bancoFolio) FROM folios;"); 
$bancos->execute();
$listafolio=$bancos->fetchAll(PDO::FETCH_ASSOC);

//Consulta para el motivo de devolución
$sen=$con->prepare("SELECT fe.* FROM folio_estatus fe
WHERE fe.id_estatus IN (4, 10)");
$sen->execute();
$listMotivos=$sen->fetchAll(PDO::FETCH_ASSOC);

//Aquí va la consulta del ajax
$selectedBanco = $_POST['banco'];
$traerFolios = $con->prepare("SELECT * FROM folios 
WHERE estado != 4
AND bancoFolio = :banco");
$traerFolios->bindParam(':banco', $selectedBanco);
$traerFolios->execute();

$folios = $traerFolios->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($folios);


//Aquí pondre mi consulta para el filtro dinamico. jsjsj
$f= $con->prepare("SELECT bancoFolio, MIN(id_folio) AS id_folio
FROM folios
GROUP BY bancoFolio");
$f->execute();
$fls = $f->fetchAll(PDO::FETCH_ASSOC);

?>
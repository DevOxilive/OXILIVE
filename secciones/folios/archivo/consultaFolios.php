<?php 
include("../../../connection/conexion.php");
$sentencia=$con->prepare("SELECT MAX(f.id_folio) AS id_folio, MAX(f.folio) AS folio, MAX(f.tipo) AS tipo, MAX(f.adminFolio) AS adminFolio, f.bancoFolio,fe.estatus 
FROM folios f 
INNER JOIN folio_estatus fe ON f.estado = fe.id_estatus
GROUP BY f.bancoFolio, fe.estatus;");
$sentencia->execute();
$listaArchivoFolio=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//Aquí va la consulta del ajax
try{
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sen = $con->prepare("SELECT f.*, fe.estatus 
FROM folios f
JOIN folio_estatus fe ON f.estado = fe.id_estatus;");
$sen->execute();
$estatus = $sen->fetchAll(PDO::FETCH_ASSOC);
if(count($estatus) > 0){
    echo json_encode($estatus);
} else {
    echo "No se encontraron resultados";
}
}catch(PDOException $e){
    echo "Error de conexion: " . $e->getMessage();
}
?>
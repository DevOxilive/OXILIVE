<?php
  include ("../../../connection/conexion.php");
 
  if (isset($_POST['submit'])) {
    $countryName = $_POST['Buscar_pacientes'];
 
    $sql = 'SELECT po.*, a.nombre_aseguradora 
    FROM pacientes_oxigeno AS po
    JOIN aseguradoras AS a ON po.Aseguradora = a.id_aseguradora 
    WHERE CONCAT(Apellidos, " ", Nombres) = :nombre';
    $stmt = $con->prepare($sql);
    $stmt->execute(['nombre' => $countryName]);
    $row = $stmt->fetch();


  } else {
    exit();
  }
?>
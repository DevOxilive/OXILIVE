
<?php
session_start(); 
  include ("../../../connection/conexion.php");
  if (isset($_POST['query'])) {
    $us = $_SESSION['us'];
    $inpText = $_POST['query'];
    $sql = ' 
    SELECT pacientes.*, aseguradoras.Nombre_aseguradora
    FROM pacientes_oxigeno AS pacientes
    JOIN administradora AS admin ON pacientes.Administradora = admin.id_administradora
    JOIN aseguradoras ON pacientes.Aseguradora = aseguradoras.id_aseguradora
    WHERE admin.Nombre_administradora = :us AND (pacientes.Apellidos LIKE :search OR pacientes.Nombres LIKE :search)
    ';
    // SELECT * FROM pacientes_oxigeno WHERE Apellidos LIKE :search OR Nombres LIKE :search';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(":us", $us);
    $stmt->bindParam(":search", $searchValue); // Asegúrate de que :search coincida con el nombre en la consulta
    
    $searchValue = '%' . $inpText . '%'; // Define la variable para :search
    $stmt->execute(); // Ahora execute() no necesita argumentos
    
    $result = $stmt->fetchAll();
 
    if ($result) { 

      foreach ($result as $row) {

        echo '<a href="#" class="list-group-item list-group-item-action border-1" data-apellidos="' . $row["Apellidos"] . '" data-nombres="' . $row["Nombres"] . '" data-direccion="' . $row["municipio"] . '" data-alcaldia="' . $row["Alcaldia"] . '" data-telefono="' . $row["Telefono"] . '">' . $row["Apellidos"] . " " . $row["Nombres"] . '</a>';

    }
    
    } else { 
        echo 'Paciente no encontrado o no registrado';
    }
  }
?>
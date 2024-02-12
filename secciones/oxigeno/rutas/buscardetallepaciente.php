
<?php
  include ("../../../connection/conexion.php");
 
  if (isset($_POST['query'])) {
    $inpText = $_POST['query'];
    $sql = 'SELECT * FROM pacientes_oxigeno WHERE Apellidos LIKE :search OR Nombres LIKE :search';
    $stmt = $con->prepare($sql);
    $stmt->execute(['search' => '%' . $inpText . '%']);
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
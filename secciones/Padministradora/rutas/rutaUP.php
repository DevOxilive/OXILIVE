<?php
include("../../../connection/conexion.php");

if (isset($_GET['txtID'])) {
  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

  $sentencia = $con->prepare("SELECT * FROM ruta_diaria_oxigeno WHERE id_ruta=:id_ruta");
  $sentencia->bindParam(":id_ruta", $txtID);
  $sentencia->execute();
  $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

  // Traer los datos de la DB
  $Fechaagenda = $registro["Fecha_agenda"];
  $Paciente = $registro["Paciente"];
  $municipio = $registro["municipio"];
  $Telefono = $registro["Telefono"];
  $Alcaldia = $registro["Alcaldia"];
  $aseguradora = $registro["Aseguradora"];
  $Tanque = $registro["Tanque"];
  $Regulador = $registro["Regulador"];
  $Portatil = $registro["Portatil"];
  $Concentrador = $registro["Concentrador"];
  $Aspirador = $registro["Aspirador"];
  $Cpac = $registro["Cpac"];
  $Bipac = $registro["Bipac"];
  $Agua = $registro["Agua"];
  $Puntas_n = $registro["Puntas_n"];
  $Puntas_neon = $registro["Puntas_neon"];
  $Vaso_borb = $registro["Vaso_borb"];
  $Mascarilla = $registro["Mascarilla"];
  $Canula = $registro["Canula"];
  $Recoleccion_tanque = $registro["Recoleccion_tanque"];
  $Recoleccion_aspi = $registro["Recoleccion_aspi"];
  $Recoleccion_concentrador = $registro["Recoleccion_concentrador"];
  $Nota = $registro["Nota"];
  $cbestatus = $registro["estado"];
}

if ($_POST) {
  $fechaAgenda = isset($_POST["FechaEntrega"]) ? $_POST["FechaEntrega"] : "";
  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $tanque = isset($_POST["Tanque"]) ? $_POST["Tanque"] : "";
  $regulador = isset($_POST["Regulador"]) ? $_POST["Regulador"] : "";
  $portatil = isset($_POST["Portatil"]) ? $_POST["Portatil"] : "";
  $concentrador = isset($_POST["Concentrador"]) ? $_POST["Concentrador"] : "";
  $aspirador = isset($_POST["Aspirador"]) ? $_POST["Aspirador"] : "";
  $cpac = isset($_POST["Cpac"]) ? $_POST["Cpac"] : "";
  $bipac = isset($_POST["Bipac"]) ? $_POST["Bipac"] : "";
  $agua = isset($_POST["Agua"]) ? $_POST["Agua"] : "";
  $puntasn = isset($_POST["PuntasN"]) ? $_POST["PuntasN"] : "";
  $puntasneon = isset($_POST["PuntasNeon"]) ? $_POST["PuntasNeon"] : "";
  $vasoborb = isset($_POST["VasoBorb"]) ? $_POST["VasoBorb"] : "";
  $mascarilla = isset($_POST["Mascarilla"]) ? $_POST["Mascarilla"] : "";
  $canula = isset($_POST["Canula"]) ? $_POST["Canula"] : "";
  $rectanque = isset($_POST["RecTanque"]) ? $_POST["RecTanque"] : "";
  $recaspi = isset($_POST["RecAspi"]) ? $_POST["RecAspi"] : "";
  $recconcent = isset($_POST["RecConcent"]) ? $_POST["RecConcent"] : "";
  $nota = isset($_POST["Nota"]) ? $_POST["Nota"] : "";
  $cbestatus = isset($_POST["cbestatus"]) ? $_POST["cbestatus"] : "";
  $checkEstadoQuery = $con->prepare("SELECT id_estado FROM estado_ruta WHERE id_estado = :estado");
  $checkEstadoQuery->bindParam(":estado", $cbestatus);
  $checkEstadoQuery->execute();

    $sentencia = $con->prepare("UPDATE ruta_diaria_oxigeno 
      SET Fecha_agenda=:fecha_agenda, Carro=4, Chofer=6, Tanque=:tanque, Regulador=:regulador, Portatil=:portatil, Concentrador=:concentrador, Aspirador=:aspirador, Cpac=:cpac, Bipac=:bipac, Agua=:agua , Puntas_n=:PuntasN, Puntas_neon=:PuntasNeon, vaso_borb=:VasoBorb, Mascarilla=:mascarilla, Canula=:canula, Recoleccion_tanque=:RecTanque, Recoleccion_aspi=:RecAspi, Recoleccion_concentrador=:RecConcent, Nota=:nota, estado=:estado 
      WHERE id_ruta=:id_ruta");
    $sentencia->bindParam(":fecha_agenda",$fechaAgenda);
    $sentencia->bindParam(":tanque", $tanque);
    $sentencia->bindParam(":regulador", $regulador);
    $sentencia->bindParam(":portatil", $portatil);
    $sentencia->bindParam(":concentrador", $concentrador);
    $sentencia->bindParam(":aspirador", $aspirador);
    $sentencia->bindParam(":cpac", $cpac);
    $sentencia->bindParam(":bipac", $bipac);
    $sentencia->bindParam(":agua", $agua);
    $sentencia->bindParam(":PuntasN", $puntasn);
    $sentencia->bindParam(":PuntasNeon", $puntasneon);
    $sentencia->bindParam(":VasoBorb", $vasoborb);
    $sentencia->bindParam(":mascarilla", $mascarilla);
    $sentencia->bindParam(":canula", $canula);
    $sentencia->bindParam(":RecTanque", $rectanque);
    $sentencia->bindParam(":RecAspi", $recaspi);
    $sentencia->bindParam(":RecConcent", $recconcent);
    $sentencia->bindParam(":nota", $nota);
    $sentencia->bindParam(":estado", $cbestatus);
    $sentencia->bindParam(":id_ruta", $txtID);
    $sentencia->execute();
    header("Location: index.php");
      
  }
?>
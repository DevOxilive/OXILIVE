<?php
session_start();
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if ($_POST) {
    $fechaAgenda = isset($_POST["FechaEntrega"]) ? $_POST["FechaEntrega"] : "";
    $Buscar_pacientes = isset($_POST["Buscar_pacientes"]) ? $_POST["Buscar_pacientes"] : "";
    $direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : "";
    $Alcaldia = isset($_POST["Alcaldia"]) ? $_POST["Alcaldia"] : "";
    $Aseguradora = isset($_POST["Aseguradora"]) ? $_POST["Aseguradora"] : "";
    $telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : "";
    $cbcarro = isset($_POST["cbcarro"]) ? $_POST["cbcarro"] : "";
    $cbcarro = is_numeric($cbcarro) ? $cbcarro : 0;
    $cbchofer = isset($_POST["cbchofer"]) ? $_POST["cbchofer"] : "";
    $cbchofer = is_numeric($cbchofer) ? $cbchofer : 0;
    $tanque = isset($_POST["Tanque"]) ? $_POST["Tanque"] : "";
    $tanque = is_numeric($tanque) ? (int)$tanque : 0;
    $regulador = isset($_POST["Regulador"]) ? $_POST["Regulador"] : "";
    $portatil = isset($_POST["Portatil"]) ? $_POST["Portatil"] : "";
    $concentrador = isset($_POST["Concentrador"]) ? $_POST["Concentrador"] : "";
    $aspirador = isset($_POST["Aspirador"]) ? $_POST["Aspirador"] : "";
    $cpac = isset($_POST["Cpac"]) ? $_POST["Cpac"] : "";
    $bipac = isset($_POST["Bipac"]) ? $_POST["Bipac"] : "";
    $agua = isset($_POST["Agua"]) ? $_POST["Agua"] : "";
    $puntasn = isset($_POST["PuntasN"]) ? $_POST["PuntasN"] : "";
    if (is_numeric($puntasn)) {
        $puntasn = (int)$puntasn;
    } else {
        $puntasn = 0;
    }
    $puntasneon = isset($_POST["PuntasNeon"]) ? $_POST["PuntasNeon"] : "";
    $puntasneon = is_numeric($puntasneon) ? (int)$puntasneon : 0;
    $vasoborb = isset($_POST["VasoBorb"]) ? $_POST["VasoBorb"] : "";
    $vasoborb = is_numeric($vasoborb) ? (int)$vasoborb : 0;
    $mascarilla = isset($_POST["Mascarilla"]) ? $_POST["Mascarilla"] : "";
    $mascarilla = is_numeric($mascarilla) ? (int)$mascarilla : 0;
    $canula = isset($_POST["Canula"]) ? $_POST["Canula"] : "";
    $rectanque = isset($_POST["RecTanque"]) ? $_POST["RecTanque"] : "";
    $rectanque = is_numeric($rectanque) ? (int)$rectanque : 0;
    $recaspi = isset($_POST["RecAspi"]) ? $_POST["RecAspi"] : "";
    $recaspi = is_numeric($recaspi) ? (int)$recaspi : 0;
    $recconcent = isset($_POST["RecConcent"]) ? $_POST["RecConcent"] : "";
    $recconcent = is_numeric($recconcent) ? (int)$recconcent : 0;
    $nota = isset($_POST["Nota"]) ? $_POST["Nota"] : "";

    $editarChofer = $con->prepare("UPDATE choferes SET contador_seleccion = contador_seleccion + 1 WHERE id_choferes = :chofer");
    $editarChofer->bindParam(":chofer", $cbchofer);

    if ($editarChofer->execute()) {
        $contaSelec = $con->prepare("SELECT contador_seleccion FROM choferes WHERE id_choferes = :chofer");
        $contaSelec->bindParam(":chofer", $cbchofer);
        $contaSelec->execute();

        $contador = $contaSelec->fetchColumn();

        if ($contador >= 3) {
            $cambiarEstadoChofer = $con->prepare("UPDATE choferes SET estado = 4 WHERE id_choferes = :chofer");
            $cambiarEstadoChofer->bindParam(":chofer", $cbchofer);
            $cambiarEstadoChofer->execute();
        }
        $insertRutaQuery = $con->prepare("INSERT INTO ruta_diaria_oxigeno
            (Fecha_agenda, Paciente, Direccion, Alcaldia, Aseguradora, Telefono, Carro, Chofer,
            Tanque, Regulador, Portatil, Concentrador, Aspirador, Cpac, Bipac, Agua, Puntas_n, Puntas_neon,
            Vaso_borb, Mascarilla, Canula, Recoleccion_tanque, Recoleccion_aspi, Recoleccion_concentrador, Nota, estado)
            VALUES
            (:fecha_agenda, :paciente, :direccion, :alcaldia, :aseguradora, :telefono, :carro, :chofer,
            :tanque, :regulador, :portatil, :concentrador, :aspirador, :cpac, :bipac, :agua, :PuntasN, :PuntasNeon,
            :VasoBorb, :mascarilla, :canula, :RecTanque, :RecAspi, :RecConcent, :nota, 1)");

        $insertRutaQuery->bindParam(":fecha_agenda", $fechaAgenda);
        $insertRutaQuery->bindParam(":paciente", $Buscar_pacientes);
        $insertRutaQuery->bindParam(":direccion", $direccion);
        $insertRutaQuery->bindParam(":alcaldia", $Alcaldia);
        $insertRutaQuery->bindParam(":aseguradora", $Aseguradora);
        $insertRutaQuery->bindParam(":telefono", $telefono);
        $insertRutaQuery->bindParam(":carro", $cbcarro);
        $insertRutaQuery->bindParam(":chofer", $cbchofer);
        $insertRutaQuery->bindParam(":tanque", $tanque);
        $insertRutaQuery->bindParam(":regulador", $regulador);
        $insertRutaQuery->bindParam(":portatil", $portatil);
        $insertRutaQuery->bindParam(":concentrador", $concentrador);
        $insertRutaQuery->bindParam(":aspirador", $aspirador);
        $insertRutaQuery->bindParam(":cpac", $cpac);
        $insertRutaQuery->bindParam(":bipac", $bipac);
        $insertRutaQuery->bindParam(":agua", $agua);
        $insertRutaQuery->bindParam(":PuntasN", $puntasn);
        $insertRutaQuery->bindParam(":PuntasNeon", $puntasneon);
        $insertRutaQuery->bindParam(":VasoBorb", $vasoborb);
        $insertRutaQuery->bindParam(":mascarilla", $mascarilla);
        $insertRutaQuery->bindParam(":canula", $canula);
        $insertRutaQuery->bindParam(":RecTanque", $rectanque);
        $insertRutaQuery->bindParam(":RecAspi", $recaspi);
        $insertRutaQuery->bindParam(":RecConcent", $recconcent);
        $insertRutaQuery->bindParam(":nota", $nota);
        if ($insertRutaQuery->execute()) {
            $nombreUsuario = $_SESSION['us'];
            $mensaje = $nombreUsuario . ' Te asigno una nueva ruta';
            $conNoti = "INSERT INTO notificaciones (usuario_destino, mensaje, asunto) VALUES (9, :mensaje, 'NUEVA RUTA')";
            $senNoti = $con->prepare($conNoti);
            $senNoti->bindParam(":mensaje", $mensaje);
            $senNoti->execute();
            echo '<script language="javascript"> ';
            echo 'Swal.fire({
                icon: "success",
                title: "RUTA AGREGADA",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
            echo '</script>';
        }

        else {
            echo "Error al guardar la ruta.";
        }
    }
}

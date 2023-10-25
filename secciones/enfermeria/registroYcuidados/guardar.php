<?php

session_start();
include("../../../connection/conexion.php");

// Verifica si las variables de sesión están inicializadas
if (
    isset(
        $_SESSION["temperatura"],
        $_SESSION["pulso"],
        $_SESSION["respiracion"],
        $_SESSION["tensionArterial"],
        $_SESSION["spo2"],
        $_SESSION["glicemiaCapilar"],
        $_SESSION["vomito"],
        $_SESSION["evacuaciones"],
        $_SESSION["orina"],
        $_SESSION["ingestaLiquidos"],
        $_SESSION["caidas"],
        $_SESSION["drenajesVendajes"],
        $_SESSION["uppHh"],
        $_SESSION["descripcionUpp"],
        $_SESSION["solucion"],
        $_SESSION["fecha"],
        $_SESSION["cantidad"],
        $_SESSION["goteo"],
        $_SESSION["frecuencia"],
        $_SESSION["inicia"],
        $_SESSION["termina"],
        $_SESSION["drescripcionCuracion"],
        $_SESSION["notaenferdia"],
        $_SESSION["notaenfernoche"],
        $_SESSION["dasayunoH"],
        $_SESSION["descripDesayuno"],
        $_SESSION["comidaH"],
        $_SESSION["descripComida"],
        $_SESSION["cenaH"],
        $_SESSION["descripCena"]
    )
) {

    // Obtén las variables de sesión
    $temperatura = $_SESSION["temperatura"];
    $pulso = $_SESSION["pulso"];
    $respiracion = $_SESSION["respiracion"];
    $tensionArterial = $_SESSION["tensionArterial"];
    $spo2 = $_SESSION["spo2"];
    $glicemiaCapilar = $_SESSION["glicemiaCapilar"];
    $vomito = $_SESSION["vomito"];
    $evacuaciones = $_SESSION["evacuaciones"];
    $orina = $_SESSION["orina"];
    $ingestaLiquidos = $_SESSION["ingestaLiquidos"];
    $caidas = $_SESSION["caidas"];
    $drenajesVendajes = $_SESSION["drenajesVendajes"];
    $uppHh = $_SESSION["uppHh"];
    $descripcionUpp = $_SESSION["descripcionUpp"];
    $solucion = $_SESSION["solucion"];
    $fecha = $_SESSION["fecha"];
    $cantidad = $_SESSION["cantidad"];
    $goteo = $_SESSION["goteo"];
    $frecuencia = $_SESSION["frecuencia"];
    $inicia = $_SESSION["inicia"];
    $termina = $_SESSION["termina"];
    $drescripcionCuracion = $_SESSION["drescripcionCuracion"];
    $notaenferdia = $_SESSION["notaenferdia"];
    $notaenfernoche = $_SESSION["notaenfernoche"];
    $dasayunoH = $_SESSION["dasayunoH"];
    $descripDesayuno = $_SESSION["descripDesayuno"];
    $comidaH = $_SESSION["comidaH"];
    $descripComida = $_SESSION["descripComida"];
    $cenaH = $_SESSION["cenaH"];
    $descripCena = $_SESSION["descripCena"];
    $medicamentos = $_POST["medicamentos"];
    $horario = $_POST["horario"];



    // Prepara y ejecuta la consulta
    $consulta = $con->prepare("INSERT INTO regisclinicos_cuidagenerales 
    (Temperatura, Pulso, Respiracion, Tension_arterial, Spo2, Glicemia_capilar,
    Vomitos, Evacuaciones, Orina, Ingesta_liquidos, Caidas, Drenajes_vendajes,
    Upp_hh, Descripcion_upp, Solucion, Fecha_solucion, Cantidad_solucion,
    Got_solucion, Frec_solucion, Hora_inicio, Hora_termina, Cauracion,
    Nota_emfermeria_dia, Nota_emfermeria_noche, Alimentos_desayuno,
    Descripcion_desayuno, Alimentos_comida, Descripcion_comida,
    Alimentos_cena, Descripcion_cena, Medicamentos, Horario_Medi) 
        VALUES (:temperatura, :pulso, :respiracion, :tensionArterial, :spo2, :glicemiaCapilar,
        :vomito, :evacuaciones, :orina, :ingestaLiquidos, :caidas, :drenajesVendajes, :uppHh,
        :descripcionUpp, :solucion, :fecha, :cantidad, :goteo, :frecuencia, :inicia, :termina,
        :drescripcionCuracion, :notaenferdia, :notaenfernoche, :dasayunoH, :descripDesayuno,
        :comidaH, :descripComida, :cenaH, :descripCena, :medicamentos, :horario)");


    // Vincula los parámetros
    $consulta->bindParam(':temperatura', $temperatura);
    $consulta->bindParam(':pulso', $pulso);
    $consulta->bindParam(':respiracion', $respiracion);
    $consulta->bindParam(':tensionArterial', $tensionArterial);
    $consulta->bindParam(':spo2', $spo2);
    $consulta->bindParam(':glicemiaCapilar', $glicemiaCapilar);
    $consulta->bindParam(':vomito', $vomito);
    $consulta->bindParam(':evacuaciones', $evacuaciones);
    $consulta->bindParam(':orina', $orina);
    $consulta->bindParam(':ingestaLiquidos', $ingestaLiquidos);
    $consulta->bindParam(':caidas', $caidas);
    $consulta->bindParam(':drenajesVendajes', $drenajesVendajes);
    $consulta->bindParam(':uppHh', $uppHh);
    $consulta->bindParam(':descripcionUpp', $descripcionUpp);
    $consulta->bindParam(':solucion', $solucion);
    $consulta->bindParam(':fecha', $fecha);
    $consulta->bindParam(':cantidad', $cantidad);
    $consulta->bindParam(':goteo', $goteo);
    $consulta->bindParam(':frecuencia', $frecuencia);
    $consulta->bindParam(':inicia', $inicia);
    $consulta->bindParam(':termina', $termina);
    $consulta->bindParam(':drescripcionCuracion', $drescripcionCuracion);
    $consulta->bindParam(':notaenferdia', $notaenferdia);
    $consulta->bindParam(':notaenfernoche', $notaenfernoche);
    $consulta->bindParam(':dasayunoH', $dasayunoH);
    $consulta->bindParam(':descripDesayuno', $descripDesayuno);
    $consulta->bindParam(':comidaH', $comidaH);
    $consulta->bindParam(':descripComida', $descripComida);
    $consulta->bindParam(':cenaH', $cenaH);
    $consulta->bindParam(':descripCena', $descripCena);
    $consulta->bindParam(':medicamentos', $medicamentos);
    $consulta->bindParam(':horario', $horario);

    $consulta->execute();
    $id = $con->lastInsertId();


    //elimina las variables de la sesion para porder realizar otro registro
    unset($_SESSION["temperatura"]);
    unset($_SESSION["pulso"]);
    unset($_SESSION["respiracion"]);
    unset($_SESSION["tensionArterial"]);
    unset($_SESSION["spo2"]);
    unset($_SESSION["glicemiaCapilar"]);
    unset($_SESSION["vomito"]);
    unset($_SESSION["evacuaciones"]);
    unset($_SESSION["orina"]);
    unset($_SESSION["ingestaLiquidos"]);
    unset($_SESSION["caidas"]);
    unset($_SESSION["drenajesVendajes"]);
    unset($_SESSION["uppHh"]);
    unset($_SESSION["descripcionUpp"]);
    unset($_SESSION["solucion"]);
    unset($_SESSION["fecha"]);
    unset($_SESSION["cantidad"]);
    unset($_SESSION["goteo"]);
    unset($_SESSION["frecuencia"]);
    unset($_SESSION["inicia"]);
    unset($_SESSION["termina"]);
    unset($_SESSION["drescripcionCuracion"]);
    unset($_SESSION["notaenferdia"]);
    unset($_SESSION["notaenfernoche"]);
    unset($_SESSION["dasayunoH"]);
    unset($_SESSION["descripDesayuno"]);
    unset($_SESSION["comidaH"]);
    unset($_SESSION["descripComida"]);
    unset($_SESSION["cenaH"]);
    unset($_SESSION["descripCena"]);

    $_SESSION['datos_guardados'] = true;
    header('Location: ../registroYcuidados/index.php?id='. $id);
   
    exit();
} else {
    echo "error en el envio de post";
}
echo '<script>window.location.href = "../registroYcuidados/index.php";</script>';
?>
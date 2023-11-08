<?php

session_start();
include("../../../connection/conexion.php");
$data = json_decode(file_get_contents('php://input'), true);
    $_SESSION['medicamento_1'] = $data['medicamento_1'];
    $_SESSION['horario_1'] = $data['horario_1'];
    $_SESSION['medicamento_2'] = $data['medicamento_2'];
    $_SESSION['horario_2'] = $data['horario_2'];
    $_SESSION['medicamento_3'] = (isset($data['medicamento_3']) != '' ? $data['medicamento_3'] : NULL);
    $_SESSION['horario_3'] = (isset($data['horario_3']) != '' ? $data['horario_3'] : NULL);
    $_SESSION['medicamento_4'] = (isset($data['medicamento_4']) != '' ? $data['medicamento_4'] : NULL);
    $_SESSION['horario_4'] = (isset($data['horario_4']) != '' ? $data['horario_4'] : NULL);
    $_SESSION['medicamento_5'] = (isset($data['medicamento_5']) != '' ? $data['medicamento_5'] : NULL);
    $_SESSION['horario_5'] = (isset($data['horario_5']) != '' ? $data['horario_5'] : NULL);  
// Verifica si las variables de sesión están inicializadas
    // Obtén las variables de sesión
    $numeroAsignacion = $_SESSION['numeroAsignacion'];
    $peso = $_SESSION['peso'];
    $diagnosticoMedico = $_SESSION['diagnosticoMedico'];
    $temperatura = $_SESSION['temperatura'];
    $pulso = $_SESSION['pulso'];
    $respiracion = $_SESSION['respiracion'];
    $tensionArterial = $_SESSION['tensionArterial']; 
    $spo2 = $_SESSION['spo2'];
    $glicemiaCapilar = $_SESSION['glicemiaCapilar'];
    $vomito = $_SESSION['vomito'];
    $evacuaciones = $_SESSION['evacuaciones'];
    $orina = $_SESSION['orina'];
    $ingestaLiquidos = $_SESSION['ingestaLiquidos'];
    $caidas = $_SESSION['caidas'];
    $drenajesVendajes = $_SESSION['drenajesVendajes'];
    $uppHh = $_SESSION['uppHh'];
    $descripcionUpp = $_SESSION['descripcionUpp'];
    $solucion = $_SESSION['solucion']; 
    $fecha = $_SESSION['fecha'] != '0000-00-00' ? $_SESSION['fecha'] : NULL;
    $cantidad = $_SESSION['cantidad']; 
    $goteo = $_SESSION['goteo']; 
    $frecuencia = $_SESSION['frecuencia']; 
    $inicia = $_SESSION['inicia']; 
    $termina = $_SESSION['termina'];
    $drescripcionCuracion = $_SESSION['drescripcionCuracion']; 
    $notaEnfermeria = $_SESSION['notaEnfermeria']; 
    $descripComidas = $_SESSION['descripComidas']; 
    $horarioComidas = $_SESSION['horarioComidas'];
    $medicamento_1 = $_SESSION['medicamento_1'];
    $horario_1 = $_SESSION['horario_1'];
    $medicamento_2 = $_SESSION['medicamento_2'];
    $horario_2 = $_SESSION['horario_2'];  
    $medicamento_3 = $_SESSION['medicamento_3'];
    $horario_3 = $_SESSION['horario_3'];
    $medicamento_4 = $_SESSION['medicamento_4'];
    $horario_4 = $_SESSION['horario_4'];
    $medicamento_5 = $_SESSION['medicamento_5'];
    $horario_5 = $_SESSION['horario_5'];


    if($diagnosticoMedico != NULL){
        $diagnosticoMedico = strtoupper($diagnosticoMedico);
    }
    if($descripcionUpp != NULL){
        $descripcionUpp = strtoupper($descripcionUpp);
    }
    if($solucion != NULL){
        $solucion = strtoupper($solucion);
    }
    if($drescripcionCuracion != NULL){
        $drescripcionCuracion = strtoupper($drescripcionCuracion);
    }
    if($notaEnfermeria != NULL){
        $notaEnfermeria = strtoupper($notaEnfermeria);
    }
    if($descripComidas != NULL){
        $descripComidas = strtoupper($descripComidas);
    }
    $medicamento_1 = strtoupper($medicamento_1);
    $medicamento_2 = strtoupper($medicamento_2);
    
    if($medicamento_3 != NULL){
        $medicamento_3 = strtoupper($medicamento_3);
    }
    if($medicamento_4 != NULL){
        $medicamento_4 = strtoupper($medicamento_4);
    }
    if($medicamento_5 != NULL){
        $medicamento_5 = strtoupper($medicamento_5);
    }

    // Prepara y ejecuta la consulta
    $consulta = $con->prepare(" INSERT INTO registro_clinico 
    (asignacionHorarios, peso, diagnoticoPaciente, temperatura, pulso, respiracion,
    tensionArterial, spo2, glicemiaCapilar, vomitos, evacuaciones, orina,
    ingestaLiquidos, caidas, drenajesVendajes, uppHh, descripcionUpp,
    solucion, fechaSolucion, cantidadSolucion, gotSolucion, frecSolucion,
    horaInicio, horaTermina, curacion, notaEnfermeria, notaAlimentacion,
    horarioAlimentacion, controlMedicamento_1, horarioMedicacmento_1,
    controlMedicamento_2, horarioMedicacmento_2, controlMedicamento_3, 
    horarioMedicacmento_3, controlMedicamento_4, horarioMedicacmento_4,
    controlMedicamento_5, horarioMedicacmento_5) 
    VALUES (:numeroAsignacion, :peso, :diagnosticoMedico, :temperatura, :pulso, 
    :respiracion, :tensionArterial, :spo2, :glicemiaCapilar, :vomito, :evacuaciones, 
    :orina, :ingestaLiquidos, :caidas, :drenajesVendajes, :uppHh, :descripcionUpp, :solucion, 
    :fecha, :cantidad, :goteo, :frecuencia, :inicia, :termina, :drescripcionCuracion, 
    :notaEnfermeria, :descripComidas, :horarioComidas, :medicamento_1, :horario_1, :medicamento_2, 
    :horario_2, :medicamento_3, :horario_3, :medicamento_4, :horario_4, :medicamento_5,
    :horario_5 )");


    // Vincula los parámetros
    $consulta->bindParam(':numeroAsignacion', $numeroAsignacion);
    $consulta->bindParam(':peso', $peso);
    $consulta->bindParam(':diagnosticoMedico', $diagnosticoMedico);
    $consulta->bindParam('temperatura', $temperatura);
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
    $consulta->bindParam(':notaEnfermeria', $notaEnfermeria);
    $consulta->bindParam(':descripComidas', $descripComidas);
    $consulta->bindParam(':horarioComidas', $horarioComidas);
    $consulta->bindParam(':medicamento_1', $medicamento_1);
    $consulta->bindParam(':horario_1', $horario_1);
    $consulta->bindParam(':medicamento_2', $medicamento_2);
    $consulta->bindParam(':horario_2', $horario_2);
    $consulta->bindParam(':medicamento_3', $medicamento_3);
    $consulta->bindParam(':horario_3', $horario_3);
    $consulta->bindParam(':medicamento_4', $medicamento_4);
    $consulta->bindParam(':horario_4', $horario_5);
    $consulta->bindParam(':medicamento_5', $medicamento_5);
    $consulta->bindParam(':horario_5', $horario_5);

    if($consulta->execute()){
        return true;
    
  


    //elimina las variables de la sesion para porder realizar otro registro
    unset($_SESSION["peso"]);
    unset($_SESSION["diagnosticoMedico"]);
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
    unset($_SESSION["notaEnfermeria"]);
    unset($_SESSION["descripComidas"]);
    unset($_SESSION["horarioComidas"]);
    unset($_SESSION["descripComida"]);
    unset($_SESSION["medicamento_1"]);
    unset($_SESSION["horario_1"]);
    unset($_SESSION["medicamento_2"]);
    unset($_SESSION["horario_2"]);
    unset($_SESSION["medicamento_3"]);
    unset($_SESSION["horario_3"]);
    unset($_SESSION["medicamento_4"]);
    unset($_SESSION["horario_4"]);
    unset($_SESSION["medicamento_5"]);
    unset($_SESSION["horario_5"]);

    $_SESSION['datos_guardados'] = true;
    
   
    exit();
    } else {
        echo 'ERROR AUN';
    }
echo '<script>window.location.href = "../registroYcuidados/index.php";</script>';
?>
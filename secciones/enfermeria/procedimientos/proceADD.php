<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';
include("../hojaComplementaria/consulta.php");
if ($_POST) {
    $pacientes = (isset($_POST["pacientes"]) ? $_POST["pacientes"] : "");
    $codigo_ICD = (isset($_POST["codigo_ICD"]) ? $_POST["codigo_ICD"] : "");
    $dx = (isset($_POST["dx"]) ? $_POST["dx"] : "");
    $medico = (isset($_POST["medico"]) ? $_POST["medico"] : "");

    // $consulta = $con->prepare("SELECT * FROM proce_enfer");
    
    // $consulta->execute();
    // $resul = $consulta->rowCount();

    //if ($resul > 0) {
    //     echo '<script language="javascript"> ';
    //     echo 'Swal.fire({
    //             icon: "warning",
    //             title: "DUPLICADO",
    //             text: "El dato ingresado ya existe",
    //             showConfirmButton: false,
    //             timer: 2000,
    //         }).then(function() {
    //             window.location = "index.php";
    //             });';
    //     echo '</script>';
    // } else {
        
        $sentencia = $con->prepare("INSERT INTO proce_enfer (id_proce,pacientes, codigo_ICD,dx,medico)
        VALUES (null, :pacientes,:codigo_ICD, :dx , :medico )");

        $sentencia->bindParam(":pacientes", $pacientes);
        $sentencia->bindParam(":codigo_ICD", $codigo_ICD);
        $sentencia->bindParam(":dx", $dx);
        $sentencia->bindParam(":medico", $medico);
        $sentencia->execute();

        echo '<script language="javascript"> ';
        echo 'Swal.fire({
                icon: "success",
                title: "Procedimiento Agregado",
                showConfirmButton: false,
                timer: 1500,
            }).then(function() {
                window.location = "index.php";
                });';
        echo '</script>';
    }
// }
?>
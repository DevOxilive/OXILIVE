<?php
include("../../../connection/conexion.php");
include_once '../../../templates/hea.php';

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Corrige la consulta SQL y usa parámetros nombrados en la consulta.
    $sentencia = $con->prepare("SELECT * FROM admi_enfer WHERE id_admi_enfer=:id_admi_enfer ");
    $sentencia->bindParam(":id_admi_enfer", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    // Traer los datos de la BDD
    $Nombre_administradora = $registro["Nombre_admi"];
    $cpt_admi = $registro["cpt_admi"];
    $des1 = $registro["des1"];
    $unidad = $registro["unidad"];

    $cpt2 = $registro["cpt2"];
    $des2 = $registro["des2"];
    $unidad2 = $registro["unidad2"];

    $cpt3 = $registro["cpt3"];
    $des3 = $registro["des3"];
    $unidad3 = $registro["unidad3"];

    $cpt4 = $registro["cpt4"];
    $des4 = $registro["des4"];
    $unidad4 = $registro["unidad4"];

    $cpt5 = $registro["cpt5"];
    $des5 = $registro["des5"];
    $unidad5 = $registro["unidad5"];

    $cpt6 = $registro["cpt6"];
    $des6 = $registro["des6"];
    $unidad6 = $registro["unidad6"];
}

if ($_POST) {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $Nombre_administradora = (isset($_POST['Nombre_administradora'])) ? $_POST['Nombre_administradora'] : "";
    $cpt_admi = (isset($_POST['cpt'])) ? $_POST['cpt'] : "";
    $des1 = (isset($_POST['des1'])) ? $_POST['des1'] : "";
    $unidad = (isset($_POST['unidad'])) ? $_POST['unidad'] : "";
    
    $cpt2 = (isset($_POST['cpt2'])) ? $_POST['cpt2'] : "";
    $des2 = (isset($_POST['des2'])) ? $_POST['des2'] : "";
    $unidad2 = (isset($_POST['unidad2'])) ? $_POST['unidad2'] : "";
    
    $cpt3 = (isset($_POST['cpt3'])) ? $_POST['cpt3'] : "";
    $des3 = (isset($_POST['des3'])) ? $_POST['des3'] : "";
    $unidad3 = (isset($_POST['unidad3'])) ? $_POST['unidad3'] : "";
    
    $cpt4 = (isset($_POST['cpt4'])) ? $_POST['cpt4'] : "";
    $des4 = (isset($_POST['des4'])) ? $_POST['des4'] : "";
    $unidad4 = (isset($_POST['unidad4'])) ? $_POST['unidad4'] : "";
    
    $cpt5 = (isset($_POST['cpt5'])) ? $_POST['cpt5'] : "";
    $des5 = (isset($_POST['des5'])) ? $_POST['des5'] : "";
    $unidad5 = (isset($_POST['unidad5'])) ? $_POST['unidad5'] : "";
    
    $cpt6 = (isset($_POST['cpt6'])) ? $_POST['cpt6'] : "";
    $des6 = (isset($_POST['des6'])) ? $_POST['des6'] : "";
    $unidad6 = (isset($_POST['unidad6'])) ? $_POST['unidad6'] : "";
    

    // Preparar la consulta de actualización
    $sentencia = $con->prepare("UPDATE admi_enfer SET 
        Nombre_admi=:Nombre_admi, 
        cpt_admi=:cpt_admi,
        des1=:des1,
        unidad=:unidad,
        cpt2=:cpt2,
        des2=:des2,
        unidad2=:unidad2,
        cpt3=:cpt3,
        des3=:des3,
        unidad3=:unidad3,
        cpt4=:cpt4,
        des4=:des4,
        unidad4=:unidad4,
        cpt5=:cpt5,
        des5=:des5,
        unidad5=:unidad5,
        cpt6=:cpt6,
        des6=:des6,
        unidad6=:unidad6
        WHERE id_admi_enfer=:id_admi_enfer");

    // Asignar valores a los marcadores de posición
    $sentencia->bindParam(":Nombre_admi", $Nombre_administradora);
    $sentencia->bindParam(":cpt_admi", $cpt_admi);
    $sentencia->bindParam(":des1", $des1);
    $sentencia->bindParam(":unidad", $unidad);


    $sentencia->bindParam(":cpt2", $cpt2);
    $sentencia->bindParam(":des2", $des2);
    $sentencia->bindParam(":unidad2", $unidad2);


    $sentencia->bindParam(":cpt3", $cpt3);
    $sentencia->bindParam(":des3", $des3);
    $sentencia->bindParam(":unidad3", $unidad3);


    $sentencia->bindParam(":cpt4", $cpt4);
    $sentencia->bindParam(":des4", $des4);
    $sentencia->bindParam(":unidad4", $unidad4);


    $sentencia->bindParam(":cpt5", $cpt5);
    $sentencia->bindParam(":des5", $des5);
    $sentencia->bindParam(":unidad5", $unidad5);


    $sentencia->bindParam(":cpt6", $cpt6);
    $sentencia->bindParam(":des6", $des6);
    $sentencia->bindParam(":unidad6", $unidad6);



    $sentencia->bindParam(":id_admi_enfer", $txtID);

    $sentencia->execute();

    echo '<script language="javascript"> ';
    echo 'Swal.fire({
          icon: "success",
          title: "DATOS GUARDADOS",
          text: "LOS DATOS SE GUARDARON CORRECTAMENTE",
          showConfirmButton: false,
          timer: 2000,
        }).then(function() {
          window.location = "index.php";
          });';
    echo '</script>';
  }
?>

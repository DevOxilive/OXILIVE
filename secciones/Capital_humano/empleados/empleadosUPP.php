<?php
include("../../../connection/conexion.php");
include("../../../templates/hea.php");

if (isset($_GET['txtID'])) {

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $sentencia = $con->prepare("SELECT em.*, col.id AS colonia_id, col.nombre AS colonia, m.nombre AS municipio, e.nombre AS estadoDir, codigo_postal 
    FROM empleados em , colonias col, municipios m, estados e
    WHERE em.colonia = col.id
    AND col.municipio = m.id
    AND m.estado = e.id AND em.id_empleado = :id_empleados");
    $sentencia->bindParam(":id_empleados", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    // //Traer los datos en la DB
    $Nombres = $registro["nombres"];
    $Apellidos = $registro["apellidos"];
    $Genero = $registro["Genero"];
    $Curp = $registro["curp"];
    $rfc = $registro["rfc"];
    $telefono = $registro["telefonoUno"];
    $correo = $registro["correo"];
    $cuentaBancaria = $registro["numCuenta"];
    $nss = $registro["nss"];
    $Puesto = $registro['departamento'];
    $codigo_postal = $registro["codigo_postal"];
    $coloniaId = $registro["colonia_id"];
    $colonia = $registro["colonia"];
    $municipio = $registro["municipio"];
    $estado = $registro["estadoDir"];
    $calle = $registro['calle'];
    $numExt = $registro['numExt'];
    $numInt = $registro['numInt'];
    $calleUno = $registro['calleUno'];
    $calleDos = $registro['calleDos'];
    $referencias = $registro['referenciasDireccion'];
    $tipoLicencia = $registro['tipoLicencia'];

    $Ine = $registro['ineDoc'];
    $acta = $registro['actaNacimiento'];
    $comprobante = $registro['comprobanteDomicilio'];
    $certificado = $registro['certificadoEstudios'];
    $numCuenta = $registro['cuenta'];

    $curp = $registro['curpDoc'];
    $nssDoc = $registro['nssDoc'];
    $rfcDoc = $registro['rfcDoc'];
    $laboral = $registro['referenciaLabUno'];
    $personal = $registro['referenciaLabDos'];
    $licencia = $registro['licenciaUno'];
}

if ($_POST) {
    $Nombres = (isset($_POST["nombres"]) ? $_POST["nombres"] : "");
    $Apellidos = (isset($_POST["apellidos"]) ? $_POST["apellidos"] : "");
    $Genero = (isset($_POST["genero"]) ? $_POST["genero"] : "");
    $telefono = (isset($_POST["telefono"]) ? $_POST["telefono"] : "");
    $telefonoDos = (isset($_POST["telefonoDos"]) ? $_POST["telefonoDos"] : null);
    $correo = (isset($_POST["email"]) ? $_POST["email"] : NULL);
    $Curp = (isset($_POST["curp"]) ? $_POST["curp"] : "");
    $rfc = (isset($_POST["rfc"]) ? $_POST["rfc"] : "");
    $departamento = (isset($_POST["departamento"]) ? $_POST["departamento"] : null);
    $calle = (isset($_POST["calle"]) ? $_POST["calle"] : "");
    $numExt = (isset($_POST["numExt"]) ? $_POST["numExt"] : "");
    $numInt = (isset($_POST["numInt"]) ? $_POST["numInt"] : NULL);
    $colonia = (isset($_POST['colonia']) ? $_POST['colonia'] : null);
    $calleUno = (isset($_POST['calleUno']) ? $_POST['calleUno'] : null);
    $calleDos = (isset($_POST['calleDos']) ? $_POST['calleDos'] : null);
    $referencias = (isset($_POST['referencias']) ? $_POST['referencias'] : null);
    $cuentaInput = (isset($_POST['cuentaInput']) ? $_POST['cuentaInput'] : null);
    // $nivelEducativo = (isset($_POST['nivelEducativo']) ? $_POST['nivelEducativo'] : "");
    $contrato = (isset($_POST['contrato']) ? $_POST['contrato'] : "");
    $nss = (isset($_POST['nss']) ? $_POST['nss'] : "");
    $tipoLicencia = (isset($_POST['tipoLicencia']) ? $_POST['tipoLicencia'] : null);
    $fechaAlta = (isset($_POST['fechaAlta']) ? $_POST['fechaAlta'] : null);
    $tipoDeContrato = (isset($_POST['tipoDeContrato']) ? $_POST['tipoDeContrato'] : null);
    $ineDoc = (isset($_POST['ineDoc']) ? $_POST['ineDoc'] : "");
    $actaNacimiento = (isset($_POST['actaNacimiento']) ? $_POST['actaNacimiento'] : null);
    $comprobanteDomicilio = (isset($_POST['comprobanteDomicilio']) ? $_POST['comprobanteDomicilio'] : null);
    $nssDoc = (isset($_POST['nssDoc']) ? $_POST['nssDoc'] : "");
    $curpDoc = (isset($_POST['curpDoc']) ? $_POST['curpDoc'] : "");
    $rfcDoc = (isset($_POST['rfcDoc']) ? $_POST['rfcDoc'] : "");
    $referenciaLabUno = (isset($_POST['referenciaLabUno']) ? $_POST['referenciaLabUno'] : "");
    $referenciaLabDos = (isset($_POST['referenciaLabDos']) ? $_POST['referenciaLabDos'] : "");
    $licenciaUno = (isset($_POST['licenciaUno']) ? $_POST['licenciaUno'] : "");
    $cuenta = (isset($_POST['cuenta']) ? $_POST['cuenta'] : null);

    $sentencia = $con->prepare("UPDATE empleados
    SET nombres=:nombres, apellidos=:apellidos, genero=:genero, telefonoUno=:telefono, telefonoDos=:telefonoDos, correo=:correo, curp=:curp,
    rfc=:rfc, departamento=:departamento, calle=:calle, numExt=:numExt, numInt=:numInt, colonia=:colonia, calleUno=:calleUno, calleDos=:calleDos,
    referenciasDireccion=:referencias, cuenta=:cuentaInput,  contrato=:contrato, nss=:nss, tipoLicencia=:tipoLicencia,
    ineDoc=:ineDoc, actaNacimiento=:actaNacimiento, comprobanteDomicilio=:comprobanteDomicilio, nssDoc=:nssDoc, curpDoc=:curpDoc, rfcDoc=:rfcDoc,
    referenciaLabUno=:referenciaLabUno, referenciaLabDos=:referenciaLabDos, licenciaUno=:licenciaUno, cuenta=:cuenta, fechaAlta=:fechaAlta, tipoDeContrato=:tipoDeContrato
    WHERE id_empleado=:id_empleados");

    $sentencia->bindParam(":nombres", $nombres);
    $sentencia->bindParam(":apellidos", $apellidos);
    $sentencia->bindParam(":genero", $genero);
    $sentencia->bindParam(":telefono", $telefono);
    $sentencia->bindParam(":telefonoDos", $telefonoDos);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":curp", $curp);
    $sentencia->bindParam(":rfc", $rfc);
    $sentencia->bindParam(":departamento", $departamento);
    $sentencia->bindParam(":calle", $calle);
    $sentencia->bindParam(":numExt", $numExt);
    $sentencia->bindParam(":numInt", $numInt);
    $sentencia->bindParam(":colonia", $colonia);
    $sentencia->bindParam(":calleUno", $calleUno);
    $sentencia->bindParam(":calleDos", $calleDos);
    $sentencia->bindParam(":referencias", $referencias);
    $sentencia->bindParam(":cuentaInput", $cuentaInput);
    // $sentencia->bindParam(":nivelEducativo", $nivelEducativo);
    $sentencia->bindParam(":contrato", $contrato);
    $sentencia->bindParam(":nss", $nss);
    $sentencia->bindParam(":tipoLicencia", $tipoLicencia);
    $sentencia->bindParam(":ineDoc", $ineDoc);
    $sentencia->bindParam(":actaNacimiento", $actaNacimiento);
    $sentencia->bindParam(":comprobanteDomicilio", $comprobanteDomicilio);
    $sentencia->bindParam(":nssDoc", $nssDoc);
    $sentencia->bindParam(":curpDoc", $curpDoc);
    $sentencia->bindParam(":rfcDoc", $rfcDoc);
    $sentencia->bindParam(":referenciaLabUno", $referenciaLabUno);
    $sentencia->bindParam(":referenciaLabDos", $referenciaLabDos);
    $sentencia->bindParam(":licenciaUno", $licenciaUno);
    $sentencia->bindParam(":cuenta", $cuenta);
    $sentencia->bindParam(":fechaAlta", $fechaAlta);
    $sentencia->bindParam(":tipoDeContrato", $tipoDeContrato);
    $sentencia->bindParam(":id_empleados", $txtID);
    $sentencia->execute();

      echo '<script language="javascript"> ';
      echo 'Swal.fire({
                      icon: "success",
                      title: "🫂 EMPLEADO MODIFICADO",
                      text: "Los datos fueron guardados",
                      showConfirmButton: false,
                      timer: 2000,
                  }).then(function() {
                      window.location = "./index.php";
                  });';
      echo '</script>';
  }
?>
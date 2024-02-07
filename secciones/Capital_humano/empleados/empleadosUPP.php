<?php
include("../../../connection/conexion.php");
include("../../../templates/hea.php");
include("../../../connection/url.php");
include("../../../ctrlArchivos/control/Archivero.php");

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
    $idEmp = $txtID;

    // //Traer los datos en la DB
    $Nombres = $registro["nombres"];
    echo "nombre ingresado; $Nombres";
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
    $archivero = new Archivero();
    $txtID = $_POST['txtID'];
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
    $nivelEducativo = (isset($_POST['nivelEducativo']) ? $_POST['nivelEducativo'] : "");
    $contrato = (isset($_POST['contrato']) ? $_POST['contrato'] : "");
    $nss = (isset($_POST['nss']) ? $_POST['nss'] : "");
    $tipoLicencia = (isset($_POST['tipoLicencia']) ? $_POST['tipoLicencia'] : null);
    $fechaAlta = (isset($_POST['fechaAlta']) ? $_POST['fechaAlta'] : null);
    $tipoDeContrato = (isset($_POST['tipoDeContrato']) ? $_POST['tipoDeContrato'] : null);

    //ESTOS SON LOS FILES
    $ineDoc = $_FILES['ineDoc']['name'];
    $actaN = $_FILES['actaNacimiento']['name'];
    $domicilio = $_FILES['comprobanteDomicilio']['name'];
    $certificadoEstudios = $_FILES['certificadoEstudios']['name'];
    $cuenta = $_FILES['cuenta']['name'];
    $nssDoc = $_FILES['nssDoc']['name'];
    $curpDoc = $_FILES['curpDoc']['name'];
    $rfcDoc = $_FILES['rfcDoc']['name'];
    $referenciaLabUno = $_FILES['referenciaLabUno']['name'];
    $referenciaLabDos = $_FILES['referenciaLabDos']['name'];
    $licenciaUno = $_FILES['licenciaUno']['name'];

    $ineDocNew = $_FILES['ineDoc']['tmp_name'];
    $actaNew = $_FILES['actaNacimiento']['tmp_name'];
    $domicilioNew = $_FILES['comprobanteDomicilio']['tmp_name'];
    $certificadoEstudiosNew = $_FILES['certificadoEstudios']['tmp_name'];
    $cuentaNew = $_FILES['cuenta']['tmp_name'];
    $nssDocNew = $_FILES['nssDoc']['tmp_name'];
    $curpNew = $_FILES['curpDoc']['tmp_name'];
    $rfcDocNew = $_FILES['rfcDoc']['tmp_name'];
    $referenciaLabUnoNew = $_FILES['referenciaLabUno']['tmp_name'];
    $referenciaLabDosNew = $_FILES['referenciaLabDos']['tmp_name'];
    $tipoLicenciaNew = $_FILES['licenciaUno']['tmp_name'];

    // $mensajes = " ";

    // echo $ineDoc . " ";

    function procesarArchivo($con, $archivero, $txtID, $tipoArchivo, $nombreArchivo, $nombreArchivoNuevo, $url_base, $campoDB) {
        if (!empty($nombreArchivo)) {
            $sql = "SELECT * FROM empleados WHERE id_empleado = $txtID";
            $actualizar = $con->prepare($sql);
            $actualizar->execute();
            $dato = $actualizar->fetchAll(PDO::FETCH_ASSOC);
    
            foreach ($dato as $fotos) ;
            $arreglo = explode("/", $fotos[$campoDB]);
            $ruta = 'OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
    
            // Validar si el archivo ya existe en la carpeta de destino
            if (file_exists($ruta . "/" . $nombreArchivo)) {
                // echo "El archivo  ya existe. No se puede cargar uno con el mismo nombre.";
                
                echo '<script language="javascript">
                Swal.fire({
                    title: "ARCHIVO?",
                    text: "EL ARCHIVO '.$nombreArchivo.' NO SE PUEDE REPETIR",
                    icon: "question"
                    }).then(function() {
                        window.location = "./index.php";
                  });
                        </script>';
                return; // Salir de la función sin procesar el archivo
            }
    
            $resultado = $archivero->eliminarArchivo($ruta . "/" . $arreglo[9]);
    
            if ($resultado === false) {
                echo "Algo falló al eliminar el archivo existente";
            } else {
                $ruta = './OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
                $resultado = $archivero->guardarArchivo($nombreArchivo, $nombreArchivoNuevo, $ruta);
                if ($resultado === false) {
                    // echo "Error al guardar la imagen en la carpeta: " . $ruta;
                    echo '<script language="javascript">
                    Swal.fire({
                        title: "Error",
                        text: "Hubo un problema al guardar la imagen en la carpeta",
                        icon: "error"
                    }).then(function() {
                        window.location = "./crear.php";
                    });
                  </script>';
            

                }
                $ruta = $url_base . "secciones/Capital_humano/empleados/OXILIVE/" . $fotos['curp'] . ' ' . $fotos['nombres'] . "/" .  $nombreArchivo;
                $sql2 = "UPDATE empleados SET $campoDB = '$ruta'  WHERE id_empleado = $txtID";
                $stmt = $con->prepare($sql2);
                $stmt->execute();
                echo '<script language="javascript">
                Swal.fire({
                    icon: "success",
                    title: "🫂 EMPLEADO MODIFICADO",
                    text: "Los datos fueron guardados",
                    showConfirmButton: false,
                    timer: 2000,
                }).then(function() {
                    window.location = "./index.php";
                });
              </script>';
            }
        }
    }
    
// INE
procesarArchivo($con, $archivero, $txtID, 'INE', $ineDoc, $ineDocNew, $url_base, 'ineDoc');
// Acta de Nacimiento
procesarArchivo($con, $archivero, $txtID, 'Acta de Nacimiento', $actaN, $actaNew, $url_base, 'actaNacimiento');
// Comprobante de Domicilio
procesarArchivo($con, $archivero, $txtID, 'Comprobante de Domicilio', $domicilio, $domicilioNew, $url_base, 'comprobanteDomicilio');
// Certificado de Estudios
procesarArchivo($con, $archivero, $txtID, 'Certificado de Estudios', $certificadoEstudios, $certificadoEstudiosNew, $url_base, 'certificadoEstudios');
// Estado de Cuenta
procesarArchivo($con, $archivero, $txtID, 'Estado de Cuenta', $cuenta, $cuentaNew, $url_base, 'cuenta');
// Número de Seguro Social
procesarArchivo($con, $archivero, $txtID, 'Número de Seguro Social', $nssDoc, $nssDocNew, $url_base, 'nssDoc');
// CURP
procesarArchivo($con, $archivero, $txtID, 'CURP', $curpDoc, $curpNew, $url_base, 'curpDoc');
// RFC
procesarArchivo($con, $archivero, $txtID, 'RFC', $rfcDoc, $rfcDocNew, $url_base, 'rfcDoc');
// Referencia Laboral 1
procesarArchivo($con, $archivero, $txtID, 'Referencia Laboral 1', $referenciaLabUno, $referenciaLabUnoNew, $url_base, 'referenciaLabUno');
// Referencia Laboral 2
procesarArchivo($con, $archivero, $txtID, 'Referencia Laboral 2', $referenciaLabDos, $referenciaLabDosNew, $url_base, 'referenciaLabDos');
// Licencia
procesarArchivo($con, $archivero, $txtID, 'Licencia', $licenciaUno, $tipoLicenciaNew, $url_base, 'licenciaUno');
    
    if (!empty($txtID)) {
        $sentencia = $con->prepare("UPDATE empleados 
        SET nombres=:nombres,apellidos=:apellidos, telefonoUno=:telefono, telefonoDos=:telefonoDos, correo=:correo, curp=:curp,
        rfc=:rfc, departamento=:departamento, calle=:calle, numExt=:numExt, numInt=:numInt, colonia=:colonia, calleUno=:calleUno, calleDos=:calleDos,
        referenciasDireccion=:referencias, numCuenta=:cuentaInput, estudio=:nivelEducativo ,contrato=:contrato, nss=:nss, tipoLicencia=:tipoLicencia
        WHERE id_empleado = :id_empleados");
        $sentencia->bindParam(":id_empleados", $txtID);
        $sentencia->bindParam(":nombres", $Nombres);
        $sentencia->bindParam(":apellidos", $Apellidos);
        // $sentencia->bindParam(":genero", $Genero);
        $sentencia->bindParam(":telefono", $telefono);
        $sentencia->bindParam(":telefonoDos", $telefonoDos);
        $sentencia->bindParam(":correo", $correo);
        $sentencia->bindParam(":curp", $Curp);
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
        //NIVEL EDUCATIVO
        $sentencia->bindParam(":nivelEducativo", $nivelEducativo);
        $sentencia->bindParam(":contrato", $contrato);
        $sentencia->bindParam(":nss", $nss);
        $sentencia->bindParam(":tipoLicencia", $tipoLicencia);
        $sentencia->execute();
        $respuesta = $sentencia->rowCount();

        // Suponiendo que $sentencia es una instancia válida de PDOStatement después de ejecutar la consulta de actualización
$filas_afectadas = $sentencia->rowCount();

// Ahora puedes verificar si se han modificado filas y mostrar el mensaje en consecuencia
if ($filas_afectadas > 0) {
    echo '<script language="javascript">
    Swal.fire({
        icon: "success",
        title: "🫂 EMPLEADO MODIFICADO",
        text: "Los datos fueron guardados",
        showConfirmButton: false,
        timer: 2000,
    }).then(function() {
        window.location = "./index.php";
    });
  </script>';
} else {
    "NO ENTRES AQUÌ HAHAHA";
}
    }
} else {
    echo "error fatal";
}

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
    echo $txtID . " ";
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

    $mensajes = " ";

    echo $ineDoc . " ";

    if (!empty($ineDoc)) {
        // echo "si llego archivo";
        $sql = "SELECT * FROM empleados WHERE id_empleado = $txtID";
        $actualizar = $con->prepare($sql);
        $actualizar->execute();
        $dato = $actualizar->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dato as $fotos);
        $arreglo = explode("/", $fotos['ineDoc']);
        // print_r($arreglo);
        // echo "<br>";
        // echo $arreglo[9];
        $ruta = 'OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
        echo $resultado = $archivero->eliminarArchivo($ruta . "/" . $arreglo[9]);

        if ($resultado === false) {
            echo "algo fallo al guardar";
        } else {
            echo $ruta = './OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
            $resultado = $archivero->guardarArchivo($ineDoc, $ineDocNew, $ruta);
            if ($resultado === false) {
                echo "error en guaerdar la imagen en la carpeta :" . $ruta;
            }
            $ruta = $url_base . "secciones/Capital_humano/empleados/OXILIVE/" . $fotos['curp'] . ' ' . $fotos['nombres'] . "/" .  $ineDoc;
            $sql2 = "UPDATE empleados SET ineDoc = '$ruta'  WHERE id_empleado = $txtID";
            $stmt = $con->prepare($sql2);
            $stmt->execute();
            $mensajes .= "imagen guardad exitosa mente ";
        }
    }
    //ACTA DE NACIMIENTO
    if (!empty($actaN)) {
        // echo "si llego archivo";
        $sql = "SELECT * FROM empleados WHERE id_empleado = $txtID";
        $actualizar = $con->prepare($sql);
        $actualizar->execute();
        $dato = $actualizar->fetchAll(PDO::FETCH_ASSOC);
        //Recorrer
        foreach ($dato as $fotos);
        $arreglo = explode("/", $fotos['actaNacimiento']);
        $ruta = 'OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
        echo $resultado = $archivero->eliminarArchivo($ruta . "/" . $arreglo[9]);

        if ($resultado === false) {
            echo "algo fallo al guardar";
        } else {
            echo $ruta = './OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
            $resultado = $archivero->guardarArchivo($actaN, $actaNew, $ruta);
            if ($resultado === false) {
                echo "error en guaerdar la imagen en la carpeta :" . $ruta;
            }
            $ruta = $url_base . "secciones/Capital_humano/empleados/OXILIVE/" . $fotos['curp'] . ' ' . $fotos['nombres'] . "/" .  $actaN;
            $sql2 = "UPDATE empleados SET actaNacimiento = '$ruta'  WHERE id_empleado = $txtID";
            $stmt = $con->prepare($sql2);
            $stmt->execute();
            $mensajes .= "imagen guardad exitosa mente ";
        }
    }
    //Comprobante de domicilio
    if (!empty($domicilio)) {
        // echo "si llego archivo";
        $sql = "SELECT * FROM empleados WHERE id_empleado = $txtID";
        $actualizar = $con->prepare($sql);
        $actualizar->execute();
        $dato = $actualizar->fetchAll(PDO::FETCH_ASSOC);
        //Recorrer
        foreach ($dato as $fotos);
        $arreglo = explode("/", $fotos['comprobanteDomicilio']);
        $ruta = 'OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
        echo $resultado = $archivero->eliminarArchivo($ruta . "/" . $arreglo[9]);

        if ($resultado === false) {
            echo "algo fallo al guardar";
        } else {
            echo $ruta = './OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
            $resultado = $archivero->guardarArchivo($domicilio, $domicilioNew, $ruta);
            if ($resultado === false) {
                echo "error en guaerdar la imagen en la carpeta :" . $ruta;
            }
            $ruta = $url_base . "secciones/Capital_humano/empleados/OXILIVE/" . $fotos['curp'] . ' ' . $fotos['nombres'] . "/" .  $domicilio;
            $sql2 = "UPDATE empleados SET comprobanteDomicilio = '$ruta'  WHERE id_empleado = $txtID";
            $stmt = $con->prepare($sql2);
            $stmt->execute();
            $mensajes .= "imagen guardad exitosa mente ";
        }
    }
    //Ultimo Certificado / Cèdula
    if (!empty($certificadoEstudios)) {
        // echo "si llego archivo";
        $sql = "SELECT * FROM empleados WHERE id_empleado = $txtID";
        $actualizar = $con->prepare($sql);
        $actualizar->execute();
        $dato = $actualizar->fetchAll(PDO::FETCH_ASSOC);
        //Recorrer
        foreach ($dato as $fotos);
        $arreglo = explode("/", $fotos['certificadoEstudios']);
        $ruta = 'OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
        echo $resultado = $archivero->eliminarArchivo($ruta . "/" . $arreglo[9]);

        if ($resultado === false) {
            echo "algo fallo al guardar";
        } else {
            echo $ruta = './OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
            $resultado = $archivero->guardarArchivo($certificadoEstudios, $certificadoEstudiosNew, $ruta);
            if ($resultado === false) {
                echo "error en guaerdar la imagen en la carpeta :" . $ruta;
            }
            $ruta = $url_base . "secciones/Capital_humano/empleados/OXILIVE/" . $fotos['curp'] . ' ' . $fotos['nombres'] . "/" .  $certificadoEstudios;
            $sql2 = "UPDATE empleados SET certificadoEstudios = '$ruta'  WHERE id_empleado = $txtID";
            $stmt = $con->prepare($sql2);
            $stmt->execute();
            $mensajes .= "imagen guardad exitosa mente ";
        }
    }
    //Estado de Cuenta
    if (!empty($cuenta)) {
        // echo "si llego archivo";
        $sql = "SELECT * FROM empleados WHERE id_empleado = $txtID";
        $actualizar = $con->prepare($sql);
        $actualizar->execute();
        $dato = $actualizar->fetchAll(PDO::FETCH_ASSOC);
        //Recorrer
        foreach ($dato as $fotos);
        $arreglo = explode("/", $fotos['cuenta']);
        $ruta = 'OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
        echo $resultado = $archivero->eliminarArchivo($ruta . "/" . $arreglo[9]);

        if ($resultado === false) {
            echo "algo fallo al guardar";
        } else {
            echo $ruta = './OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
            $resultado = $archivero->guardarArchivo($cuenta, $cuentaNew, $ruta);
            if ($resultado === false) {
                echo "error en guaerdar la imagen en la carpeta :" . $ruta;
            }
            $ruta = $url_base . "secciones/Capital_humano/empleados/OXILIVE/" . $fotos['curp'] . ' ' . $fotos['nombres'] . "/" .  $cuenta;
            $sql2 = "UPDATE empleados SET cuenta = '$ruta'  WHERE id_empleado = $txtID";
            $stmt = $con->prepare($sql2);
            $stmt->execute();
            $mensajes .= "imagen guardad exitosa mente ";
        }
    }
    //Nùmero de seguro social
    if (!empty($nssDoc)) {
        // echo "si llego archivo";
        $sql = "SELECT * FROM empleados WHERE id_empleado = $txtID";
        $actualizar = $con->prepare($sql);
        $actualizar->execute();
        $dato = $actualizar->fetchAll(PDO::FETCH_ASSOC);
        //Recorrer
        foreach ($dato as $fotos);
        $arreglo = explode("/", $fotos['nssDoc']);
        $ruta = 'OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
        echo $resultado = $archivero->eliminarArchivo($ruta . "/" . $arreglo[9]);

        if ($resultado === false) {
            echo "algo fallo al guardar";
        } else {
            echo $ruta = './OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
            $resultado = $archivero->guardarArchivo($nssDoc, $nssDocNew, $ruta);
            if ($resultado === false) {
                echo "error en guaerdar la imagen en la carpeta :" . $ruta;
            }
            $ruta = $url_base . "secciones/Capital_humano/empleados/OXILIVE/" . $fotos['curp'] . ' ' . $fotos['nombres'] . "/" .  $nssDoc;
            $sql2 = "UPDATE empleados SET nssDoc = '$ruta'  WHERE id_empleado = $txtID";
            $stmt = $con->prepare($sql2);
            $stmt->execute();
            $mensajes .= "imagen guardad exitosa mente ";
        }
    }
    //CURP
    if (!empty($curpDoc)) {
        // echo "si llego archivo";
        $sql = "SELECT * FROM empleados WHERE id_empleado = $txtID";
        $actualizar = $con->prepare($sql);
        $actualizar->execute();
        $dato = $actualizar->fetchAll(PDO::FETCH_ASSOC);
        //Recorrer
        foreach ($dato as $fotos);
        $arreglo = explode("/", $fotos['curpDoc']);
        $ruta = 'OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
        echo $resultado = $archivero->eliminarArchivo($ruta . "/" . $arreglo[9]);

        if ($resultado === false) {
            echo "algo fallo al guardar";
        } else {
            echo $ruta = './OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
            $resultado = $archivero->guardarArchivo($curpDoc, $curpNew, $ruta);
            if ($resultado === false) {
                echo "error en guaerdar la imagen en la carpeta :" . $ruta;
            }
            $ruta = $url_base . "secciones/Capital_humano/empleados/OXILIVE/" . $fotos['curp'] . ' ' . $fotos['nombres'] . "/" .  $curpDoc;
            $sql2 = "UPDATE empleados SET curpDoc = '$ruta'  WHERE id_empleado = $txtID";
            $stmt = $con->prepare($sql2);
            $stmt->execute();
            $mensajes .= "imagen guardad exitosa mente ";
        }
    }
    //RFC
    if (!empty($rfcDoc)) {
        // echo "si llego archivo";
        $sql = "SELECT * FROM empleados WHERE id_empleado = $txtID";
        $actualizar = $con->prepare($sql);
        $actualizar->execute();
        $dato = $actualizar->fetchAll(PDO::FETCH_ASSOC);
        //Recorrer
        foreach ($dato as $fotos);
        $arreglo = explode("/", $fotos['rfcDoc']);
        $ruta = 'OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
        echo $resultado = $archivero->eliminarArchivo($ruta . "/" . $arreglo[9]);

        if ($resultado === false) {
            echo "algo fallo al guardar";
        } else {
            echo $ruta = './OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
            $resultado = $archivero->guardarArchivo($rfcDoc, $rfcDocNew, $ruta);
            if ($resultado === false) {
                echo "error en guaerdar la imagen en la carpeta :" . $ruta;
            }
            $ruta = $url_base . "secciones/Capital_humano/empleados/OXILIVE/" . $fotos['curp'] . ' ' . $fotos['nombres'] . "/" .  $rfcDoc;
            $sql2 = "UPDATE empleados SET rfcDoc = '$ruta'  WHERE id_empleado = $txtID";
            $stmt = $con->prepare($sql2);
            $stmt->execute();
            $mensajes .= "imagen guardad exitosa mente ";
        }
    }
    //REFERENCIA LABORAL 1
    if (!empty($referenciaLabUno)) {
        // echo "si llego archivo";
        $sql = "SELECT * FROM empleados WHERE id_empleado = $txtID";
        $actualizar = $con->prepare($sql);
        $actualizar->execute();
        $dato = $actualizar->fetchAll(PDO::FETCH_ASSOC);
        //Recorrer
        foreach ($dato as $fotos);
        $arreglo = explode("/", $fotos['referenciaLabUno']);
        $ruta = 'OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
        echo $resultado = $archivero->eliminarArchivo($ruta . "/" . $arreglo[9]);

        if ($resultado === false) {
            echo "algo fallo al guardar";
        } else {
            echo $ruta = './OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
            $resultado = $archivero->guardarArchivo($referenciaLabUno, $referenciaLabUnoNew, $ruta);
            if ($resultado === false) {
                echo "error en guaerdar la imagen en la carpeta :" . $ruta;
            }
            $ruta = $url_base . "secciones/Capital_humano/empleados/OXILIVE/" . $fotos['curp'] . ' ' . $fotos['nombres'] . "/" .  $referenciaLabUno;
            $sql2 = "UPDATE empleados SET referenciaLabUno = '$ruta'  WHERE id_empleado = $txtID";
            $stmt = $con->prepare($sql2);
            $stmt->execute();
            $mensajes .= "imagen guardad exitosa mente ";
        }
    }
    //REFERENCIA LABORAL 2
    if (!empty($referenciaLabDos)) {
        // echo "si llego archivo";
        $sql = "SELECT * FROM empleados WHERE id_empleado = $txtID";
        $actualizar = $con->prepare($sql);
        $actualizar->execute();
        $dato = $actualizar->fetchAll(PDO::FETCH_ASSOC);
        //Recorrer
        foreach ($dato as $fotos);
        $arreglo = explode("/", $fotos['referenciaLabDos']);
        $ruta = 'OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
        echo $resultado = $archivero->eliminarArchivo($ruta . "/" . $arreglo[9]);

        if ($resultado === false) {
            echo "algo fallo al guardar";
        } else {
            echo $ruta = './OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
            $resultado = $archivero->guardarArchivo($referenciaLabDos, $referenciaLabDosNew, $ruta);
            if ($resultado === false) {
                echo "error en guaerdar la imagen en la carpeta :" . $ruta;
            }
            $ruta = $url_base . "secciones/Capital_humano/empleados/OXILIVE/" . $fotos['curp'] . ' ' . $fotos['nombres'] . "/" .  $referenciaLabDos;
            $sql2 = "UPDATE empleados SET referenciaLabDos = '$ruta'  WHERE id_empleado = $txtID";
            $stmt = $con->prepare($sql2);
            $stmt->execute();
            $mensajes .= "imagen guardad exitosa mente ";
        }
    }
    //Licencia
    if (!empty($licenciaUno)) {
        // echo "si llego archivo";
        $sql = "SELECT * FROM empleados WHERE id_empleado = $txtID";
        $actualizar = $con->prepare($sql);
        $actualizar->execute();
        $dato = $actualizar->fetchAll(PDO::FETCH_ASSOC);
        //Recorrer
        foreach ($dato as $fotos);
        $arreglo = explode("/", $fotos['licenciaUno']);
        $ruta = 'OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
        echo $resultado = $archivero->eliminarArchivo($ruta . "/" . $arreglo[9]);

        if ($resultado === false) {
            echo "algo fallo al guardar";
        } else {
            echo $ruta = './OXILIVE/' . $fotos['curp'] . ' ' . $fotos['nombres'];
            $resultado = $archivero->guardarArchivo($licenciaUno, $tipoLicenciaNew, $ruta);
            if ($resultado === false) {
                echo "error en guaerdar la imagen en la carpeta :" . $ruta;
            }
            $ruta = $url_base . "secciones/Capital_humano/empleados/OXILIVE/" . $fotos['curp'] . ' ' . $fotos['nombres'] . "/" .  $licenciaUno;
            $sql2 = "UPDATE empleados SET licenciaUno = '$ruta'  WHERE id_empleado = $txtID";
            $stmt = $con->prepare($sql2);
            $stmt->execute();
            $mensajes .= "imagen guardad exitosa mente ";
        }
    }
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
        if ($respuesta > 0) {
?>
            <script language="javascript">
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
<?php
        }
    }
    // // echo "Num" . $txtID; 
    // if (count($respuesta) > 0) {
    // } else {

    //     echo '<script language="javascript"> ';
    //     echo 'Swal.fire({
    //                   icon: "success",
    //                   title: "🫂 EMPLEADO MODIFICADO",
    //                   text: "Los datos fueron guardados",
    //                   showConfirmButton: false,
    //                   timer: 2000,
    //               }).then(function() {
    //              window.location = "./index.php";                     
    //               });';
    //     echo '</script>';
    // }
} else {
    echo "error fatal";
}

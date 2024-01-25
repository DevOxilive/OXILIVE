<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    require_once "../../../connection/conexion.php";
    include("../../../model/genero.php");
    include("../../../model/banco.php");
    include("../../../secciones/puestos/consulta.php");
} else {
  echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<link rel="stylesheet" href="../../../assets/css/foto_perfil.css">
<link rel="stylesheet" href="../../../assets/css/edit.css">
<link rel="stylesheet" href="css/valid.css">
</head>

</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Nuevo Empleado</H4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="empleadosADD.php" method="POST" enctype="multipart/form-data"
                    class="row g-3 needs-validation optional-form" novalidate id="formulario">
                    <!-- <div class="col-md-3">
                        <label for="Foto_perfil" class="form-label" style="text-align: center;">Sube una foto de
                            perfil</label>
                        <div class="profile-picture">
                            <div class="picture-container">
                                <?php if (!empty($Foto_perfil)) { ?>
                                <img id="preview" src="<?php echo $Foto_perfil; ?>">
                                <?php } else { ?>
                                <img id="preview" src="../../chatNotifica/img/usuario.png">
                                <?php } ?>
                                <div class="overlay">
                                    <?php if (empty($Foto_perfil)) { ?>
                                    <a href="#" class="change-link" onclick="openFilePicker(event)">
                                        <i class="fa fa-camera"></i>
                                    </a>
                                    <?php } else { ?>
                                    <a href="#" class="delete-link" onclick="deletePhoto(event)">Eliminar foto</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="Foto_perfil" id="Foto_perfil"
                            onchange="previewImage(this);" style="display: none;">
                    </div> -->
                    <div class="contenido col-md-4"><br>
                        <label for="departamento" class="form-label">Puesto</label>
                        <select id="departamento" name="departamento" class="form-select">
                            <?php foreach ($lista_puestos as $puesto) { ?>
                            <option value="<?php echo $puesto['id_puestos']; ?>">
                                <?php echo $puesto['Nombre_puestos']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-4"> <br>
                        <label for="usuario" class="form-label">Cuenta con contrato</label>
                        <input type="text" class="form-control" name="contrato" id="contrato" maxlength="2"
                            placeholder="Escriba SI / NO" required>
                        <div class="valid-feedback">
                            contrato correcto
                        </div>
                    </div>
                    
                    <hr>
                    <h1 style="text-align: center;">Datos Generales</h1>
                    
                        <div class="contenido col-md-3 position-relative"> <br>
                            <label for="nombres" class="form-label">Nombre:(s)</label>
                            <input type="text" class="form-control" name="nombres" id="nombres"
                                placeholder="Ingrese el nombre" maxlength="20" required>
                            <div class="valid-tooltip">
                                Nombre apropiado
                            </div>
                        </div>
                        <div class="contenido col-md-3 position-relative"> <br>
                            <label for="apellidos" class="form-label">Apellido:(s)</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos"
                                placeholder="Apellidos" maxlength="20" required>
                            <div class="valid-tooltip">
                                Apllido apropiado
                            </div>
                        </div>
                        <div class="contenido col-md-3"> <br>
                            <label for="genero" class="form-label">Género</label>
                            <select id="genero" name="genero" class="form-select">
                                <?php foreach ($lista_genero as $genero) { ?>
                                <option value="<?php echo $genero['id_genero']; ?>">
                                    <?php echo $genero['genero']; ?>
                                </option>
                                <?php } ?>
                            </select>

                        </div>
                        <div class="contenido col-md-3 position-relative"> <br>
                            <label for="curp" class="form-label">CURP</label>
                            <input type="text" class="form-control" name="curp" id="curp" placeholder="curp"
                                maxlength="30" required>
                            <div class="valid-tooltip">
                                CURP correcto
                            </div>
                        </div>
                        <div class="contenido col-md-3">
                        <label for="rfc" class="form-label">RFC</label>
                        <input type="text" class="form-control" name="rfc" id="rfc" maxlength="15"
                            placeholder="x1x1x1x1x1x1x1x" required>
                        <div class="valid-feedback">
                            RFC correcto
                        </div>
                    
                    </div>
                    <div class="contenido col-md-3 position-relative">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="Phone" class="form-control" name="telefono" id="telefono"
                            placeholder="Telefono de 10 digitos" required>
                        <div class="valid-tooltip">
                            Telefono Correcto
                        </div>
                    </div>
                    <div class="contenido col-md-3 position-relative">
                        <label for="email" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese el correo"
                            maxlength="40">
                        <div class="optional-tooltip">
                            Opcional
                        </div>
                    </div>
                    <hr>
                    <h1>Domicilio Actual </h1>
                    <!--Aquí voy a meter el codigo postal-->
                    <div class="contenido col-md-8">
                        <label for="calle" class="form-label">Calle</label>
                        <input type="text" class="form-control" name="calle" id="calle" maxlength="200"
                            placeholder="Rocita Elvires" required>
                        <div class="valid-feedback">
                            calle valida
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <label for="numExt" class="form-label">Num.Ext</label>
                        <input type="text" class="form-control" name="numExt" id="numExt" maxlength="15"
                            placeholder="Lt2" required>
                        <div class="valid-feedback">
                            Num.Ext. Valido
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <label for="numInt" class="form-label">Num.Int</label>
                        <input type="text" class="form-control" name="numInt" id="numInt" maxlength="15"
                            placeholder="12">
                    </div>
                
                    <div class="contenido col-md-2">
                        <label for="cp" class="form-label">Código Postal:</label>
                        <input type="text" class="form-control" id="cp"
                            placeholder="Ejem: 92734" required>
                    </div>
                    <div class="contenido col-md-4">
                        <label for="colonia" class="form-label" >Colonia:</label>
                        <select name="colonia" id="colonia" class="form-select" required>
                            <option value="" >Selecciona un Código Postal</option>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="delMun" class="form-label">Delegación/Municipio:</label>
                        <select name="delMun" id="delMun" class="form-select" disabled required>
                            <option value="">Selecciona un Código Postal</option>
                        </select>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="estadoDir" class="form-label">Estado:</label>
                        <select name="estadoDir" id="estadoDir" class="form-select" disabled required>
                            <option value="">Selecciona un Código Postal</option>
                        </select>
                    </div>
                    <!--Aquí lo voy a cerrar el codigo postal-->
                    

                    <div class="contenido col-md-6 position-relative">
                        <label for="calleUno" class="form-label">Entre Calle:</label>
                        <input type="text" class="form-control " name="calleUno" id="calleUno" placeholder="Laureles"
                            maxlength="40">
                        <div class="optional-tooltip">
                            Opcional
                        </div>
                    </div>

                    <div class="contenido col-md-6 position-relative">
                        <label for="referencias" class="form-label">Y Calle:</label>
                        <input type="text" class="form-control " name="calleDos" id="calleDos" placeholder="Rojo Gomez"
                            maxlength="40">
                        <div class="optional-tooltip">
                            Opcional
                        </div>
                    </div>
                    <div class="contenido col-md-12 position-relative">
                        <label for="referencias" class="form-label">Referencias</label>
                        <input type="text" class="form-control" name="referencias" id="referencias"
                            placeholder="Ejem. Frente a tiendita" maxlength="150">
                        <div class="optional-tooltip">
                            Opcional
                        </div>
                    </div>
                    <hr>
                    <h1 style="text-align: center;">Comprobantes</h1>
                    <div class="contenido col-md-4 position-relative">
                        <label for="estudio" class="form-label">Estudio</label>
                        <input type="file" class="formulario__input-file" name="estudio" id="estudio">
                        <div class="optional-tooltip">
                            Opcional
                        </div>
                    </div>

                    <div class="contenido col-md-4">
                        <label for="cuenta" class="form-label">Cuenta</label>
                        <input type="file" class="form-control" aria-label="file example" required name="cuenta"
                            id="cuenta">
                        <div class="">Seleccione archivo pdf.</div>
                    </div>

                    <div class="contenido col-md-4">
                        <label for="cedula" class="form-label">Ultimo Certificado / Cedula</label>
                        <input type="file" class="form-control" aria-label="file example" required name="cedula"
                            id="cedula">
                        <div class="">Seleccione archivo pdf.</div>
                    </div>

                    <div class="contenido col-md-4">
                        <label for="referencias" class="form-label">Comprobante de domicilio</label>
                        <input type="file" class="form-control" aria-label="file example" required
                            name="comprobante_domicilio" id="comprobante_domicilio">
                        <div class="">Seleccione archivo pdf.</div>
                    </div>
                    <div class="contenido col-md-4">
                        <label for="credencialFrente" class="form-label">(INE) Credencial parte superior</label>
                        <input type="file" class="form-control" aria-label="file example" required
                            name="credencialFrente" id="credencialFrente">
                    </div>
                    <div class="contenido col-md-4">
                        <label for="credencialAtras" class="form-label">(INE) Credencial parte inferior</label>
                        <input type="file" class="form-control" aria-label="file example" required
                            name="credencialAtras" id="credencialAtras">
                    </div>
                    <div class="contenido col-md-4">
                        <label for="nss" class="form-label">No. Seguro Social</label>
                        <input type="file" class="formulario__input-file" name="nss" id="nss">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-primary">Guardar</button>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar</a>
                    </div>
                </form>


            </div>
        </div>
</main>
<script src="js/documentos.js"></script>
<script src="./js/validaciones.js"></script>
<script src="../../../Js/domicilio.js"></script>
<script src="js/domicilio.js"></script>
<?php
include("../../../templates/footer.php");
?>
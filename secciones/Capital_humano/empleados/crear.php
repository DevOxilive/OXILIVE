<?php
session_start();
if (!isset($_SESSION['us'])) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
  include("../../../templates/header.php");
  include("../../../connection/conexion.php");
  include("../../../secciones/puestos/consulta.php");
  include("../../../module/genero.php");
  include("../../../module/estado.php");
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
                <form action="crear.php" method="POST" enctype="multipart/form-data" class="formLogin row g-3">
                    <div class="col-md-3">
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
                    </div>
                    <div class="contenido col-md-3"><br>
                        <label for="departamento" class="form-label">Puesto</label>
                        <select id="departamento" name="departamento" class="form-select">
                            <?php foreach ($lista_puestos as $puesto) { ?>
                            <option value="<?php echo $puesto['id_puestos']; ?>">
                                <?php echo $puesto['Nombre_puestos']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-3"><br>
                        <label for="contrato" class="form-label">Compratatado</label>
                        <select id="contrato" name="contrato" class="form-select">
                            <option value="">
                                <li>SI / NO</li>
                            </option>
                        </select>
                    </div>
                    <div class="contenido col-md-3"> <br>
                            <label for="usuario" class="form-label">RFC</label>
                            <input type="text" class="form-control" name="rfc" id="rfc" placeholder="RFC"
                                maxlength="15">
                        </div>
                    <hr>
                                <h1 style="text-align: center;">Datos Generales</h1>
                    <div class="row">
                    <div class="contenido col-md-3"> <br>
                        <label for="nombres" class="form-label">Nombre:(s)</label>
                        <input type="text" class="form-control" name="nombres" id="nombres"
                            placeholder="Ingrese el nombre" maxlength="20">
                    </div>
                    <div class="contenido col-md-3"> <br>
                        <label for="apellidos" class="form-label">Apellido:(s)</label>
                        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos"
                            maxlength="20">
                    </div>

                    
                        <div class="contenido col-md-3"> <br>
                            <label for="genero" class="form-label">Género</label>
                            <select id="genero" name="genero" class="form-select">
                                <?php foreach ($lista_genero as $genero) { ?>
                                <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero['genero']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="contenido col-md-3"> <br>
                            <label for="curp" class="form-label">CURP</label>
                            <input type="text" class="form-control" name="curp" id="curp" placeholder="curp"
                                maxlength="30">
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="Phone" class="form-control" name="telefono" id="telefono"
                            placeholder="Telefono de 10 digitos">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="email" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Ingrese el correo " maxlength="40">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="calleUno" class="form-label">Entre Calle:</label>
                        <input type="text" class="form-control" name="calleUno" id="calleUno" placeholder="Laureles" maxlength="40">
                    </div>
                    <div class="contenido col-md-3">
                        <label for="referencias" class="form-label">Y Calle:</label>
                        <input type="text" class="form-control" name="calleDos" id="calleDos" placeholder="Rojo Gomez" maxlength="40">
                    </div>
                    <div class="contenido col-md-12">
                        <label for="referencias" class="form-label">Referencias</label>
                        <input type="text" class="form-control" name="referencias" id="referencias"
                            placeholder="Ejem. Frente a tiendita" maxlength="100">
                    </div>
                    <hr>
                    <h1 style="text-align: center;">Comprobantes</h1>
                    <div class="contenido col-md-4">
                        <label for="estudio" class="form-label">Estudio</label>
                        <input type="file" class="formulario__input-file" name="estudio"
                            id="estudio">
                    </div>

                    <div class="contenido col-md-4">
                        <label for="cuenta" class="form-label">Cuenta</label>
                        <input type="file" class="formulario__input-file" name="cuenta"
                            id="cuenta">
                    </div>

                    <div class="contenido col-md-4">
                        <label for="cedula" class="form-label">Ultimo Certificado / Cedula</label>
                        <input type="file" class="formulario__input-file" name="cedula"
                            id="cedula">
                    </div>

                    <div class="contenido col-md-4">
                        <label for="referencias" class="form-label">Comprobante de domicilio</label>
                        <input type="file" class="formulario__input-file" name="comprobante_domicilio"
                            id="comprobante_domicilio">
                    </div>
                    <div class="contenido col-md-4">
                        <label for="credencialFrente" class="form-label">(INE) Credencial parte superior</label>
                        <input type="file" class="formulario__input-file" name="credencialFrente" id="credencialFrente">
                    </div>
                    <div class="contenido col-md-4">
                        <label for="credencialAtras" class="form-label">(INE) Credencial parte inferior</label>
                        <input type="file" class="formulario__input-file" name="credencialAtras" id="credencialAtras">
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
<script src="JS/documentos.js"></script>
<script src="JS/validaciones.js"></script>
<?php
include("../../../templates/footer.php");
?>
<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("../../../module/genero.php");
    include("../../../module/banco.php");
    include("../../../module/aseguradora.php");
    include("../../../module/administradora.php");
    include("../../oxigeno/pacientes/pacientesUP.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="../../../assets/css/foto_editar.css">
    <link rel="stylesheet" href="../../../assets/css/edit.css">
</head>

</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Editar datos del Paciente</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./pacientesUP.php" method="post" enctype="multipart/form-data" class="row g-3 formEdit">
                    <div class="contenido col-md-1"> <br>
                        <label for="txtID" class="form-label">Num</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId">
                    </div>

                    <div class="contenido col-md-2"> <br>
                        <label for="Nombres" class="form-label">Nombres</label>
                        <input type="text" value="<?php echo $Nombres; ?>" class="form-control" name="Nombres" id="Nombres" aria-describedby="helpId" placeholder="Nombres" required>
                    </div>

                    <div class="contenido col-md-3"> <br>
                        <label for="Apellidos" class="form-label">Apellidos</label>
                        <input type="text" value="<?php echo $Apellidos; ?>" class="form-control" name="Apellidos" id="Apellidos" aria-describedby="helpId" placeholder="Apellidos" required>
                    </div>
                    <div class="contenido col-md-3"> <br>
                        <label for="rfc" class="form-label">RFC</label>
                        <input type="text" value="<?php echo $rfc; ?>" class="form-control" name="rfc" id="rfc" aria-describedby="helpId" required>
                    </div>
                    <div class="contenido col-md-2"> <br>
                        <label for="genero" class="form-label">Género</label>
                        <select id="genero" name="genero" class="form-select">
                            <?php foreach ($lista_genero as $registro) { ?>
                                <option <?php echo ($genero == $registro['id_genero']) ? "selected" : ""; ?> value="<?php echo $registro['id_genero']; ?>">
                                    <?php echo $registro['genero']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenido col-md-1"> <br>
                        <label for="Edad" class="form-label">Edad</label>
                        <input type="number" value="<?php echo $Edad; ?>" class="form-control" name="Edad" id="Edad" aria-describedby="helpId" placeholder="Edad" required>
                    </div>
                    <div class="contenido col-md-3"> 
                        <label for="Telefono" class="form-label">Telefono</label>
                        <input type="text" value="<?php echo $Telefono; ?>" class="form-control" name="Telefono" id="Telefono " aria-describedby="helpId" placeholder="Telefono" required>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="calle" class="form-label">Calle</label>
                        <input type="text" value="<?php echo $calle; ?>" class="form-control" name="calle" id="calle" aria-describedby="helpId" placeholder="Direccion" required>
                    </div>
                    <div class="contenido col-md-2">
                        <label for="num_in" class="form-label">Núm. Int</label>
                        <input type="text" value="<?php echo $num_in; ?>" class="form-control" name="num_in" id="num_in" aria-describedby="helpId" placeholder="Direccion" required>
                    </div>
                    <div class="contenido col-md-2">
                        <label for="num_ext" class="form-label">Núm. Ext</label>
                        <input type="text" value="<?php echo $num_ext; ?>" class="form-control" name="num_ext" id="num_ext" aria-describedby="helpId" placeholder="Direccion" required>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="colonia" class="form-label">Colonia</label>
                        <input type="text" value="<?php echo $colonia; ?>" class="form-control" name="colonia" id="colonia" aria-describedby="helpId" placeholder="Direccion" required>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="municipio" class="form-label">Municipio</label>
                        <input type="text" value="<?php echo $municipio; ?>" class="form-control" name="municipio" id="municipio" aria-describedby="helpId" placeholder="Direccion" required>
                    </div>
                    <div class="contenido col-md-2">
                        <label for="cp" class="form-label">Código Postal</label>
                        <input type="text" value="<?php echo $cp; ?>" class="form-control" name="cp" id="cp" aria-describedby="helpId" placeholder="Direccion" required>
                    </div>
                    <div class="contenido col-md-3">
                        <label for="estado_direccion" class="form-label">Estado:</label>
                        <input type="text" value="<?php echo $estado_direccion; ?>" class="form-control" name="estado_direccion" id="estado_direccion" aria-describedby="helpId" placeholder="Direccion" required>
                    </div>
                    <div class="contenido col-md-6">
                        <label for="responsable" class="form-label">Responsable</label>
                        <input type="text" value="<?php echo $responsable; ?>" class="form-control" name="responsable" id="responsable" aria-describedby="helpId" placeholder="Direccion" required>
                    </div>

                    <div class="contenido col-md-3">
                        <label for="Alcaldia" class="form-label">Alcaldia</label>
                        <input type="text" value="<?php echo $Alcaldia; ?>" class="form-control" name="Alcaldia" id="Alcaldia" aria-describedby="helpId" placeholder="Alcaldia" required>
                    </div>

                    <div class="contenido col-md-3">
                        <label for="referencias" class="form-label">Referencias</label>
                        <input type="text" value="<?php echo $referencias; ?>" class="form-control" name="referencias" id="referencias" aria-describedby="helpId" placeholder="referencias" required>
                    </div>

                    <div class="contenido col-md-3">
                        <label for="Administradora" class="form-label">Administradora</label>
                        <select id="Administradora" name="Administradora" class="form-select">
                            <?php foreach ($lista_administradora as $registro) { ?>
                                <option <?php echo ($Administradora == $registro['id_administradora']) ? "selected" : ""; ?> value="<?php echo $registro['id_administradora']; ?>">
                                    <?php echo $registro['Nombre_administradora']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenido col-md-3">
                        <label for="Aseguradora" class="form-label">Aseguradora</label>
                        <select id="Aseguradora" name="Aseguradora" class="form-select">
                            <?php foreach ($lista_ase as $registro) { ?>
                                <option <?php echo ($Aseguradora == $registro['id_aseguradora']) ? "selected" : ""; ?> value="<?php echo $registro['id_aseguradora']; ?>">
                                    <?php echo $registro['Nombre_aseguradora']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenido col-md-2">
                        <label for="banco" class="form-label">Banco</label>
                        <select id="banco" name="banco" class="form-select">
                            <?php foreach ($lista_bancos as $registro) { ?>
                                <option <?php echo ($banco == $registro['id_bancos']) ? "selected" : ""; ?> value="<?php echo $registro['id_bancos']; ?>">
                                    <?php echo $registro['Nombre_banco']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="contenido col-md-4">
                        <label for="Nomina" class="form-label">No. Nomina</label>
                        <input type="text" value="<?php echo $Nomina; ?>" class="form-control" name="Nomina" id="Nomina " aria-describedby="helpId" placeholder="Nomina" required>
                    </div>

                    <div class="col-md-3">
                        <label for="comprobante" class="form-label">Comprobante de domicilio, Ver: <a href="./PAPELETA/<?php echo $Apellidos . " " . $Nombres ?>/<?php echo $comprobante; ?>"> <i class="bi bi-eye-fill"></i></a></label>
                        <label for="comprobante" class="form-label">Comprobante de domicilio</label>
                        <?php echo $comprobante; ?>
                        <input type="file" value="<?php echo $comprobante; ?>" class="form-control" name="comprobante" id="comprobante">
                    </div>

                    
                    <!--  -->
                    <div class="col-md-4">
                        <label for="Credencial_aseguradora" class="form-label">(ASEGURADORA) Credencial parte superior</label>
                        <br>
                        <div class="profile-picture-cre">
                            <div class="picture-container-cre">
                                <?php if (!empty($Credencial_aseguradora)) : ?>
                                    <img src="./PAPELETA/<?php echo $Apellidos . " " . $Nombres ?>/<?php echo $Credencial_aseguradora; ?>" alt="" id="imagenActual2" class="img-thumbnail-ine" style="width: 350px ; height: 210px;">
                                <?php else : ?>
                                    <img src="../../../img/OXILIVE.ico" alt="SIN ASEGURADORA" id="imagenActual2" class="img-thumbnail-ine" style="width: 350px ; height: 210px;">
                                <?php endif; ?>
                                <div class="overlay-cre">
                                    <label for="Credencial_aseguradora" class="change-link"><i class="fas fa-camera"></i>
                                    </label>
                                    <?php if (!empty($Credencial_aseguradora)) : ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="Credencial_aseguradora" id="Credencial_aseguradora" onchange="cambiarImagen2(event)" style="display: none;">
                    </div>
                    <div class="contenido col-md-1">
                        <label></label>
                    </div>
                    <div class="col-md-4">
                        <label for="Credencial_aseguradoras_post" class="form-label">(ASEGURADORA) Credencial parte inferior</label>
                        <br>
                        <div class="profile-picture-cre">

                            <div class="picture-container-cre">
                                <?php if (!empty($Credencial_aseguradoras_post)) : ?>
                                    <img src="./PAPELETA/<?php echo $Apellidos . " " . $Nombres ?>/<?php echo $Credencial_aseguradoras_post; ?>" alt="" id="imagenActual3" class="img-thumbnail-ine" style="width: 350px ; height: 210px;">
                                <?php else : ?>
                                    <img src="../../../img/OXILIVE.ico" alt="SIN ASEGURADORA" id="imagenActual3" class="img-thumbnail-ine" style="width: 350px ; height: 210px;">
                                <?php endif; ?>
                                <div class="overlay-cre">
                                    <label for="Credencial_aseguradoras_post" class="change-link"><i class="fas fa-camera"></i>
                                    </label>
                                    <?php if (!empty($Credencial_aseguradoras_post)) : ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <input type="file" class="form-control" name="Credencial_aseguradoras_post" id="Credencial_aseguradoras_post" onchange="cambiarImagen3(event)" style="display: none;">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-primary">Guardar</button>
                        <a role="button" onclick="mostrarAlertaCancelar()" name="cancelar" class="btn btn-outline-danger"> Cancelar</a>
                    </div>

                </form>
            </div>
        </div>
        <script src="../../../assets/js/archivosPacientes.js"></script>
        <script>
            function mostrarAlertaCancelar() {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Los cambios no se guardarán',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, cancelar',
                    cancelButtonText: 'No, continuar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redireccionar a la página de inicio o realizar alguna acción adicional
                        window.location.href = '<?php echo $url_base; ?>secciones/oxigeno/pacientes/index.php';
                    }
                })
            }
        </script>
        <?php
        include("../../../templates/footer.php");
        ?>
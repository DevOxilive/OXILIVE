<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
    include("../../connection/conexion.php");
    include("../puestos/consulta.php");
} else {
    echo "Error en el sistema";
}

$id = $_SESSION['idus'];
$sql = "SELECT * FROM empleados WHERE usuarioSistema = $id";
$loadUser = $con->prepare($sql);
$loadUser->execute();
foreach ($loadUser as $row);
?>

<main id="main" class="main">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Perfil</h3>
            <hr>
        </div>
        <div class="row">
            <div class="col-xl-3">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="<?php echo $_SESSION['foto'] ?>" style="width: 120px; height: 120px;" id="fotito" alt="Profile" class="rounded-circle">
                    <br>
                    <h5><?php echo $_SESSION['us'] ?></h5>
                    <h4>Usuario</h4>
                </div>
            </div>
            <div class="col-xl-9">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="false">Inicio</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="true">Editar</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Detalles del Perfil</h5>
                            <br>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Puesto</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php
                                    foreach ($lista_puestos as $key => $value) {
                                        if ($value['id_puestos'] === $row['departamento']) {
                                            echo  $value['Nombre_puestos'];
                                        }
                                    } ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Nombre Completo</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo $row['nombres'] . " " . $row['apellidos']; ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Teléfono uno</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo $row['telefonoUno']; ?>
                                </div>
                            </div>
                            <br>
                            <?php
                            if ($row['telefonoDos'] !== null) {
                                echo '<div class="row">';
                                echo '<div class="col-lg-3 col-md-4 label">Teléfono dos</div>
                                        <div class="col-lg-9 col-md-8">';
                                echo $row['telefonoDos'];
                                echo "</div></div>";
                                echo "<br>";
                            }
                            ?>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Correo</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo $row['correo']; ?>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                        <form action="model/editar.php" method="post" enctype="multipart/form-data">
                            <h5 class="card-title">Editar detalles del perfil</h5>
                            <div class="contenido col-md-3">
                                <center>
                                    <label for="Foto_perfil" class="form-label">Foto de perfil
                                        <div class="profile-picture">
                                            <div class="picture-container">
                                                <img src="<?php echo $_SESSION['foto'] ?>" alt="Foto de perfil" id="imagenActual" class="rounded-circle" style="width: 120px; height: 110px;">

                                                <div class="overlay">
                                                    <label for="Foto_perfil" class="change-link"><i class="fas fa-camera"></i> Nueva foto</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="file" class="form-control" name="Foto_perfil" id="Foto_perfil" onchange="cambiarImagen(event)" style="display: none;">
                                    </label>
                                </center>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="inputNombre" class="col-sm-2 col-form-label">Nombre:</label>
                                <div class="col-sm-8">
                                    <input name="" type="text" class="form-control" id="inputNombre" value="<?php echo $row['nombres']; ?>" disabled>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="inputApelldos" class="col-sm-2 col-form-label">Apellidos:</label>
                                <div class="col-sm-8">
                                    <input name="" type="text" class="form-control" id="inputApelldos" value="<?php echo $row['apellidos']; ?>" disabled>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Correo:</label>
                                <div class="col-sm-8">
                                    <input name="correo" type="email" class="form-control" maxlength="50" id="inputEmail3" placeholder="<?php
                                                                                                                            if ($row['correo'] == null) {
                                                                                                                                echo "Actualizar correo";
                                                                                                                            } else {
                                                                                                                                echo $row['correo'];
                                                                                                                            } ?>">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Password:</label>
                                <div class="col-sm-8">
                                    <input name="pass" type="password" class="form-control" id="inputPassword3" placeholder="Actualizar contraseña" maxlength="16" minlength="8">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row" id="telefonoBox">
                                <label for="telefono" class="col-sm-2 col-form-label">telefono uno:</label>
                                <div class="col-sm-8">
                                    <input name="telefonoUno" type="text" class="form-control only-numbers" id="telefonoBox" placeholder="<?php
                                                                                                                                            if ($row['telefonoUno'] == null) {
                                                                                                                                                echo "telefono uno";
                                                                                                                                            } else {
                                                                                                                                                echo $row['telefonoUno'];
                                                                                                                                            } ?>" maxlength="10" minlength="10">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row" id="telefonoDosBox">
                                <label for="telefono" class="col-sm-2 col-form-label">telefono dos:</label>
                                <div class="col-sm-8">
                                    <input name="telefonoDos" type="text" class="form-control only-numbers" id="telefonoDosBox" maxlength="10" minlength="10" placeholder="<?php
                                                                                                                                                                            if ($row['telefonoDos'] == null) {
                                                                                                                                                                                echo "telefono dos";
                                                                                                                                                                            } else {
                                                                                                                                                                                echo $row['telefonoDos'];
                                                                                                                                                                            }
                                                                                                                                                                            ?>">
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                            <button type="button" onclick="cancelar()" class="btn btn-danger">Cancelar</button>
                        </form>
                        <br>
                    </div>
                </div>
</main>
<script>
    function mostrarImagen(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imagenActual = document.getElementById("imagenActual");
                imagenActual.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function abrirSelectorArchivo(event) {
        event.preventDefault();
        var selectorArchivo = document.getElementById("Foto_perfil");
        selectorArchivo.click();
    }

    function cambiarImagen(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imagenActual = document.getElementById("imagenActual");
                imagenActual.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function eliminarImagen(event) {
        event.preventDefault();
        var imagenActual = document.getElementById("imagenActual");
        imagenActual.src = "./img/error.png";
        var selectorArchivo = document.getElementById("Foto_perfil");
        selectorArchivo.value = null;
    }

    function cancelar() {
        Swal.fire({
            title: '¿Estas seguro?',
            text: "cancelar edicion",
            cancelButtonText: 'Cancelar',
            icon: 'info',
            buttons: true,
            showCancelButton: true,
            dangerMode: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Cancelar',
            cancelButtonText: 'continuar editando'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "./account.php";
            }
        });
    }
</script>
<script src="../../Js/validacionRegex.js"></script>
<?php
include("../../templates/footer.php");
?>
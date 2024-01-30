<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
    include("../../connection/conexion.php");
    include("../../secciones/puestos/consulta.php");
    include("../../templates/hea.php");
} else {
    echo "Error en el sistema";
}
try {

    $id = $_GET['idus'];

    $sql = "SELECT id_empleado, departamento, id_usuarios, usuario, fotoPerfil 
        FROM usuarios, empleados 
        WHERE id_usuarios = $id AND usuarioSistema = $id";
    $usuarioSelect = $con->prepare($sql);
    $usuarioSelect->execute();
    $datos = $usuarioSelect->fetchAll(PDO::FETCH_ASSOC);

    foreach ($datos as $column) {
?>
        <html lang="en">
        <link rel="stylesheet" href="../../assets/css/foto_editar.css">
        <link rel="stylesheet" href="../../assets/css/edit.css">

        </html>
        <main id="main" class="main">
            <section class="section dashboard">
                <div class="card">
                    <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                        <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                            Editar datos de Usuario
                        </h4>
                    </div>
                    <div class="card-body" style="border: 2px solid #BFE5FF;"> <br>
                        <form action="./usuariosUP.php" method="POST" enctype="multipart/form-data" class="formEdit row g-3">
                            <input type="number" hidden value="<?php echo $column['id_empleado']; ?>" name="id_empleado">
                            <input type="number" hidden value="<?php echo $column['id_usuarios']; ?>" name="id_usuarios">
                            <div class="contenido col-md-3">
                                <label for="Foto_perfil" class="form-label">Foto de perfil</label> <br>
                                <div class="profile-picture">
                                    <div class="picture-container">
                                        <img src="<?php echo $column['fotoPerfil']; ?>" alt="Foto de perfil" id="imagenActual" class="img-thumbnail">

                                        <div class="overlay">
                                            <label for="Foto_perfil" class="change-link"><i class="fas fa-camera"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <input type="file" class="form-control" name="Foto_perfil" id="Foto_perfil" onchange="cambiarImagen(event)" style="display: none;">
                            </div>

                            <div class="contenido col-md-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" value="<?php echo $column['usuario']; ?>" class="form-control" name="usuario" id="usuario" placeholder="Usuario" maxlength="100" minlength="3">
                            </div>

                            <div class="contenido col-md-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" value="" class="form-control" name="password" id="password" placeholder="actualizar Contraseña" minlength="8" maxlength="12">
                            </div>

                            <div class="contenido col-md-3">
                                <label for="departamento" class="form-label">Permiso de departamento</label>
                                <select id="departamento" name="departamento" class="form-select">
                                    <?php
                                    // carga de opciones del sistema. 
                                    foreach ($lista_puestos as $key => $value) {
                                        if ($value['id_puestos'] === $column['departamento']) {
                                            echo ' <option value="' . $column['departamento'] . '">' . $value['Nombre_puestos'] . '</option> ';
                                        }
                                    }
                                    foreach ($lista_puestos as $key => $value) {
                                        if ($value['id_puestos'] != $column['departamento']) {
                                            echo ' <option value="' . $value['id_puestos'] . '">' . $value['Nombre_puestos'] . '</option> ';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-outline-primary">Guardar</button>
                                <a role="button" onclick="mostrarAlertaCancelar()" name="cancelar" class="btn btn-outline-danger">
                                    Cancelar</a>
                            </div>
                        </form>
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

            function mostrarAlertaCancelar() {
                Swal.fire({
                    title: '¿Estas seguro de cancelar?',
                    text: 'No se actualizara nada',
                    icon: 'info',
                    buttons: true,
                    showCancelButton: true,
                    dangerMode: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "./index.php";
                    }
                });
            }

            function mostrarImagen1(event) {
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var imagenActual1 = document.getElementById("imagenActual1");
                        imagenActual1.src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function abrirSelectorArchivo1(event) {
                event.preventDefault();
                var selectorArchivo1 = document.getElementById("credencialFrente");
                selectorArchivo1.click();
            }

            function cambiarImagen1(event) {
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var imagenActual1 = document.getElementById("imagenActual1");
                        imagenActual1.src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function eliminarImagen1(event) {
                event.preventDefault();
                var imagenActual1 = document.getElementById("imagenActual1");
                imagenActual1.src = "./img/error.png";
                var selectorArchivo1 = document.getElementById("credencialFrente");
                selectorArchivo1.value = null;
            }

            //    INE2
            function mostrarImagen2(event) {
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var imagenActual2 = document.getElementById("imagenActual2");
                        imagenActual2.src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function abrirSelectorArchivo2(event) {
                event.preventDefault();
                var selectorArchivo2 = document.getElementById("credencialAtras");
                selectorArchivo2.click();
            }

            function cambiarImagen2(event) {
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var imagenActual2 = document.getElementById("imagenActual2");
                        imagenActual2.src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function eliminarImagen2(event) {
                event.preventDefault();
                var imagenActual2 = document.getElementById("imagenActual2");
                imagenActual2.src = "./img/error.png";
                var selectorArchivo2 = document.getElementById("credencialAtras");
                selectorArchivo2.value = null;
            }
        </script>
    <?php
        include("../../templates/footer.php");
    }
} catch (Exception $e) {
    ?>
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "error en la obtencion de datos!",
        }).then(function() {
            window.location = "./index.php";
        });
    </script>;
<?php
}
?>
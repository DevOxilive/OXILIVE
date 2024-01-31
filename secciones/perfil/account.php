<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
    include("../../connection/conexion.php");
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
    <div class="pagetitle">
        <h1>Perfil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $url_base; ?>index.php">Inicio</a></li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="row">
            <div class="col-xl-3">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="<?php echo $_SESSION['foto'] ?>" style="width: 120px; height: 120px;" id="fotito" alt="Profile" class="rounded-circle">
                    <h2>Puesto:</h2>
                    <h3><?php echo $row['departamento']; ?></h3>
                </div>
            </div>
            <div class="col-xl-9">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Inicio</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Editar</button>
                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"></button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Detalles del Perfil</h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Nombre Completo</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo $row['nombres'] . " " . $row['apellidos']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">RFC</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo $row['rfc']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Teléfono</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo $row['telefonoUno']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Correo</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo $row['correo']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                        <h5 class="card-title">Editar detalles del perfil</h5>
                        <br>
                        <form action="">
                        <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail3" value="<?php echo $row['nombres']; ?>" disabled>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail3" value="<?php echo $row['correo']; ?>">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword3" placeholder="Nueva contraseña">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="telefono" class="col-sm-2 col-form-label">telefono</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="telefono" placeholder="telefono">
                                </div>
                            </div>
                        </form>

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Editar detalles del perfil</h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Nombre Completo</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo $row['nombres'] . " " . $row['apellidos']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">RFC</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo $row['rfc']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Teléfono</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo $row['telefonoUno']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Correo</div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo $row['correo']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">más</div>
                    <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">ricas</div>
                </div>
            </div>
        </div>
</main>
<script>
    function mostrarImagen(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var fotito = document.getElementById("fotito");
                fotito.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php
include("../../templates/footer.php");
?>
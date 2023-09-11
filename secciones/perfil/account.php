<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../module/puestos.php");
    include("../../templates/header.php");
    include("../../module/sesiones.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>

<body>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Perfil</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $url_base; ?>index.php">Inicio</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="../usuarios/OXILIVE/<?php echo $_SESSION['ape']." ".$_SESSION['no']?>/<?php echo $fot; ?>" style="width: 120px; height: 120px;" id="fotito" alt="Profile" class="rounded-circle">
                            <h2>
                                <?php echo $_SESSION['no'] ?>
                                <?php echo $_SESSION['ape'] ?>
                            </h2>
                            <h3> Puesto:
                                <?php echo $datos['Nombre_puestos'] ?>
                            </h3>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Detalles</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Detalles del Perfil</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nombre Completo</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?php echo $_SESSION['no'] ?>
                                            <?php echo $_SESSION['ape'] ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">RFC</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?php echo $_SESSION['rfc'] ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Teléfono</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?php echo $_SESSION['tel'] ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Correo</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?php echo $_SESSION['email'] ?>
                                        </div>
                                    </div>

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
</body>

</html>
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
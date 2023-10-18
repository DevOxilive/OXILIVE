<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
    include("../../connection/conexion.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
</head>
<main id="main" class="main">
    <input type="hidden" id="statusUs" name="statusUs" value="<?php echo $_SESSION['estado']; ?>">
    <div class="pagetitle">
        <h1 style="text-align: center">
             Medic<?php if ($_SESSION['genero'] == 1) { ?>o<?php } else { ?>a<?php } ?>
            <?php echo ucfirst(strtolower($_SESSION['no'])); ?>
        </h1>
        
    </div>
    <section class="section dashboard">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <div class="card">
                    <div class="card-body">
                        <img src="data:image/jpg/png;base64,<?php echo base64_encode($_SESSION['foto']) ?>" id="fot" alt="Foto de perfil" class="img-fluid mt-4">
                        <p class="mt-3" style=""> <strong style="color:brown"> Bienvenido <br>Que tenga un buen día</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




</main>

</html>
<script src="js/nextService.js"></script>
<script src="js/rangeActivity.js"></script>
<?php
include("../../templates/footer.php");
?>
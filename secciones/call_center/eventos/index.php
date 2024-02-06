<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
    exit(); // Asegúrate de salir después de redirigir para prevenir la ejecución de código adicional.
} else {
    include("../../../templates/header.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="css/buscador.css">
</head>
<main class="main" id="main">
    <section class="section">
        <div class="card card-form">
            <div class="card-header">
                <h4>Consultar Paciente</h4>
            </div>
            <div class="card-body"> <br>
                <form class="formLogin row g-3">
                    <div class="contenido col-md-12">
                        <label class="form-label fs-5">Buscar paciente:</label>
                        <input type="text" class="form-control" id="search_cliente" placeholder="Nombre del paciente" autocomplete="off">
                    </div>
                    <div class="contenido col-md-12">
                        <div class="dropdown-list" id="show-list"></div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

</html>
<script src="js/buscador.js"></script>
<?php
include("../../../templates/footer.php");
?>
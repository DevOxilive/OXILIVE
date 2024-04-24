<?php
session_start();
if (!empty($_SESSION['idus'])) {
    include("../../../templates/header.php");
    include("../../../model/administradora.php");
    include("../../../model/banco.php");
} else {
    header("location: ../../../index.php");
}
?>
<link rel="stylesheet" href="../css/checks.css">
<link rel="stylesheet" href="../css/cajaMostrar.css">
<main class="main" id="main">
    <div class="card card-form">
        <div class="card-header">
            <h4>Asignar folio.</h4>
        </div>
        <div class="card-body">
            <form action="../model/asignarFolios.php" method="post" id="formularioF">
                <br>
                <div class="row">
                    <div class="contenido col-md-6" id="selectAdmin">
                        <label for="administradora">Selecciona la administradora</label>
                        <select name="administradora" id="administradora" class="form-select">
                            <option value="" selected disabled required>Selecciona una opcion</option>
                            <?php foreach ($lista_administradora as $valores) {
                                echo '<option value="' . $valores['Nombre_administradora'] . '">' . $valores['Nombre_administradora'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="contenido col-md-6" id="selectBanco">
                        <label for="bancos">Selecciona el banco</label>
                        <select name="bancos" id="bancos" class="form-select">
                            <option value="" selected disabled required>Selecciona una opcion</option>
                            <?php foreach ($lista_bancos as $valores) {
                                echo '<option value="' . $valores['Nombre_banco'] . '">' . $valores['Nombre_banco'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="contenido col-md-6">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" class="form-select">
                            <option value="" selected disabled required>Selecciona una opción</option>
                            <option value="CONSULTA">CONSULTA</option>
                            <option value="RECETA">RECETA</option>
                        </select>
                    </div>
                    <!-- por revisar-->
                    <div class="contenido col-md-6">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" name="cant" id="cant" min="1" max="50" required>
                    </div>
                </div>
                <hr>
                <h1>Folios disponibles</h1>
                <div class="col-md-12" id="verFolios">
                    <h5>Selecciona las características del folio</h5>
                    <!-- aqui se generan los folios con las especicaciones -->
                </div>
                <br>
                <div class="contenido col-md-6">
                    <button type="submit" id="botonEnvio" class="btn btn-outline-info">enviar</button>
                    <button type="button" onclick="cancelar()" class="btn btn-outline-danger">cancelar</button>
                </div>
            </form>
        </div>
    </div>
</main>
<script src="../js/cargaFolios.js"></script>
<script>
    function cancelar() {
        swal.fire({
            title: '¿Estas seguro de cancelar?',
            text: 'No se actualizara nada',
            icon: 'info',
            buttons: true,
            showCancelButton: true,
            dangerMode: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Cancelar',
            cancelButtonText: 'No, Continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "../index.php";
            }
        });
    }
</script>
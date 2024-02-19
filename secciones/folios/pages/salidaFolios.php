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
<main class="main" id="main">
    <div class="card card-form">
        <div class="card-header">
            <h4>Asignar folio.</h4>
        </div>
        <div class="card-body">
            <form action="../model/asignarFolios.php" method="post">
                <br>
                <div class="row">
                    <div class="contenido col-md-6" id="selectAdmin">
                        <label for="administradora">Selecciona la administradora</label>
                        <select name="administradora" id="administradora">
                            <?php foreach ($lista_administradora as $valores) {
                                echo '<option value="' . $valores['Nombre_administradora'] . '">' . $valores['Nombre_administradora'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="contenido col-md-6" id="selectBanco">
                        <label for="bancos">Selecciona el banco</label>
                        <select name="bancos" id="bancos">
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
                        <label for="tipo">tipo</label>
                        <select name="tipo" id="tipo">
                            <option value="CONSULTA">CONSULTA</option>
                            <option value="RECETA">RECETA</option>
                        </select>
                    </div>
                    <!-- por revisar-->
                    <div class="contenido col-md-6">
                        <label for="cantidad">cantidad</label>
                        <input type="number" name="cant" id="cant" min="1" max="50">
                    </div>
                </div>
                <hr>
                <h1>folios disponibles</h1>
                <div class="col-md-12" id="verFolios">
                    <h5>selecciona las caracteristicas del folio</h5>
                    <!-- aqui se generan los folios con las especicaciones -->
                </div>
                <br>
                <div class="contenido col-md-6">
                    <button type="submit">enviar</button>
                    <button type="button">cancelar</button>
                </div>
            </form>
        </div>
    </div>
</main>
<script src="../js/cargaFolios.js"></script>
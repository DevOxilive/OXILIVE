<?php
session_start();
if (!empty($_SESSION['idus'])) {
    include("../../../templates/header.php");
    include("../../../model/banco.php");
} else {
    header("location: ../../../index.php");
}
?>
<div class="main" id="main">
    <div class="card card-form">
        <div class="card-header">
            <h4>Nuevo Folio</h4>
        </div>
        <div class="card-body">
            <form action="../model/cargarFolios.php" method="post" style="margin: 10px;" novalidate id="formulario">
                <div class="row">
                    <div class="contenido col-md-4" id="nombreFolioBox">
                        <label for="nombreFolio" class="form-label">Nombre del folio: </label>
                        <input type="text" name="nombreFolio" id="nombreFolio" class="form-control letters-and-numbers" minlength="4" maxlength="30" required placeholder="ejemplo: folios de almacen">
                    </div>
                    <br>
                    <div class="contenido col-md-4" id="idFolioBox">
                        <label for="idFolio" class="form-label">Cuerpo del folio: </label>
                        <input type="text" name="idFolio" id="idFolio" class="form-control letters-and-numbers" minlength="4" maxlength="30" required placeholder="ejemplo: B100">
                    </div>
                    <br>
                    <div class="contenido col-md-4" id="bancoBox">
                        <label for="bonco" class="form-label">Banco As: </label>
                        <select name="banco" id="banco">
                            <?php foreach ($lista_bancos as $bancos) { ?>
                                <option value="<?php echo $bancos['id_bancos'] ?>"><?php echo $bancos['Nombre_banco'] ?></option>
                            <?php } ?>
                        </select required>
                    </div>
                </div>
                <br>
                <hr>
                <h3>Rango del folios</h3>
                <br>
                <div class="row">
                    <div class="contenido col-md-5" id="inicioFolioBox">
                        <label for="nombreFolio" class="form-label">inicio de folio: </label>
                        <input type="text" name="inicioFolio" id="inicioFolio" class="form-control only-numbers" minlength="1" maxlength="3" required placeholder="cantidad de inicio">
                    </div>
                    <br>
                    <div class="contenido col-md-5" id="rangoFolioBox">
                        <label for="rangoFolio" class="form-label">termino de folio: </label>
                        <input type="text" name="rangoFolio" id="rangoFolio" class="form-control only-numbers" minlength="1" maxlength="3" required placeholder="cantidad de folios max">
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-outline-info">Guardar</button>
                <button class="btn btn-outline-danger">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<?php
include("../../../templates/footer.php");
?>
<script src="../../../Js/validacionRegex.js"></script>
<script src="../../../Js/validacionEnvio.js"></script>
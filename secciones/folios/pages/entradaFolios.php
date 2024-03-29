<?php
session_start();
if (!empty($_SESSION['idus'])) {
    include("../../../templates/header.php");
    include("../../../model/banco.php");
    include("../../../model/administradora.php");
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
                    <div class="contenido col-md-6" id="tipofolioBox">
                        <label for="tipofolio" class="form-label">tipo de folio: </label>
                        <select name="tipofolio" id="tipofolio">
                            <option value="CONSULTA">CONSULTA</option>
                            <option value="RECETA">RECETA</option>
                        </select>
                    </div>
                    <br>
                    <div class="contenido col-md-6" id="cuerpoBox">
                        <label for="cuerpo" class="form-label">Cuerpo del folio: </label>
                        <input type="text" name="cuerpo" id="cuerpo" class="form-control letters-and-numbers" minlength="4" maxlength="30" required placeholder="ejemplo: B100">
                    </div>
                    <br>
                    <div class="contenido col-md-6" id="bancoBox">
                        <label for="bonco" class="form-label">Banco As: </label>
                        <select name="banco" id="banco">
                            <?php foreach ($lista_bancos as $bancos) { ?>
                                <option value="<?php echo $bancos['Nombre_banco'] ?>"><?php echo $bancos['Nombre_banco'] ?></option>
                            <?php } ?>
                        </select required>
                    </div>
                    <br>
                    <div class="contenido col-md-6" id="admonistradoraBox">
                        <label for="administradora" class="form-label">Administradora As: </label>
                        <select name="administradora" id="administradora">
                            <?php foreach ($lista_administradora as $administradora) { ?>
                                <option value="<?php echo $administradora['Nombre_administradora'] ?>"><?php echo $administradora['Nombre_administradora'] ?></option>
                            <?php  } ?>
                        </select required>
                    </div>
                </div>

                <br>
                <hr>
                <h3>Rango del folios</h3>
                <br>
                <div class="row">
                    <div class="contenido col-md-6" id="inicioFolioBox">
                        <label for="inicioFolio" class="form-label">inicio de folio: </label>
                        <input type="text" name="inicioFolio" id="inicioFolio" class="form-control only-numbers" minlength="1" maxlength="3" required placeholder="cantidad de inicio">
                    </div>
                    <br>
                    <div class="contenido col-md-6" id="rangoFolioBox">
                        <label for="rangoFolio" class="form-label">termino de folio: </label>
                        <input type="text" name="rangoFolio" id="rangoFolio" class="form-control only-numbers" minlength="1" maxlength="3" required placeholder="cantidad de folios max">
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-outline-info">Guardar</button>
                <button type="button" onclick="mostrarAlertaCancelar()" class="btn btn-outline-danger">Cancelar</button>
            </form>
        </div>
    </div>
</div>
<?php
include("../../../templates/footer.php");
?>
<script src="../../../Js/validacionRegex.js"></script>
<script src="../../../Js/validacionEnvio.js"></script>
<script>
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
            confirmButtonText: 'Si, Cancelar',
            cancelButtonText: 'No, Continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "../index.php";
            }
        });
    }
</script>
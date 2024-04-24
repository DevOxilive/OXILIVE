<?php
session_start();
if (!empty($_SESSION['idus'])) {
    include("../../../templates/header.php");
    include("../../../model/banco.php");
    include("../../../model/administradora.php");
    include('../../../templates/hea.php');
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
                        <label for="tipofolio" class="form-label">Tipo de folio: </label>
                        <select name="tipofolio" id="tipofolio" class="form-select">
                            <option value="CONSULTA">CONSULTA</option>
                            <option value="RECETA">RECETA</option>
                        </select>
                    </div>
                    <br>
                    <div class="contenido col-md-6" id="cuerpoBox">
                        <label for="cuerpo" class="form-label">Cuerpo del folio: </label>
                        <input type="text" name="cuerpo" id="cuerpo" class="form-control letters-and-numbers" minlength="4" maxlength="30" required placeholder="Ejemplo: B100">
                    </div>
                    <br>
                    <div class="contenido col-md-6" id="admonistradoraBox">
                        <label for="administradora" class="form-label">Administradora As: </label>
                        <select name="administradora" id="administradora" class="form-select">
                            <option value="">SELECCIONA ADMINISTRADORA</option>
                            <?php foreach ($lista_administradora as $administradora) { ?>
                                <option value="<?php echo $administradora['Nombre_administradora'] ?>"><?php echo $administradora['Nombre_administradora'] ?></option>
                            <?php  } ?>
                        </select required>
                    </div>
                    <br>
                    <div class="contenido col-md-6" id="bancoBox">
                        <label for="banco" class="form-label">Banco As: </label>
                        <select name="banco" id="banco" class="form-select">
                            <option value="">SELECCIONA BANCO</option>
                            <?php foreach ($lista_bancos as $bancos) { ?>
                                <option value="<?php echo $bancos['Nombre_banco'] ?>"><?php echo $bancos['Nombre_banco'] ?></option>
                            <?php } ?>
                        </select required>
                    </div>

                </div>

                <br>
                <hr>
                <h3>Rango del Folio</h3>
                <br>
                <div class="row">
                    <div class="contenido col-md-6" id="inicioFolioBox">
                        <label for="inicioFolio" class="form-label">Inicio de Folio: </label>
                        <input type="text" name="inicioFolio" id="inicioFolio" class="form-control only-numbers" minlength="1" maxlength="3" required placeholder="Cantidad de inicio">
                    </div>
                    <br>
                    <div class="contenido col-md-6" id="rangoFolioBox">
                        <label for="rangoFolio" class="form-label">Término de folio: </label>
                        <input type="text" name="rangoFolio" id="rangoFolio" class="form-control only-numbers" minlength="1" maxlength="3" required placeholder="Cantidad de término">
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
<script src="../../../js/validacionRegex.js"></script>
<script src="../../../js/validacionEnvio.js"></script>
<script>
    function mostrarAlertaCancelar() {
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
<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../connection/conexion.php");
    include("../../../templates/header.php");
    include("./consulta.php");
    include("./insumoUP.php");
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../assets/css/edit.css">
</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Editar datos del Insumo</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
            <form action="./insumoUP.php" method="POST" class="row g-3 formEdit">
                <div class="contenido col-md-1"> <br>
                    <label for="txtID" class="form-label">Núm</label>
                    <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId">
                </div>
                <div class="contenido col-md-3"> <br>
                    <label for="marca_insumo" class="form-label">Marca del insumo</label>
                    <select id="marca_insumo" name="marca_insumo" class="form-select">
                        <?php foreach ($lista_marca as $mar) { ?>
                            <option <?php echo ($marca_insumo == $mar['id_marca']) ? "selected" : ""; ?> value="<?php echo $mar['id_marca']; ?>">
                                <?php echo $mar['marca_insumo'];  ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="contenido col-md-3"> <br>
                    <label for="estado_insumo" class="form-label">Estado del insumo</label>
                    <select id="estado_insumo" name="estado_insumo" class="form-select">
                        <?php foreach ($lista_estado as $esta) { ?>
                            <option <?php echo ($estado_insumo == $esta['id_estado']) ? "selected" : ""; ?> value="<?php echo $esta['id_estado']; ?>">
                                <?php echo $esta['estado_insumo'];  ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="contenido col-md-3"> <br>
                    <label for="tamano_insumo" class="form-label">Tamaño del tanque</label>
                    <select id="tamano_insumo" name="tamano_insumo" class="form-select">
                        <?php foreach ($lista_tama as $tama) { ?>
                            <option <?php echo ($tamano_insumo == $tama['id_tamano']) ? "selected" : ""; ?> value="<?php echo $tama['id_tamano']; ?>">
                                <?php echo $tama['tamano_insumo'];  ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="contenido col-md-4">
                    <label for="cantidad_insumo" class="form-label">Cantidad</label>
                    <input type="text" value="<?php echo $cantidad_insumo; ?>" class="form-control" name="cantidad_insumo" id="cantidad_insumo">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-outline-primary">Guardar</button>
                    <a role="button" onclick="mostrarAlertaCancelar()" name="cancelar" class="btn btn-outline-danger"> Cancelar</a>
                </div>
            </form>
        </div>
        </div>
</main>
<script>
    function mostrarAlertaCancelar() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Los cambios no se guardarán',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cancelar',
            cancelButtonText: 'No, continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?php echo $url_base; ?>secciones/oxigeno/insumos/index.php';
            }
        })
    }
</script>
<?php
include("../../../templates/footer.php");
?>
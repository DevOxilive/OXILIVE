<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
    include("../aseguradoras/aseguradoraUP.php");
    include("../../module/administradora.php");
} else {
    echo "Error en el sistema";
}

?>
<html>
<link rel="stylesheet" href="../../assets/css/edit.css">

</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Editar aseguradora</H4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./aseguradoraUP.php" method="POST" class="row g-3 formEdit">
                    <div class="contenido col-md-1"> <br>
                        <label for="txtID" class="form-label">Num</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId">
                    </div>

                    <div class="contenido col-md-6"> <br>
                        <label for="Nombre_aseguradora" class="form-label">Nombre</label>
                        <input type="text" value="<?php echo $Nombre_aseguradora; ?>" class="form-control" name="Nombre_aseguradora" id="Nombre_aseguradora" placeholder="Nombre aseguradora" required>
                    </div>
                    <div class="contenido col-md-3"> <br>
                        <label for="administradora" class="form-label">Administradora</label>
                        <select id="administradora" name="administradora" class="form-select">
                            <?php foreach ($lista_administradora as $registro) { ?>
                            <option <?php echo ($administradora == $registro['id_administradora']) ? "selected" : ""; ?>
                                value="<?php echo $registro['id_administradora']; ?>">
                                <?php echo $registro['Nombre_administradora']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-success">Guardar</button>
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
                window.location.href = '<?php echo $url_base; ?>secciones/aseguradoras/index.php';
            }
        })
    }
</script>
<?php
include("../../templates/footer.php");
?>
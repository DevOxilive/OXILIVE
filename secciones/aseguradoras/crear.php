<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
    include("../../connection/conexion.php");
    include("../../module/administradora.php");
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../assets/css/vali.css">
<link rel="stylesheet" href="../../assets/css/edit.css">

</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos de la nueva aseguradora</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./aseguradoraADD.php" method="POST" enctype="multipart/form-data" class="formLogin row g-3" id="formulario">
                    <div class="contenido col-md-5">
                        <br>
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="Nombre_aseguradora" class="formulario__label">Nombe de la aseguradora</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="Nombre_aseguradora" id="Nombre_aseguradora" placeholder="Nombre aseguradora">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-4">
                        <br>
                        <label for="administradora" class="formulario__label">Administradora a la que
                            pertenece</label>
                        <select id="administradora" name="administradora" class="form-select">
                        <option value="0" selected disabled>Elija una opción</option>
                            <?php foreach ($lista_administradora as $admin) { ?>
                                <option value="<?php echo $admin['id_administradora']; ?>">
                                    <?php echo $admin['Nombre_administradora']; ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-success">Guardar</button>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
</main>
<script>
    function confirmCancel(event) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Si cancelas, se perderán los datos ingresados.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cancelar',
            cancelButtonText: 'No, continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo $url_base; ?>secciones/aseguradoras/index.php";
            }
        });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.formLogin').addEventListener('submit', function(event) {
            event.preventDefault();

            // Verifica si los campos obligatorios están vacíos
            var Nombre_aseguradora = document.getElementById('Nombre_aseguradora').value;
            var administradora = document.getElementById('administradora').value;

            if (!Nombre_aseguradora || !administradora) {
                Swal.fire({
                    icon: 'error',
                    title: 'Campos vacíos',
                    text: 'Por favor, completa todos los campos obligatorios.',
                });
            } else {
                this.submit();
            }
        });
    });
</script>
<?php
include("../../templates/footer.php");
?>
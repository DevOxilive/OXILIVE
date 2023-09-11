<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../assets/css/vali.css">

</html>
<main id="main" class="main">
    <div class="card">
        <div class="card-header" style="border: 2px solid #012970; background: #005880;">
            <h4
                style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                Datos del nuevo puesto</h4>
        </div>
        <div class="card-body" style="border: 2px solid #BFE5FF;">
            <form action="./puestosADD.php" method="POST" enctype="multipart/form-data" class="formLogin row g-3"
                id="formulario">
                <div class="contenido col-md-6">
                    <br>
                    <div class="formulario__grupo" id="grupo__Nombredelpuestos">
                        <label for="Nombredelpuestos" class="formulario-label">Nombre Puesto</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="Nombredelpuestos" id="Nombredelpuestos"
                                placeholder="Nombre del puesto">
                        </div>
                    </div>
                </div>
                <br>
                <div class="formulario__grupo formulario__grupo-btn-enviar">
                    <button type="submit" class="btn btn-outline-success">Guardar</button>
                    <a name="registrar" id="" class="btn btn-outline-danger" onclick="confirmCancel(event)"
                        role="button">Cancelar</a>
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
                window.location.href = "<?php echo $url_base; ?>secciones/puestos/index.php";
            }
        });
    }
</script>
<!-- ESTA ALERTA SIRVE PARA NO PERMITIR NINGUN CAMPO VACIO -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.formLogin').addEventListener('submit', function(event) {
            event.preventDefault();
            // Verifica si los campos obligatorios están vacíos
            var Nombredelpuestos = document.getElementById('Nombredelpuestos').value;
            if (!Nombredelpuestos) {
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
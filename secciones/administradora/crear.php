<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
    include("administradoraADD.php");
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../assets/css/vali.css">

</html>
<main id="main" class="main">

    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos de la nueva Administradora</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./administradoraADD.php" method="POST" class="formLogin" id="formulario">
                    <div class="contenido col-md-6"> <br>
                        <label for="Nombre_administradora" class="form-label">
                            Nombre de la administradora
                        </label>
                        <input type="text" class="form-control" name="Nombre_administradora" id="Nombre_administradora" placeholder="Nombre administradora">
                    </div>
                    <br>
                    <div class="card-footer text-muted">
                        <div class="formulario__grupo formulario__grupo-btn-enviar">
                            <button type="submit" class="btn btn-outline-success">Guardar</button>
                            <a name="registrar" id="" class="btn btn-outline-danger" onclick="confirmCancel(event)" role="button">Cancelar</a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
</main>
<!-- ESTO SIRVE PARA LA ALERTA DE CANCELAR, SE MANEJA CON SWEET ALERT -->
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
                window.location.href = "<?php echo $url_base; ?>secciones/administradora/index.php";
            }
        });
    }
</script>
<!-- ESTA ALERTA SIRVE PARA NO PERMITIR NINGUN CAMPO VACIO -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var nombreAdministradoraInput = document.getElementById('Nombre_administradora');
        function validarCampo() {
            var valorCampo = nombreAdministradoraInput.value;
            if (valorCampo.length < 3) {
                nombreAdministradoraInput.style.borderColor = 'red';
            } else {
                nombreAdministradoraInput.style.borderColor = '';
            }
        }
        nombreAdministradoraInput.addEventListener('input', validarCampo);
        document.querySelector('.formLogin').addEventListener('submit', function(event) {
            var Nombre_administradora = nombreAdministradoraInput.value;
            if (Nombre_administradora.length < 3) {
                Swal.fire({
                    icon: 'error',
                    title: 'Administradora Vacía',
                    text: 'Por favor, complete el campo min 3 letras.',
                });
                nombreAdministradoraInput.style.borderColor = 'red';
                event.preventDefault();
                return;
            }
            this.submit();
        });
    });
</script>

<?php
include("../../templates/footer.php");
?>
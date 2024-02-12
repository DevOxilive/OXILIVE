<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../assets/css/vali.css">

</html>
<main id="main" class="main">

    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos del nuevo carro</H4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./carrosADD.php" method="POST" class="formLogin row g-3" id="formulario">

                    <div class="contenido col-md-6"> <br>
                        <div class="formulario__grupo" id="grupo__Nombre_carro">
                            <label for="Nombre_carro" class="form-label">Nombre del carro</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="Nombre_carro" id="Nombre_carro" placeholder="Eje: Aveo">
                            </div>
                        </div>
                    </div>

                    <div class="contenido col-md-6"> <br>
                        <div class="formulario__grupo" id="grupo__Nombredelmodelo">
                            <label for="Nombredelmodelo" class="form-label">Modelo</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="Nombredelmodelo" id="Nombredelmodelo" placeholder="Eje: Aveo">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-6">
                        <div class="formulario__grupo" id="grupo__Marca">
                            <label for="Marca" class="formulario-label">Marca</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="Marca" id="Marca" placeholder="Eje: Chevrolet">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__Placas">
                            <label for="Placas" class="formulario-label">Placas</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="Placas" id="Placas" placeholder="Eje: MUG-13-13">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="formulario__grupo formulario__grupo-btn-enviar">
                            <button type="submit" class="btn btn-outline-success">Guardar</button>
                            <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger"> Cancelar</a>
                        </div>
                </form>
            </div>
        </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.formLogin').addEventListener('submit', function(event) {
            event.preventDefault();

            // Verifica si los campos obligatorios están vacíos
            var Nombre_carro = document.getElementById('Nombre_carro').value;
            var Nombredelmodelo = document.getElementById('Nombredelmodelo').value;
            var Marca = document.getElementById('Marca').value;
            var Placas = document.getElementById('Placas').value;

            if (!Nombre_carro || !Nombredelmodelo || !Marca || !Placas) {
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
                window.location.href = "<?php echo $url_base; ?>secciones/oxigeno/carros/index.php";
            }
        });
    }
</script>
<?php
include("../../../templates/footer.php");
?>
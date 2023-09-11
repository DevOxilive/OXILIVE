<?php
session_start();
if (!isset($_SESSION['us'])) {
    session_start();
    session_destroy();
    header('Location: ../../login.php');
} elseif(isset($_SESSION['us'])){
    include ("../../templates/header.php");
    include ("../../connection/conexion.php");
}else{
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
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos del nuevo Banco</H4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./bancoADD.php" method="POST" class="formLogin row g-3" id="formulario">
                    <div class="contenido col-md-6"> <br>
                        <div class="formulario__grupo" id="grupo__Nombre_banco">
                            <label for="Nombre_banco" class="formulario-label">Nombre del banco</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="Nombre_banco" id="Nombre_banco"
                                    placeholder="Nombre del banco">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="contenido col-12">
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
            window.location.href = "<?php echo $url_base; ?>secciones/bancos/index.php";
        }
    });
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.formLogin').addEventListener('submit', function(event) {
            event.preventDefault();

            // Verifica si los campos obligatorios están vacíos
            var Nombre_banco = document.getElementById('Nombre_banco').value;

            if (!Nombre_banco) {
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
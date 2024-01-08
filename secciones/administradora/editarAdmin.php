<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../templates/header.php");
    include("editarAdminUP.php");
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
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos de la nueva Administradora</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="editarAdminUP.php" method="POST" class="formLogin" id="formulario">
                    <div class="row">
                        <div class="contenido col-md-1"> <br>
                        <label for="Nombre_administradora" class="formulario__label">No.</label>
                            <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID"
                                id="txtID" aria-describedby="helpId">
                        </div>
                        <div class="contenido col-md-6"> <br>
                            <div class="formulario__grupo" id="grupo__Nombre_administradora">
                                <label for="Nombre_administradora" class="formulario__label">Nombre de la
                                    Administradora</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" class="formulario__input" value="<?php echo $administradora ?>"
                                        name="Nombre_administradora" id="Nombre_administradora">
                                </div>
                            </div>
                        </div>
                    </div>


                    <br>
                    <div class="card-footer text-muted">
                        <div class="formulario__grupo formulario__grupo-btn-enviar">
                            <button type="submit" class="btn btn-outline-success">Guardar</button>
                            <a name="registrar" id="" class="btn btn-outline-danger" onclick="confirmCancel(event)"
                                role="button">Cancelar</a>

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
    document.querySelector('.formLogin').addEventListener('submit', function(event) {
        event.preventDefault();
        // Verifica si los campos obligatorios están vacíos
        var Nombre_administradora = document.getElementById('Nombre_administradora').value;
        if (!Nombre_administradora) {
            Swal.fire({
                icon: 'error',
                title: 'Administradora Vacia',
                text: 'Por favor, complete el campo.',
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
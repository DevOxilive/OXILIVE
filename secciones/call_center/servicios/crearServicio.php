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
<!--trae los estilos-->
<link rel="stylesheet" href="../../../assets/css/vali.css">
<link rel="stylesheet" href="../../../assets/css/edit.css">

</html>

<!--formulario para crear nuevo servicio-->
<main id="main" class="main">

    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #005880; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos del nuevo servicio</H4>
            </div>
            <div class="card-body" style="border: 12px solid #005880;">
                <form action="./model/agregarServicio.php" method="POST" class="formLogin row g-3" id="formulario">

                    <div class="contenido col-md-6"> <br>
                        <div class="formulario__grupo" id="grupo__nomServicio">
                            <label for="nomServicio" class="form-label">Nombre del servicio</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="nomServicio" id="nomServicio"
                                    placeholder="Eje: VISITA MEDICA DOMICILIARIA">
                            </div>
                        </div>
                    </div>

                    <div class="contenido col-md-6"> <br>
                        <div class="formulario__grupo" id="grupo__descripServicio">
                            <label for="descripServicio" class="form-label">Descripcion del servicio</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="descripServicio" id="descripServicio"
                                    placeholder="Eje: horario de 07:00 a las 20:00 hrs. ">
                            </div>
                        </div>
                    </div>
                    <!--botones que realizan las acciones de guarda y cancelar-->
                    <div class="col-12">
                        <div class="formulario__grupo formulario__grupo-btn-enviar">
                            <button type="submit" class="btn btn-outline-success">Guardar</button>
                            <a role="button" onclick="confirmCancel(event)" name="cancelar"
                                class="btn btn-outline-danger"> Cancelar</a>
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
        var nomServicio = document.getElementById('nomServicio').value;


        if (!nomServicio) {
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
            window.location.href = "<?php echo $url_base; ?>secciones/call_center/servicios/index.php";
        }
    });
}
</script>
<?php
include("../../../templates/footer.php");
?>
<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    include("consulta.php");
    include("./crearADD.php");
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../../assets/css/vali.css">
<link rel="stylesheet" href="../../../../assets/css/edit.css">

</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Captura del CPT Segun la administradora</h4>
            </div>

            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./crearADD.php" method="POST" enctype="multipart/form-data" class="formLogin row g-3"
                    id="formulario">
                    <div class="contenido col-md-4">
                        <label for="administradora" class="formulario__label">Administradora a la que
                            pertenece</label>
                        <select id="administradora" name="administradora" class="form-select">
                            <option value="0" selected disabled>Elija una opción</option>
                            <?php foreach ($lis_admi as $listAdmin) { ?>
                            <option value="<?php echo $listAdmin['id_administradora']; ?>">
                                <?php echo $listAdmin['Nombre_administradora']; ?>
                            </option>
                            <?php } ?>

                        </select>
                    </div>

                    <!---->
                    <div class="col-md-2 align-self-center">
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="cpt" class="formulario__label text-left">CPT</label>
                            <div class="formulario__grupo-input">
                                <input type="text" name="cpt[]" class="form-control " placeholder="Ejemplo E20B-21-ND"
                                   required >
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="descripcion" class="formulario__label text-left">descripcion</label>
                            <div class="formulario__grupo-input">
                                <input type="text" name="descripcion[]" class="form-control "
                                    placeholder="Apoyo General 8 Horas" required >
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="unidad" class="formulario__label text-left">Unidad</label>
                            <div class="formulario__grupo-input">
                                <input type="text" name="unidad[]" class="form-control " placeholder="Turno 8 Horas"
                                required>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="code" class="text-left"></label>
                            <div class="formulario__grupo-input">
                                <button class="btn add-btn btn-info">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="newData"></div>
                    <!--aquí terminan las pruebas-->
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-success">Guardar</button>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
</main>
<!--Este escript es para generar los input-->
<!-- Incluye SweetAlert2 desde un CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.formLogin').addEventListener('submit', function(event) {
        event.preventDefault();

        var administradora = document.getElementById('administradora').value;
        var numCampos = document.querySelectorAll('.form-row').length;
        var camposIncompletos = false;
        var campos = document.querySelectorAll('.form-row');

        for (var i = 0; i < campos.length; i++) {
            var cptInput = campos[i].querySelector('input[name="cpt[]"]').value.trim();
            var descripcionInput = campos[i].querySelector('input[name="descripcion[]"]').value.trim();
            var unidadInput = campos[i].querySelector('input[name="unidad[]"]').value.trim();

            if (cptInput === "" || descripcionInput === "" || unidadInput === "") {
                camposIncompletos = true;
                break;
            }
        }

        if (administradora === "0") {
            Swal.fire({
                icon: 'error',
                title: 'Campo Administradora requerido',
                text: 'Por favor, seleccione una administradora.',
            });
        } else if (camposIncompletos) {
            Swal.fire({
                icon: 'error',
                title: 'Campos CPT, Descripción y Unidad requeridos',
                text: 'Por favor, complete todos los campos CPT, Descripción y Unidad en cada conjunto.',
            });
        } else {
            this.submit();
        }
    });
});
</script>




<script type="text/javascript">
$(function() {
    var maxDivs = 5; // Cambiar el límite a 6
    $('.add-btn').click(function(e) {
        e.preventDefault();
        
        // Verifica si se ha alcanzado el límite
        if ($('.newData .form-row').length < maxDivs) {
            var i = $('.newData .form-row').length + 2;
            
            var newDiv = $('<div class="form-row" id="cpt' + i + '">');
            newDiv.html(
                '<div class="col-md-6">' +
                '<div class="row">' +
                '<div class="col-md-6">' +
                '<label class="mb-0">CPT</label> ' + i +
                '<input type="text" name="cpt[]" value="" class="form-control required">' +
                '</div>' +
                '<div class="col-md-6">' +
                '<label class="mb-0">Descripción</label>' +
                '<input type="text" name="descripcion[]" value="" class="form-control required">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-4">' +
                '<label class="mb-0">Unidad</label>' +
                '<div class="input-group">' +
                '<input type="text" name="unidad[]" value="" class="form-control required">' +
                '<div class="input-group-append">' +
                '<a href="#" class="btn add-btn btn-info remove-lnk" data-id="' + i + '"> <i class="fas fa-trash-alt"></i></a>' +
                '</div>' +
                '</div>' +
                '</div>'
            );
            
            $('.newData').append(newDiv);
        } else {
            alert("No se pueden agregar más CPTS.");
        }
    });
    
    $(document).on('click', '.remove-lnk', function(e) {
        e.preventDefault();

        var id = $(this).data("id");
        $('#cpt' + id).remove();
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
            window.location.href = "<?php echo $url_base; ?>secciones/enfermeria/alta/cpts/index.php";
        }
    });
}
</script>




<?php
include("../../../../templates/footer.php");
?>
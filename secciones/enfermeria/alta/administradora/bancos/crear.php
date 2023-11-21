<?php
session_start();
if (!isset($_SESSION['us'])) {
    session_start();
    session_destroy();
    header('Location: ../../login.php');
} elseif(isset($_SESSION['us'])){
    include ("../../../../../templates/header.php");
    include ("../../../../../connection/conexion.php");
    include("consulta.php");
}else{
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../../../assets/css/vali.css">

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

                    <div class="contenido col-md-4">
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

                    <div class="contenido col-md-6"> 
                        <div class="formulario__grupo" id="grupo__Nombre_banco">
                        <label for="administradora" class="formulario__label">Nombre del banco</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="Nombre_banco[]" id="Nombre_banco"
                                    placeholder="Nombre del banco">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 align-self-center">
                        <br>
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="code" class="text-left"></label>
                            <div class="formulario__grupo-input">
                                <button class="btn add-btn btn-info">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="newData"></div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
$(function() {
    var maxDivs = 50; // Cambiar el límite a 6
    $('.add-btn').click(function(e) {
        e.preventDefault();

        // Verifica si se ha alcanzado el límite
        if ($('.newData .form-row').length < maxDivs) {
            var i = $('.newData .form-row').length + 2;

            var newDiv = $('<div class="form-row" id="codigo' + i + '">');
            newDiv.html(
                '<div class="col-md-12">' +
                '<div class="row">' +
                '<div class="col-md-6">' +
                '<label class="mb-0">Banco</label> ' + i +
                '<div class="input-group">' +
                '<input type="text" name="Nombre_banco[]" value="" class="form-control required">' +
                '<div class="input-group-append">' +
                '<a href="#" class="btn add-btn btn-info remove-lnk" data-id="' + i +
                '"> <i class="fas fa-trash-alt"></i></a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>'
            );

            $('.newData').append(newDiv);
        } else {
            alert("No se pueden agregar más Código.");
        }
    });

    $(document).on('click', '.remove-lnk', function(e) {
        e.preventDefault();

        var id = $(this).data("id");
        $('#codigo' + id).remove();
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
            window.location.href = "<?php echo $url_base; ?>secciones/enfermeria/alta/administradora/index.php";
        }
    });
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var nombreBancoInput = document.getElementById('Nombre_banco');
        var administradoraSelect  = document.getElementById('administradora');

        function validarCampoSelect() {
            var valorSelect = administradoraSelect.value;
            if (valorSelect === '0') {
                administradoraSelect.style.borderColor = 'red';
            } else {
                administradoraSelect.style.borderColor = '';
            }
        }

        function validarCampo() {
            var valorCampo = nombreBancoInput.value;
            if (!valorCampo.trim()) {
                nombreBancoInput.style.borderColor = 'red';
            } else {
                nombreBancoInput.style.borderColor = '';
            }
        }
        // Agregar un event listener para el evento de cambio en el campo de entrada
        nombreBancoInput.addEventListener('input', validarCampo);
        administradoraSelect.addEventListener('change', validarCampoSelect);

        document.querySelector('.formLogin').addEventListener('submit', function(event) {
            event.preventDefault();
            var Nombre_banco = nombreBancoInput.value;
            var valorSelect = administradoraSelect.value;
            // Validar si el campo está vacío
            if (!Nombre_banco.trim()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Campo Vacío',
                    text: 'Por favor, completa el campo.',
                });
                nombreBancoInput.style.borderColor = 'red';
                 administradoraSelect.style.borderColor = 'red';
                return;
            }

            // Si el campo no está vacío, enviar el formulario
            this.submit();
        });
    });
</script>

<?php
include("../../../../../templates/footer.php");
?>
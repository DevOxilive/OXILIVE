<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("consulta.php");
    include("editarUP.php");
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../../../assets/css/edit.css">
</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Editar aseguradora</H4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./editarUP.php" method="POST" class="row g-3 formEdit">
                    <div class="contenido col-md-1">
                        <label for="txtID" class="form-label">Num</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID[]"
                            id="txtID" aria-describedby="helpId">
                    </div>
                    <div class="contenido col-md-3"> 
                        <label for="administradora" class="form-label">Administradora</label>
                        <select id="administradora" name="administradora" class="form-select">
                            <?php foreach ($lis_admi as $registro) { ?>
                            <option <?php echo ($administradora == $registro['id_administradora']) ? "selected" : ""; ?>
                                value="<?php echo $registro['id_administradora']; ?>">
                                <?php echo $registro['Nombre_administradora']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Aquí vamos hacer la prueba -->
                    <!-- Repite estos campos según sea necesario -->
                    <div class="col-md-2 align-self-center">
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="codigo" class="formulario__label text-left">Código</label>
                            <div class="formulario__grupo-input">
                                <input type="text" value="<?php echo $codigo; ?>" name="codigo[]" class="form-control codigoInput" placeholder="Ejemplo E20B-21-ND" required>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="descripcion" class="formulario__label text-left">Descripción</label>
                            <div class="formulario__grupo-input">
                                <input type="text" value="<?php echo $descripcion; ?>" name="descripcion[]" class="form-control descripcionInput" placeholder="Apoyo General 8 Horas" required>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="unidad" class="formulario__label text-left">Unidad</label>
                            <div class="formulario__grupo-input">
                                <input type="text" value="<?php echo $unidad; ?>" name="unidad[]" class="form-control unidadInput" placeholder="Turno 8 Horas" required>
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Aquí terminan las pruebas -->

                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-success">Guardar</button>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.formEdit').addEventListener('submit', function(event) {
        event.preventDefault();

        var administradora = document.getElementById('administradora').value;
        var numCampos = document.querySelectorAll('.form-row').length;
        var camposIncompletos = false;
        var campos = document.querySelectorAll('.form-row');

        for (var i = 0; i < campos.length; i++) {
            var codigoInput = campos[i].querySelector('.codigoInput').value.trim();
            var descripcionInput = campos[i].querySelector('.descripcionInput').value.trim();
            var unidadInput = campos[i].querySelector('.unidadInput').value.trim();

            if (codigoInput === "" || descripcionInput === "" || unidadInput === "") {
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
                title: 'Campos Código, Descripción y Unidad requeridos',
                text: 'Por favor, complete todos los campos Código, Descripción y Unidad en cada conjunto.',
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
            window.location.href = "<?php echo $url_base; ?>secciones/enfermeria/alta/codigo_servicios/index.php";
        }
    });
}
</script>

<?php
include("../../../../templates/footer.php");
?>

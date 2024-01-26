<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include_once './consulta.php';
    include_once '../../../model/empleados.php';
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../assets/css/vali.css">
<link rel="stylesheet" href="../../../assets/css/edit.css">

</html>
<main id="main" class="main">

    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos del nuevo recurso o material</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./almacenADD.PHP" method="POST" id="formulario" class="formLogin row g-3">
                    <div class="contenido col-md-4">
                        <br>
                        <label for="tipo_material" class="form-label">Tipo de material o recurso que se ingresa</label>
                        <select id="tipo_material" name="tipo_material" class="form-select">
                            <option value="0" selected disabled>Elija una opción</option>
                            <?php foreach ($lista_material as $material) { ?>
                                <option value="<?php echo $material['id_material']; ?>">
                                    <?php echo $material['nombre_material']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-6"> <br>
                        <div class="formulario__grupo" id="grupo__nombre">
                            <label for="nombre" class="form-label">Nombre del material o recurso</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Eje: Hojas de papel">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__entrega">
                            <label for="entrega" class="form-label">¿Quien lo entrega?</label>
                            <select id="entrega" name="entrega" class="form-select">
                                <option value="0" selected disabled>Elija una opcion</option>
                                <?php foreach ($lista_empleados as $entrega) { ?>
                                    <option value="<?php echo $entrega['id_empleados']; ?>"><?php echo $entrega['Nombres']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__recibe">
                            <label for="recibe" class="form-label">¿Quien lo recibe?</label>
                            <select id="recibe" name="recibe" class="form-select">
                                <option value="0" selected disabled>Elija una opcion</option>
                                <?php foreach ($lista_empleados as $recibe) { ?>
                                    <option value="<?php echo $recibe['id_empleados']; ?>"><?php echo $recibe['Nombres']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-6">
                        <div class="formulario__grupo" id="grupo__observaciones">
                            <label for="observaciones" class="form-label">Observaciones del producto</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="observaciones" id="observaciones" placeholder="Complementar descripcion">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__cantidad">
                            <label for="cantidad" class="form-label">Cantidad que se almacena</label>
                            <div class="formulario__grupo-input">
                                <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Eje: 2">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-4">
                        <label for="estado" class="form-label">Estado del material</label>
                        <select id="estado" name="estado" class="form-select">
                            <option value="0" selected disabled>Elija una opción</option>
                            <?php foreach ($estado_mate as $estamate) { ?>
                                <option value="<?php echo $estamate['id_estado']; ?>">
                                    <?php echo $estamate['nombre_estado']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-4">
                        <div class="formulario__grupo" id="grupo__cantidad_adecuada">
                            <label for="cantidad_adecuada" class="form-label">Cantidad que es recomendable tener</label>
                            <div class="formulario__grupo-input">
                                <input type="number" class="form-control" name="cantidad_adecuada" id="cantidad_adecuada" placeholder="Eje: 2">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="formulario__grupo" id="grupo__fecha_salida" style="display: none;">
                            <label for="fecha_salida" class="formulario-label">Fecha de salida (SOLO SI EL PRODUCTO SALE)</label>
                            <input type="date" name="fecha_salida" value="<?php echo date("Y-m-d"); ?>" class="form-control">
                        </div>
                    </div> -->
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
<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        const estadoSelect = document.getElementById("estado");
        const fechaSalidaGrupo = document.getElementById("grupo__fecha_salida");

        estadoSelect.addEventListener("change", function() {
            if (estadoSelect.value == 3) {
                fechaSalidaGrupo.style.display = "block";
            } else {
                fechaSalidaGrupo.style.display = "none";
            }
        });
    });
</script> -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.formLogin').addEventListener('submit', function(event) {
            event.preventDefault();
            var tipo_material = document.getElementById('tipo_material').value;
            var nombre = document.getElementById('nombre').value;
            var entrega = document.getElementById('entrega').value;
            var recibe = document.getElementById('recibe').value;
            var observaciones = document.getElementById('observaciones').value;
            var cantidad = document.getElementById('cantidad').value;
            var estado = document.getElementById('estado').value;

            if (!tipo_material || !nombre || !entrega || !recibe || !observaciones || !cantidad || !estado) {
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
                window.location.href = "<?php echo $url_base; ?>secciones/almacen/materiales/index.php";
            }
        });
    }
</script>
<?php
include("../../../templates/footer.php");
?>
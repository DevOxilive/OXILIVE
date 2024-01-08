<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include ("./consulta.php");
    include("../../../module/empleados.php");
    include_once './almacenUP.php';
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
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Editar datos del material</H4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./almacenUP.php" method="POST" class="formLogin row g-3" id="formulario">
                <div class="contenido col-md-1"> <br>
                        <label for="txtID" class="form-label">Num</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId">
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__nombre"> <br>
                            <label for="nombre" class="form-label">Nombre del equipo</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="nombre" id="nombre"
                                 value="<?php echo $nombre;?>">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__tipo_material"> <br>
                            <label for="tipo_material" class="form-label">Tipo de material que se entrega</label>
                            <select id="tipo_material" name="tipo_material" class="form-select">
                                <?php foreach ($lista_material as $tipo) { ?>
                                    <option <?php echo ($tipo_material == $tipo['id_material']) ? "selected" : ""; ?>
                                    value="<?php echo $tipo['id_material']; ?>">
                                    <?php echo $tipo['nombre_material']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__entrega"> <br>
                            <label for="entrega" class="form-label">¿Quien lo entrega?</label>
                            <select id="entrega" name="entrega" class="form-select">
                                <?php foreach ($lista_empleados as $entreg) { ?>
                                    <option <?php echo ($entrega == $entreg['id_empleados']) ? "selected" : ""; ?>
                                    value="<?php echo $entreg['id_empleados']; ?>">
                                    <?php echo $entreg['Nombres']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__recibe"> <br>
                            <label for="recibe" class="form-label">¿Quien lo recibe?</label>
                            <select id="recibe" name="recibe" class="form-select">
                                <?php foreach ($lista_empleados as $reci) { ?>
                                    <option <?php echo ($recibe == $reci['id_empleados']) ? "selected" : ""; ?>
                                    value="<?php echo $reci['id_empleados']; ?>">
                                    <?php echo $reci['Nombres']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="contenido col-md-4">
                        <div class="formulario__grupo" id="grupo__observaciones"> <br>
                            <label for="observaciones" class="form-label">Observaciones del material</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="observaciones" value="<?php echo $observaciones; ?>" id="observaciones">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-4">
                        <div class="formulario__grupo" id="grupo__cantidad">
                            <label for="cantidad" class="form-label">Cantidad de material ingresado</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="form-control" name="cantidad" value="<?php echo $cantidad; ?>" id="cantidad">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__estado">
                            <label for="estado" class="form-label">Estado</label>
                            <select id="estado" name="estado" class="form-select">
                                <?php foreach ($estado_mate as $esta) { ?>
                                    <option <?php echo ($estado == $esta['id_estado']) ? "selected" : ""; ?>
                                    value="<?php echo $esta['id_estado']; ?>">
                                    <?php echo $esta['nombre_estado']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-4">
                        <div class="formulario__grupo" id="grupo__fecha_entrada">
                        <label for="fecha_entrada" class="form-label">Fecha y hora en que entro</label>
                        <input type="datetime-local" value="<?php echo $fecha_entrada; ?>" name="fecha_entrada"
                            id="fecha_entrada" class="form-control">
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
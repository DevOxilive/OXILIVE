<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include_once '../../../connection/conexion.php';
    include("./consulta.php");
    include("./tanquesADD.php");
} else {
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../assets/css/edit.css">
<link rel="stylesheet" href="../../../assets/css/vali.css">

</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Datos del equipo</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./tanquesADD.php" method="POST" class="formLogin row g-3" id="formulario"> 
                <div class="contenido col-md-2"><br>
                        <label for="marca" class="formulario__label">Marca del equipo</label>
                        <select id="marca" name="marca" class="form-select">
                        <option value="0" selected disabled>Elija una opcion</option>
                            <?php foreach ($lista_marca as $mar) { ?>
                                <option value="<?php echo $mar['id_marca']; ?>"><?php echo $mar['nombre_marca']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-2"><br>
                        <label for="estado_tanque" class="formulario__label">Estado del equipo</label>
                        <select id="estado_tanque" name="estado_tanque" class="form-select">
                        <option value="0" selected disabled>Elija una opcion</option>
                            <?php foreach ($lista_estado as $esta) { ?>
                                <option value="<?php echo $esta['id_estado']; ?>"><?php echo $esta['estado']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="contenido col-md-2"><br>
                        <label for="tamano" class="formulario__label">Tamaño del equipo</label>
                        <select id="tamano" name="tamano" class="form-select">
                        <option value="0" selected disabled>Elija una opcion</option>
                            <?php foreach ($lista_tama as $tama) { ?>
                                <option value="<?php echo $tama['id_tamano']; ?>"><?php echo $tama['tamano']; ?>
                                </option>
                            <?php } ?>
                        </select>   
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__cantidad"> <br>
                            <label for="cantidad" class="formulario__label">Cantidad de equipo</label>
                            <div class="formulario__grupo-input">
                                <input type="number" class="formulario__input" name="cantidad" id="cantidad" required>
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
            window.location.href = "<?php echo $url_base; ?>secciones/oxigeno/equipo/index.php";
        }
    });
}
</script>
<?php
include("../../../templates/footer.php");
?>
<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include_once './consulta.php';
    include_once '../../../module/empleados.php';
    include_once './buscarmaterial.php';
    include_once './consultasbuscar.php';
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
                    Datos Para devolver el material</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./entradaADD.php" method="POST" id="formulario" class="formLogin row g-3">
                <input type="hidden" name="id_salida" id="id_salida" value="<?php echo $row['id_salida']; ?>">    
                <input type="hidden" name="tipo_mateentra" id="tipo_mateentra" value="<?php echo $row['tipo_matesali']; ?>">
                <input type="hidden" name="estado_entrada" id="estado_entrada" value="<?php echo $row['estado_salida']; ?>">
                               
                    <div class="contenido col-md-3">                       
                        <br>
                        <label for="buscar_material_devolver" class="formulario__label">Material o recurso sacado</label>
                        <input type="text" value="<?php echo $row['nombre_matesali']; ?>" readonly class="form-control" name="buscar_material_devolver" id="buscar_material_devolver">
                    </div>
                    <div class="contenido col-md-2">
                        <br>
                        <label for="cantidad_salida" class="formulario__label">Cantidad que se saco</label>
                        <input type="datatime-local" value="<?php echo $row['cantidad_salida']; ?>" readonly class="form-control" name="cantidad_salida" id="cantidad_salida">
                    </div>
                    <div class="contenido col-md-6">
                        <br>
                        <label for="pide_salida" class="formulario__label">Persona que lo solicito</label>
                        <input type="datatime-local" value="<?php echo $row['pide_salida']; ?>" readonly class="form-control" name="pide_salida" id="pide_salida">
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__recibe_entrada">
                            <label for="recibe_entrada" class="formulario__label">¿Quien recibe la devolución?</label>
                            <select id="recibe_entrada" name="recibe_entrada" class="form-select">
                                <option value="0" selected disabled>Elija una opcion</option>
                                <?php foreach ($lista_empleados as $entrega) { ?>
                                    <option value="<?php echo $entrega['id_empleados']; ?>"><?php echo $entrega['Nombres']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__pide_entrada">
                            <label for="pide_entrada" class="formulario__label">¿Quien lo devuelve??</label>
                            <select id="pide_entrada" name="pide_entrada" class="form-select">
                                <option value="0" selected disabled>Elija una opcion</option>
                                <?php foreach ($lista_empleados as $recibe) { ?>
                                    <option value="<?php echo $recibe['id_empleados']; ?>"><?php echo $recibe['Nombres']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__cantidad_entrada">
                            <label for="cantidad_entrada" class="formulario__label">Cantidad que devuelve</label>
                            <div class="formulario__grupo-input">
                                <input type="number" class="formulario__input" name="cantidad_entrada" id="cantidad_entrada" placeholder="Eje: 2">
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-5">
                        <div class="formulario__grupo" id="grupo__observacionesentra">
                            <label for="observacionesentra" class="formulario__label">Nuevas observaciones del material y/o producto</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="observacionesentra" id="observacionesentra" placeholder="Eje: 2">
                            </div>
                        </div>
                    </div>
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
                window.location.href = "<?php echo $url_base; ?>secciones/almacen/entradas/index.php";
            }
        });
    }
</script>
<?php
include("../../../templates/footer.php");
?>
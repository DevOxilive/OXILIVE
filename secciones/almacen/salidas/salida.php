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
                    Datos Para sacar el material</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./salidaADD.php" method="POST" id="formulario" class="formLogin row g-3">
                <input type="hidden" name="id_almacen" id="id_almacen" value="<?php echo $row['id_almacen']; ?>">    
                <input type="hidden" name="tipo_material" id="tipo_material" value="<?php echo $row['tipo_material']; ?>">
                <input type="hidden" name="estado" id="estado" value="<?php echo $row['estado']; ?>">
                    <div class="contenido col-md-3">                        
                        <br>
                        <label for="buscar_material" class="form-label">Material o recurso</label>
                        <input type="text" value="<?php echo $row['nombre']; ?>" readonly class="form-control" name="buscar_material" id="buscar_material">
                    </div>
                    <div class="contenido col-md-2">
                        <br>
                        <label for="cantidad" class="form-label">Disponibles</label>
                        <input type="datatime-local" value="<?php echo $row['cantidad']; ?>" readonly class="form-control" name="cantidad" id="cantidad">
                    </div>
                    <div class="contenido col-md-6">
                        <br>
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <input type="datatime-local" value="<?php echo $row['observaciones']; ?>" readonly class="form-control" name="observaciones" id="observacionessali">
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__entrega_salida">
                            <label for="entrega_salida" class="form-label">¿Quien lo entrega?</label>
                            <select id="entrega_salida" name="entrega_salida" class="form-select">
                                <option value="0" selected disabled>Elija una opcion</option>
                                <?php foreach ($lista_empleados as $entrega) { ?>
                                    <option value="<?php echo $entrega['id_empleados']; ?>"><?php echo $entrega['Nombres']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-3">
                        <div class="formulario__grupo" id="grupo__pide_salida">
                            <label for="pide_salida" class="form-label">¿Quien lo recibe?</label>
                            <select id="pide_salida" name="pide_salida" class="form-select">
                                <option value="0" selected disabled>Elija una opcion</option>
                                <?php foreach ($lista_empleados as $recibe) { ?>
                                    <option value="<?php echo $recibe['id_empleados']; ?>"><?php echo $recibe['Nombres']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="contenido col-md-2">
                        <div class="formulario__grupo" id="grupo__cantidad_salida">
                            <label for="cantidad_salida" class="form-label">Cantidad a entregar</label>
                            <div class="formulario__grupo-input">
                                <input type="number" class="form-control" name="cantidad_salida" id="cantidad_salida" placeholder="Eje: 2">
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
                window.location.href = "<?php echo $url_base; ?>secciones/almacen/salidas/index.php";
            }
        });
    }
</script>
<?php
include("../../../templates/footer.php");
?>
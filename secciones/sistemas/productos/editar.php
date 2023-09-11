<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("./productosUP.php");
} else {
    echo "Error en el sistema";
}

?>
<html>
<link rel="stylesheet" href="../../../assets/css/edit.css">

</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Editar Productos</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./productosUP.php" method="POST" class="row g-3 formEdit" enctype="multipart/form-data">
                    <div class="contenido col-md-1"> <br>
                        <label for="txtID" class="form-label">Num</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID"
                            id="txtID" aria-describedby="helpId">
                    </div>
                    <div class="contenido col-md-10"> <br>
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" value="<?php echo $nombre; ?>" class="form-control" id="nombre" name="nombre"
                            required>
                    </div>

                    <div class="contenido col-md-14">
                        <label for="apellidos" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="descripcions" value="<?php echo $descripcion; ?>"
                            name="descripcion" required>
                    </div>
                    <div class="contenido col-md-8">
                        <label for="Imagen" class="from-label"> Imagen </label>
                        <input type="file" value="<?php echo $imagen; ?>" class="form-control" name="imagen"
                            id="imagen">
                    </div>
                    <div class="contenido col-md-2">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precio" value="<?php echo $precio; ?>"
                            name="precio">
                    </div>
                    <div class="contenido col-md-2">
                        <label for="precio" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" value="<?php echo $cantidad; ?>"
                            name="cantidad">
                    </div>
                    <div class="contenido col-md-4">
                        <label for="disponible"> Disponibilidad </label>
                        <input type="text" class="form-control" name="disponible" id="disponible"
                            value="<?php echo $disponible; ?>">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-success">Guardar</button>
                        <a role="button" onclick="mostrarAlertaCancelar()" name="cancelar"
                            class="btn btn-outline-danger"> Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.formEdit').addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Datos Guardados',
            text: 'Los datos han sido guardados correctamente.',
            icon: 'success',
        }).then(() => {
            e.target.submit();
        });
    });
});

function mostrarAlertaCancelar() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Los cambios no se guardarán',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No, continuar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?php echo $url_base; ?>secciones/sistemas/productos/index.php';
        }
    })
}
</script>
<?php
include("../../../templates/footer.php");

?>
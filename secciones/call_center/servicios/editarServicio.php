<?php
session_start();
if(!isset($_SESSION['us'])){
    header('Location: ../../../login.php');
} elseif(isset($_SESSION['us'])){
    include ("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include ("../../call_center/servicios/agregarEditar.php");
}else{
    echo "Error en el sistema";
}
?>
<html>
<link rel="stylesheet" href="../../../assets/css/edit.css">

</html>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #005880; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Editar datos del servicio</H4>
            </div>
            <div class="card-body" style="border: 12px solid #005880;">
                <form action="./agregarEditar.php" method="post" class="row g-3 formEdit">
                    <div class="contenido col-md-1"> <br>
                        <label for="txtID" class="form-label">N°</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID"
                            id="txtID" aria-describedby="helpId">
                    </div>
                    <div class="contenido col-md-11"> <br>
                        <label for="nomServicio" class="form-label">Nombre del servicio</label>
                        <input type="text" class="form-control" name="nomServicio" value="<?php echo $nombreServicio; ?>"
                            id="nomServicio" required>
                    </div>
                    <div class="contenido col-md-12"> <br>
                        <label for="descripServicio" class="form-label">Descricion del servicio</label>
                        <input type="text" class="form-control" name="descripServicio" value="<?php echo $descripcionServicio; ?>" id="descripServicio">
                    </div>
                    <div class="col-12">
                        
                        <a role="button" onclick="mostrarAlertaCancelar()" name="cancelar"
                            class="btn btn-primary"> Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
        </div>
</main>
<script>
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
            window.location.href = '<?php echo $url_base; ?>secciones/call_center/servicios/index.php';
        }
    })
}
</script>
<?php
include("../../../templates/footer.php");
?>
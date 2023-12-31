<?php
session_start();
if(!isset($_SESSION['us'])){
    header('Location: ../../../login.php');
} elseif(isset($_SESSION['us'])){
    include ("../../../connection/conexion.php");
    include ("../../../templates/header.php");
    include("../../../module/estado.php");
    include ("../../oxigeno/choferes/choferUP.php");
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
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
                <h4
                    style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Editar datos del chofer</H4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./choferUP.php" method="POST" class="row g-3 formEdit">
                    <div class="contenido col-md-1"> <br>
                        <label for="txtID" class="form-label">Núm</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID"
                            id="txtID" aria-describedby="helpId">
                    </div>

                    <div class="contenido col-md-6"> <br>
                        <label for="Nombre_completo" class="form-label">Nombre completo</label>
                        <input type="text" value="<?php echo $Nombre_completo; ?>" class="form-control"
                            name="Nombre_completo" id="Nombre_completo" placeholder="Ingrese el nombre completo"
                            required>
                    </div>

                    <div class="contenido col-md-2"> <br>
                        <label for="status" class="form-label">Estado</label>
                        <select id="status" name="status" class="form-select">
                            <?php foreach($lista_estado as $registro){ ?>
                            <option <?php echo($status==$registro['id_estado'])?"selected":"";?>
                                value="<?php echo $registro['id_estado']; ?>">
                                <?php echo $registro['Nombre_estado'];  ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-primary">Guardar</button>
                        <a role="button" onclick="mostrarAlertaCancelar()" name="cancelar"
                            class="btn btn-outline-danger"> Cancelar</a>
                    </div>
                </form>
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
            window.location.href = '<?php echo $url_base; ?>secciones/oxigeno/choferes/index.php';
        }
    })
}
</script>
<?php
include("../../../templates/footer.php");
?>
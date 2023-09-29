<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("./consultaProce.php");
    include("./proceUP.php");
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
                    Procedimientos Realizados</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="./proceUP.php" method="POST" enctype="multipart/form-data" class="formLogin row g-3" id="formulario">
                
                <div class="contenido col-md-1"> <br>
                        <label for="txtID" class="form-label">Num</label>
                        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId">
                    </div>
                
                    <div class="contenido col-md-5">
                        <br>
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="codigo_ICD" class="formulario__label">Código ICD:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" value="<?php echo $codigo_ICD; ?>" class="formulario__input" name="codigo_ICD" id="codigo_ICD" placeholder="187.2 / 163">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>

                    <div class="contenido col-md-5">
                        <br>
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="dx" class="formulario__label">DX: Insuficiencia Venosa / EVC</label>
                            <div class="formulario__grupo-input">
                                <input type="text" value="<?php echo $dx;?>" class="formulario__input" name="dx" id="dx" placeholder="Insuficiencia Venosa / EVC">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>

                    <div class="contenido col-md-5">
                        <br>
                        <div class="formulario__grupo" id="grupo__Nombre_aseguradora">
                            <label for="medico" class="formulario__label">Médico tratante</label>
                            <div class="formulario__grupo-input">
                                <input type="text" value="<?php echo $medico;?>" class="formulario__input" name="medico" id="medico" placeholder="Alan Garcia">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-success">Guardar</button>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar</a>
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
                window.location.href = "<?php echo $url_base; ?>secciones/enfermeria/procedimientos/index.php";
            }
        });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.formLogin').addEventListener('submit', function(event) {
            event.preventDefault();

            // Verifica si los campos obligatorios están vacíos 
            var codigo_ICD =document.getElementById('codigo_ICD').value;
            var dx=document.getElementById('dx').value;

            if (!codigo_ICD || !dx) {
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
<?php
include("../../../templates/footer.php");
?>
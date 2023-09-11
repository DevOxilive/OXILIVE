<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("../../../module/administradora.php");
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
                    Datos de CPT</h4>
            </div>
            <div class="card-body" style="border: 2px solid #BFE5FF;">
                <form action="" method="POST" enctype="multipart/form-data" class="formLogin row g-3" id="formulario">
                    
                <div class="contenido col-md-5">
                        <br>
                        <div class="formulario__grupo" id="nombreCPT">
                            <label for="nombreCPT" class="formulario__label">Nombre del paciente</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="nombreCPT" id="nombreCPT" placeholder="Mora Castro Margarita">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>              
                
                <div class="contenido col-md-3">
                        <br>
                        <label for="CPT" class="formulario__label">CPT</label>
                        <select id="CPT" name="CPT" class="form-select">
                        <option value="0" selected disabled>Elija una opción</option>
                        </select>
                    </div>
                    

                    <div class="contenido col-md-3">
                        <br>
                        <div class="formulario__grupo" id="fechaCPT">
                            <label for="fechaCPT" class="formulario__label">Fecha</label>
                            <div class="formulario__grupo-input">
                                <input type="date" class="formulario__input" name="fechaCPT" id="fechaCPT" placeholder="11/07/2022">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>


                    <div class="contenido col-md-3">
                        <br>
                        <div class="formulario__grupo" id="nominaCPT">
                            <label for="nominaCPT" class="formulario__label">Número de Nomína:</label>
                            <div class="formulario__grupo-input">
                                <input type="number" class="formulario__input" name="nominaCPT" id="nominaCPT" placeholder="4365-00">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>

                    <div class="contenido col-md-3">
                        <br>
                        <div class="formulario__grupo" id="icdCPT">
                            <label for="icdCPT" class="formulario__label">Codígo ICD:187.2 / 163</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="icdCPT" id="icdCPT" placeholder="187.2 / 163">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="contenido col-md-4  ">
                    <br>
                        <div class="formulario__grupo" id="dxGPT">
                            <label for="dxGPT" class="formulario__label">DX:</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="dxGPT" id="dxGPT" placeholder="insuficiencia Venosa / EVC">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>


                    <div class="contenido col-md-5">
                        <br>
                        <div class="formulario__grupo" id="descripcionCPT">
                            <label for="descripcionCPT" class="formulario__label">Descripción</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="descripcionCPT" id="descripcionCPT" placeholder="Apoyo Enfermerian General 8 horas">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
               

                    <div class="contenido col-md-3">
                        <br>
                        <div class="formulario__grupo" id="Unidades">
                            <label for="Unidades" class="formulario__label">Unidades</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="Unidades" id="Unidades" placeholder="Turno 8 Horas">
                                <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                            </div>
                        </div>
                    </div>
                     <!--Implementación de CPT-->
                     <br><br><br><br><br><br><br><br><br>
                    <!--Fin del contenedor  de CPT-->
                    <div class="row justify-content-center">
                        <div class="col-md-auto ">
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-success">Guardar</button>
                        <a role="button" onclick="confirmCancel(event)" name="cancelar" class="btn btn-outline-danger">
                            Cancelar</a>
                    </div>
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
                window.location.href = "<?php echo $url_base; ?>secciones/enfermeria/procedimientosRealizados/index.php";
            }
        });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.formLogin').addEventListener('submit', function(event) {
            event.preventDefault();

            // Verifica si los campos obligatorios están vacíos
            var Nombre_aseguradora = document.getElementById('Nombre_aseguradora').value;
            var administradora = document.getElementById('administradora').value;

            if (!Nombre_aseguradora || !administradora) {
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
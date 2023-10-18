<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");

} else {
    echo "Error en el sistema";
}

?>


<html>
<link rel="stylesheet" href="../../../assets/css/vali.css">

</html>

<main id="main" class="main">
    <div class="card">
        <div class="card-header" style="border: 2px solid #012970; background: #005880;">
            <h4 style="text-align:center;
            color: #ffff;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                REGISTRO CLÍNICO Y CUDADOS GENERALES
            </h4>
        </div>
        <div class="card-body" style="border: 2px solid #BFE5FF;">
            <form action="guardar.php" method="POST" class="formLogin form-inline" id="formulario">
                <div class="col-md-5">
                    <div class="formulario__grupo">
                        <label for="medicamentos" class="formulario__label">MEDICAMENTOS</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="medicamentos" id="medicamentos"
                                value="paracetamol">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="horario" class="formulario__label">HORARIO</label>
                        <div class="formulario__grupo-input">
                            <input type="Time" class="formulario__input" name="horario" id="horario">
                        </div>
                    </div>
                </div>
            </form>
            <br>
            <button id="btnAnterior" class="btn btn-secondary" onclick="mostrarAlerta()">Anterior</button>
            <button id="btnGuardar" class="btn btn-success" type="submit" form="formulario">Guardar</button>
        </div>
    </div>
    </div>
    
</main>

<script type="text/javascript">
function mostrarAlerta() {
    var confirmacion = confirm("¿Estás seguro de que deseas ir atrás? Los datos no se guardarán.");
    if (confirmacion) {
        window.history.back();
    } else {
        window.location.href = 'form4.php';
    }
}
</script>



<?php
include("../../../templates/footer.php");
?>


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
            <form action="procesarf2.php" method="POST" class="formLogin form-inline" id="formulario">
                <div class="col-md-4 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="solucion" class="formulario__label">SOLUCION</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="solucion" id="solucion"
                                value="INTRAVENOSA">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="fecha" class="formulario__label">FECHA</label>
                        <div class="formulario__grupo-input">
                            <input type="date" class="formulario__input" name="fecha" id="fecha">
                        </div>
                    </div>
                </div>
                <div class="col-md-2 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="cantidad" class="formulario__label">CANT.</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="cantidad" id="cantidad">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="goteo" class="formulario__label">GOT.</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="goteo" id="goteo">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="frecuencia" class="formulario__label">FREC.</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="frecuencia" id="frecuencia">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="inicia" class="formulario__label">INICIA</label>
                        <div class="formulario__grupo-input">
                            <input type="Time" class="formulario__input" name="inicia" id="inicia">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="termina" class="formulario__label">TERMINA</label>
                        <div class="formulario__grupo-input">
                            <input type="Time" class="formulario__input" name="termina" id="termina">
                        </div>
                    </div>
                </div>
            </form>
            <br>
            <button id="btnAnterior" class="btn btn-secondary" onclick="mostrarAlerta()">Anterior</button>
            <button id="btnSiguiente" class="btn btn-primary" type="submit" form="formulario">Siguiente</button>
        </div>
        </form>
    </div>
    </div>
</main>
<script>


// Obtener fecha actual
let fecha = new Date();
// Obtener cadena en formato yyyy-mm-dd, eliminando zona y hora
let fechaMin = fecha.toISOString().split('T')[0];
// Asignar valor mínimo
document.querySelector('#fecha').min = fechaMin;
</script>

<?php
include("../../../templates/footer.php");
?>

<script type="text/javascript">
function mostrarAlerta() {
    var confirmacion = confirm("¿Estás seguro de que deseas ir atrás? Los datos no se guardarán.");
    if (confirmacion) {
        window.history.back();
    } else {
        window.location.href = 'form2.php';
    }
}
</script>
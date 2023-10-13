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
            <form action="procesarf3.php" method="POST" class="formLogin form-inline" id="formulario">
            <div class="col-md-12">
                    <div class="formulario__grupo">
                        <label for="drescripcionCuracion" class="formulario__label">Curación (Descripción de procedimiento)</label>
                        <div class="formulario__grupo-input">
                            <textarea name="drescripcionCuracion" id="drescripcionCuracion"
                                style="width: 100%; max-width: 1000px; height: 90px;"
                                placeholder="Descripción"></textarea>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>    
            <div class="col-md-12">
                    <div class="formulario__grupo">
                        <label for="notaenferdia" class="formulario__label">NOTA DE ENFREMERÍA (DÍA)</label>
                        <div class="formulario__grupo-input">
                            <textarea name="notaenferdia" id="notaenferdia"
                                style="width: 100%; max-width: 1000px; height: 90px;"
                                placeholder="Descripción"></textarea>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="formulario__grupo">
                        <label for="notaenfernoche" class="formulario__label">NOTA DE ENFREMERÍA (NOCHE)</label>
                        <div class="formulario__grupo-input">
                            <textarea name="notaenfernoche" id="notaenfernoche"
                                style="width: 100%; max-width: 1000px; height: 90px;"
                                placeholder="Descripción"></textarea>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="dasayunoH" class="formulario__label">DESAYUNO (HORARIO)</label>
                        <div class="formulario__grupo-input">
                            <input type="Time" class="formulario__input" name="dasayunoH" id="dasayunoH">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="formulario__grupo">
                        <label for="descripDesayuno" class="formulario__label"></label>
                        <div class="formulario__grupo-input">
                            <textarea name="descripDesayuno" id="descripDesayuno"
                                style="width: 100%; max-width: 900px; height: 90px;" placeholder="Desayuno"></textarea>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="comidaH" class="formulario__label">COMIDA (HORARIO)</label>
                        <div class="formulario__grupo-input">
                            <input type="Time" class="formulario__input" name="comidaH" id="comidaH">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="formulario__grupo">
                        <label for="descripComida" class="formulario__label"></label>
                        <div class="formulario__grupo-input">
                            <textarea name="descripComida" id="descripComida"
                                style="width: 100%; max-width: 900px; height: 90px;" placeholder="Comida"></textarea>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="cenaH" class="formulario__label">CENA (HORARIO)</label>
                        <div class="formulario__grupo-input">
                            <input type="Time" class="formulario__input" name="cenaH" id="cenaH">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="formulario__grupo">
                        <label for="descripCena" class="formulario__label"></label>
                        <div class="formulario__grupo-input">
                            <textarea name="descripCena" id="descripCena"
                                style="width: 100%; max-width: 900px; height: 90px;" placeholder="Cena"></textarea>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
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
<script type="text/javascript">
function mostrarAlerta() {
    var confirmacion = confirm("¿Estás seguro de que deseas ir atrás? Los datos no se guardarán.");
    if (confirmacion) {
        window.history.back();
    } else {
        window.location.href = 'form3.php';
    }
}
</script>

<?php
include("../../../templates/footer.php");
?>


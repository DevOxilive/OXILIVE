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
                Formulario parte 3
            </h4>
        </div>
        <div class="card-body" style="border: 2px solid #BFE5FF;">
            <form class="formLogin form-inline" id="formulario">
            <div class="col-md-12">
                    <div class="formulario__grupo">
                        <label for="drescripcionCuracion" class="formulario__label">Curación (Descripción de procedimiento)</label>
                        <div class="formulario__grupo-input">
                            <textarea name="drescripcionCuracion" id="drescripcionCuracion"
                                style="width: 100%; max-width: 1000px; height: 90px;"
                                placeholder="Descripción"></textarea>
                        </div>
                    </div>
                </div>    
            <div class="col-md-12">
                    <div class="formulario__grupo">
                        <label for="notaEnfermeria" class="formulario__label">NOTA DE ENFERMERÍA (DÍA O NOCHE)</label>
                        <div class="formulario__grupo-input">
                            <textarea name="notaEnfermeria" id="notaEnfermeria"
                                style="width: 100%; max-width: 1000px; height: 90px;"
                                placeholder="Descripción"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="formulario__grupo">
                        <label for="descripComidas" class="formulario__label">NOTA DE ALIMENTACION (DESAYUNO, COMIDA Y CENA)</label>
                        <div class="formulario__grupo-input">
                            <textarea name="descripComidas" id="descripComidas"
                                style="width: 100%; max-width: 900px; height: 90px;" placeholder="Descripción"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="formulario__grupo" id="grupo__Nombre_administradora">
                        <label for="horarioComidas" class="formulario__label">HORARIO</label>
                        <div class="formulario__grupo-input">
                            <input type="Time" class="formulario__input" name="horarioComidas" id="horarioComidas">
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
</main>
<script type="text/javascript">
    function mostrarAlerta() {
        Swal.fire({
            icon: 'question',
            title: '¿Estás seguro de ir atrás?',
            text: 'Los datos no se guardarán',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'form2.php'; // Cambia aquí para redirigir a 'index.php'
            }
        });
    }
</script>
<script src="js/valiform3.js"></script>

<?php
include("../../../templates/footer.php");
?>


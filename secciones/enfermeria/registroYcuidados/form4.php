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
            <form class="formLogin form-inline" id="formulario">
                    <div class="col-md-5">
                        <div class="formulario__grupo">
                            <label for="medicamento_1" class="formulario__label">1.° MEDICAMENTO</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="medicamento_1" id="medicamento_1">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 ">
                        <div class="formulario__grupo" id="grupo__Nombre_administradora">
                            <label for="horario_1" class="formulario__label">HORARIO</label>
                            <div class="formulario__grupo-input">
                                <input type="Time" class="formulario__input" name="horario_1" id="horario_1">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="formulario__grupo">
                            <label for="medicamento_2" class="formulario__label">2.° MEDICAMENTO</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="medicamento_2" id="medicamento_2">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 ">
                        <div class="formulario__grupo" id="grupo__Nombre_administradora">
                            <label for="horario_2" class="formulario__label">HORARIO</label>
                            <div class="formulario__grupo-input">
                                <input type="Time" class="formulario__input" name="horario_2" id="horario_2">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="formulario__grupo">
                            <label for="medicamento_3" class="formulario__label">3.° MEDICAMENTO</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="medicamento_3" id="medicamento_3">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 ">
                        <div class="formulario__grupo" id="grupo__Nombre_administradora">
                            <label for="horario_3" class="formulario__label">HORARIO</label>
                            <div class="formulario__grupo-input">
                                <input type="Time" class="formulario__input" name="horario_3" id="horario_3">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="formulario__grupo">
                            <label for="medicamento_4" class="formulario__label">4.° MEDICAMENTO</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="medicamento_4" id="medicamento_4">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 ">
                        <div class="formulario__grupo" id="grupo__Nombre_administradora">
                            <label for="horario_4" class="formulario__label">HORARIO</label>
                            <div class="formulario__grupo-input">
                                <input type="Time" class="formulario__input" name="horario_4" id="horario_4">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="formulario__grupo">
                            <label for="medicamento_5" class="formulario__label">5.° MEDICAMENTO</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" name="medicamento_5" id="medicamento_5">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 ">
                        <div class="formulario__grupo" id="grupo__Nombre_administradora">
                            <label for="horario_5" class="formulario__label">HORARIO</label>
                            <div class="formulario__grupo-input">
                                <input type="Time" class="formulario__input" name="horario_5" id="horario_5">
                            </div>
                        </div>
                    </div>
            </form>
            <br>
            <button id="btnAnterior" class="btn btn-secondary" onclick="mostrarAlerta()">Anterior</button>
            <button id="btnGuardar" class="btn btn-success" type="submit" form="formulario">Guardar</button>
        </div>
    </div>
</main>


<script type="text/javascript">
function mostrarAlerta() {
    Swal.fire({
        icon: 'question',
        title: '¿Estás seguro de que deseas ir atrás?',
        text: 'Los datos no se guardarán',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            window.history.back();
        } else {
            window.location.href = 'form3.php';
        }
    });
}
</script>

<script src="js/valiform4.js"></script>


<?php
include("../../../templates/footer.php");
?>
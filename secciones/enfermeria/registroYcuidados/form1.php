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
            <form action="procesarf1.php" method="POST" class="formLogin form-inline" id="formulario">
                <div class="col-md-2">
                    <div class="formulario__grupo">
                        <label for="temperatura" class="formulario__label">Temperatura:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" class="formulario__input" name="temperatura" id="temperatura"
                                placeholder="Ej. 35.3º" step="any" pattern="^\d+(\.\d{1,2})?$">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="pulso" class="formulario__label">Pulso:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" class="formulario__input" name="pulso" id="pulso"
                                placeholder="Ej. 100.67 ppm" step="any" pattern="^\d+(\.\d{1,2})?$">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="formulario__grupo">
                        <label for="respiracion" class="formulario__label">Respiración:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" class="formulario__input" name="respiracion" id="respiracion"
                                placeholder="19 rpm" oninput="validarNumeroEntero(this)">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="tensionArterial" class="formulario__label">Tensión Arterial:</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="tensionArterial" id="tensionArterial"
                                placeholder="120/80 mm Hg" oninput="validarTensionArterial(this)"
                                pattern="\d{1,3}/\d{1,3}">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="formulario__grupo">
                        <label for="spo2" class="formulario__label">SPO2:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" class="formulario__input" name="spo2" id="spo2" placeholder="89%"
                                oninput="validarNumeroEntero(this)">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="formulario__grupo">
                        <label for="glicemiaCapilar" class="formulario__label">Glicemia Capilar:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" class="formulario__input" name="glicemiaCapilar" id="glicemiaCapilar"
                                placeholder="Ej. 30.3º" step="any" pattern="^\d+(\.\d{1,2})?$">
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="vomito" class="formulario__label">Vómito:</label>
                        <div class="formulario__grupo-input">
                            <select class="formulario__input" name="vomito" id="vomito">
                                <option value="0">Seleccionar</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                            </select>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="evacuaciones" class="formulario__label">Evacuaciones:</label>
                        <div class="formulario__grupo-input">
                            <select class="formulario__input" name="evacuaciones" id="evacuaciones">
                                <option value="0">Seleccionar</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                            </select>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="orina" class="formulario__label">orina:</label>
                        <div class="formulario__grupo-input">
                            <select class="formulario__input" name="orina" id="orina">
                                <option value="0">Seleccionar</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                            </select>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="ingestaLiquidos" class="formulario__label">Ingesta de Liquidos:</label>
                        <div class="formulario__grupo-input">
                            <select class="formulario__input" name="ingestaLiquidos" id="ingestaLiquidos">
                                <option value="0">Seleccionar</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                            </select>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="caidas" class="formulario__label">Caidas:</label>
                        <div class="formulario__grupo-input">
                            <select class="formulario__input" name="caidas" id="caidas">
                                <option value="0">Seleccionar</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                            </select>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="drenajesVendajes" class="formulario__label">Drenajes y/o Vendajes:</label>
                        <div class="formulario__grupo-input">
                            <select class="formulario__input" name="drenajesVendajes" id="drenajesVendajes">
                                <option value="0">Seleccionar</option>
                                <option value="1">1°</option>
                                <option value="2">2°</option>
                                <option value="3">3°</option>
                            </select>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="uppHh" class="formulario__label">UPP, Heridas o Hematomas</label>
                        <div class="formulario__grupo-input">
                            <select class="formulario__input" name="uppHh" id="uppHh">
                                <option value="0">Seleccionar</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <i class="formulario__validacion-estado bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="formulario__grupo">
                        <label for="descripcionUpp" class="formulario__label">Descripción UPP, Heridas o
                            Hematomas</label>
                        <div class="formulario__grupo-input">
                            <textarea name="descripcionUpp" id="descripcionUpp"
                                style="width: 100%; max-width: 900px; height: 90px;"
                                placeholder="(Descripción)"></textarea>
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
<script>

//esta funcion es para que no acepte valores que no sean enteros
function validarNumeroEntero(input) {
    // Remueve cualquier punto decimal ingresado por el usuario
    input.value = input.value.replace(/[.,]/g, '');

    // Valida que el valor sea un número entero
    if (input.value !== '') {
        input.value = parseInt(input.value, 10);
    }
}

//esta funcion es para que la tencion arterial valode el tipo de formato
function validarTensionArterial(input) {
    // Expresión regular para el formato XXX/XXX
    var regex = /^\d{1,3}\/\d{1,3}$/;

    // Valida el formato usando la expresión regular
    if (!regex.test(input.value)) {
        // Si el formato no es válido, muestra un mensaje de error
        input.setCustomValidity("Formato incorrecto. Debe ser XXX/XXX.");
    } else {
        // Si el formato es válido, limpia el mensaje de error
        input.setCustomValidity("");
    }
}
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
        window.location.href = 'form1.php';
    }
}
</script>
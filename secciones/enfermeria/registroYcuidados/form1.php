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
                <div class="col-md-2">
                    <div class="formulario__grupo">
                        <label for="peso" class="formulario__label">Peso del paciente:</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="peso" id="peso" placeholder="Ej. 60 kg">
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="formulario__grupo">
                        <label for="diagnosticoMedico" class="formulario__label">Diagnostico medico:</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="diagnosticoMedico" id="diagnosticoMedico"
                                placeholder="Ej. Enfermedad pulmonar obstructiva crónica">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="formulario__grupo">
                        <label for="temperatura" class="formulario__label">Temperatura:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" class="formulario__input" name="temperatura" id="temperatura"
                                placeholder="Ej. 35.3º">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="pulso" class="formulario__label">Pulso:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" class="formulario__input" name="pulso" id="pulso"
                                placeholder="Ej. 100.67 ppm">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="formulario__grupo">
                        <label for="respiracion" class="formulario__label">Respiración:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" class="formulario__input" name="respiracion" id="respiracion"
                                placeholder="19 rpm">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="formulario__grupo">
                        <label for="tensionArterial" class="formulario__label">Tensión Arterial:</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="tensionArterial" id="tensionArterial"
                                placeholder="120/80 mm Hg">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="formulario__grupo">
                        <label for="spo2" class="formulario__label">SPO2:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" class="formulario__input" name="spo2" id="spo2" placeholder="89%">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="formulario__grupo">
                        <label for="glicemiaCapilar" class="formulario__label">Glicemia Capilar:</label>
                        <div class="formulario__grupo-input">
                            <input type="number" class="formulario__input" name="glicemiaCapilar" id="glicemiaCapilar"
                                placeholder="Ej. 30.3º">
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
                        </div>
                    </div>
                </div>
            </form>
            <br>
            <button id="btnAnterior" class="btn btn-secondary" onclick="mostrarAlerta()">Anterior</button>
            <button id="btnSiguiente" class="btn btn-primary" type="submit" form="formulario">Siguiente</button>
        </div>
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
            window.location.href = 'form1.php';
        }
    });
}
</script>
<script src="js/valiform1.js"></script>




<?php
include("../../../templates/footer.php");
?>
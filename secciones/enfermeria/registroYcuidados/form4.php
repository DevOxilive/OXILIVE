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
            <form action="#" method="POST" class="formLogin form-inline" id="formulario">
                <div class="col-md-5">
                    <div class="formulario__grupo">
                        <label for="medicamentos" class="formulario__label">MEDICAMENTOS</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="medicamentos" id="medicamentos"
                                value="paracetamol" readonly disabled>
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
            <button id="btnAnterior" class="btn btn-secondary">Anterior</button>
            <button type="button" class="btn btn-success">Guardar</button>
        </div>
        </form>
    </div>
    </div>
</main>
<script>
var btnAnterior = document.getElementById('btnAnterior');
btnAnterior.addEventListener('click', function() {
    window.location.href = 'form2.php';
});

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
            window.location.href = "<?php echo $url_base; ?>secciones/enfermeria/registroYcuidados/index.php";
        }
    });
}

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

//funcion asignada a la fecha para que no te deje colorcar fecha anteriores
function validarFecha() {
    var fechaInput = document.getElementById("fecha").value;
    var fechaSeleccionada = new Date(fechaInput);
    var fechaActual = new Date();

    if (fechaSeleccionada <= fechaActual) {
        alert("No puedes seleccionar una fecha anterior a la actual.");
        document.getElementById("fecha").value = ""; // Limpiar el campo de fecha
    }
}

// Agrega un manejador de eventos al evento beforeunload
window.addEventListener('beforeunload', function(event) {
    // Cancela el evento para evitar que el navegador lo maneje por defecto
    event.preventDefault();
    // Crea un mensaje personalizado para la alerta
    var mensaje = 'Si abandonas esta página, perderás todos los datos ingresados.';
    // Asigna el mensaje a la propiedad returnValue del evento
    event.returnValue = mensaje;
    // Devuelve el mensaje para que sea mostrado al usuario (esto es opcional y depende del navegador)
    return mensaje;
});
</script>

<?php
include("../../../templates/footer.php");
?>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura los datos del formulario
    $medicamentos = $_POST["medicamentos"];
    $horario = $_POST["horario"];

    // Almacena los datos en la sesión junto con el ID del usuario
    $_SESSION["registro_data"] = array(
        "user_id" => $_SESSION['user_id'],
        "medicamentos" => $medicamentos,
        "horario" => $horario
        // ... Almacena otros datos en el array ...
    );
    
}
?>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos almacenados en la sesión
    $registroData = $_SESSION["registro_data"];
    $user_id = $registroData["user_id"];
    $temperatura = $registroData["temperatura"];
    $pulso = $registroData["pulso"];
    $respiracion = $registroData["respiracion"];
    $tensionArterial = $registroData["tensionArterial"]; 
    $spo2 = $registroData["spo2"];
    $glicemiaCapilar = $registroData["glicemiaCapilar"];
    $vomito = $registroData["vomito"];
    $evacuaciones = $registroData["evacuaciones"];
    $orina = $registroData["orina"];
    $ingestaLiquidos = $registroData["ingestaLiquidos"];
    $caidas = $registroData["caidas"];
    $drenajesVendajes = $registroData["drenajesVendajes"];
    $uppHh = $registroData["uppHh"];
    $descripcionUpp = $registroData["descripcionUpp"];
    $solucion = $registroData["solucion"];
    $fecha = $registroData["fecha"];
    $cantidad = $registroData["cantidad"];
    $goteo = $registroData["goteo"]; 
    $frecuencia = $registroData["frecuencia"];
    $inicia = $registroData["inicia"];
    $termina = $registroData["termina"];
    $drescripcionCuracion = $registroData["drescripcionCuracion"];
    $notaenferdia = $registroData["notaenferdia"];
    $notaenfernoche = $registroData["notaenfernoche"];
    $dasayunoH = $registroData["dasayunoH"]; 
    $descripDesayuno = $registroData["descripDesayuno"];
    $comidaH = $registroData["comidaH"];
    $descripComida = $registroData["descripComida"];
    $cenaH = $registroData["cenaH"];
    $descripCena = $registroData["descripCena"];
    $medicamentos = $registroData["medicamentos"];
    $horario = $registroData["horario"]; 
   

   // Configuración de la base de datos
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$nombre_base_de_datos = "bdoxilive";

try {
    // Establece la conexión PDO
    $conexion = new PDO("mysql:host=$servidor;dbname=$nombre_base_de_datos", $usuario, $contrasena);
    // Habilita el modo de errores de PDO para manejar excepciones
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Captura los datos del formulario
    $user_id = $_SESSION['user_id'];
    $temperatura = $_POST["temperatura"];
    $pulso = $_POST["pulso"];
    $respiracion = $_POST["respiracion"];
    $tensionArterial = $_POST["tensionArterial"]; 
    $spo2 = $_POST["spo2"];
    $glicemiaCapilar = $_POST["glicemiaCapilar"];
    $vomito = $_POST["vomito"];
    $evacuaciones = $_POST["evacuaciones"];
    $orina = $_POST["orina"];
    $ingestaLiquidos = $_POST["ingestaLiquidos"];
    $caidas = $_POST["caidas"];
    $drenajesVendajes = $_POST["drenajesVendajes"];
    $uppHh = $_POST["uppHh"];
    $descripcionUpp = $_POST["descripcionUpp"]; 
    $solucion = $_POST["solucion"];
    $fecha = $_POST["fecha"];
    $cantidad = $_POST["cantidad"];
    $goteo = $_POST["goteo"]; 
    $frecuencia = $_POST["frecuencia"];
    $inicia = $_POST["inicia"];
    $termina = $_POST["termina"];
    $drescripcionCuracion = $_POST["drescripcionCuracion"];
    $notaenferdia = $_POST["notaenferdia"];
    $notaenfernoche = $_POST["notaenfernoche"];
    $dasayunoH = $_POST["dasayunoH"]; 
    $descripDesayuno = $_POST["descripDesayuno"];
    $comidaH = $_POST["comidaH"];
    $descripComida = $_POST["descripComida"];
    $cenaH = $_POST["cenaH"];
    $descripCena = $_POST["descripCena"];
    $medicamentos = $_POST["medicamentos"];
    $horario = $_POST["horario"];
    // Captura otros valores del formulario según sea necesario

    // Prepara la consulta SQL
    $consulta = $conexion->prepare(" INSERT INTO 
    regisclinicos_cuidagenerales (id_RC, id_usuario, Fecha_hora_servicio, Temperatura, Pulso, Respiracion, Tension_arterial, Spo2, Glicemia_capilar, Vomitos, Evacuaciones, Orina, Ingesta_liquidos,
    Caidas, Drenajes_vendajes, Upp_hh, Descripcion_upp, Solucion, Fecha_solucion, Cantidad_solucion, Got_solucion, Frec_solucion, Hora_inicio, Hora_termina, Cauracion, Nota_emfermeria_dia, 
    Nota_emfermeria_noche, Alimentos_desayuno, Descripcion_desayuno, Alimentos_comida, Descripcion_comida, Alimentos_cena, descripcion_cena, Medicamentos, Horario_Medi) 
    VALUES ( null, :user_id, null, :temperatura, :pulso, :respiracion, :tensionArterial, :spo2, :glicemiaCapilar, :vomito, :evacuaciones, :orina, :ingestaLiquidos, :caidas,
    :drenajesVendajes, :uppHh, :descripcionUpp, :solucion, :fecha, :cantidad, :goteo, :frecuencia, :inicia, :termina, :drescripcionCuracion, :notaenferdia, :notaenfernoche,
    :dasayunoH, :descripDesayuno, :comidaH, :descripComida, :cenaH, :descripCena, :medicamentos, :horario )");

    // Vincula los parámetros
    $consulta->bindParam(':user_id', $user_id); 
    $consulta->bindParam(':temperatura', $temperatura);
    $consulta->bindParam(':pulso', $pulso);

    // Ejecuta la consulta
    $consulta->execute();

    echo "Datos guardados correctamente.";
} catch(PDOException $e) {
    echo "Error al guardar datos: " . $e->getMessage();
}

}
?>
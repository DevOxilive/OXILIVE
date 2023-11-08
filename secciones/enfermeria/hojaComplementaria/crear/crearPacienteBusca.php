<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
    include("../../../../connection/conexion.php");
    include("../../../../module/genero.php");
    include("../../../../module/administradora.php");
    include("../../../../module/tipoPaciente.php");
    include("../../../../module/banco.php"); //Listo ya quedo..:3
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../../../../assets/css/foto_perfil.css">
    <link rel="stylesheet" href="../../../../assets/css/edit.css">
    <link rel="stylesheet" href="../css/nomina.css">
    <link rel="stylesheet" href="../css/buscador.css">
</head>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-header" style="border: 2px solid #012970; background: #005880;">
            <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Primero asegurate de que el paciente no existe</h4>
                    
            </div>
        </div>
    </section>
</main>
<script>
const banco = document.querySelector('#banco');
const administradoraInput = document.querySelector('#administradora');
banco.addEventListener('change', () => {
    const selectedOption = banco.options[banco.selectedIndex];
    const bancoId = selectedOption.value;

    const op = new XMLHttpRequest();

    //Configuro la colicitud
    op.open('GET', `consultaAdmi.php?banco_id=${bancoId}`, true);
    //Mi prueba de manejo de respuesta
    op.onload = () => {
        if (op.status === 200) {
            const data = JSON.parse(op.responseText);
            administradoraInput.value = data.Nombre_administradora;
        } else {
            console.error('Error al obtener la administradora..:( ', op.statusText);
        }
    };
    //Errores de conexion
    op.onerror = () => {
        console.error('Error de conexion al servidor..:(');
    }
    op.send();
});
</script>
<script src="../js/buscador.js"></script>
<script src="../js/nomina.js"></script>
<script src="../js/botonAdd.js"></script>
<script src="../js/validacion.js"></script>
<script src="../js/formButtons.js"></script>
<script src="../js/domicilio.js"></script>
<script src="../js/paciente.js"></script>
</html>
<?php
include("../../../../templates/footer.php");
?>
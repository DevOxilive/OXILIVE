<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include ("../../../connection/conexion.php");

    // Obtener el ID del paciente 
    $pacienteId = $_GET['idPac'];

    // Consulta para obtener los detalles del paciente utilizando el ID almacenado en la variable de sesión
    $consulta = "SELECT pacientes.*, Nombre_administradora, Nombre_aseguradora, Nombre_banco
    FROM pacientes_oxigeno AS pacientes
    JOIN administradora AS admin ON pacientes.Administradora = admin.id_administradora
    JOIN aseguradoras ON pacientes.Aseguradora = aseguradoras.id_aseguradora
    JOIN bancos ON pacientes.Banco = bancos.id_bancos
    WHERE pacientes.id_pacientes = :id_pacientes";

    $sentencia = $con->prepare($consulta);
    $sentencia->bindParam(':id_pacientes', $pacienteId);
    $sentencia->execute();
    $datos_paciente = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    // Mostrar los detalles del paciente aquí utilizando la variable $paciente
} else {
    echo "Error en el sistema";
}
?>

<!-- Contenido HTML para mostrar los datos del paciente -->
<main class="main" id="main">
    <div class="card">
        <div class="card-header" style="border: 2px solid #012970; background: #005880;">
            <h4
                style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                Datos del paciente</h4>
                <div class="card">
    <?php foreach($datos_paciente as $paciente) {?>
        <div class="card-body">
            <h5 class="card-title">Numero de expediente: <?php echo $paciente['No_nomina']; ?></h5>
            <h5 class="card-title">Nombre completo: <?php echo $paciente['Nombres'] . ' ' . $paciente['Apellidos']; ?></h5>
            <h5 class="card-title">Género: <?php echo $paciente['Genero']; ?></h5>
            <h5 class="card-title">Edad: <?php echo $paciente['Edad']; ?></h5>
            <h5 class="card-title">Domicilio: <?php echo $paciente['calle'] . ' ' . $paciente['num_in'] . ' ' . $paciente['num_ext'] . ' ' . $paciente['colonia'] . ' ' . $paciente['cp'] . ' ' . $paciente['municipio'] . ' ' . $paciente['estado_direccion'] . ' ' . $paciente['Alcaldia']; ?></h5>
            <h5 class="card-title">Administradora: <?php echo $paciente['Nombre_administradora']; ?></h5>
            <h5 class="card-title">Aseguradora: <?php echo $paciente['Nombre_aseguradora']; ?></h5>
            <h5 class="card-title">Banco: <?php echo $paciente['Nombre_banco']; ?></h5>
            <h5 class="card-title">Responsable: <?php echo $paciente['responsable']; ?></h5>
        </div>
    <?php } ?>
</div>

</main>

<?php
include("../../../templates/footer.php");
?>
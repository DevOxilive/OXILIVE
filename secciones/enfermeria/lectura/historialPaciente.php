<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
}  elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("./ltr/consultaPrueba.php");
}
else {
    echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div class="row">
        <h1 style="text-align:center;">Esta en SHF</h1>
        <div class="card-header" style="text-align: left;">
            <a class="btn btn-outline-dark" href="index.php" role="button"><i class="bi bi-bank"></i> Salir</a>
        
            <button class="btn btn-success float-right" id="mostrarOcultarBtn"><i class="bi bi-link"></i> Generar URL</button>
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered  border-dark table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr class="table-active table-group-divider" style="text-align: center;">
                                <th scope="col">No.P</th>
                                <th scope="col">Paciente</th>
                                <th scope="col">Genero</th>
                                <th scope="col">Edad</th>
                                <th scope="col">Calle</th>
                                <th scope="col">RFC</th>
                                <th scope="col">Nomina</th>
                                <th scope="col">Doctor</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($id_lista as $lt) { ?>
                            <tr class="">
                                <td>
                                    <?php echo $lt['id_pacientes']; ?>
                                </td>

                                <td>
                                    <?php echo $lt['Nombres']; ?>
                                </td>

                                <td>
                                    <?php echo $lt['Genero']; ?>
                                </td>
                                <td>
                                    <?php echo $lt['Edad']; ?>
                                </td>
                                <td>
                                    <?php echo $lt['calle']; ?>
                                </td>
                                <td>
                                    <?php echo $lt['rfc']; ?>
                                </td>
                                <td>
                                    <?php echo $lt['No_nomina']; ?>
                                </td>
                                <td>
                                    <?php echo $lt['responsable']; ?>
                                </td>

                                <!-- <td style="text-align: center;">
                                    <a class="btn btn-info" id="mostrarDiv" href="../historialPaciente.php?txtID=<?php echo $ltrSHS['id_pacientes']; ?>" role="button"><i class="bi bi-link"></i></a>                       
                                    </td> -->
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- <div id="resultadoURL"></div> -->
                    <div id="miDiv" style="text-align:center">
                    <?php
                        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
                        $host = $_SERVER['HTTP_HOST'];
                        $uri = $_SERVER['REQUEST_URI'];
                        $urlDeLaVista = $protocol . "://" . $host . $uri;
                        echo "URL de la vista: " . $urlDeLaVista;
                    ?>
                    </div>
                    <!--Aquí termina-->
                </div>
            </div>
</main>
<script>
        // Obtén una referencia al botón y al div
        var mostrarOcultarBtn = document.getElementById("mostrarOcultarBtn");
        var miDiv = document.getElementById("miDiv");
        
        // Agrega un controlador de clic al botón
        mostrarOcultarBtn.addEventListener("click", function () {
            // Verifica si el div está visible o no
            if (miDiv.style.display === "none") {
                // Si está oculto, muéstralo
                miDiv.style.display = "block";
            } else {
                // Si está visible, ocúltalo
                miDiv.style.display = "none";
            }
        });
    </script>
<!-- <script>
       
        // Obtén una referencia al botón
        var generarURLBtn = document.getElementById("generarURLBtn");
        
        // Agrega un controlador de clic al botón
        generarURLBtn.addEventListener("click", function () {
            // Obtiene el protocolo (http o https)
            var protocol = window.location.protocol;
            
            // Obtiene el nombre del host (dominio)
            var host = window.location.host;
            
            // Obtiene la ruta actual (nombre del archivo)
            var uri = window.location.pathname;
            
            // Construye la URL completa
            var urlDeLaVista = protocol + "//" + host + uri;
            
            // Muestra la URL en el elemento con id "resultadoURL"
            document.getElementById("resultadoURL").innerHTML = "URL de la vista: " + urlDeLaVista;
        });
    </script> -->
<?php
include("../../../templates/footer.php");
?>
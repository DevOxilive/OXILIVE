<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<main id="main" class="main">
    <input type="hidden" id="statusUs" name="statusUs" value="<?php echo $_SESSION['estado']; ?>">
    <input type="hidden" id="idMed" name="idMed" value="<?php echo $_SESSION['idus']; ?>">

    <div class="pagetitle">
        <h1 style="text-align: center">
            Medic<?php if ($_SESSION['genero'] == 1) { ?>o<?php } else { ?>a<?php } ?>
            <?php echo ucfirst(strtolower($_SESSION['no'])); ?>
        </h1>
    </div>
    <section class="section dashboard">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                    <div class="card">
                        <div class="card-body">
                            <p class="mt-2"><strong style="color:brown"> Bienvenido <br>Que tenga un buen día</strong></p>
                            <img src="<?php echo $_SESSION['foto']; ?>" id="fot" alt="Foto de perfil" class="img-fluid mt-3">
                            <p class="mt-2"><strong style="color:brown" id="servicio-status"></strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

</html>
<script>
    $(document).ready(function() {
        var botonAgregado = false; // Variable para controlar si el botón ya se agregó

        function consultarServicio() {
            let idMed = document.getElementById("idMed").value;
            $.ajax({
                url: '../medicos/consulta.php',
                type: 'POST',
                data: {
                    id: idMed
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.length > 0) {
                        var serviciosPorRealizar = 0;
                        var incidencias = 0;
                        var boton = $("<a href='../medicos/index.php' type='button' class='btn btn-info'>ver <i class='bi bi-eye'></i> </a>");
                        for (var i = 0; i < data.length; i++) {
                            var estado = data[i].estado;

                            if (estado === 1) {
                                serviciosPorRealizar++;
                            } else if (estado === 3) {
                                incidencias++;
                            }
                            console.log(serviciosPorRealizar);
                        }
                        if (serviciosPorRealizar > 0) {
                            $('#servicio-status').text("Tienes " + serviciosPorRealizar + " servicios por realizar\n");

                            if (!botonAgregado) {
                                $("#servicio-status").after(boton);
                                botonAgregado = true;
                            }
                        } else if (incidencias > 0) {
                            $('#servicio-status').text("No tienes incidencias por realizar");
                        } else {
                            $('#servicio-status').text("Tienes " + incidencias + " incidencias");
                        }
                    } else {
                        $('#servicio-status').text("No se encontraron datos");
                    }
                },
                error: function(error) {
                    console.error("Error al obtener los datos:", error);
                    $('#servicio-status').text("Error al obtener los datos");
                }
            });
        }
        consultarServicio();
        setInterval(consultarServicio, 2000);
    });
</script>
<?php
include("../../../templates/footer.php");
?>
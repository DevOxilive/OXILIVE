<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    
    include("consulta.php");
} else {
    echo "Error en el sistema";
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/foto_perfil.css">
    <link rel="stylesheet" href="<?php echo $url_base; ?>assets/css/edit.css">
</head>
<main id="main" class="main">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-success" href="crear.php" role="button">Ir a scannerar <i class="bi bi-fullscreen"></i></a>
            </div>

            <!-- Aquí empiezo mis pruebas xD -->
            <?php foreach ($ltServicio as $servicio) { ?>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Solicitado por: <?php echo $servicio['nom_solicitante']; ?></h5>
                            <p class="card-text">Motivo de consulta: <?php echo $servicio['moti_consulta']; ?></p>
                            <div class="map-container">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15052.618110601145!2d-98.97974744999998!3d19.405728200000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2smx!4v1697645003873!5m2!1ses-419!2smx"
                                        width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            <!-- Botón "Iniciar Servicio" -->
                            <?php
                            $estado = $servicio['estado'];
                            if ($estado == 1) {
                                $mensaje = "Servicio Iniciado";
                            } else {
                                $mensaje = "Iniciar Servicio";
                            }
                            ?>
                            <button id="btn-iniciar-servicio" class="btn btn-primary" data-id="<?php echo $servicio['id_sv']; ?>" data-estado="<?php echo $estado; ?>"><?php echo $mensaje; ?></button>
                            <button id="btn-finalizar-servicio" class="btn btn-danger" style="display: none;" disabled>Finalizar Servicio</button>
                            <!-- Cronómetro -->
                            <div id="cronometro_<?php echo $servicio['id_sv']; ?>"></div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</main>
<script>
    const btnIniciarServicio = document.querySelectorAll("#btn-iniciar-servicio");
    const btnFinalizarServicio = document.querySelectorAll("#btn-finalizar-servicio");

    btnIniciarServicio.forEach(function (btn) {
        btn.addEventListener("click", function () {
            const servicioId = this.getAttribute("data-id");
            const estado = this.getAttribute("data-estado");
            if (estado == 1) {
                // Cambiar el estado a 2 (Servicio Iniciado)
                cambiarEstadoServicio(servicioId, 2);
                // Mostrar alerta
                mostrarAlerta("Servicio Iniciado");
                // Deshabilitar el botón "Iniciar Servicio"
                btn.disabled = true;
                // Mostrar el botón "Finalizar Servicio" después de 20 segundos
                setTimeout(function () {
                    btnFinalizarServicio.forEach(function (finalizarBtn) {
                        if (finalizarBtn.getAttribute("data-id") === servicioId) {
                            finalizarBtn.style.display = "block";
                            finalizarBtn.disabled = false;
                        }
                    });
                }, 20000);
                // Iniciar el cronómetro
                iniciarCronometro(servicioId, 20);
            }
        });
    });

    // Botón "Finalizar Servicio"
    btnFinalizarServicio.forEach(function (btn) {
        btn.addEventListener("click", function () {
            const servicioId = this.getAttribute("data-id");
            // Cambiar el estado a 3 (Servicio Finalizado)
            cambiarEstadoServicio(servicioId, 3);
        });
    });

    // Simular cambio de estado en la base de datos
    function cambiarEstadoServicio(servicioId, nuevoEstado) {
        // Aquí puedes realizar una solicitud AJAX para actualizar el estado en la base de datos.
        // Simulación en este caso:
        const btnIniciar = document.querySelector(`#btn-iniciar-servicio[data-id="${servicioId}"]`);
        btnIniciar.setAttribute("data-estado", nuevoEstado);
    }

    function iniciarCronometro(servicioId, tiempoSegundos) {
        const cronometro = document.getElementById("cronometro_" + servicioId);
        let segundos = tiempoSegundos;

        function actualizarCronometro() {
            const minutos = Math.floor(segundos / 60);
            const segundosRestantes = segundos % 60;

            const minutosTexto = minutos < 10 ? "0" + minutos : minutos;
            const segundosTexto = segundosRestantes < 10 ? "0" + segundosRestantes : segundosRestantes;

            cronometro.textContent = minutosTexto + ":" + segundosTexto;

            if (segundos <= 0) {
                // Cuando el tiempo se agota, oculta el cronómetro
                cronometro.style.display = "none";
            } else {
                setTimeout(actualizarCronometro, 1000);
            }

            segundos--;
        }

        actualizarCronometro();
    }
    function mostrarAlerta(mensaje) {
        // Aquí puedes personalizar la alerta con un estilo adecuado
        alert(mensaje);
    }
</script>

<?php
include("../../../templates/footer.php");
?>
</html>
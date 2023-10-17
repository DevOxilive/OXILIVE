<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
    exit(); // Asegúrate de salir después de redirigir para prevenir la ejecución de código adicional.
} else {
    include("../../../templates/header.php");
}
?>

<main class="main" id="main">
    <div class="card">
        <div class="card-header" style="border: 2px solid #012970; background: #005880;">
            <h4
                style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                Consultar Paciente</h4>
        </div>
        <div class="card-body" style="border: 2px solid #BFE5FF;"> <br>
            <form class="row g-3">
                <label for="Buscar_pacientes" class="form-label">Buscar paciente</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="search_cliente" name="Buscar_pacientes"
                        placeholder="Nombre del paciente" required autocomplete="off">
                    <button class="btn btn-primary" type="button" id="Select">Seleccionar</button>
                </div>
                <div class="card list-group" id="show-list"></div>
            </form>

        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $("#search_cliente").keyup(function() {
        let searchText = $(this).val();

        if (/[^a-zA-Z]/.test(searchText)) {
            $("#show-list").html("Solo se permiten letras en la búsqueda.");
            $("#Select").prop("disabled", true).removeClass("btn-primary").addClass("btn-danger");
            return;
        }

        if (searchText != "") {
            $.ajax({
                url: "buscarPaciente.php",
                method: "post",
                data: {
                    query: searchText
                },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        if ("error" in data) {
                            $("#Select").prop("disabled", true).removeClass("btn-primary")
                                .addClass("btn-danger");
                            $("#show-list").html(data.error);
                        } else {
                            $("#Select").prop("disabled", false).removeClass("btn-danger")
                                .addClass("btn-primary");
                            var patientList = data.map(function(patient) {
                                // Codificar los valores de id_pacientes, Apellidos y Nombres para asegurar la URL
                                var idPaciente = encodeURIComponent(patient
                                    .id_pacientes);
                                var url = 'informacionPaciente.php?idPac=' +
                                    idPaciente;
                                return '<a href="' + url +
                                    '" class="list-group-item list-group-item-action border-1">' +
                                    patient.Apellidos + ' ' + patient.Nombres +
                                    '</a>';
                            });
                            $("#show-list").html(patientList.join(''));
                        }
                    } catch (error) {
                        console.log("Error al parsear la respuesta JSON: " + error);
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error en la solicitud AJAX: " + error);
                }
            });
        } else {
            $("#Select").prop("disabled", true).removeClass("btn-primary").addClass("btn-danger");
            $("#show-list").html("");
        }
    });

    $("#show-list").on("click", "a", function(event) {
        event.preventDefault();
        $("#search_cliente").val($(this).text());
        $("#show-list").html("");
    });

    $("#show-list").on("click", "a", function(event) {
        event.preventDefault();
        var pacienteId = $(this).data('id_pacientes'); // Obtén el ID del paciente de los atributos de datos del enlace

        // Redirige a la página informacionPaciente.php con el ID del paciente como parámetro GET
        window.location.href = "informacionPaciente.php?idPac=" + pacienteId;
    });
});


</script>
<?php
include("../../../templates/footer.php");
?>
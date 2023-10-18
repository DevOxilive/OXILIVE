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
            <h4 style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                Consultar Paciente</h4>
        </div>
        <div class="card-body" style="border: 2px solid #BFE5FF;"> <br>
            <form class="row g-3">
                <label for="Buscar_pacientes" class="form-label">Buscar paciente</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="search_cliente" name="Buscar_pacientes" placeholder="Nombre del paciente" required autocomplete="off">
                </div>
                <div class="card list-group" id="show-list"></div>
            </form>

        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $("#search_cliente").on("input", function() {
            // Obtén el texto de búsqueda
            let searchText = $(this).val();

            $.ajax({
                url: "buscarPaciente.php",
                type: "post",
                data: {
                    query: searchText
                },
                success: function(data) {
                    $("#show-list").html(data);
                }
            });
        });
    });
</script>
<?php
include("../../../templates/footer.php");
?>
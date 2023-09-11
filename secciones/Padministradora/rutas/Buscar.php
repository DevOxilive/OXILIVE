<?php
session_start();
if (!isset($_SESSION['us']) || $_SESSION['puesto'] != 2) {
  header('Location: ../../login.php');
} elseif (isset($_SESSION['us']) && $_SESSION['puesto'] == 2) {
  include("../../../templates/header.php");
} else {
  echo "Error en el sistema";
}
?>

<main class="main" id="main">
  <div class="card">
    <div class="card-header" style="border: 2px solid #012970; background: #005880;">
      <h4
        style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
        Generar ruta</h4>
    </div>
    <div class="card-body" style="border: 2px solid #BFE5FF;"> <br>
      <form action="./crear.php" method="POST" class="row g-3">

        <label for="Buscar_pacientes" class="form-label">Nombre de paciente</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="search_cliente" name="Buscar_pacientes"
            placeholder="Nombre del paciente" required autocomplete="off">
          <button class="btn btn-primary" type="submit" name="submit" id="Select">Seleccionar</button>
        </div>
        <div class="card list-group" id="show-list"></div>

      </form>
    </div>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>
  $(document).ready(function () {
    // Send Search Text to the server
    $("#search_cliente").keyup(function () {
      let searchText = $(this).val();
      if (searchText != "") {
        $.ajax({
          url: "buscardetallepaciente.php",
          method: "post",
          data: {
            query: searchText,
          },
          success: function (response) {
            $("#show-list").html(response);
          },
        });
      } else {
        $("#show-list").html("");
      }
    });
    $("#show-list").on("click", "a", function (event) {
      event.preventDefault();
      $("#search_cliente").val($(this).text());
      $("#show-list").html("");
    });
  });
</script>
<?php
include("../../../templates/footer.php");
?>
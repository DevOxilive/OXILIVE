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
<main class="main" id="main">
<section class="section dashboard">
  <div class="card">
    <div class="card-header" style="border: 2px solid #012970; background: #005880;">
      <h4
        style="text-align: center; color: #fff; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
        Buscar producto para devolver</h4>
    </div>
    <div class="card-body" style="border: 2px solid #BFE5FF;"> <br>
      <form action="./entrada.php" method="POST" class="row g-3">

        <label for="buscar_material_devolver" class="form-label">Nombre del Material ó Producto</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="search_material_devuelto" name="buscar_material_devolver"
            placeholder="Nombre del material" required autocomplete="off">
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
    $("#search_material_devuelto").keyup(function () {
      let searchText = $(this).val();
      if (searchText != "") {
        $.ajax({
          url: "buscarmaterial.php",
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
      console.log("Elemento seleccionado:", $(this).text());
      $("#search_material_devuelto").val($(this).text());
      $("#id_salida").val($(this).data("id_salida"));
      $("#id_almacen").val($(this).data("id_almacen"));
      $("#show-list").html("");
    });
  });
</script>
<?php
include("../../../templates/footer.php");
?>
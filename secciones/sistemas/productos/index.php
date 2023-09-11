<?php 
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../../../connection/conexion.php");
    include("./consulta.php");
} else {
    echo "Error en el sistema";
}
?>

<main id="main" class="main">
  <div class="row">
    <div class="card">
      <div class="card-header">
        <a class="btn btn-outline-primary" href="crear.php" role="button"><i class="bi bi-bag-plus-fill"></i>   
          Agregar Productos</a>
      </div>

      <div class="card-body">
        <div class="table-responsive-sm">
          <table class="table table-bordered  border-dark table-hover" id="myTable">
            <thead class="table-dark">
              <tr class="table-active table-group-divider" style="text-align: center;">
                <th scope="col">Num</th>
                <th scope="col">Nombre </th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($listaproductos as $registro) { ?>
                <tr class="">
                  <th scope="row">
                    <?php echo $registro['id_productos']; ?>
                  </th>
                  <td>
                    <?php echo $registro['nombre']; ?>
                  </td>
                  <td style="text-align: center;">
                    <a class="btn btn-outline-warning"
                      href="editar.php?txtID=<?php echo $registro['id_productos']; ?>" role="button"><i
                        class="bi bi-pencil-square"></i></a>
                    |
                    <a class="btn btn-outline-danger" onclick="eliminar(<?php echo $registro['id_productos']; ?>)"
                      role="button"><i class="bi bi-trash-fill"></i></a>
                  </td>
                </tr>

              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</main>


<script>
      function eliminar(codigo) {
    Swal.fire({
      title: '¿Estas seguro?',
      text: "No podrás recuperar los datos",
      cancelButtonText: 'Cancelar',
      icon: 'warning',
      buttons: true,
      showCancelButton: true,
      dangerMode: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        mandar(codigo)
      }
    })
  }
  function mandar(codigo) {
    parametros = { id: codigo };
    $.ajax({
      data: parametros,
      url: "./eliminar.php",
      type: "POST",
      beforeSend: function () { },
      success: function () {
        Swal.fire("Eliminado:", "Ha sido eliminado", "success").then((result) => {
          window.location.href = "index.php";


        });
      },



    });



  }
    $(document).ready(function () {
    $.noConflict();

    $('#myTable').DataTable({
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
      }
    });

  });
</script>
<?php 

include("../../../templates/footer.php");

?>



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
<main id="main" class="main">
    <h1 style="text-align: center;">Procedimientos Realizados</h1>
      <div class="card-header" style="text-align: right;"></div>
    <div class="card">
        <div class="card-header">
            <a name="" id="" class="btn btn-outline-primary" href="./crear.php" role="button"> <i class="bi bi-person-fill-add"></i> Nuevo procedimiento</a>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-bordered  border-dark table-hover" id="myTable">
                    <thead class="table-dark">
                        <tr class="table-active table-group-divider" style="text-align: center;">
                            <th scope="col">Núm</th>
                            <th scope="col">CPT</th>
                            <th scope="col">Nom.Paciente</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Fecha</th>                           
                            
                            <th scope="col">Operaciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <th scope="row">
                                1
                            </th>
                             <td>
                             <P>EN-BA-03</P>
                             <td>
                                    <p>Mora Castro Margarita</p>
                                </td>
                                </td>
                                <td>
                                    <p>Apoyo Enfermera General 8 Horas</p>
                                </td>
                              
                                <td>
                                <P>Turno 8 Horas</P>
                                </td>
                            <td style="text-align: center;">
                                <a class="btn btn-outline-warning"
                                    href="#" role="button"><i
                                        class="bi bi-pencil-square"></i></a>
                                |
                                <a class="btn btn-outline-danger"
                                    onclick="#" role="button"><i
                                        class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php
include("../../../templates/footer.php");
?>
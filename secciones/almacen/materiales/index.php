<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
} else {
    echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div class="row">
        <div class="card w-100">
            <div class="card-header">
                <h3 class="card-title">Listado De Materiales Y Recursos</h3>
                <hr>
                <div class="btn-box justify-content-first">
                    <a class="btn btn-outline-primary" href="crear.php" role="button">
                        <i class="bi bi-person-fill-add"></i> Entrada
                    </a>
                </div>
            </div>
            <div class="card-body d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card mb-3 h-100" style="text-align: center;">
                            <div class="card-body"><br>
                           
                                <p class="card-text"><a href="">Materiales De Oficina</a></p>
                                <hr>
                                <svg xmlns="http://www.w3.org/2000/svg" width="100px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                <p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    consequatur adipisci qui quia nostrum recusandae.</p>
                                    
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mb-3 h-100" style="text-align: center;">
                            <div class="card-body"><br>
                                <p class="card-text"><a href="">Materiales De Computo</a></p>
                                <hr>
                                <svg xmlns="http://www.w3.org/2000/svg" width="100px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z" /></svg>
                                <p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    consequatur adipisci qui quia nostrum recusandae.</p>
                            </div>
                        </div>
                    </div>
                    <!--Materiales de herramienta-->
                    <div class="col-md-3">
                        <div class="card mb-3 h-100" style="text-align: center;">
                            <div class="card-body"><br>
                                <p class="card-text"><a href="">Herramienta</a></p>
                                <hr>
                                <svg xmlns="http://www.w3.org/2000/svg" width="100px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"> <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" /></svg>
                                <p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    consequatur adipisci qui quia nostrum recusandae.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include("../../../templates/footer.php");
?>
<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} else {
    include("../../../templates/header.php");
}
?>
<main class="main" id="main">
    <section class="section">
        <div class="card card-form">
            <div class="card-header">
                <h4>Consultar Paciente</h4>
            </div>
            <div class="card-body"><br>
                <form class="formLogin row g-3">
                    <div class="contenido col-md-12">
                        <label class="form-label fs-5">Buscar material:</label>
                        <input type="text" class="form-control" placeholder="Nombre del material" autocomplete="off">
                    </div>
                    <div class="contenido col-md-12">
                        <div class="dropdown-list" id="show-list"></div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
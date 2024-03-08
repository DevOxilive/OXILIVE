<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../templates/header.php");
    include("../model/profile.php");
}
?>
<main class="main" id="main">
    <div class="row">
        <?php foreach ($datos_usuario as $user) { ?>
            <div class="card">
                <div class="card-body">
                    <div class="profile-card mt-5">
                        <img style="width: 150px; height: 150px;" src="<?php echo $user['fotoPerfil'] ?>" alt="Foto de Perfil" class="rounded-circle">
                    </div>
                    <h3 class="card-title"><?php echo $user['usuario']; ?></h3>
                    <h4 class="text-black"><?php echo $user['nombres'] . " " . $user['apellidos']; ?></h4>
                </div>
            </div>
        <?php } ?>
    </div>
</main>
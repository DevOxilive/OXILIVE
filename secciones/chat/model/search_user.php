<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    include('../../../connection/conexion.php');
    include('../control/Chat.php');
    $text = $_POST['search'];
    $id = $_SESSION['idus'];
    $search = new Chat();
    // buscar usuarios
    $result = $search->search($con, $text, $id);
    if (count($result) > 0) {
        foreach ($result as $data) {
?>
            <div class="box-user" id="box-user" data-check="<?php echo $data['token'] ?>">
                <div class="box-img">
                    <img src="<?php echo $data['fotoPerfil'] ?>" alt="" width="100">
                </div>
                <div class="info">
                    <?php echo $data['usuario'] ?>
                    <?php echo $data['nombres'] ?>
                    <?php echo $data['apellidos'] ?>
                    <?php echo $data['estatus'] ?>
                </div>
            </div>
        <?php
        }
    } else {
        ?>
        <h4>no se encuentran resultados</h4>
<?php
    }
}

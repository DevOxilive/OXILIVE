<?php
include("../../../templates/hea.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {

} else {
    ?>
    <script>
        swal.fire({
            icon: 'info',
            title: 'ERROR',
            text: 'Error en el servidor',
        }).then((result) => {
            window.location = "../account.php";
          });
    </script>
    <?php
}
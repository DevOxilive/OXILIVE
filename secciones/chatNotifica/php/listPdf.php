<!-- <form action="eliminar_documento.php" method="post"> -->

        <?php
        try {

            include '../../../cargaDoc/control.php';
            $output = $_POST['output'];
            mostrarPDF($con, 'documentos/', $output);
        } catch (Exception $e) {
            echo ":D";
        }
        ?>
<!-- </form> -->
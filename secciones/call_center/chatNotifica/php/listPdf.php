<table>
    <?php
    include '../../../../cargaDoc/control.php';
    $output = $_POST['output'];
    mostrarPDF($con, 'documentos/', $output);
    ?>
</table>

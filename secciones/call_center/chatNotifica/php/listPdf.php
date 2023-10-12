<table>
    <tr class="encabezadoT">
        <td>id</td>
        <td>nombre del documento</td>
    </tr>
    <?php
    include '../../../../cargaDoc/control.php';
    mostrarPDF($con, 'documentos/');
    ?>
</table>
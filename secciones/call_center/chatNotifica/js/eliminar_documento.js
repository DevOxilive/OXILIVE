$(document).ready(function () {
    $('.eliminar-documento').click(function () {
        var documentoID = $(this).data('documento-id'); // Mueve esta línea dentro de la función de clic

        console.log("Clic en botón Eliminar: documentoID = " + documentoID);
        if (confirm("¿Estás seguro de que deseas eliminar este documento?")) {
            $.ajax({
                type: "POST",
                url: "eliminar_documento.php",
                data: { documento_id: documentoID },
                success: function (response) {
                    if (response === "success") {
                        location.reload();
                    } else {
                        alert("Hubo un error al eliminar el documento.");
                    }
                }
            });
        }
    });
});
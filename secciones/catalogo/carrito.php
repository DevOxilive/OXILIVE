<?php
date_default_timezone_set('America/Mexico_City');
session_start();
include("../../templates/header.php");
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}
if (!empty($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
} else {
    echo "Your cart is empty.";
}
function calcularSubtotal()
{
    $subtotal = 0;
    if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $producto) {
            if (isset($producto['precio']) && isset($producto['cantidad'])) {
                $subtotal += $producto['precio'] * $producto['cantidad'];
            }
        }
    }
    return $subtotal;
}
$ivaPorcentaje = 0.16;
include("../../connection/conexion.php");
function obtenerCantidadMaxima($productID, $con)
{
    try {
        $query = "SELECT cantidad FROM productos WHERE id_productos = :productID";
        $stmt = $con->prepare($query);
        $stmt->bindValue(':productID', $productID, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row['cantidad'];
        } else {
            return 100;
        }
    } catch (PDOException $e) {
        return 100;
    }
}
?>
<?php
function obtenerCantidadTotalCarrito()
{
    $cantidadTotal = 0;
    if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $producto) {
            if (isset($producto['cantidad'])) {
                $cantidadTotal += $producto['cantidad'];
            }
        }
    }
    return $cantidadTotal;
}
$numProductosCarrito = obtenerCantidadTotalCarrito();
?>
<main id="main" class="main">
    <div class="card-header" style="text-align: right;">
        <a class="btn btn-outline-dark" href="./index.php" role="button"><i class="bi bi-arrow-return-left"></i>
            Volver</a>
    <h1 style="text-align: center; font-family: Verdana, Geneva, Tahoma, sans-serif; color:black;"><i class="bi bi-cart-fill"></i>
        Carrito de Compras</h1> <br>
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table cart-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['carrito'] as $key => $producto) {

                            $maxima = obtenerCantidadMaxima($key, $con);
                            ?>
                            <tr>
                                <td>
                                    <?php echo $producto['nombre']; ?>
                                </td>
                                <td>$
                                    <?php echo number_format($producto['precio']); ?>
                                </td>
                                <td>
                                    <input type="number" class="form-control cart-quantity"
                                        data-product-key="<?php echo $key; ?>" min="1"
                                        value="<?php echo $producto['cantidad']; ?>" max="<?php echo $maxima; ?>">
                                </td>
                                <td>$
                                    <?php echo number_format($producto['precio'] * $producto['cantidad']); ?>
                                </td>
                                <td>
                                    <button class="btn btn-danger remove-btn"
                                        data-product-key="<?php echo $key; ?>">Eliminar</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <h2 class="cart-subtotal">Subtotal: $
                    <?php echo number_format(calcularSubtotal()); ?>
                </h2>
            </div>
        </div>
        <div id="ticket-container" style="display: none; max-width: 300px;">
            <div style="text-align: center;">
                <img src="../../img/Logo.png" alt="Logo de la empresa" style="max-width: 150px;">
            </div>
            <p style="text-align: center; font-size: 14px; margin-top: 5px;">Oxilive Mexico </p>
            <p style="text-align: center; font-size: 12px;">Villa Guerrero 227, Atlacomulco, 57600 Nezahualcóyotl, Méx.
            </p>
            <p style="text-align: left; font-size: 12px; margin-bottom: 5px;">RFC: ABC123456XYZ</p>
            <p style="text-align: left; font-size: 12px; margin-bottom: 5px;">Folio Fiscal: 12345678901234567890</p>
            <?php
            $fechaActual = date_default_timezone_set('America/Mexico_City');
            $fechaActual = date('Y-m-d H:i:s', time());
            ?>
            <p style="text-align: left; font-size: 12px; margin-bottom: 5px;">Fecha y hora de emisión:
                <?php echo $fechaActual; ?>
            </p>
            <hr style="margin: 10px 0;">
            <table style="width: 100%; margin-bottom: 10px;">
                <tr style="background-color: #f2f2f2; font-size: 12px;">
                    <th style="padding: 5px; text-align: left; width: 60%;">Producto</th>
                    <th style="padding: 5px; text-align: right; width: 20%;">Cant.</th>
                    <th style="padding: 5px; text-align: right; width: 20%;">Total</th>
                </tr>
            </table>
            <table style="width: 100%; margin-bottom: 10px; font-size: 12px;">
                <?php foreach ($_SESSION['carrito'] as $producto) { ?>
                    <tr>
                        <td style="padding: 5px; width: 60%;">
                            <?php echo $producto['nombre']; ?>
                        </td>
                        <td style="padding: 5px; text-align: right; width: 20%;">
                            <?php echo $producto['cantidad']; ?>
                        </td>
                        <td style="padding: 5px; text-align: right; width: 20%;">$
                            <?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <table style="width: 100%; font-size: 12px;">
                <tr>
                    <td style="padding: 5px; text-align: right; width: 80%;">Subtotal:</td>
                    <td style="padding: 5px; text-align: right; width: 20%;">$
                        <?php echo number_format(calcularSubtotal(), 2); ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px; text-align: right;">IVA (
                        <?php echo ($ivaPorcentaje * 100) . '%'; ?>):
                    </td>
                    <td style="padding: 5px; text-align: right;">$
                        <?php echo number_format(calcularSubtotal() * $ivaPorcentaje, 2); ?>
                    </td>
                </tr>
                <tr style="font-weight: bold;">
                    <td style="padding: 5px; text-align: right;">Total:</td>
                    <td style="padding: 5px; text-align: right;">$
                        <?php echo number_format(calcularSubtotal() * (1 + $ivaPorcentaje), 2); ?>
                    </td>
                </tr>
            </table>
            <p style="text-align: center; font-size: 10px;">Gracias por su compra. ¡Vuelva pronto!</p>
        </div>
        <?php if (!empty($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
            ?>
            <button class="btn btn-primary checkout-btn">Generar Ticket</button>
        <?php } ?>

        <div id="factura-container" style="display: none; max-width: 300px;">
            <p style="text-align: left; font-size: 12px; margin-bottom: 5px;">Oxilive Mexico</p>
            <p style="text-align: left; font-size: 12px; margin-bottom: 5px;">RFC: ABC123456XYZ</p>
            <p style="text-align: left; font-size: 12px; margin-bottom: 5px;">Domicilio Fiscal: Calle 123, Ciudad,
                Estado, C.P. 12345</p>
            <p style="text-align: left; font-size: 12px; margin-bottom: 5px;">Cliente: Juan Pérez</p>
            <p style="text-align: left; font-size: 12px; margin-bottom: 5px;">RFC: PERJ800202ABC</p>
            <p style="text-align: left; font-size: 12px; margin-bottom: 5px;">Domicilio: Calle A, Colonia B, Ciudad,
                Estado, C.P. 67890</p>
            <?php
            $folioFiscal = "FOLIO123456789";
            ?>
            <p style="text-align: left; font-size: 12px; margin-bottom: 5px;">Folio Fiscal:
                <?php echo $folioFiscal; ?>
            </p>
            <p style="text-align: left; font-size: 12px; margin-bottom: 5px;">Fecha y hora de emisión:
                <?php echo date('Y-m-d H:i:s'); ?>
            </p>
            <p style="text-align: left; font-size: 12px; margin-bottom: 5px;">Método de pago: Tarjeta de crédito</p>
            <hr style="margin: 10px 0;">
            <table style="width: 100%; margin-bottom: 10px;">
                <tr style="background-color: #f2f2f2; font-size: 12px;">
                    <th style="padding: 5px; text-align: left; width: 60%;">Producto</th>
                    <th style="padding: 5px; text-align: right; width: 20%;">Cant.</th>
                    <th style="padding: 5px; text-align: right; width: 20%;">Total</th>
                </tr>
            </table>
            <table style="width: 100%; margin-bottom: 10px; font-size: 12px;">
                <?php foreach ($_SESSION['carrito'] as $producto) { ?>
                    <tr>
                        <td style="padding: 5px; width: 60%;">
                            <?php echo $producto['nombre']; ?>
                        </td>
                        <td style="padding: 5px; text-align: right; width: 20%;">
                            <?php echo $producto['cantidad']; ?>
                        </td>
                        <td style="padding: 5px; text-align: right; width: 20%;">$
                            <?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <table style="width: 100%; font-size: 12px;">
                <tr>
                    <td style="padding: 5px; text-align: right; width: 80%;">Subtotal:</td>
                    <td style="padding: 5px; text-align: right; width: 20%;">$
                        <?php echo number_format(calcularSubtotal(), 2); ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px; text-align: right;">IVA (16%):</td>
                    <td style="padding: 5px; text-align: right;">$
                        <?php echo number_format(calcularSubtotal() * 0.16, 2); ?>
                    </td>
                </tr>
                <tr style="font-weight: bold;">
                    <td style="padding: 5px; text-align: right;">Total:</td>
                    <td style="padding: 5px; text-align: right;">$
                        <?php echo number_format(calcularSubtotal() * 1.16, 2); ?>
                    </td>
                </tr>
            </table>
            <p style="text-align: center; font-size: 10px;">Gracias por su compra. ¡Vuelva pronto!</p>
        </div>
                </div>
</main>
<script>
    $(document).ready(function () {

        $(".remove-btn").click(function () {
            var productKey = $(this).data("product-key");
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará el producto del carrito',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "./eliminarcarrito.php",
                        method: "POST",
                        data: {
                            key: productKey
                        },
                        success: function () {
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            Swal.fire('Error', 'Error al eliminar el producto del carrito', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(document).on("change", ".cart-quantity", function () {
            var productKey = $(this).data("product-key");
            var newQuantity = $(this).val();
            var maxQuantity = parseInt($(this).attr("max"));

            if (newQuantity > maxQuantity) {
                Swal.fire({
                    icon: 'error',
                    title: 'Cantidad máxima excedida',
                    text: 'La cantidad máxima permitida es ' + maxQuantity,
                });
                $(this).val(maxQuantity);
            }

            $.ajax({
                url: "./actualizarcarrito.php",
                method: "POST",
                data: {
                    key: productKey,
                    quantity: newQuantity
                },
                success: function () {
                    location.reload();
                },
                error: function () {
                    alert("Error al actualizar la cantidad en el carrito.");
                }
            });
        });

        $(".remove-btn").click(function () {
            var productKey = $(this).data("product-key");
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará el producto del carrito',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "./eliminarcarrito.php",
                        method: "POST",
                        data: {
                            key: productKey
                        },
                        success: function () {
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            Swal.fire('Error', 'Error al eliminar el producto del carrito', 'error');
                        }
                    });
                }
            });
        });

        $(".checkout-btn").click(function () {
            var ticketContent = $("#ticket-container").html();
            var ticketWindow = window.open("", "Ticket de Compra", "width=600,height=400,scrollbars=yes,resizable=yes");
            ticketWindow.document.open();
            ticketWindow.document.write('<html><head><title>Ticket de Compra</title></head><body>');
            ticketWindow.document.write(ticketContent);
            ticketWindow.document.write('</body></html>');
            ticketWindow.document.close();
            $.ajax({
                url: "./borrarcarrito.php",
                method: "POST",
                success: function (response) {
                    if (response === "success") {
                        $(".cart-table tbody").empty();
                        $(".cart-subtotal").text("Subtotal: $0.00");
                    } else {
                        Swal.fire('Error', 'Error al generar el ticket y borrar el carrito', 'error');
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire('Error', 'Error al realizar la petición', 'error');
                }
            });
        });
    });


    $(".remove-btn").click(function () {
        console.log("Click en el botón de eliminar");
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
include("../../templates/footer.php");
?>
<script>
    $(".checkout-btn").click(function () {
        var ticketContent = $("#ticket-container").html();
        var ticketWindow = window.open("", "Ticket de Compra", "width=600,height=400,scrollbars=yes,resizable=yes");
        ticketWindow.document.open();
        ticketWindow.document.write('<html><head><title>Ticket de Compra</title></head><body>');
        ticketWindow.document.write(ticketContent);
        ticketWindow.document.write('</body></html>');
        ticketWindow.document.close();

    });
</script>
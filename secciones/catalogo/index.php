<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} else if (isset($_SESSION['us'])) {
    include("../../connection/conexion.php");
    include("./consulta.php");
    include("../../templates/header.php");
}
$numProductosCarrito = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
?>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<main id="main" class="main">
    <div class="container">
        <h1 class="text-center my-5">Nuestros Productos</h1>
        <div class="row justify-content-end mb-4">
            <div class="col-auto">
                <a href="carrito.php" class="btn btn-primary">
                    <i class="fas fa-shopping-cart mr-2"></i>Carrito
                    <span class="cart-count ml-2 badge badge-light" id="cart-count"><?php echo $numProductosCarrito; ?></span>
                </a>
            </div>
        </div>
        <div class="row">
            <?php foreach ($listaproductos as $registro) {

                $productID = $registro['id_productos'];
                $cantidadEnCarrito = isset($_SESSION["carrito"][$productID]) ? $_SESSION["carrito"][$productID]["cantidad"] : 0;
                $cantidadDisponible = $registro['cantidad'] - $cantidadEnCarrito;
                $cardClass = $cantidadDisponible === 0 ? 'disabled-card' : '';

            ?>
                <div class="col-md-6 col-lg-4 mb-4 ">
                    <div class="card shadow-sm product-card custom-card  <?php echo $cardClass; ?> ">
                        <img src="../../secciones/sistemas/productos/productos/<?php echo $registro['imagen']; ?>" style="padding: 10px; width: 340px; height: 180px;" class="card-img-top img-fluid" alt="<?php echo $registro['nombre']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $registro['nombre']; ?></h5>
                            <p class="card-text">$ <?php echo number_format($registro['precio']); ?></p>
                            <p class="card-text">Disponibles: <?php echo $registro['cantidad']; ?></p>
                            <div class="quantity-wrapper">
                                <label for="quantity<?php echo $registro['id_productos']; ?>" class="quantity-label">Cantidad:</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-number" data-type="minus" data-field="quantity<?php echo $registro['id_productos']; ?>">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="number" class="form-control input-number" id="quantity<?php echo $registro['id_productos']; ?>" name="quantity" min="1" max="<?php echo $registro['cantidad']; ?>" value="1">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-number" data-type="plus" data-field="quantity<?php echo $registro['id_productos']; ?>">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="cta-buttons">
                                <button class="btn btn-primary mt-2 btn-details" data-product-id="<?php echo $registro['id_productos']; ?>">Detalles</button>
                                <button class="btn btn-success mt-2 add-to-cart-btn" data-product-id="<?php echo $registro['id_productos']; ?>" data-product-name="<?php echo $registro['nombre']; ?>" data-product-price="<?php echo $registro['precio']; ?> ">
                                    Agregar al carrito
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
<?php foreach ($listaproductos as $registro) {
    $productID = $registro['id_productos'];
    $cantidadEnCarrito = isset($_SESSION["carrito"][$productID]) ? $_SESSION["carrito"][$productID]["cantidad"] : 0;
    $cantidadDisponible = $registro['cantidad'] - $cantidadEnCarrito;
?>
    <div class="modal fade" id="detailsModal<?php echo $productID; ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel<?php echo $productID; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel<?php echo $productID; ?>">Detalles del Producto <br> <?php echo $registro['nombre']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="../../secciones/sistemas/productos/productos/<?php echo $registro['imagen']; ?>" class="card-img-top img-fluid" alt="<?php echo $registro['nombre']; ?>">
                        </div>
                        <div class="col-md-6 product-details">
                            <h5 class="product-title"><?php echo $registro['nombre']; ?></h5>
                            <p class="product-price">$ <?php echo number_format($registro['precio']); ?></p>

                            <p class="product-description"><?php echo $registro['descripcion']; ?></p>
                            <div class="form-group">
                                <label for="quantity<?php echo $productID; ?>" class="quantity-label">Cantidad:</label>
                                <input type="number" class="form-control" id="quantity<?php echo $productID; ?>" name="quantity" min="1" max="<?php echo $cantidadDisponible; ?>" value="1">
                            </div>
                            <button class="btn btn-success add-to-cart-btn" data-product-id="<?php echo $productID; ?>" data-product-name="<?php echo $registro['nombre']; ?>" data-product-price="<?php echo $registro['precio']; ?>">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on("click", ".card-body .btn.btn-primary", function() {
        var modalID = $(this).data("target");
        $(modalID).modal("show");
    });
    $(document).on("click", ".modal .close, .modal .btn-secondary", function() {
        $(this).closest(".modal").modal("hide");
    });
</script>
<script>
    $(document).ready(function() {
        $(".btn-number").click(function(e) {
            e.preventDefault();
            var fieldName = $(this).attr("data-field");
            var type = $(this).attr("data-type");
            var input = $("#" + fieldName);
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if (type === "minus") {
                    if (currentVal > input.attr("min")) {
                        input.val(currentVal - 1).change();
                    }
                } else if (type === "plus") {
                    if (currentVal < input.attr("max")) {
                        input.val(currentVal + 1).change();
                    }
                }
            } else {
                input.val(1);
            }
        });
        $(".input-number").focusin(function() {
            $(this).data("oldValue", $(this).val());
        });
        $(".input-number").change(function() {
            var minValue = parseInt($(this).attr("min"));
            var maxValue = parseInt($(this).attr("max"));
            var valueCurrent = parseInt($(this).val());

            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + $(this).attr("id") + "']").removeAttr("disabled");
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Cantidad mínima excedida',
                    text: 'La cantidad mínima permitida es ' + minValue,
                });
                $(this).val($(this).data("oldValue"));
            }

            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + $(this).attr("id") + "']").removeAttr("disabled");
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Cantidad máxima excedida',
                });
                $(this).val($(this).data("oldValue"));
            }
        });

        $(".input-number").keydown(function(e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||

                (e.keyCode === 65 && e.ctrlKey === true) ||

                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $(document).on("click", ".btn-details", function() {
            var productID = $(this).data("product-id");
            $("#detailsModal" + productID).modal("show");
        });
    });

    function actualizarNumeroProductosCarrito() {
        $.ajax({
            type: "GET",
            url: "./obtener_numero_productos_carrito.php",
            dataType: "json",
            success: function(data) {
                $("#cart-count").text(data.numProductosCarrito);
            },
            error: function() {
                console.log("Error al ontener el numero de productos del carrito")
            }
        });
    }

    function showErrorAlert(errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage,
        });
    }
    $(document).ready(function() {
        actualizarNumeroProductosCarrito();
    });



    function actualizarNumeroProductosCarrito() {
        $.ajax({
            type: "GET",
            url: "./obtener_numero_productos_carrito.php",
            dataType: "json",
            success: function(data) {
                $("#cart-count").text(data.numProductosCarrito);
            },
            error: function() {
                console.log("Error al obtener el número de productos del carrito.");
            }
        });
    }

    $(document).on("click", ".add-to-cart-btn", function() {
        var productID = $(this).data("product-id");
        var productName = $(this).data("product-name");
        var productPrice = $(this).data("product-price");
        var inputField = $("#quantity" + productID);
        var quantity = parseInt(inputField.val());
        var maxQuantity = parseInt(inputField.attr("max"));
        var availableQuantity = parseInt(inputField.attr("data-available-quantity"));

        if (isNaN(quantity) || quantity <= 0) {
            showErrorAlert("Ingrese una cantidad válida.");
            return;
        }

        if (quantity > maxQuantity) {
            showErrorAlert("La cantidad excede el límite permitido.");
            return;
        }

        if (quantity > availableQuantity) {
            showErrorAlert("La cantidad excede la disponibilidad.");
            return;
        }

        $.ajax({
            url: "./agregarcarrito.php",
            method: "POST",
            data: {
                id: productID,
                nombre: productName,
                precio: productPrice,
                cantidad: quantity
            },
            success: function(response) {
                if (response === "success") {
                    actualizarNumeroProductosCarrito();
                    var mensaje = quantity + " producto(s) de " + productName + " agregado(s) al carrito.";
                    $("#mensaje-productos-agregados").text(mensaje).fadeIn().delay(2000).fadeOut();
                    availableQuantity -= quantity;
                    $("#quantity" + productID).attr("max", availableQuantity);

                } else {
                    showErrorAlert("Error al agregar el producto al carrito.");
                }
            },
            error: function() {
                showErrorAlert("Error al agregar el producto al carrito.");
            }
        });

    });



    function showErrorAlert(errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage,
        });
    }
</script>
<?php
include("../../templates/footer.php");
?>
<script>

</script>
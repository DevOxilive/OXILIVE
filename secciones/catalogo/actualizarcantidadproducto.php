<?php
session_start();
include("../../connection/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["key"]) && isset($_POST["quantity"])) {
        $productKey = $_POST["key"];
        $quantityToSubtract = (int)$_POST["quantity"];

        try {
            $queryGetQuantity = "SELECT cantidad FROM carrito WHERE id_usuario = :idUser AND id_producto = :productKey";
            $stmtGetQuantity = $con->prepare($queryGetQuantity);
            $stmtGetQuantity->bindValue(':idUser', $_SESSION['us']['id_usuarios'], PDO::PARAM_INT);
            $stmtGetQuantity->bindValue(':productKey', $productKey, PDO::PARAM_INT);
            $stmtGetQuantity->execute();
            $row = $stmtGetQuantity->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $currentQuantity = $row['cantidad'];
                if ($currentQuantity >= $quantityToSubtract) {
                    $newQuantity = $currentQuantity - $quantityToSubtract;
                    $queryUpdateQuantity = "UPDATE carrito SET cantidad = :newQuantity WHERE id_usuario = :idUser AND id_producto = :productKey";
                    $stmtUpdateQuantity = $con->prepare($queryUpdateQuantity);
                    $stmtUpdateQuantity->bindValue(':newQuantity', $newQuantity, PDO::PARAM_INT);
                    $stmtUpdateQuantity->bindValue(':idUser', $_SESSION['us']['id_usuarios'], PDO::PARAM_INT);
                    $stmtUpdateQuantity->bindValue(':productKey', $productKey, PDO::PARAM_INT);
                    $stmtUpdateQuantity->execute();

                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Cantidad actualizada correctamente en el carrito',
                            });
                          </script>";
                } else {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'La cantidad a restar es mayor que la cantidad en el carrito',
                            });
                          </script>";
                }
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Producto no encontrado en el carrito',
                        });
                      </script>";
            }
        } catch (PDOException $e) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al actualizar la cantidad en el carrito',
                        text: '" . $e->getMessage() . "',
                    });
                  </script>";
        }
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Datos incompletos',
                });
              </script>";
    }
} else {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Método no permitido',
            });
          </script>";
}
?>

function confirmCancel(event) {
  event.preventDefault();
  Swal.fire({
    title: "¿Estás seguro?",
    text: "Si cancelas, se perderán los datos ingresados.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, cancelar",
    cancelButtonText: "No, continuar",
  }).then((result) => {
    if (result.isConfirmed) {
      // Aquí puedes redirigir al usuario a otra página o realizar alguna otra acción
      window.location.href = "../index.php";
    }
  });
}
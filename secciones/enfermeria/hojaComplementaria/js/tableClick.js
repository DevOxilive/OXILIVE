document.addEventListener("DOMContentLoaded", function () {
    var filas = document.querySelectorAll(".clickeable-row");
  
    filas.forEach(function (fila) {
      fila.addEventListener("click", function () {
        // Obtén el URL específico de la fila clickeada
        var url = fila.getAttribute("data-url");
        console.log(url);
  
        // Redirige a la URL específica cuando se hace clic en la fila
        window.location.href = url;
      });
    });
  });
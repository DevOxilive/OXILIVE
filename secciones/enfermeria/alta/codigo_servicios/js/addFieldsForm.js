$(document).ready(function () {
  var cont = 1;
  var maxDivs = 20; // Cambiar el límite a 6

  var elems = document.querySelectorAll(".not-empty");

  $("#add-btn").prop("disabled", true);
  // Deshabilita el botón de agregar al cargar la página
  elems.forEach(function (elem) {
    elem.addEventListener("input", function () {
      if (elem.value !== "") {
        $("#add-btn").prop("disabled", false);
      } else {
        $("#add-btn").prop("disabled", true);
      }
    });
  });
  $("#add-btn").click(function (e) {
    e.preventDefault();
    cont++;
    // Verifica si se ha alcanzado el límite
    if (cont < maxDivs) {
      const codigo = document.createElement("div");
      codigo.classList.add("contenido", "col-md-3", "toDel" + cont);
      const desc = document.createElement("div");
      desc.classList.add("contenido", "col-md-3", "toDel" + cont);
      const uni = document.createElement("div");
      uni.classList.add("contenido", "col-md-2", "toDel" + cont);
      const btn = document.createElement("div");
      btn.classList.add("col-md-1", "align-self-center", "toDel" + cont);
      btn.setAttribute("style", "padding-top:1.8rem;");
      const fill = document.createElement("div");
      fill.classList.add("col-md-3", "toDel" + cont);

      var code = "",
        dess = "",
        unidad = "",
        btnDel = "";

      code =
        '<label class="form-label">Código ' +
        cont +
        "</label> " +
        '<input type="text" maxlength="12" name="codigo[]" class="form-control not-empty" placeholder="Ejemplo E20B-21-ND" required>';

      dess =
        '<label class="form-label">Descripción ' +
        cont +
        "</label>" +
        '<input type="text" maxlength="40" name="descripcion[]" class="form-control not-empty" required placeholder="Apoyo General 8 Horas">';

      unidad =
        '<label class="form-label">Unidad ' +
        cont +
        "</label>" +
        '<input type="text" maxlength="40" name="unidad[]" class="form-control not-empty" required placeholder="Turno 8 Horas">';

      btnDel =
        '<a href="#" class="btn add-btn btn-danger remove-lnk" data-id="' +
        cont +
        '"> <i class="fas fa-trash-alt"></i></a>';

      codigo.innerHTML = code;
      desc.innerHTML = dess;
      uni.innerHTML = unidad;
      btn.innerHTML = btnDel;
      var form = document.getElementById("formulario");
      var beforeThis = document.getElementById("beforeThis");

      form.insertBefore(codigo, beforeThis);
      form.insertBefore(desc, beforeThis);
      form.insertBefore(uni, beforeThis);
      form.insertBefore(btn, beforeThis);
      form.insertBefore(fill, beforeThis);
    } else {
      alert("No se pueden agregar más Código.");
    }
  });

  $(document).on("click", ".remove-lnk", function (e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var elemDels = document.querySelectorAll(".toDel" + cont);
    var elemSels = document.querySelectorAll(".toDel" + id);
    elemDels.forEach(function (elemDel) {
      elemDel.remove();
    });
    elemSels.forEach(function (elemSel) {
      elemSel.value = "";
    });
    cont--;
  });
});

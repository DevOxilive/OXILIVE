var tamaño;
var select = -1;
var elem;
var input = document.getElementById("search_cliente");
const lista = document.getElementById("show-list");
$(document).ready(function () {
  $("#search_cliente").on("input", function () {
    // Obtén el texto de búsqueda
    validar();
    let searchText = $(this).val();
    if (searchText != "") {
      fetch("model/buscarPaciente.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ text: searchText }),
      })
        .then((response) => response.json())
        .then((datos) => {
          select = 0;
          if (datos != "") {
            tamaño = datos.length;
            showPacientes(datos);
          } else {
            lista.innerHTML = "";
            var registrar = document.createElement("div");
            registrar.setAttribute(
              "data-url",
              "./crear/crearPaciente.php",
            );
            registrar.setAttribute("id", 1);
            registrar.classList.add("contenido", "col-md-12", "item-search");
            registrar.style.fontWeight = "bold";
            registrar.addEventListener("click", function () {
                window.location.href = registrar.getAttribute("data-url");
              });
            registrar.textContent = "¿No existe el paciente? Registralo aquí";
            lista.appendChild(registrar);
          }
        });
    } else {
      lista.innerHTML = "";
        select = -1;
    }
  });
});
function showPacientes(datos) {
  lista.innerHTML = "";
  let pacienteEncontrado = false;

  datos.forEach((pac, i) => {
    const item = document.createElement("div");
    item.setAttribute(
      "data-url",
      "./crear/editarPaciente.php?txtID=" + pac.id_pacientes
    );
    item.setAttribute("id", i + 1);
    item.classList.add("contenido", "col-md-12", "item-search");
    item.textContent = pac.nomComp;
    lista.appendChild(item);
    item.addEventListener("click", function () {
      window.location.href = item.getAttribute("data-url");
    });
    item.addEventListener("mouseover", function () {
      resetList();
      select = 0;
    });
    
    // Verifica si el registro actual contiene 'Credencial_front'
    if (pac.Credencial_front) {
      pacienteEncontrado = true;

      // Redirige a la página de creación para este paciente
      const crearPacienteItem = document.createElement("div");
      crearPacienteItem.setAttribute("data-url", "pacientes.php?txtID=" + pac.id_pacientes);
      crearPacienteItem.setAttribute("id", i + 1);
      crearPacienteItem.classList.add("contenido", "col-md-12", "item-search");
      crearPacienteItem.style.fontWeight = "bold";
      crearPacienteItem.addEventListener("click", function () {
        window.location.href = crearPacienteItem.getAttribute("data-url");
      });
      crearPacienteItem.textContent ="ESTE PACIENTE EXISTE  VER AQUI";
      lista.appendChild(crearPacienteItem);
    }
  });
}

input.addEventListener("keydown", function (event) {
  if (select>=0) {
    // Flecha arriba
    if (event.key === "ArrowUp") {
      event.preventDefault();
      resetList();
      if (select > 1) {
        select--;
      } else if (select == 1 || select == 0) {
        select = tamaño;
      }
      changeClass(select);
    }
    // Flecha abajo
    else if (event.key === "ArrowDown") {
      event.preventDefault();
      resetList();
      if (select < tamaño) {
        select++;
      } else if (select == tamaño) {
        select = 1;
      }
      changeClass(select);
    }
    // Enter
    else if (event.key === "Enter" && select > 0) {
      event.preventDefault();
      window.location.href = elem.getAttribute("data-url");
    }
  } else {
    if (event.key === "Enter") {
      event.preventDefault();
    }
  }
});
function resetList() {
  for (let i = 1; i <= tamaño; i++) {
    elem = setElem(i);
    elem.classList.remove("item-pseudo-hover");
  }
}
function setElem(index) {
  var elemento = document.getElementById(index);
  return elemento;
}
function changeClass(select) {
  elem = setElem(select);
  elem.classList.add("item-pseudo-hover");
}
function validar(){
    text = input.value;
    var regex = /^[a-zA-Z ]+$/;
    if (regex.test(text)) {
    } else {
        text=text.slice(0, -1);
    }
    input.value = text;
}

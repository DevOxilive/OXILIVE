var num;
function filtro(e, n, apuntador) {
  // n se vuelve el número que será consultado para traer exclusivamente los servicios con ese estado
  e.preventDefault();
  let btn = document.getElementById("btnFiltro"),
    lista = document.getElementById("lista"),
    delBtn = document.querySelectorAll(".deleteFilter");
  delBtn.forEach((e) => {
    e.style.display = "block";
  });
  lista.classList.remove("show");
  btn.setAttribute("aria-expanded", "false");
  btn.classList = "";
  btn.textContent = "";
  btn.innerHTML = "<i class='bi bi-funnel-fill'></i>";
  btn.innerHTML += " " + apuntador.textContent + " ";
  btn.style.boxShadow = "0.2em 0.2em 1em rgba(0, 0, 0, 0.3)";
  btn.classList.add("btn", "dropdown-toggle");
  num = n;
  switch (n) {
    case 1:
      btn.classList.add("btn-warning");
      break;
    case 2:
      btn.classList.add("btn-info");
      break;
    case 3:
      btn.classList.add("btn-success");
      break;
    case 4:
      btn.classList.add("btn-danger");
      break;
    default:
      btn.classList.add("btn-outline-secondary");
      btn.textContent = "";
      btn.innerHTML = "<i class='bi bi-funnel-fill'></i>";
      btn.innerHTML += " Filtro ";
      delBtn.forEach((e) => {
        e.style.display = "none";
      });
      btn.style = "";
      break;
  }
  if (n != 0) {
    fetch("model/consulta.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ estado: n }),
    })
      .then((response) => response.json())
      .then((datos) => {
        setTabla(datos);
      });
  } else {
    setAll();
  }
  getStatus(num);
  setInterval(getStatus(num), 2500);
}
function setTabla(datos) {
  let tabla = document.getElementById("table");
  tabla.innerHTML = "";
  datos.forEach((dato) => {
    const fila = document.createElement("tr"),
      enfermero = document.createElement("td"),
      fecha = document.createElement("td"),
      horario = document.createElement("td"),
      paciente = document.createElement("td"),
      estado = document.createElement("td"),
      acciones = document.createElement("td");

    fila.setAttribute("id", "fila" + dato.id);
    enfermero.textContent = dato.enfermero;
    fecha.innerHTML = "<center>" + dato.fecha + "</center>";
    horario.innerHTML =
      "<center>" +
      dato.horarioEntrada +
      " /<br>" +
      dato.horarioSalida +
      "</center>";
    paciente.textContent = dato.paciente;
    estado.innerHTML =
      "<center class='placeholder-glow'><span id='status" + dato.id + "' class='placeholder placeholder-lg col-md-8 bg-secondary'></span></center>";
    acciones.innerHTML = "<center id='acciones" + dato.id + "' class='placeholder-glow'><a class='btn btn-secondary disabled placeholder col-2' aria-disabled='true'></a>  |  <a class='btn btn-secondary disabled placeholder col-2' aria-disabled='true'></a></center>";

    fila.appendChild(enfermero);
    fila.appendChild(fecha);
    fila.appendChild(horario);
    fila.appendChild(paciente);
    fila.appendChild(estado);
    fila.appendChild(acciones);

    tabla.appendChild(fila);
  });
}
function setAll() {
  fetch("model/consulta.php", {
    headers: { "Content-Type": "application/json" },
  })
    .then((response) => response.json())
    .then((datos) => {
      setTabla(datos);
    });
}
setAll();

<?php
session_start();
if (!isset($_SESSION['us'])) {
    header('Location: ../../login.php');
} elseif (isset($_SESSION['us'])) {
    include("../../../../templates/header.php");
} else {
    echo "Error en el sistema";
}
?>
<main id="main" class="main">
    <div class="card-header" style="text-align: right;">
        <h1 style="text-align: center;" style="color:black">Servicios Asignados</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table border-dark table-hover" id="myTable" style="border: 2px solid black">
                    <thead class="table-dark">
                        <tr class="table-active table-group-divider">
                            <th scope="col">No.</th>
                            <th scope="col">Paciente</th>
                            <th scope="col">Medico</th>
                            <th scope="col">Motivo Consulta</th>
                            <th scope="col">Fecha Consulta</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla" style="text-align: center;">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<script>
var tabla = document.getElementById("tabla");
tabla.innerHTML = "";

function consultarServicio() {
    $.ajax({
        url: 'consulta.php',
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            $(tabla).html(data);
            data.sort(function(a, b) {
                if (a.estatus < b.estatus) {
                    return -1;
                } else if (a.estatus > b.estatus) {
                    return 1;
                } else {
                    return 0;
                }
            });
            data.forEach(dato => {
                const verde = "background-color: #88DC65; color: white;";
                const rojo = "background-color: #FF6961; color: white;";
                const amarillo = "background-color: #F9E37C; color: white;";
                const azul = "background-color: #2271B3; color: white;";
                const fila = document.createElement("tr");
                const id_sv = document.createElement("th");
                const paciente = document.createElement("td");
                const usuario = document.createElement("td");
                const fecha = document.createElement("td");
                const motivo = document.createElement("td");
                const estadoT = document.createElement("td");
                const hora = document.createElement("td");
                const acciones = document.createElement("td");

                id_sv.textContent = dato.id_sv;
                paciente.textContent = dato.paciente;
                usuario.textContent = dato.Usuario;
                fecha.textContent = dato.fecha;
                motivo.textContent = dato.moti_consulta;
                estadoT.textContent = dato.estatus;
                hora.textContent = dato.hora;

                if (dato.estado === 1) {
                    // Aquí le dejo su boton a Jon xD
                    const contenedorBotones = document.createElement("div");
                    const btnEditar = document.createElement("button");
                    btnEditar.id = "botonEditar";
                    btnEditar.setAttribute("data-valor", id_sv.textContent);
                    btnEditar.className = "btn btn-outline-warning";
                    btnEditar.innerHTML = "<i class='bi bi-pencil-fill'></i>";
                    btnEditar.textContent = "Editar";
                    btnEditar.addEventListener("click", function() {
                        var id_sv = this.getAttribute("data-valor");
                        console.log("Editar servicio con ID: " + id_sv);
                        window.location.href = "../editar/editarEvento.php?id=" + id_sv;
                    });
                    //Este es mio jsjsjs
                    const btnCancelar = document.createElement("button");
                    btnCancelar.id = "botonCancelar";
                    btnCancelar.setAttribute("data-valor", id_sv.textContent);
                    btnCancelar.className = "btn btn-outline-danger";
                    btnCancelar.innerHTML = "<i class='bi bi-trash-fill'></i>";
                    btnCancelar.textContent = "Cancelar";
                    btnCancelar.addEventListener("click", function() {
                        var valorid = this.getAttribute("data-valor");
                        console.log(valorid);
                        Swal.fire({
                            title: '¿Estás seguro que quieres cancelar el servicio?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, cancelar servicio'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'Servicio cancelado',
                                    '',
                                    'success'
                                );
                                $.ajax({
                                    url: 'eliminar.php',
                                    type: 'POST',
                                    data: {
                                        valorid: valorid
                                    },
                                    success: function(data) {}
                                });
                            }
                        });

                    });
                    contenedorBotones.appendChild(btnEditar);
                    contenedorBotones.appendChild(btnCancelar);
                    acciones.appendChild(contenedorBotones);
                }
                fila.append(id_sv, paciente, usuario, motivo, fecha, estadoT, hora, acciones);
                tabla.append(fila);
                var estado = dato.estado;
                if (estado === 1) {
                    estadoT.style = azul;
                } else if (estado === 3) {
                    estadoT.style = verde;
                } else if (estado === 2) {
                    estadoT.style = amarillo;
                } else if (estado === 0) {
                    estadoT.style = rojo;
                } else {
                    alert("Hay algún problema");
                }
            })
        },
        error: function(error) {
            console.error("Error al obtener los datos:", error);
        }
    });
}
consultarServicio();
setInterval(() => {
    consultarServicio();
}, 1000);
</script>
<script src="../../../../js/tables.js"></script>
<?php
include("../../../../templates/footer.php");
?>
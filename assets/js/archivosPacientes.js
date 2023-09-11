        function previewImage(input) {
        var preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.setAttribute('src', e.target.result);
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }

    function openFilePicker(event) {
        event.preventDefault();
        document.getElementById('Credencial_front').click();
    }

    function deletePhoto(event) {
        event.preventDefault();
        document.getElementById('preview').src = '../../../img/Logo.png';
        document.getElementById('preview').style.display = 'none';
        document.getElementById('Credencial_front').value = '';
        var deleteLink = document.querySelector('.delete-link');
        deleteLink.style.display = 'none';
    }


    // 
    function previewImage2(input) {
        var preview2 = document.getElementById('preview2');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview2.setAttribute('src', e.target.result);
                preview2.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview2.style.display = 'none';
        }
    }

    function openFilePicker2(event) {
        event.preventDefault();
        document.getElementById('Credencial_aseguradora').click();
    }

    function deletePhoto2(event) {
        event.preventDefault();
        document.getElementById('preview2').src = '../../../img/Logo.png';
        document.getElementById('preview2').style.display = 'none';
        document.getElementById('Credencial_aseguradora').value = '';
        var deleteLink = document.querySelector('.delete-link');
        deleteLink.style.display = 'none';
    }

    //
    function previewImage3(input) {
        var preview3 = document.getElementById('preview3');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview3.setAttribute('src', e.target.result);
                preview3.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview3.style.display = 'none';
        }
    }

    function openFilePicker3(event) {
        event.preventDefault();
        document.getElementById('Credencial_aseguradoras_post').click();
    }

    function deletePhoto3(event) {
        event.preventDefault();
        document.getElementById('preview3').src = '../../../img/Logo.png';
        document.getElementById('preview3').style.display = 'none';
        document.getElementById('Credencial_aseguradoras_post').value = '';
        var deleteLink = document.querySelector('.delete-link');
        deleteLink.style.display = 'none';
    }

    // 
    function confirmCancel(event) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Si cancelas, se perderán los datos ingresados.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cancelar',
            cancelButtonText: 'No, continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo $url_base; ?>secciones/oxigeno/pacientes/index.php";
            }
        });
    }

    function previewImage1(input) {
        var preview1 = document.getElementById('preview1');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview1.setAttribute('src', e.target.result);
                preview1.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview1.style.display = 'none';
        }
    }

    function openFilePicker1(event) {
        event.preventDefault();
        document.getElementById('Credencial_post').click();
    }

    function deletePhoto1(event) {
        event.preventDefault();
        document.getElementById('preview1').src = '../../../img/Logo.png';
        document.getElementById('preview1').style.display = 'none';
        document.getElementById('Credencial_post').value = '';
        var deleteLink = document.querySelector('.delete-link');
        deleteLink.style.display = 'none';
    }

    //PARA EDITAR PACIENTES 
    function mostrarImagen(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imagenActual = document.getElementById("imagenActual");
                imagenActual.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function abrirSelectorArchivo(event) {
        event.preventDefault();
        var selectorArchivo = document.getElementById("Credencial_front");
        selectorArchivo.click();
    }

    function cambiarImagen(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imagenActual = document.getElementById("imagenActual");
                imagenActual.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function eliminarImagen(event) {
        event.preventDefault();
        var imagenActual = document.getElementById("imagenActual");
        imagenActual.src = "./img/error.png";
        var selectorArchivo = document.getElementById("Credencial_front");
        selectorArchivo.value = null;
    }

    function mostrarImagen1(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imagenActual1 = document.getElementById("imagenActual1");
                imagenActual1.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function abrirSelectorArchivo1(event) {
        event.preventDefault();
        var selectorArchivo1 = document.getElementById("Credencial_post");
        selectorArchivo1.click();
    }

    function cambiarImagen1(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imagenActual1 = document.getElementById("imagenActual1");
                imagenActual1.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function eliminarImagen1(event) {
        event.preventDefault();
        var imagenActual1 = document.getElementById("imagenActual1");
        imagenActual1.src = "../../../assets/img/not-found.svg";
        var selectorArchivo1 = document.getElementById("Credencial_post");
        selectorArchivo1.value = null;
    }

    // 
    function mostrarImagen2(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imagenActual2 = document.getElementById("imagenActual2");
                imagenActual2.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function abrirSelectorArchivo2(event) {
        event.preventDefault();
        var selectorArchivo2 = document.getElementById("Credencial_aseguradora");
        selectorArchivo2.click();
    }

    function cambiarImagen2(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imagenActual2 = document.getElementById("imagenActual2");
                imagenActual2.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function eliminarImagen2(event) {
        event.preventDefault();
        var imagenActual2 = document.getElementById("imagenActual2");
        imagenActual2.src = "../../img/OXILIVE.ico";
        var selectorArchivo2 = document.getElementById("Credencial_aseguradora");
        selectorArchivo2.value = null;
    }

    // 
    function mostrarImagen3(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imagenActual3 = document.getElementById("imagenActual3");
                imagenActual3.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function abrirSelectorArchivo3(event) {
        event.preventDefault();
        var selectorArchivo3 = document.getElementById("Credencial_aseguradoras_post");
        selectorArchivo3.click();
    }

    function cambiarImagen3(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imagenActual3 = document.getElementById("imagenActual3");
                imagenActual3.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function eliminarImagen3(event) {
        event.preventDefault();
        var imagenActual3 = document.getElementById("imagenActual3");
        imagenActual3.src = "../../img/OXILIVE.ico";
        var selectorArchivo3 = document.getElementById("Credencial_aseguradoras_post");
        selectorArchivo3.value = null;
    }
//PARA LAS ASEGURADORAS 
    function actualizarAseguradoras(administradoraId) {
        // console.log("Llamado a actualizarAseguradoras con administradoraId:", administradoraId);
        const aseguradoraSelect = document.getElementById("Aseguradora");
        aseguradoraSelect.innerHTML = '<option value="0" selected disabled>Cargando...</option>';

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../../../module/obtener_aseguradora.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                aseguradoraSelect.innerHTML = '<option value="0" selected disabled>Elija una opción</option>';
                const data = JSON.parse(xhr.responseText);

                data.forEach(function(aseguradora) {
                    const option = document.createElement("option");
                    option.value = aseguradora.id_aseguradora;
                    option.textContent = aseguradora.Nombre_aseguradora;
                    aseguradoraSelect.appendChild(option);
                });
            } else if (xhr.readyState === 4) {
                aseguradoraSelect.innerHTML = '<option value="0" selected disabled>Error al cargar las aseguradoras</option>';
            }
        };
        // console.log("administradoraId antes de enviar:", administradoraId);
        xhr.send("administradoraId=" + encodeURIComponent(administradoraId));
    }

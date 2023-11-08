const formulario = document.getElementById('formulario');
    const inputs = document.querySelectorAll('#formulario input');

    const expresiones = {
        No_nomina: /^\d+$/, // Letras y espacios, pueden llevar acentos.
    }

    const campos = {
        No_nomina: false,
    }

    const validarFormulario = (e) => {
        switch (e.target.name) {
            case "No_nomina":
                validarCampo(expresiones.No_nomina, e.target, 'No_nomina');
                break;
        }
    }

    const validarCampo = (expresion, input, campo) => {

		const grupo = document.getElementById(`grupo__${campo}`);
		const mensajeError = grupo.querySelector('.formulario__input-error');

        if (expresion.test(input.value)) {
        grupo.classList.remove('formulario__grupo-incorrecto');
        grupo.classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('bi-check-circle-fill');
        document.querySelector(`#grupo__${campo} i`).classList.remove('bi-exclamation-triangle-fill');
        input.classList.add('input-valid'); // Agregar clase para campo válido
        campos[campo] = true;
			mensajeError.style.display = 'none';
        } else {
            grupo.classList.add('formulario__grupo-incorrecto');
        grupo.classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('bi-exclamation-triangle-fill');
        document.querySelector(`#grupo__${campo} i`).classList.remove('bi-check-circle-fill');
        input.classList.remove('input-valid'); // Eliminar la clase en caso de campo no válido
        campos[campo] = false;
			mensajeError.style.display = 'block';
			input.style.borderColor = 'red';
        }
    }

    inputs.forEach((input) => {
        input.addEventListener('keyup', validarFormulario);
        input.addEventListener('blur', validarFormulario);
    });

    formulario.addEventListener('submit', (e) => {
        e.preventDefault();

        if(campos.No_nomina){
            formulario.submit();
            document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
                icono.classList.remove('formulario__grupo-correcto');
            });
        } else {
            document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
        }
    });
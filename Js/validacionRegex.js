// Regex de validaciones
const RegexOnlyLetters = /^[A-Za-zñÑáéíóúÁÉÍÓÚ ]+$/;
const RegexOnlyNumbers = /^[0-9]+$/;
const RegexLettersAndNumbers = /^[A-Za-zñÑáéíóúÁÉÍÓÚ0-9]+$/;
const RegexWithoutSpecial = /^[A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]+$/;
const RegexWithPoint = /^[A-Za-zñÑáéíóúÁÉÍÓÚ0-9. ]+$/;
//const NewRegex = /^[Parámetros de nuevo regex]/;


// Función de validación
function validarCampo(elemento, regex) {
    var valor = elemento.value;
    if (!regex.test(valor)) {
        elemento.value = valor.slice(0, -1);
    }
}

// Validar al cargar la página
document.addEventListener("DOMContentLoaded", function() {
    //Elementos del DOM
    var formFields = [
        ...document.getElementsByClassName("only-letters"),
        ...document.getElementsByClassName("only-numbers"),
        ...document.getElementsByClassName("letters-and-numbers"),
        ...document.getElementsByClassName("without-special"),
        ...document.getElementsByClassName("with-point")
        //...document.getElementsByClassName("new-regex")
    ];

    formFields.forEach(function(elemento) {
        elemento.addEventListener("input", function() {
            switch (true) {
                //Validaciones por clase
                case elemento.classList.contains("only-letters"):
                    validarCampo(elemento, RegexOnlyLetters);
                    break;
                case elemento.classList.contains("only-numbers"):
                    validarCampo(elemento, RegexOnlyNumbers);
                    break;
                case elemento.classList.contains("letters-and-numbers"):
                    validarCampo(elemento, RegexLettersAndNumbers);
                    break;
                case elemento.classList.contains("without-special"):
                    validarCampo(elemento, RegexWithoutSpecial);
                    break;
                case elemento.classList.contains("with-point"):
                    validarCampo(elemento, RegexWithPoint);
                    break;
                /*
                case elemento.classList.contains("new-regex"):
                  validarCampo(elemento, NewRegex);
                  break;
                */
            }
        });
    });
});
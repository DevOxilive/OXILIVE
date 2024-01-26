document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("formulario");

    form.addEventListener("submit", function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            Swal.fire({
                icon: "warning",
                title: "FALTAN DATOS",
                text: "Revisar que todos los datos obligatorios estén ingresados",
                showConfirmButton: false,
                timer: 2000,
            });
        }
    });
});



function validarCuenta(){
    var inputCuenta = document.getElementById("cuentaInput");
    var msjError = document.getElementById("mensajeError");
    //Aquì voy a eliminar error en caso de no contener los digitos solicitados
    msjError.inert = "";
    //Recupero el valor de la cuenta
    var cuenta = inputCuenta.value.trim();
    //Validao la longitud
    if(cuenta.length === 10 || cuenta.length === 14 || cuenta.length === 17){
    msjError.innerHTML = "Num.cuenta ✅" ;
    msjError.className = "verde";
    }else if(cuenta.length === 16 ){
        msjError.innerHTML = "Tarjeta✅";
        msjError.className = "verde";
    }else if(cuenta.length === 18 || cuenta.length === 20){
        msjError.innerHTML = "Clabe Bancaria ✅"
        msjError.className = "verde";
    }else {
        mensajeError.innerHTML = "La cuenta no es valida.";
        msjError.className = "error-message";
    }
}
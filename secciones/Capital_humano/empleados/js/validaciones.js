
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
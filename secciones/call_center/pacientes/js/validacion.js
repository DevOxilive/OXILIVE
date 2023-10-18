var nombre = document.getElementById("nombre"),
    apellidos = document.getElementById("apellidos"),
    edad = document.getElementById("edad"),
    
    telUno = document.getElementById("telUno"),
    telDos = document.getElementById("telDos"),
    calle = document.getElementById("calle"),
    numExt = document.getElementById("numExt"),
    numInt = document.getElementById("numInt"),
    calleUno = document.getElementById("calleUno"),
    calleDos = document.getElementById("calleDos"),

    exp = document.getElementById("expediente"),
    autGen = document.getElementById("autorizacionGen"),
    autEsp = document.getElementById("autorizacionEsp");

nombre.addEventListener("input", function () {
    var regex = /^[a-zA-Z\s]+$/;
    var string = nombre.value;
    if(!regex.test(string)){
        nombre.value = string.slice(0, -1);
    }
});
apellidos.addEventListener("input", function () {
    var regex = /^[a-zA-Z\s]+$/;
    var string = apellidos.value;
    if(!regex.test(string)){
        apellidos.value = string.slice(0, -1);
    }
});
edad.addEventListener("input", function () {
    var regex = /^\d{1,3}$/;
    var numero = edad.value;
    if(!regex.test(numero)){
        edad.value = numero.slice(0, -1);
    }
});


telUno.addEventListener("input", function () {
    var regex = /^\d{1,10}$/;
    var numero = telUno.value;
    if(!regex.test(numero)){
        telUno.value = numero.slice(0, -1);
    }
});
telDos.addEventListener("input", function () {
    var regex = /^\d{1,10}$/;
    var numero = telDos.value;
    if(!regex.test(numero)){
        telDos.value = numero.slice(0, -1);
    }
});
calle.addEventListener("input", function () {
    var regex = /^[a-zA-Z0-9\s]+$/;
    var string = calle.value;
    if(!regex.test(string)){
        calle.value = string.slice(0, -1);
    }
});
numExt.addEventListener("input", function () {
    var regex = /^[a-zA-Z0-9\s]+$/;
    var string = numExt.value;
    if(!regex.test(string)){
        numExt.value = string.slice(0, -1);
    }
});
numInt.addEventListener("input", function () {
    var regex = /^[a-zA-Z0-9\s]+$/;
    var string = numInt.value;
    if(!regex.test(string)){
        numInt.value = string.slice(0, -1);
    }
});
calleUno.addEventListener("input", function () {
    var regex = /^[a-zA-Z0-9\s]+$/;
    var string = calleUno.value;
    if(!regex.test(string)){
        calleUno.value = string.slice(0, -1);
    }
});
calleDos.addEventListener("input", function () {
    var regex = /^[a-zA-Z0-9\s]+$/;
    var string = calleDos.value;
    if(!regex.test(string)){
        calleDos.value = string.slice(0, -1);
    }
});


exp.addEventListener("input", function () {
    var regex = /^[a-zA-Z0-9\s]+$/;
    var string = exp.value;
    if(!regex.test(string)){
        exp.value = string.slice(0, -1);
    }
});
autGen.addEventListener("input", function () {
    var regex = /^[a-zA-Z0-9\s]+$/;
    var string = autGen.value;
    if(!regex.test(string)){
        autGen.value = string.slice(0, -1);
    }
});
autEsp.addEventListener("input", function () {
    var regex = /^[a-zA-Z0-9\s]+$/;
    var string = autEsp.value;
    if(!regex.test(string)){
        autEsp.value = string.slice(0, -1);
    }
});
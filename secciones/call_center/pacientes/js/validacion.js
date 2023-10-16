var nombre = document.getElementById("nombre"),
    apellidos = document.getElementById("apellidos"),
    edad = document.getElementById("edad"),
    telUno = document.getElementById("telUno"),
    telDos = document.getElementById("telDos");

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
    console.log(numero);
    if(!regex.test(numero)){
        telDos.value = numero.slice(0, -1);
    }
});

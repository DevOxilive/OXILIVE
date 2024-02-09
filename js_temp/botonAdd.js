var add = document.getElementById("add"),
    addBtn = document.getElementById("addBoton"),
    delBtn = document.getElementById("delBoton"),
    tel = document.getElementById("tel"),
    telDos = document.getElementById("telDos");
addBtn.addEventListener("click", function () {
    add.style.display = "none";
    tel.style.display = "block";
});
delBtn.addEventListener("click", function () {
    add.style.display = "flex";
    tel.style.display = "none";
    telDos.value = "";
    valNum(telDos);
});
document.addEventListener("DOMContentLoaded", function() {
    const addBoton = document.getElementById("addBoton");
    const telDos = document.getElementById("telDos");
    const delBoton = document.getElementById("delBoton");

    addBoton.addEventListener("click", function() {
        telDos.style.display = "block"; 
        addBoton.style.display = "none"; 
    });

    delBoton.addEventListener("click", function() {
        telDos.style.display = "none"; 
        addBoton.style.display = "block";
    });
});







var add = document.getElementById("add"),
    addBtn = document.getElementById("addBoton"),
    delBtn = document.getElementById("delBoton"),
    tel = document.getElementById("tel");
addBtn.addEventListener("click", function () {
    add.style.display = "none";
    tel.style.display = "block";
});
delBtn.addEventListener("click", function () {
    add.style.display = "flex";
    tel.style.display = "none";
})
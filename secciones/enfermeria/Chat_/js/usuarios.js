setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "usuarios.php", true);
    xhr.send();
}, 1000);



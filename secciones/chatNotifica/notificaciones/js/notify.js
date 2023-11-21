Push.create("dazz", {
    body: "hola todo esta rico",
    icon: '../img/usuario.png',
    onClick: function () {
        window.location = "http://localhost:8080/OXILIVE/secciones/enfermeria/Chat_/";
        window.focus();
        this.close();
    }
});
const ineDoc = document.getElementById("ineDoc");

ineDoc.addEventListener("change", function(){
    const file = this.files[0];
    if (file){
        const fileType = file.type;
        const validExtensions = ["image/jpeg", "image/png", "application/pdf"]; // Corregido
        if(!validExtensions.includes(fileType)){
            alert("SOLO SE PERMITEN IMAGENES JPG, PNG Y PDF");
            this.value = null;
        }
    }
});

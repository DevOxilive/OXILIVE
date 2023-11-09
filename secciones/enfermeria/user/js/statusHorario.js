var idus = document.getElementById("idus").value;
function getStatus() {
    fetch("../model/status.php", {
      headers: { "Content-Type": "application/json" },
      method: "POST",
      body: JSON.stringify({id: idus}),
    })
      .then((response) => response.json())
      .then((datos) => {
        datos.forEach((dato) => {
          console.log(dato);
        });
      });
  }
  getStatus();
  setInterval(getStatus, 2500);
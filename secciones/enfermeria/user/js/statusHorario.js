function getStatus() {
  fetch("../model/status.php", {
    headers: { "Content-Type": "application/json" },
    method: "POST",
    body: JSON.stringify({ id: idus.value }),
  })
    .then((response) => response.json())
    .then((datos) => {
      datos.forEach((dato) => {
        let card = document.getElementById("cardHead"+dato.id);
        switch (dato.id_est) {
          case 1:
            card.style.borderBottom = "#ffc107 2px solid";
            break;
          case 2:
            card.style.borderBottom = "#0dcaf0 2px solid";
            break;
          case 3:
            card.style.borderBottom = "#198754 2px solid";
            break;
          case 4:
            card.style.borderBottom = "#dc3545 2px solid";
            break;
        }
      });
    });
}
getStatus();
setInterval(getStatus, 2500);

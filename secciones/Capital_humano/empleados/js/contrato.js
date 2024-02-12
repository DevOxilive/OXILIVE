$(document).ready(function () {
  $("#contrato").change(function () {
    var contrato = $(this).val();
    valContrato(contrato);
  });
  function valContrato(contrato) {
    if (contrato == "SI CONTRATADO") {
      $("#tipoDeContratoHid").css({
        display: "block",
      });
      $("#fechaAltaHid").css({
        display: "block",
      });
    } else {
      $("#tipoDeContratoHid").css({
        display: "none",
      });
      $("#fechaAltaHid").css({
        display: "none",
      });
    }
  }
  var contrato = $("#contrato").val();
  valContrato(contrato);
});

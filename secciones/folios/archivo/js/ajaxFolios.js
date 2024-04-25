$(document).ready(function() {
  $('#banco').change(function() {
      var selectedBanco = $(this).val();
      $.ajax({
          type: 'POST',
          url: './consultaFolios.php', 
          data: { banco: selectedBanco },
          dataType: 'json',
          success: function(response) {
              $('#foliosB').empty();
              $('#id_folio').val(''); 
              $.each(response, function(index, folio) {
                  $('#foliosB').append('<option value="' + folio.id_folio + '">' + folio.folio + '</option>');
              });
              if (response.length > 0) {
                  $('#id_folio').val(response[0].id_folio);
              }
          },
          error: function(xhr, status, error) {
              console.error('Error en la solicitud AJAX: ' + error);
          }
      });
  });
});


document.getElementById('btnToggle').addEventListener('click', function(){
    var tabla = document.getElementById('mostrar');
    if (tabla.style.display === 'none') {
        tabla.style.display = 'block';
        setTimeout(function() {
            tabla.style.opacity = '1';
        }, 20); // Se inicia la transición después de un breve tiempo para que funcione correctamente
    } else {
        tabla.style.opacity = '0';
        setTimeout(function() {
            tabla.style.display = 'none';
        }, 500); // Duración de la transición, ajusta según lo necesario
    }
});

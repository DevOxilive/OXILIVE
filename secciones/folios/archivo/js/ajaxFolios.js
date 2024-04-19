$(document).ready(function() {
  $('#banco').change(function() {
      var selectedBanco = $(this).val();
      $.ajax({
          type: 'POST',
          url: './consultaFolios.php', 
          data: { banco: selectedBanco },
          dataType: 'json',
          success: function(response) {
              $('#folios').empty();
              $('#id_folio').val(''); 
              $.each(response, function(index, folio) {
                  $('#folios').append('<option value="' + folio.id_folio + '">' + folio.folio + '</option>');
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

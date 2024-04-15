$(document).ready(function(){
    
    estatusList();
    function estatusList(){
        $.ajax({
            url: './consultaFolios.php',
            type: 'GET',
            dataType:'json',
            success: function(response){
                //aquí voy a limpiar la lista solo del front
                $('#estatus-list').empty();
                var filteredResponse = response.filter(function(estatus){
                    return estatus.estado !==10;
                });
                filteredResponse.forEach(function(estatus) {
                    console.log('El estatus está jalando perrón: ' + estatus.estatus);
                    $('#estatus-list').append('<li>' + estatus.estatus + '</li>'); 
                });
            },
            error: function(xhr, status, error){
                console.log('Hubo un error con el estatus.:(', error);
            }
            });
    }
    setInterval(estatusList, 20000);
});
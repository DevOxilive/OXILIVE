// al cargar la pagina
$(document).ready(function () {
    var administradora = document.getElementById('administradora');
    var bancos = document.getElementById('bancos');
    var tipo = document.getElementById('tipo');
    var cant = document.getElementById('cant');
    var verFolio = document.getElementById('verFolios');
    // revision de eventos  
    $(administradora).on('change', function () {
        val1 = $(administradora).val();
        val2 = $(bancos).val();
        val4 = $(tipo).val();
        val3 = $(cant).val();
        // bloque de envio [...]
        $.ajax({
            type: 'POST',
            url: '../model/folios.php',
            data: { administradora: val1, bancos: val2, tipo: val4, cant: val3 },
            success: function (response) {
                $(verFolio).html(response);
            }
        })
    });

    $(bancos).on('change', function () {
        var bancos = document.getElementById('bancos');
        val1 = $(administradora).val();
        val2 = $(bancos).val();
        val4 = $(tipo).val();
        val3 = $(cant).val();
        $.ajax({
            type: 'POST',
            url: '../model/folios.php',
            data: { administradora: val1, bancos: val2, tipo: val4, cant: val3 },
            success: function (response) {
                $(verFolio).html(response);
            }
        })
    });

    $(tipo).on('change', function () {
        var bancos = document.getElementById('bancos');
        val1 = $(administradora).val();
        val2 = $(bancos).val();
        val4 = $(tipo).val();
        val3 = $(cant).val();
        $.ajax({
            type: 'POST',
            url: '../model/folios.php',
            data: { administradora: val1, bancos: val2, tipo: val4, cant: val3 },
            success: function (response) {
                $(verFolio).html(response);
            }
        })
    });

    $(cant).on('input', function () {
        var bancos = document.getElementById('bancos');
        val1 = $(administradora).val();
        val2 = $(bancos).val();
        val4 = $(tipo).val();
        val3 = $(cant).val();

        $.ajax({
            type: 'POST',
            url: '../model/folios.php',
            data: { administradora: val1, bancos: val2, tipo: val4, cant: val3 },
            success: function (response) {
                $(verFolio).html(response);
            }
        })
    });
});
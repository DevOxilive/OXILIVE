$(document).ready(function () {
    var selectDept = document.getElementById("departamento");
    var usuario = document.getElementById('usuario');
    $(selectDept).on('change', function () {
        var val = $(selectDept).val();

        $.ajax({
            type: 'post',
            url: '../model/user.php',
            data: { selectDept: val },
            success: function (response) {
                $(usuario).html(response);
            }
        })
    })
})
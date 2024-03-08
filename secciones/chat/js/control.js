$(document).ready(function () {
    var search = document.getElementById('search');
    var container = document.getElementById('search-result');
    var containerListUser = document.getElementById('load-users');
    //busaca los usuarios
    function searchUser() {
        var result = $(search).val();
        if (result.trim() !== '') {
            $.ajax({
                type: 'POST',
                url: 'model/search_user.php',
                data: { search: result },
                success: function (data) {
                    $(container).html(data)
                    loadChat()
                }
            });
        } else {
            $(container).empty();
        }
    }

    //lista los usuarios
    function userList() {
        $.ajax({
            type: 'POST',
            url: 'model/listUserChat.php',
            success: function (data) {
                $(containerListUser).html(data)
                loadChat()
            }
        });
    }

    // carga el chat
    function loadChat() {
        var boxUser = document.getElementsByClassName('box-user');
        $(boxUser).on('click', function () {
            var load = $(this).data('check');
            window.location = 'model/load_chat.php?chat=' + load;
        });
    }

    //comprobacion de eventos
    $(search).on('input', function () {
        searchUser();
    });

    $(search).on('blur', function () {
        searchUser();
    });

    //refresca la pagina
    setInterval(function () {
        userList();
    }, 2000)

})
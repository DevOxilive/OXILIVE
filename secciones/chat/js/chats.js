$(document).ready(function () {
    function loadUsers() {
        $.ajax({
            url: 'php/get_user.php',
            type: 'POST',
            success: function (data) {
                $('#chats').html(data);

            }
        });
    }

    setInterval(() => {
        loadUsers();
    }, 1000);
});
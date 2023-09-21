$(document).ready(function () {

    function loadUsers() {
        $.ajax({
            url: 'src/get_user.php',
            type: 'POST',
            success: function (data) {
                $('#users-list').html(data);
            }
        });
    }

    setInterval(() => {
        loadUsers();
    }, 3000);

});
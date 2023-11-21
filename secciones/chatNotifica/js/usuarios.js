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
    }, 1000);
    // Made by Dazz

    /**
     * 
     *          ( D- A- Z- Z )
     *                /\
     *              /  /
     *            /_  /_
     *             /_   /_
     *              /   /
     *             / /      
     *             \/
     * 
     */
});
$(document).ready(function () {

    function loadUsers() {
        $.ajax({
            url: 'listPdf.php',
            type: 'POST',
            success: function (data) {
                $('#list-documentos').html(data);
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
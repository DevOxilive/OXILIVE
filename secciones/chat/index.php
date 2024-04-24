<?php
session_start();
if (isset($_SESSION['us'])) {
    include('../../templates/header.php');
} else {
    header('location: ../../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Oxilive</title>
</head>

<body>
    <main class="main" id="main">
        <div class="container-chat">
            <div class="container-search">
                <h3>buscar Usuario</h3>
                <input type="text" name="search" id="search">
            </div>
            <br>
            <div class="search-result" id="search-result">
                <!-- generate users -->
            </div>
            <hr>
            <br>
            <div class="load-users" id="load-users">
                <!-- generate user default -->
            </div>
        </div>
    </main>
    
</body>
<?php
include('../../templates/footer.php');
?>
<script src="js/control.js"></script>

</html>
<?php include_once "funcion_cookie.php" ?>
<html>
    <head><title>Web 0</title></head>
    <body>
        <h2>WEB 0</h2>
        <ul>
            <li><a href="./web1.php">WEB 1</a></li>
            <li><a href="./web2.php">WEB 2</a></li>
        </ul>
    <?php
        var_dump($_COOKIE);
    ?>
    </body>
</html>
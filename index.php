<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <body>
        <?php
            session_start();
            $_SESSION = array();
            session_destroy();
        ?>
        <div id="viewport">
            <div style="width: 100%; text-align: center;">
                <img alt="Logo" src="images/logo.jpg" style="max-width: 360px; height: auto; padding: 1em;"/>
            </div>
            <form action="game.php" method="post">
                <p><input type="text" name="username" placeholder="Username"/></p>
                <p><input class="button" type="submit" value="Submit"/></p>
            </form>
        </div>
    </body>
</html>

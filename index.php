<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <body>
        <div class="navigation">
            <span class="back-button">&#xffe9; Back</span>
            <span>Spirit: <?php $user->getSpirit(); ?></span>
            <span>Hello, <?php $user->getName(); ?> &nbsp; <a href="ui-design-login.html">Log off</a></span>
        </div>
        <div style="height: 2em;"></div>
        <div class="master-viewport">
            <?php $user->getCurrentQuest()->display(); ?>
        </div>
    </body>
</html>

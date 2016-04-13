<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
<?php
    include_once('user.php');
    include_once('database.php');
    include_once('lrc_questline.php');
    session_start();
    $user = $_SESSION["user"];
?>
        <div class="navigation">
            <span class="back-button" onclick="window.location.href='game.php'">&#xffe9; Back</span>
            <span>Spirit: <?php echo($user->getSpirit()) ?></span>
            <span>
                <span
                    onclick="window.location.href='badges.php'" 
                    class="tmp-badge-button">
                    Badges</span>
                Hello, <?php echo($user->getFirstName()) ?> &nbsp; <a href="index.php">Log off</a>
            </span>
        </div>
        <div style="height: 6em;"></div>
            <div style="text-align: center;">
                <img alt="Image of a badge."
                     <?php
                        if ($user->badges["SeaPup"]->isAchieved())
                            echo('src="images/badge.jpg" style="max-height: 180px; width: auto;"');
                        else
                            echo('src="images/badge.jpg" style="max-height: 180px; width: auto; opacity: 0.25;"');
                     ?>
                />
                <h2><?php
                    $str = array("", "(ACHIEVED)");
                    echo($user->badges["SeaPup"]->getName() . " "
                    . $str[$user->badges["SeaPup"]->isAchieved()]); ?></h2>
                <p><em><?php
                    echo($user->badges["SeaPup"]->getRequirements()); ?></em></p>
            </div>
        </div>
</body>
</html>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
<?php
    include_once('database.php');
    include_once('lrc_questline.php');
    session_start();
    if (isset($_POST["username"]))
    {
        $_SESSION["message"] = array();
        $username = $_POST["username"];
        if ($username === "") echo("<script>window.location.href='index.php'</script>");
        $username = strtok($username, "@");
        $row = Database::getRow("User", "username='" . $username . "'");
        $id = $row["id"];
        $user = new User($row["id"]);
        $_SESSION["user"] = $user;
        $_SESSION["quest"] = $user->quests["LRC"];
        $_SESSION["history"] = array();
    }
    else if (isset($_POST["answer"]))
    {
        $user = $_SESSION["user"];
        $quest = $_SESSION["quest"];
        $answer = $_POST["answer"];
        $_POST = array();
        $quest->submit($answer);
        if ($quest->validate($user))
        {
            array_push($_SESSION["message"], "<p class='msg-correct'>CORRECT!</p>");
            $quest->save($user->getId());
            foreach ($user->badges as $key=>$value)
            {
                if ($value->validate($user))
                    array_push($_SESSION["message"], "<p class='msg-correct'>You achieved a new Badge!</p>");
            }
            $user->save();
            foreach ($user->quests as $key=>$questline)
                if ($questline->validate($user))
                    $questline->save($user->getId());
            if (count($_SESSION["history"]) >= 1)
            {
                $_SESSION["quest"] = array_pop($_SESSION["history"]);
                $quest = $_SESSION["quest"];
            }
        }
        else if ($quest->isComplete())
        {
        }
        else if ($quest->getName() === $user->quests["LRC"]->getName())
        {
        }
        else
        {
            array_push($_SESSION["message"], "<p class='msg-incorrect'>The answer you have entered is incorrect.</p>");
        }
    }
    else
    {
        $user = $_SESSION["user"];
        $quest = $_SESSION["quest"];
    }
?>
        <div class="navigation">
            <span class="back-button" onclick="back()">&#xffe9; Back</span>
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
        <div id="viewport">
    <?php
        while (!empty($_SESSION["message"]))
            echo("<span style='text-algin: center;'>" . array_pop($_SESSION["message"]) . "</span>\n");
        $_SESSION["quest"]->html();
    ?>
    </div>
</body>
<script>
    function forward(lbl)
    {
        $.get('forward.php', { quest: lbl })
        .done(function(data)
        {
            document.getElementById("viewport").innerHTML = data;
        });
    }
    function back()
    {
        $.get('back.php', { })
        .done(function(data)
        {
            document.getElementById("viewport").innerHTML = data;
        });
    }
</script>
</html>

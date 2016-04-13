<!doctype html>
<html>
<head><link rel="stylesheet" type="text/css" href="style.css"/></head>
<body>
        <div class="navigation">
            <span class="back-button">&#xffe9; Back</span>
            <span>Spirit: <?php echo($spirit) ?></span>
            <span>Hello, <?php echo($name) ?> &nbsp; <a href="index.php">Log off</a></span>
        </div>
        <div style="height: 4em;"></div>
        <div id="viewport">
	<?php
		$user = new User($row["id"]);
		$user->quests["LRC"]->html();
	?>
	</div>
</body>
</html>

<?php

	include_once('user.php');
	session_start();
	$user = $_SESSION["user"];
	$quest = $_REQUEST["quest"] . "";
	$current_quest = $_SESSION["quest"];


	array_push($_SESSION["history"], $current_quest);
	$_SESSION["quest"] = $current_quest->quests[$quest];
	$quest = $_SESSION["quest"];

    while (!empty($_SESSION["message"]))
        echo("<span style='text-algin: center;'>" . array_pop($_SESSION["message"]) . "</span>\n");
	$quest->html();

?>

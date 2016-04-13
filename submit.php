<?php

	include_once('user.php');
	session_start();
	$user = $_SESSION["user"];
	$quest = $_SESSION["quest"];
	$answer = $_REQUEST["answer"];

	print "<p>" . $quest->getName() . " " . $answer . "</p>";
	if ($quest->submit($answer))
	{
		$user->addSpirit($quest->getReward());
		$quest->save($user);
		$user->save();
	}

	$quest->html();

?>

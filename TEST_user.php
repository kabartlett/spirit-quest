<?php

	include('user.php');

	$user = new User(1);

	echo($user->getId() . " " .$user->getName() . " " . $user->getSpirit() . "\n");

?>

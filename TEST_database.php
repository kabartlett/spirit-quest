<?php

	include_once("database.php");

	$db = new Database();
	$result = $db->query('SELECT * FROM User');
	if ($result->num_rows > 0)
		while ($row = $result->fetch_assoc())
			echo $row['id'] . "\n";
	else
		echo 'No results';
	$db->close();
?>

<?php
	session_start();
	//End session
	session_destroy();
	//Return to homepage
	header("Location: login.php");
	exit();

?>

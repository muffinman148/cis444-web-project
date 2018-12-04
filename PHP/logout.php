<?php
	//Ensure same session is being used
	session_start();
	//End session
	session_destroy();
	//Return to homepage
	header("Location: login.php");
	exit();

?>

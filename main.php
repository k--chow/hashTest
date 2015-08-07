<?php
	session_start();
	if (isset($_SESSION["User"]))
	{
	echo "Welcome, " . $_SESSION["User"];
	echo "<br><a href='logout.php'>Log out</a>";//logout delete session
	}
	else
	{
		echo "<br><a href='login.php'>Log In</a>";
		echo "<br><a href='signup.php'>Sign Up</a>";
	}
?>
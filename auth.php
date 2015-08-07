<?php
	session_start();
	include_once('db.php');
	$salt = "addsalt";//salt key, in future we can generate a random string of x length and store it
	$attemptedPassword = hash('sha256', ($_POST['pass'] . $salt));
	$query = "SELECT password FROM users WHERE username = '" . $user . "'";
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	$row = pg_fetch_row($result);
	$truePassword = $row[0];
	if (strcmp($truePassword, $attemptedPassword) == 0)//compare two passwords
	{
		echo "Passed";
		$_SESSION["User"] = $_POST['user'];
	}
	else
	{
		echo "Failed";
		echo $attemptedPassword . " " . $truePassword;
	}
	pg_close($db);
?>
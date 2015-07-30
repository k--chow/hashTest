<?php
	$db = pg_connect('host=localhost port=5432 dbname=test1 user=postgres password=apassword')
	or die ('Could not connect: ' . pg_last_error());
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$salt = "addsalt";//salt key, in future we can generate a random string of x length and store it
	$attemptedPassword = hash('sha256', ($_POST['pass'] . $salt));
	$query = "SELECT password FROM users WHERE username = '" . $user . "'";
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	$row = pg_fetch_row($result);
	$truePassword = $row[0];
	if (strcmp($truePassword, $attemptedPassword) == 0)//compare two passwords
	{
		echo "Passed";
	}
	else
	{
		echo "Failed";
		echo $attemptedPassword . " " . $truePassword;
	}
	pg_close($db);
?>
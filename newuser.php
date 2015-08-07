<?php
	session_start();
	include_once('db.php');
	$query = "SELECT count(username) FROM users WHERE username = '" . $user . "'";
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	$row = pg_fetch_row($result);
	$userUnique = $row[0];
	$salt = 'addsalt';
	$hashedAndSaltedPassword = hash('sha256', ($_POST['pass'] . $salt));
	if ($userUnique == 0)
	{
		
		$successQuery = "insert into users(username, password) values
		('" . $user . "', '" . $hashedAndSaltedPassword . "');";
		$results = pg_query($successQuery) or die('Query failed: ' . pg_last_error());
		if (!$results)
		{
		echo "Failed";
		}
		else
		{
			$_SESSION["User"] = $_POST['user'];
			echo "Passed";

		}
	}
	else 
	{
		echo "Failed";
	}
?>
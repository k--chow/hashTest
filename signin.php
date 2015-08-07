
<?php
session_start();
?>
<html>
<head>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
$(document).ready(function() {
$('#login').submit(function() {
	auth();
	return false;//prevents default submit page refresh
});
});<!--end of ready-->
//other functions
function auth()
{
	var username = document.getElementsByName('username')[0].value;
	var password = document.getElementsByName('password')[0].value;
	
	$.ajax({
		url: 'auth.php',
		type: 'POST',
		data: {user: username, pass: password},
		success: function(data) {
			if (data === "Passed")
			{
				console.log("Password is correct!");
				//$('#login').html('<?php echo "Logged in as " . $_SESSION["User"];?>');
				window.location = 'main.php';
				//console.log('<?php echo "Logged in as " . $_SESSION["User"];?>');

			}
			else
			{
				console.log("Password is wrong!");
				$('#status').html('Username or Password incorrect.');
			}
		}
	});
}

</script>
</head>

<form id="login">
<h1 id="status" style="color:red"></h1><!--status of log in-->
Username  <input type="text" name="username"></input><br><br>
Password  <input type="password" name="password"></input><br><br>
<input type="submit" value ="Log In"></input>
</form>

</html>
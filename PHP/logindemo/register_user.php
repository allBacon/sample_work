<?php # register_user.php ?>
<!doctype html>
<html>
	<head>
		<title>Register User</title>
	</head>
<body>
	<h1>Register</h1>
	<h2>Enter a username and password:</h2>
	<form method="Post" action="process_user.php">
		<label for="username">Username:</label>
		<input id="username" type="text" name="username">
		<br>
		<label for="password">Password:</label>
		<input id="password" type="password" name="password"> 
		<br>
		<input type="Submit" value="Register">
	</form>
	<?php 
		echo "<p><a href=\"login.php\">Login</a></p>";
	?>
</body>
</html>
<?php # login.php ?>
<!doctype html>
<html>
	<head>
		<title>Login</title>
	</head>
<body>
	<h1>Login</h1>
	<h2>Enter your username and password:</h2>
	<form method="Post" action="process_login.php">
		<label for="username">Username:</label>
		<input id="username" type="text" name="username">
		<br>
		<label for="password">Password:</label>
		<input id="password" type="password" name="password"> 
		<br>
		<input type="Submit" value="Login">
	</form>
	<?php 
		echo "<p><a href=\"register_user.php\">Register</a></p>";
	?>
</body>
</html>
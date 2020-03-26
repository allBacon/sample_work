<?php # register_user.php ?>
<!doctype html>
<html>
	<head>
		<title>Home Page - Login Demo</title>
	</head>
<body>
	<h1>Login Demo Home</h1>
	
	<?php  

	session_start();


	if (isset($_SESSION['loggedin']) == 1) { ?>	
		<p>You are logged in!</p>
		<p><a href="logout.php">Logout</a></p>
	<?php } else { ?>
		<p>You are not logged in!</p>
		<p>Please login <a href="login.php">here.</a></p>
		<p>If you have not registered please do so <a href="register_user.php">here.</a></p>
	<?php } ?>

</body>
</html>
<?php # register_user.php ?>
<!doctype html>
<html>
	<head>
		<title>Logout Page - Login Demo</title>
	</head>
<body>
	<h1>Login Demo - Logout</h1>
	
	<?php #You are to build this page on your own. It is to display whether a user has logged in to the database. If a user is logged in then display a message. If the user is not logged in display the link to the register/login pages. 
	session_start();
	

	if ($_SESSION['loggedin'] == 1) { ?>
		<p>You have successfully logged out.</p>
		<p>Please login <a href="login.php">here.</a></p>
		<p>If you have not registered please do so <a href="register_user.php">here.</a></p>
	<?php 

	session_destroy();

	header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	?>

</body>
</html>
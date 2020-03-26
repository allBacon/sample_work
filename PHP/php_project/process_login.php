<?php # process_login.php ?>
<?php session_start(); ?>
<!doctype html>
<html>
	<head>
		<title>Process Login</title>
	</head>
<body>
	<?php 

	# check to ensure form is being posted
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		echo "Go away.";
		# stop the script
		exit();
	}

	# Connect to the MySQL database
	include('inc/mysqli_connect.php'); 

	# get the variable names from the login form
	$username = $_POST['username'];
	$password = $_POST['password'];

	# debug statement
	# echo $username . $password;

	# Now query the database to see if you get a match for username/password
	$sql = "SELECT * FROM users WHERE username='$username' AND password=SHA1('$password')"; 
	#$sql2 = "SELECT users.user_id, users.username, usercredentials.password, usercredentials.passwordSalt, users.date_created FROM users INNER JOIN usercredentials ON users.user_id=usercredentials.user_id"; 
	# debug statement
	# echo $sql;

	# perform the query
	$result = mysqli_query($dbc,$sql);

	# debug statement
	#var_dump($result);

	if (mysqli_num_rows($result) == 1) {
		# username and password match
		# Now set a session variable
		$_SESSION['loggedin'] = 1;
		echo "You are now logged in!";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	} elseif (!mysqli_num_rows($result)){
		echo "<p>I'm sorry but your login info was not correct.</p>";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	?>
</body>
</html>

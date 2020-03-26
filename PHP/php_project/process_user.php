<?php # process_user.php ?>
<!doctype html>
<html>
	<head>
		<title>Process User Registration</title>
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

	# Let's insert the new user into the database table
	# Note the use of SHA1() in the SQL below
	$sql = "INSERT INTO users (username, password) VALUES ('$username', SHA1('$password'))";
	
	# use for debugging
	# echo $sql;

	$results = mysqli_query($dbc,$sql);

	echo "Thanks for registering!";
	header('Location: ' . $_SERVER['HTTP_REFERER']);

	# close the db connection
	mysqli_close($dbc);

	?>
</body>
</html>
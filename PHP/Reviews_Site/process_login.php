<?php # process_login.php 
include 'inc/header.inc.php';
?>

<div class="main-wrapper">

<?php
# check to ensure form is being posted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	echo "There was an error logging in.";
	# stop the script
	exit();
} else {
	# get the variable names from the login form
	$username = $_POST['username'];
	$userpassword = $_POST['password'];
	# echo $username . $password;

	# we need to add passwordSalt to user submitted password when requesting login (if exists)
	$sql_passwordSalt_request = '';
	if ($userpassword && $userpassword!='') {
		$sql_passwordSalt_request .= "SELECT userCredentials.passwordSalt FROM userCredentials INNER JOIN user ON user.id=userCredentials.user_id WHERE user.username = '$username'";
	}
	$result_passwordSalt_request = mysqli_query($dbc,$sql_passwordSalt_request);
	// var_dump($result_passwordSalt_request);

	$passwordSalt = mysqli_fetch_array($result_passwordSalt_request);
	$password = $userpassword .= $passwordSalt['passwordSalt'];
	// echo $password;

	# Now query the database to see if you get a match for username/password
	$sql_login_validate = "SELECT * FROM user INNER JOIN userCredentials ON user.id=usercredentials.user_id WHERE username='$username' AND password=SHA1('$password')"; 

	# perform the query
	$result_login_validate = mysqli_query($dbc,$sql_login_validate);
	// var_dump($result_login_validate);

	if (mysqli_num_rows($result_login_validate) == 1) {
		# username and password match
		# Now set a session variable
		$_SESSION['loggedin'] = 1;
		$_SESSION['username'] = "$username";

		if ($_SESSION['loggedin'] == 1) {
			$checkUserData = mysqli_fetch_array($result_login_validate);
			$isAdmin = $checkUserData['administrator'];
			# check isAdmin value
			// echo $isAdmin;
			$getUserId = $checkUserData['user_id'];
			# check userId value
			// echo $getUserId;
			if ($isAdmin == 1) {
				$_SESSION['isAdmin'] = "true";
			}
			if (isset($getUserId)) {
				$_SESSION['user_id'] = "$getUserId";
			}
		}
		echo "You are now logged in!";
		header('Location:index.php');
		exit();
	} elseif (!mysqli_num_rows($result_login_validate)){
		?> 
			<p>I'm sorry, your login information was incorrect.</p>
		<?php
	}
}
?>
</div> <!-- end main-wrapper -->

<?php include 'inc/footer.inc.php';?>
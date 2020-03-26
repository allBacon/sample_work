<?php # process_user.php 
include 'inc/header.inc.php';
?>

<div class="main-wrapper">

<?php
# check to ensure form is being posted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	echo "There was an error.";
	# stop the script
	exit();
} else {	
	# get the variable names from the login form
	$username = trim($_POST['username']);
	$password = $_POST['password'];
	$password_verify = $_POST['password_verify'];
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$email = $_POST['email'];

	$email = filter_var($email, FILTER_SANITIZE_EMAIL);

	#check database for duplicate user registration details for username or email
	$sql_check_duplicate = "SELECT username,email FROM user WHERE (user.username = '$username' OR user.email = '$email')";
	$duplicate_query = mysqli_query($dbc,$sql_check_duplicate);
	
	if (mysqli_num_rows($duplicate_query) > 0) {

	?> 

	<div class="main-wrapper">
		<br><br>
		<p>Sorry, there is already a user with your desired username or email. Please try again.</p>
	</div>

	<?php 
		// header('Location: ' . $_SERVER['HTTP_REFERER']);
		// exit();
	} elseif (strlen($password) < 8 || strlen($password) > 40) {
		echo "Passwords should be 8-40 characters long!<br />";
	} elseif ($password != $password_verify) {
		echo "Passwords do not match!<br />";
	} else {

	# select matching credential id's with users id's and their associated username and email
	// SELECT usercredentials.id,users.user_id,users.username,users.email
	// FROM usercredentials
	// INNER JOIN users 
	// ON usercredentials.id=users.user_id

	if ($password && $password!='') {
		$length = 8;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*';
    	$charactersLength = strlen($characters);
    	$randomString = '';
    	for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength-1)];
    	}
    	$passwordSalt = $randomString;
    	$password .= $randomString;
	}
	
	#create a counter for usercredentials user_id input value when user is created
	$sql_get_user_rows = "SELECT user.id from user ORDER BY id";
	$result_user_rows = mysqli_query($dbc,$sql_get_user_rows);
	$row_count = mysqli_num_rows($result_user_rows);
	$row_count++;
	// echo $row_count;

	# Let's insert the new user into the database table
	# Note the use of SHA1() in the SQL below
	$sql_insert_username = "INSERT INTO user (username, first_name, last_name, email, active_user) VALUES ('$username', '$first_name', '$last_name', '$email', 1)";
	$sql_insert_usercred = "INSERT INTO userCredentials (user_id, password, passwordSalt, administrator) 
			 VALUES ('$row_count', SHA1('$password'), '$passwordSalt', '0')";
	# use for debugging
	// echo $password."<br />";
	// echo SHA1('$password')."<br />";
	// echo $passwordSalt."<br />";
	// echo $sql."<br />";
	// echo $sql2."<br />";

	$result_insert_username = mysqli_query($dbc,$sql_insert_username);
	$result_insert_usercred = mysqli_query($dbc,$sql_insert_usercred);

	?> 
		<p>Thanks for registering, <?php echo $username ?>!</p>
		<p>Please Sign-In at the top of the page.</p>
	<?php 
	
	// header('Location:index.php');
	//exit();
	}
	
	# close the db connection
	// mysqli_close($dbc);
}?>

</div> <!-- end main-wrapper -->
<?php include 'inc/footer.inc.php';?>
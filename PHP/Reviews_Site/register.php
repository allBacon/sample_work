<?php #This file includes the necessary files for PHP page creation
  include 'inc/header.inc.php';
?>

<script>
$(document).ready(function() {
	$('#register-form').validate({
		rules: {
			username: {
				required: true,
			},
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				rangelength:[8,40]
			},
			password_verify: {
				equalTo:'#password'
			}
		}, // end rules

		messages: {
			email: {
				required: "Please supply an e-mail address.",
				email: "This is not a valid e-mail address."
			},
			password: {
				required: 'Please type a password.',
				rangelength: 'Password must be between 8 and 16 characters long.'
			},
			password_verify: {
				equalTo: 'The two passwords do not match.'
			}
		}, // end messages

		errorPlacement: function(error, element) {
			if (element.is(":radio") || element.is(":checkbox")) {
				error.appendTo(element.parent());
			} else {
				error.insertAfter(element);
			} 
		} // end errorPlacement
	}); //end validate
	$('#login-form').validate({
		rules: {
			username: {
				required: true,
			},
			password: {
				required: true,
			}
		}, // end rules

		messages: {
			username: {
				required: 'Please type your username',
			},
			password: {
				required: 'Please type a password.',
			}
		}, // end messages

		errorPlacement: function(error, element) {
			if (element.is(":radio") || element.is(":checkbox")) {
				error.appendTo(element.parent());
			} else {
				error.insertAfter(element);
			} 
		} // end errorPlacement
	}); //end validate

}); // end ready
</script>

	<div id="main-wrapper">
	  <div class="register-form">
		<h1>Register</h1>
		<form name="register-form" id="register-form" method="POST" action="process_user.php">
			<label for="username">Username:</label>
			<input id="username" type="text" name="username"><br />
			<label for="password">Password:</label>
			<span><input id="password" type="password" name="password"></span><br />
			<label for="password_verify">Verify Password:</label>
			<span><input id="password_verify" type="password" name="password_verify"></span><br />
			<label for="first_name">First Name:</label>
			<span><input id="first_name" type="text" name="first_name"></span><br />
			<label for="last_name">Last Name:</label>
			<span><input id="last_name" type="text" name="last_name"></span><br />
			<label for="email">Email Address:</label>
			<span><input id="email" type="email" name="email"></span><br />
			<span><button name="register-submit"><i class="fa fa-user-plus" aria-hidden="true"></i></button></span>
		</form>
	  </div>
	  <div class="login-form">
	  	<h1>Sign-In</h1>
		<form name="login-form" id="login-form" method="POST" action="process_login.php">
			<input type="text" name="username" id="username" placeholder="Username"><br />
			<input type="password" name="password" id="password" placeholder="Password"><br />
			<span><button name="login-submit"><i class="fa fa-sign-in" aria-hidden="true"></i></button></span>
		</form>
	  </div>
	</div>  

<?php include 'inc/footer.inc.php';?>
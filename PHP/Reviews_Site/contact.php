<?php #This file includes the necessary files for PHP page creation
  include 'inc/header.inc.php';
?>

<script>
$(document).ready(function() {
	$('#contact-form').validate({
		rules: {
			name: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
			message: {
				required: true
			}
		}, // end rules
		messages: {
			name: {
				required: "Please give your name.",
			},
			email: {
				required: "Please supply an e-mail address.",
				email: "This is not a valid e-mail address."
			},
			message: {
				required: "Please input a message.",
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
<?php 
#send email when user submits the form
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
		$email_address = "d.benson3@students.clark.edu";
		$email_subject = "New Meta Autos: Contact Form Submission";

		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$message = htmlspecialchars($_POST['message']);

		$email_body = '';
		$email_body .= "Name: ".$name."\n";
		$email_body .= "Email: ".$email."\n";
		$email_body .= "Message: ".$message."\n";

		$headers = 'From: '.$email."\r\n".'Reply-To: '.$email."\r\n".'X-Mailer: PHP/'.phpversion();
		@mail($email_address,$emailil_subject,$email_body,$headers);
		echo "Thank you for contacting us!";
	} else { ?>
		<div id="main-wrapper">
		  <div class="new-review">
			<h1>Contact Us</h1>
			<form name="contact-form" id="contact-form" method="POST" action="contact.php">
				<label for="name">Name:</label>
				<input id="name" type="text" name="name"><br />
				<label for="email">Email Address:</label>
				<span><input id="email" type="email" name="email"></span><br />
				<label for="message">Message:</label>
				<span><textarea id="message" name="message" form="contact-form"></textarea></span><br />
				<span><button name="register-submit"><i class="fa fa-user-plus" aria-hidden="true"></i></button></span>
			</form>
		  </div>
		</div>  
	<?php } ?>
<?php include 'inc/footer.inc.php';?>
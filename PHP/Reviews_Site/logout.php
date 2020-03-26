<?php # logout.php 
include 'inc/header.inc.php';
?>
<div id="main-wrapper">
	<div class="logout">
<?php 
if (isset($_SESSION['loggedin']) == 1) { 
	header('Refresh:0;');
	if (isset($_SESSION['loggedin']) !== 1) {
		session_destroy();
		exit();	
	}
} ?>
		<p>You have successfully logged out.</p>
	</div>
</div>

<?php include 'inc/footer.inc.php'; ?>
<?php #This file includes the necessary files for REVIEW PAGE creation
	include 'includes/header.inc.php';

	$reviewPage = $_GET['review'];
	if (!empty($reviewPage)) {
		$reviewPage .= '.php';
		include '/inc/review-content.inc.php';
	}
?>


<?php
	include 'includes/footer.inc.php';
?>
<!doctype html>
<?php session_start();?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Canvas API Project - Dan Benson</title>
	<link rel="stylesheet" href="css/style.css">
	<!-- Add jQuery CDN -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- SmartMenus jQuery plugin -->
    <script type="text/javascript" src="lib/jquery.smartmenus.js"></script>
    <!-- SmartMenus core CSS (required) -->
    <link href="css/css/sm-core-css.css" rel="stylesheet" type="text/css" />
    <!-- "sm-blue" menu theme (optional, you can use your own CSS, too) -->
    <link href="css/css/sm-blue/sm-blue.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<script type="text/javascript" src="lib/script.js"></script>
	<?php include_once "lib/functions.php"; ?>
</head>

<body>
<script type="text/javascript">

</script>
<?php
	
?>
<div id="pagewrapper">

<header>
	<div id="custom_token">
	  <div id="custom_token_form_box">
	  	<form id="process_custom_token" name="process_custom_token" method="" action="">
	  	  <input type="text" id="custom_access_token" />
	  	  <div id="submit_custom_token" class="btn submit_token">Set Token</div>
	  	</form>
	  </div>
	  <div id="custom_token_slide"><i class="fa fa-angle-double-down fa-fw" aria-hidden="true"></i>Custom Token<i class="fa fa-angle-double-down fa-fw" aria-hidden="true"></i></div>
	</div>
	<div id="user_main">
		<div id="user_avatar">
		  <?php
		  getAvatar();
		  getSelf();
		  ?>
		</div>
		<div id="course_select">
		  <div id="course_select_form">
		    <form id="process_form" name="process_form" action="">
		      <select name="course_id" id="course_id">
			    <?php getCourses();?>
			  </select>
			  <div id="submit" class="btn sm submit_course">Get Course</div>
		    </form>
		  </div>
		  <div id="display_course_data">
			<?php
				// $courseId = $_SESSION['course_id'];
				// $rootId = $_SESSION['root_account_id'];
				displayCourseInfo();			  	
			  ?>
		  </div>
		</div>
	</div> <!-- End user_main -->
	<?php subMenu();?>
</header>
<div id="mainwrapper">
	<div id="mainContent">
	  <?php  ?>
	  <div class="loader_img"><img src="img/loading.gif"></div>
	  <div id="assignments">
		
	  </div>
	</div>
</div>

<footer>
	<p id="copyright">&copy; Canvas API Project - Dan Benson</p>
</footer>

</div> <!-- End #pagewrapper -->

<script>
	
</script>
<?php #session_destroy() ?>
</body>
</html>
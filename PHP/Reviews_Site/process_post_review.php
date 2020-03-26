<?php #post_review.php 
include 'inc/header.inc.php';?>

<div id="main-wrapper">
	<?php 
		if (isset($_SESSION['isAdmin']) != "true") {
		echo "You don't belong here.";
		# stop the script
		exit();
	} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['isAdmin']) == "true") {
		
		# Connect to the MySQL database
		// include('inc/mysqli_connect.php'); 

		# get the variable names from the login form
		$title = $_POST['title'];
		$make = $_POST['make'];
		$model = $_POST['model'];
		$year = $_POST['year'];
		$cat_id = $_POST['category'];
		$embed_link = $_POST['embed_link'];
		$review_meta = mysqli_real_escape_string($_POST['review_meta']);
		$review_content = mysqli_real_escape_string($_POST['review_content']);
		$user_id = $_SESSION['user_id'];
		$make_id = '';
		$model_id = '';

		echo "Title: ".$title."<br>";
		echo "Make: ".$make."<br>";
		echo "Model: ".$model."<br>";
		echo "Year: ".$year."<br>";
		echo "Category: ".$cat_id."<br>";
		echo "Embed: ".$embed_link."<br>";
		echo "Review Meta: ".$review_meta."<br>";
		echo "Content: ".$review_content."<br>";
		echo "User ID: ".$user_id."<br>";


		if (isset($make) && $make!='') {
			#check database for duplicate user registration details for username or email
			$sql_check_duplicate = "SELECT manufacturer FROM make WHERE (make.manufacturer = '$make')";
			$duplicate_query = @mysqli_query($dbc,$sql_check_duplicate);
			
			if (mysqli_fetch_array($duplicate_query) > 0) {
				$row_makeId = mysqli_fetch_array($duplicate_query);
				$make_id = $row_makeId['id'];
				// header('Location: ' . $_SERVER['HTTP_REFERER']);
				// exit();
			} else {
				$sql_insert_make = "INSERT INTO `make`(`manufacturer`) VALUES ('$make')";
				@mysqli_query($dbc,$sql_insert_make);
				// if(mysqli_affected_rows($dbc) == 1) {

				# assign appropriate make_id for model entered
				$sql_select_makeId = "SELECT make.id FROM `make` WHERE make.manufacturer = '$make'";
				# query the database
				$result_makeId = @mysqli_query($dbc, $sql_select_makeId);
				$row_makeId = mysqli_fetch_array($result_makeId);
				#set make_id variable
				$make_id = $row_makeId['id'];

				// # generate the SQL
				// $sql1 = "SELECT * FROM make";

				// # query the database
				// $result1 = mysqli_query($dbc, $sql1);
				// 	while ($row1 = mysqli_fetch_array($result1)){
				// 		echo $row1['id']." ".$row1['manufacturer'];
				// 	}
				// }
			}
		}
		if (isset($model) && $model!='') {
			#check database for duplicate user registration details for username or email
			$sql_check_duplicate = "SELECT model.id,model.model_name FROM model WHERE (model.model_name = '$model')";
			$duplicate_query = @mysqli_query($dbc,$sql_check_duplicate);
			
			if (mysqli_num_rows($duplicate_query) > 0) {
				$row_modelId = mysqli_fetch_array($duplicate_query);
				$model_id = $row_modelId['id'];
				// header('Location: ' . $_SERVER['HTTP_REFERER']);
				// exit();
			} else {
				$sql_insert_model = "INSERT INTO `model` (model_name,year,make_id,cat_id) VALUES ('$model',$year,$make_id,$cat_id)";
				@mysqli_query($dbc,$sql_insert_model);

				# assign appropriate make_id for model entered
				$sql_select_modelId = "SELECT model.id FROM `model` WHERE model.model_name = '$model'";
				# query the database
				$result_modelId = @mysqli_query($dbc, $sql_select_modelId);
				$row_modelId = mysqli_fetch_array($result_modelId);
				#set make_id variable
				$model_id = $row_modelId['id'];

				// if(mysqli_affected_rows($dbc) == 1) {

				// # generate the SQL
				// $sql2 = "SELECT * FROM model";

				// # query the database
				// $result2 = mysqli_query($dbc, $sql2);
				// 	while ($row2 = mysqli_fetch_array($result2)){
				// 		echo $row2['model_name']." ".$row2['year'];
				// 	}
				// }
			}
		}

		if ($title!='' && $embed_link!='' && $review_meta!='' && $review_content!='') {
			#check database for duplicate user registration details for username or email
			$sql_check_duplicate = "SELECT * FROM review WHERE (review.title = '$title') OR (review.youtube_embed_link = '$embed_link')";
			$duplicate_query = @mysqli_query($dbc,$sql_check_duplicate);
			
			if (mysqli_num_rows($duplicate_query) > 0) {
				// header('Location: ' . $_SERVER['HTTP_REFERER']);
				// exit();
			} else {

				$sql_insert_review = "INSERT INTO `review` (title,youtube_embed_link,review_meta, review_content,published_time,updated_time,model_id,user_id,cat_id,active_post) VALUES ('$title','$embed_link','$review_meta','$review_content', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000',$model_id,$user_id,$cat_id,1)";
				@mysqli_query($dbc,$sql_insert_review);

			}
		}
		// mysqli_close($dbc);
	}
// phpinfo();
?>
</div>
<?php include 'inc/footer.inc.php';?>
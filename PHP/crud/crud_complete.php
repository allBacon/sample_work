<!doctype html>
<html lang="en">
	<!-- Author: Bruce Elgort -->
	<!-- Created: February 2014 -->
	<!-- Revised: March 4, 2014 -->
	<!-- Revised: February 14, 2016 -->
	<!-- Class: CTEC 127 -->
<head>
	<meta charset="UTF-8">
	<title>Crud</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="wrapper">
	<h1>CRUD - Create, Read, Update, Delete</h1>
	
	<p>
		<a href="crud_complete.php" title="Home">Home</a> <?php if(!isset($_GET['create']))echo "| <a href=\"?create\" title=\"Create a Record\">Add Student</a>" ?>
	</p>

	<?php
	# Connect to the MySQL database
	require 'includes/mysqli_connect.inc.php';
	?>

	<?php 

	# Function use to create a new Record
	function create_record() {
		echo "<p>Create Record</p>";
	?>	<!-- end PHP script temporarily -->
		<!-- Display HTML form -->
		<form method="POST" action="?save">
			<p><label for="id">Student ID:</label>
			<input type="text" name="id" value="">
			<p><label for="first_name">First Name:</label>
			<input type="text" id="first_name" value="" name="first_name">
			</p>
			<p>
			<p><label for="last_name">Last Name:</label>
			<input type="text" id="last_name" value="" name="last_name">
			</p>
			<p><label for="email">Email:</label>
			<input type="text" id="email" value="" name="email">
			</p>
			<p><label for="phone">Phone:</label>
			<input type="text" id="phone" value="" name="phone">
			</p>
			<a href="crud_complete.php">Cancel</a>&nbsp;&nbsp;
			<input type="submit" value="Save New Record">
		</form>

	<?php # resume PHP script 

	} # end of create_record function

	# display student data table
	function render_data($result) {
		echo "<table>\n";
		echo '<tr><th>Action</th><th><a href="?sort=first_name">First Name</a></th><th><a href="?sort=last_name">Last Name</a></th><th><a href="?sort=student_id">Student ID</a></th><th><a href="?sort=email">Email</a></th><th><a href="?sort=phone">Phone</a></th></tr>' . "\n";
		# loop thru each record in the students table
		while ($row = mysqli_fetch_array($result)){
			echo "<tr>\n";
			echo "<td><a href=\"?edit={$row['student_id']}\">Edit</a> <a href=\"?delete={$row['student_id']}\" onclick=\"return confirm('Are you sure?');\">Delete</a></td><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['student_id'] . "</td><td>" . $row['email'] . "</td><td>" . $row['phone'] . "</td>\n";	
			echo "</tr>\n";
		} # end of while loop
		echo "</table>\n";
	} # end of render_data function

	# display form so data can be edited
	function edit_data($dbc,$id){
		echo "<p>Editing Record: $id</p>";

		# generate SQL statement that will be used to get the complete row of data from the students table
		$sql = "SELECT * FROM students WHERE student_id=$id LIMIT 1";

		# get the array of data for the student_id being passed into function
		$result = mysqli_query($dbc,$sql);

		# now get the row of data from the array
		$row = mysqli_fetch_array($result);

		# assign the form variables to some variables
		# this will make it easier to use the values in the HTML form
		$first = $row['first_name'];
		$last = $row['last_name'];
	?> 	<!-- end PHP script temporarily -->
		<!-- Display HTML form -->
		<form method="POST" action="?update=<?php echo $id; ?>">
			<p><label for="id">Student ID:</label>
				<input type="text" name="id" value="<?php echo $row['student_id']; ?>" readonly>
			<p><label for="first_name">First Name:</label>
			<input type="text" id="first_name" value="<?php echo $first; ?>" name="first_name">
			</p>
			<p>
			<p><label for="last_name">Last Name:</label>
			<input type="text" id="last_name" value="<?php echo $last; ?>" name="last_name">
			</p>
			</p>
			<a href="crud_complete.php">Cancel</a>&nbsp;&nbsp;
			<input type="submit" value="Update and Save">
		</form>

	<?php # resume PHP script
	} # end of edit_data function

	# check the Query parameters of the URL 
	# handle each case accordingly:
	# sort - user clicks on column headings to sort
	# edit - edit an existing student record
	# update - update the data changed in the edit operation
	# create - create a new record
	# save - save the data from the create operation
	# delete - delete a recordee

	# handle ?sort first
	if(isset($_GET['sort'])){

		echo "<h2>Sorting data by: " . $_GET['sort'] . "</h2>\n";
		# generate SQL statement
		$sql = "SELECT * FROM students ORDER BY {$_GET['sort']}";
		# query the database using the SQL
		$result = mysqli_query($dbc, $sql);
		# call the render_data function
		render_data($result);

	} elseif (isset($_GET['edit'])) {

		# handle the ?edit

		# call the edit_date function
		# pass in $dbc and student_id from the URL
		edit_data($dbc, $_GET['edit']);

	} elseif (isset($_GET['update'])) { 

		#handle the ?update

		# generate SQL statement
		$sql = "UPDATE students SET first_name='{$_POST['first_name']}', last_name='{$_POST['last_name']}' WHERE student_id={$_POST['id']}";
		# query the database using the SQL
		$result = mysqli_query($dbc,$sql);

		# if the update was ok then display all student data
		if($result){

			# generate the SQL
			$sql = "SELECT * FROM students";
			# query the database
			$result = mysqli_query($dbc, $sql);
			# call the render_data() function to display all of the student data in a table
			render_data($result);

		} else {

			# something didn't go well when trying to update the student record
			echo "ruh roh....";

		}

	} elseif (isset($_GET['create'])) {

		#handle the ?create

		# create a new Record
		# present a form
		create_record($dbc);

	} elseif (isset($_GET['save'])) {

		# handle the ?save

		# now INSERT the data into the database table
		# INSERT INTO tablename (column1,column2) VALUES (val1,val2) LIMIT 1

		# assign the form field data to variables
		# makes things easier to code in the SQL statement

		$id = $_POST['id'];
		$first = $_POST['first_name'];
		$last = $_POST['last_name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];

		# generate the SQL
		$sql = "INSERT INTO students (student_id,first_name,last_name,email,phone)
		 VALUES ($id,'$first','$last','$email','$phone')";

		# [debug] Uncomment the line below for debugging
		# echo $sql;

		# query the database
		$result = @mysqli_query($dbc,$sql);

		# did the delete "affect" one row? It better have!
		if(mysqli_affected_rows($dbc) == 1) {

			# generate the SQL
			$sql = "SELECT * FROM students";

			# query the database
			$result = mysqli_query($dbc, $sql);

			# call the render_data function
			render_data($result);

		} else {

			# something went wrong with the save
			echo "<p>ruh roh.... Something didn't go right when trying to add a new student.</p>";
		}

	} elseif (isset($_GET['delete']))  {

		# handle the ?delete

		# generate the sql
		$sql = "DELETE FROM students WHERE student_id={$_GET['delete']} LIMIT 1";
		
		# query the database
		$result = mysqli_query($dbc,$sql);

		# check to see that the delete was successful
		if(mysqli_affected_rows($dbc) == 1) {

			# generate the SQL
			$sql = "SELECT * FROM students";
			# query the database
			$result = mysqli_query($dbc, $sql);
			# call the render_data() function
			render_data($result);

		} else {

			# something didn't go right with the DELETE
			echo "ruh roh.... Something didn't go right.";

		}

	} else { 

		# catch all
		# simply display the student data from the table

		$sql = "SELECT * FROM students";
		$result = mysqli_query($dbc, $sql);
		render_data($result);

	}

	# close the connection to the database
	mysqli_close($dbc);

	?> <!-- end of PHP -->

</div> <!-- end wrapper -->
</body>
</html>
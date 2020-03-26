<?php 

try {
	require_once 'inc/mysqli_connect.php';
	$sql = "SELECT first_name,last_name,student_id,email FROM students";
	$result = $db->query($sql);
} catch (exception $e){
	$error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MySqliOOP Test</title>
</head>

<body>
		<?php if(isset($error)){
				echo "<p>$error</p>";
			} 

			$numrows = $result->num_rows;

			if (!$numrows) {
				echo "<p>No rows were found</p>";
			} else {
				echo "<p>Total results found: ".$numrows;
			}

		?>

	<table>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Student ID</th>
			<th>Email</th>
		</tr>
		<?php 
		while ($row = $result->fetch_row()) { ?>
			<tr>
				<td><?php echo $row[0]; ?></td>
				<td><?php echo $row[1]; ?></td>
				<td><?php echo $row[2]; ?></td>
				<td><?php echo $row[3]; ?></td>
			
			</tr>
		<?php } ?>
	</table>
	<?php $db->close(); ?>
</body>
</html>
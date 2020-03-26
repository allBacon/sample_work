<?php #This file includes the necessary files for Review List Page creation
	include 'inc/header.inc.php';
?>
<div id="data-wrapper">
	<div class="table_data">
	<?php

	function display_data($result) {
	?>
		<h1>User List</h1>
		<table>
			<tr>
				<th>Action</th>
				<th><a href="?sort=user.id&order=<?php $order=$_GET['order']; echo(($order=='desc')?'asc':'desc');?>">User ID</a></th>
				<th><a href="?sort=username&order=<?php $order=$_GET['order']; echo(($order=='desc')?'asc':'desc');?>">Username</a></th>
				<th><a href="?sort=email&order=<?php $order=$_GET['order']; echo(($order=='desc')?'asc':'desc');?>">Email</a></th>
				<th><a href="?sort=first_name&order=<?php $order=$_GET['order']; echo(($order=='desc')?'asc':'desc');?>">First Name</a></th>
				<th><a href="?sort=last_name&order=<?php $order=$_GET['order']; echo(($order=='desc')?'asc':'desc');?>">Last Name</a></th>
				<th><a href="?sort=administrator&order=<?php $order=$_GET['order']; echo(($order=='desc')?'asc':'desc');?>">Admin</a></th>
				<th><a href="?sort=active&order=<?php $order=$_GET['order']; echo(($order=='desc')?'asc':'desc');?>">Active User</a></th></tr>
			<?php 
			while ($row = mysqli_fetch_array($result)){
			?>
			<tr>
				<td>
					<a href="?edit=<?php echo $row['id'];?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
					<a href="?delete=<?php echo $row['id'];?>" onclick="return confirm('Are you sure you want to delete this entry?');"><i class="fa fa-minus-square" aria-hidden="true"></i></a>
				</td>
				<td><?php echo $row['id'];?></td>
				<td><?php echo $row['username'];?></td>
				<td><?php echo $row['email'];?></td>
				<td><?php echo $row['first_name'];?></td>
				<td><?php echo $row['last_name'];?></td>
				<td><?php echo $row['administrator'];?></td>
				<td><?php echo $row['active_user'];?></td>
			</tr>
		<?php } ?>
		</table>
	<?php } #end of display_data()
	function edit_data($dbc,$id){
		$sql = "SELECT usercredentials.administrator,user.active_user,user.id,user.username,user.email,user.first_name,user.last_name FROM user INNER JOIN usercredentials ON user.id=usercredentials.user_id WHERE usercredentials.id=$id LIMIT 1";
		$result = mysqli_query($dbc,$sql);
		$row = mysqli_fetch_array($result);
		$username = $row['username'];
		$email = $row['email'];
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$administrator = $row['administrator'];
		$active_user = $row['active_user'];
	?>
		<div class="update">
		<h1>Update Review</h1>
		<form id="update" method="POST" action="?update=<?php echo $id; ?>">
			<label for="administrator">Administrator:</label>
			<input type="text" id="administrator" name="administrator" value="<?php echo $row['administrator'];?>"">
			<label for="active_user">Active User:</label>
			<input type="text" id="active_user" name="active_user" value="<?php echo $row['active_user'];?>"">		
			<p><label for="id">User ID:</label>
			<input type="text" name="id" value="<?php echo $row['id']; ?>" readonly>
			</p><p>
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" value="<?php echo $username; ?>">
			</p><p>
			<label for="email">Email:</label>
			<input type="text" id="email" name="email" value="<?php echo$email;?>">
			</p>
			<p>
			<label for="first_name">First Name:</label>
			<input type="text" id="first_name" name="first_name" value="<?php echo$first_name;?>">
			</p>
			<p>
			<label for="last_name">Last Name:</label>
			<input type="text" id="last_name" name="last_name" value="<?php echo$last_name;?>">
			</p>
			<p>
			<span><a href="car_list.php"><i class="fa fa-ban" aria-hidden="true"></i></a>&nbsp;&nbsp;
			<button id="update-btn" name="update"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></span>
		</form>
		</div>

	<?php
	} #end of edit_data()
	if(isset($_GET['sort'])){
		
		$order = isset($_GET['order'])?$_GET['order']:'asc';
		
		$sql = "SELECT * FROM user INNER JOIN usercredentials ON user.id=usercredentials.id ORDER BY {$_GET['sort']} $order";
		$result = mysqli_query($dbc, $sql);
		display_data($result);
	} elseif (isset($_GET['edit'])) {
		edit_data($dbc, $_GET['edit']);
	} elseif (isset($_GET['update'])) { 
		$sql = "UPDATE user INNER JOIN usercredentials ON user.id=usercredentials.id SET user.username='{$_POST['username']}', user.email='{$_POST['email']}', user.first_name='{$_POST['first_name']}', user.last_name='{$_POST['last_name']}', usercredentials.administrator='{$_POST['administrator']}', user.active_user={$_POST['active_user']} WHERE usercredentials.id={$_POST['id']}";
		$result = mysqli_query($dbc,$sql);
		if($result){
			$sql = "SELECT user.id,user.username,user.email,user.first_name,user.last_name,usercredentials.administrator,user.active_user FROM user INNER JOIN usercredentials ON user.id=usercredentials.id ORDER BY user.id ASC";
			$result = mysqli_query($dbc, $sql);
			display_data($result);
		} else {
			#error
			echo "There was an error updating this user.";
		}
	} elseif (isset($_GET['delete']))  {
		// $sql = "DELETE FROM user INNER JOIN usercredentials ON user.id=usercredentials.id WHERE user.id={$_GET['delete']} AND usercredentials.id={$_GET['delete']} LIMIT 1";
		$sql = "UPDATE user SET active_user=0 WHERE user.id={$_GET['delete']}";
		$result = mysqli_query($dbc,$sql);
		if(mysqli_affected_rows($dbc) == 1) {
			$sql = "SELECT * FROM user";
			$result = mysqli_query($dbc, $sql);
			display_data($result);
		} else {
			#error
			echo "There was an error deleting this user.";
		}
	} else { 
		$sql = "SELECT * FROM user INNER JOIN usercredentials ON user.id=usercredentials.id";
		$result = mysqli_query($dbc, $sql);
		display_data($result);
	}
	// mysqli_close($dbc);

	?> 
	</div> <!-- end of table_data -->
</div> <!-- end main-wrapper -->

<?php include 'inc/footer.inc.php'; ?>
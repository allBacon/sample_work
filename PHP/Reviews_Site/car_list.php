<?php #This file includes the necessary files for Review List Page creation
	include 'inc/header.inc.php';
?>
<div id="data-wrapper">
	<div class="table_data">
	<?php

	function display_data($result) {
	?>
		<h1>Car List</h1>
		<table>
			<tr>
				<th>Action</th>
				<th><a href="?sort=model.id&order=<?php $order=$_GET['order']; echo (($order=='desc')?'asc':'desc');?>">Car ID</a></th>
				<th><a href="?sort=year&order=<?php $order=$_GET['order']; echo (($order=='desc')?'asc':'desc');?>">Year</a></th>
				<th><a href="?sort=manufacturer&order=<?php $order=$_GET['order']; echo (($order=='desc')?'asc':'desc');?>">Make</a></th>
				<th><a href="?sort=model_name&order=<?php $order=$_GET['order']; echo (($order=='desc')?'asc':'desc');?>">Model</a></th>
				<th><a href="?sort=cat_id&order=<?php $order=$_GET['order']; echo (($order=='desc')?'asc':'desc');?>">Category</a></th></tr>
			<?php 
			while ($row = mysqli_fetch_array($result)){
			?>
			<tr>
				<td>
					<a href="?edit=<?php echo $row['id'];?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
					<a href="?delete=<?php echo $row['id'];?>" onclick="return confirm('Are you sure you want to delete this entry?');"><i class="fa fa-minus-square" aria-hidden="true"></i></a>
				</td>
				<td><?php echo $row['id'];?></td>
				<td><?php echo $row['year'];?></td>
				<td><?php echo $row['manufacturer'];?></td>
				<td><?php echo $row['model_name'];?></td>
				<td><?php echo $row['cat_id'];?></td>
			</tr>
		<?php } ?>
		</table>
	<?php } #end of display_data()
	function edit_data($dbc,$id){
		$sql = "SELECT model.id,model.year,make.manufacturer,model.model_name,model.cat_id FROM model INNER JOIN make ON model.id=make.id WHERE make.id=$id LIMIT 1";
		$result = mysqli_query($dbc,$sql);
		$row = mysqli_fetch_array($result);
		$year = $row['year'];
		$make = $row['manufacturer'];
		$model = $row['model_name'];
		$cat_id = $row['cat_id'];
	?>
		<div class="update">
		<h1>Update Review</h1>
		<form id="update" method="POST" action="?update=<?php echo $id; ?>">
			<p><label for="id">Model ID:</label>
			<input type="text" name="id" value="<?php echo $row['id']; ?>" readonly>
			</p><p>
			<label for="year">Year:</label>
			<input type="text" id="year" name="year" value="<?php echo $year; ?>">
			</p><p>
			<label for="make">Make:</label>
			<input type="text" id="make" name="make" value="<?php echo$make;?>">
			</p>
			<p>
			<label for="model">Model:</label>
			<input type="text" id="model" name="model" value="<?php echo$model;?>">
			</p>
			<p>
			<label for="cat_id">Category ID:</label>
			<input type="text" id="cat_id" name="cat_id" value="<?php echo$cat_id;?>">
			</p>
			<span><a href="car_list.php"><i class="fa fa-ban" aria-hidden="true"></i></a>&nbsp;&nbsp;
			<button id="update-btn" name="update"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></span>
		</form>
		</div>

	<?php
	} #end of edit_data()
	if(isset($_GET['sort'])){
		$order = isset($_GET['order'])?$_GET['order']:'asc';
		
		$sql = "SELECT * FROM model INNER JOIN make ON model.id=make.id ORDER BY {$_GET['sort']} $order";
		$result = mysqli_query($dbc, $sql);
		display_data($result);
	} elseif (isset($_GET['edit'])) {
		edit_data($dbc, $_GET['edit']);
	} elseif (isset($_GET['update'])) { 
		$sql = "UPDATE model INNER JOIN make ON model.id=make.id SET year='{$_POST['year']}', make.manufacturer='{$_POST['make']}', model.model_name='{$_POST['model']}', model.cat_id='{$_POST['cat_id']}' WHERE model.id={$_POST['id']}";
		$result = mysqli_query($dbc,$sql);
		if($result){
			$sql = "SELECT model.id,model.year,make.manufacturer,model.model_name,model.cat_id FROM model INNER JOIN make ON model.id=make.id ORDER BY make.manufacturer ASC";
			$result = mysqli_query($dbc, $sql);
			display_data($result);
		} else {
			#error
			echo "There was an error updating this vehicle.";
		}
	} elseif (isset($_GET['delete']))  {
		$sql = "DELETE FROM model WHERE model.id={$_GET['delete']} LIMIT 1";
		$result = mysqli_query($dbc,$sql);
		if(mysqli_affected_rows($dbc) == 1) {
			$sql = "SELECT * FROM model";
			$result = mysqli_query($dbc, $sql);
			display_data($result);
		} else {
			#error
			echo "There was an error deleting this vehicle.";
		}
	} else { 
		$sql = "SELECT model.id,model.year,make.manufacturer,model.model_name,model.cat_id FROM model INNER JOIN make ON model.id=make.id ORDER BY make.manufacturer ASC";
		$result = mysqli_query($dbc, $sql);
		display_data($result);
	}
	// mysqli_close($dbc);

	?> 
	</div> <!-- end of table_data -->
</div> <!-- end main-wrapper -->

<?php include 'inc/footer.inc.php'; ?>
<?php #This file includes the necessary files for Review List Page creation
	include 'inc/header.inc.php';
?>
<div id="data-wrapper">
	<div class="table_data">
	<?php

	function display_data($result) {
	?>
		<h1>Current Reviews</h1>
		<table>
			<tr>
				<th>Action</th>
				<th><a href="?sort=review_id&order=<?php $order = $_GET['order']; echo (($order=='desc')?'asc':'desc');?>">Review ID</a></th>
				<th><a href="?sort=title&order=<?php $order = $_GET['order']; echo (($order=='desc')?'asc':'desc');?>">Title</a></th>
				<th><a href="?sort=youtube_embed_link&order=<?php $order = $_GET['order']; echo (($order=='desc')?'asc':'desc');?>">YouTube ID</a></th>
				<th><a href="?sort=review_meta&order=<?php $order = $_GET['order']; echo (($order=='desc')?'asc':'desc');?>">Description</a></th>
				<th><a href="?sort=published_time&order=<?php $order = $_GET['order']; echo (($order=='desc')?'asc':'desc');?>">Published</a></th>
				<th><a href="?sort=user_id&order=<?php $order = $_GET['order']; echo (($order=='desc')?'asc':'desc');?>">User</a></th>
				<th><a href="?sort=cat_id&order=<?php $order = $_GET['order']; echo (($order=='desc')?'asc':'desc');?>">Category</a></th>
				<th><a href="?sort=active&order=<?php $order = $_GET['order']; echo (($order=='desc')?'asc':'desc');?>">Active Post</a></th></tr>
			<?php 
			while ($row = mysqli_fetch_array($result)){
			?>
			<tr>
				<td>
					<a href="?edit=<?php echo $row['review_id'];?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
					<a href="?delete=<?php echo $row['review_id'];?>" onclick="return confirm('Are you sure you want to delete this entry?');"><i class="fa fa-minus-square" aria-hidden="true"></i></a>
				</td>
				<td><?php echo $row['review_id'];?></td>
				<td><?php echo $row['title'];?></td>
				<td><?php echo $row['youtube_embed_link'];?></td>
				<td><?php echo $row['review_meta'];?></td>
				<td><?php echo $row['published_time'];?></td>
				<td><?php echo $row['user_id'];?></td>
				<td><?php echo $row['cat_id'];?></td>
				<td><?php echo $row['active_post'];?></td>
			</tr>
		<?php } ?>
		</table>
	<?php } #end of display_data()
	function edit_data($dbc,$id){
		$sql = "SELECT * FROM review WHERE review_id=$id LIMIT 1";
		$result = mysqli_query($dbc,$sql);
		$row = mysqli_fetch_array($result);
		$title = $row['title'];
		$youtube_embed_link = $row['youtube_embed_link'];
		$review_meta = $row['review_meta'];
		$review_content = $row['review_content'];
		$active_post = $row['active_post'];
	?>
		<div class="update">
		<h1>Update Review</h1>
		<form id="update" method="POST" action="?update=<?php echo $id; ?>">
			<label for="active_post">Active Review:</label>
			<input type="text" name="active_post" value="<?php echo $row['active_post']; ?>">
			<p><label for="id">Review ID:</label>
			<input type="text" name="id" value="<?php echo $row['review_id']; ?>" readonly>
			</p><p>
			<label for="youtube_id">YouTube ID:</label>
			<input type="text" id="youtube_id" name="youtube_id" value="<?php echo $youtube_embed_link; ?>">
			</p><p>
			<label for="review_meta">Review Description:</label>
			<textarea id="review_meta" name="review_meta" form="update"><?php echo $review_meta; ?></textarea>
			</p>
			<p>
			<label for="review_content">Review Content:</label>
			<textarea id="review_content" name="review_content" form="update"><?php echo $review_content; ?></textarea>
			</p>
			<span><a href="review_list.php"><i class="fa fa-ban" aria-hidden="true"></i></a>&nbsp;&nbsp;
			<button id="update-btn" name="update"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></span>
		</form>
		</div>

	<?php
	} #end of edit_data()
	if(isset($_GET['sort'])){
		
		$order = isset($_GET['order'])?$_GET['order']:'asc';
		
		$sql = "SELECT * FROM review ORDER BY {$_GET['sort']} $order";
		$result = mysqli_query($dbc, $sql);
		display_data($result);
	} elseif (isset($_GET['edit'])) {
		edit_data($dbc, $_GET['edit']);
	} elseif (isset($_GET['update'])) { 
		$sql = "UPDATE review SET review.active_post='{$_POST['active_post']}',review.youtube_embed_link='{$_POST['youtube_id']}', review.review_meta='{$_POST['review_meta']}', review.review_content='{$_POST['review_content']}' WHERE review.review_id={$_POST['id']}";
		$result = mysqli_query($dbc,$sql);
		if($result){
			$sql = "SELECT * FROM review";
			$result = mysqli_query($dbc, $sql);
			display_data($result);
		} else {
			#error
			echo "There was an error updating this review.";
		}
	} elseif (isset($_GET['delete']))  {
		$sql = "UPDATE review SET active_post=0 WHERE review_id={$_GET['delete']}";
		$result = mysqli_query($dbc,$sql);
		if(mysqli_affected_rows($dbc) == 1) {
			$sql = "SELECT * FROM review";
			$result = mysqli_query($dbc, $sql);
			display_data($result);
		} else {
			#error
			echo "There was an error deleting this review.";
		}
	} else { 
		$sql = "SELECT * FROM review";
		$result = mysqli_query($dbc, $sql);
		display_data($result);
	}
	// mysqli_close($dbc);

	?> 
	</div> <!-- end of table_data -->
</div> <!-- end main-wrapper -->

<?php include 'inc/footer.inc.php'; ?>
<?php #post_review.php 
include 'inc/header.inc.php';?>

<script>
$(document).ready(function() {
	$('#post-review').validate({
		rules: {
			title: {
				required: true,
			},
			make: {
				required: true,
			},
			model: {
				required: true,
			},
			embed_link: {
				required: true,
			},
			review_meta: {
				required: true,
			},
			review_content: {
				required: true,
			}
		}, // end rules

		messages: {
			title: {
				required: "Please enter a Title",
			},
			make: {
				required: "Please enter a Manufacturer Name",
			},
			model: {
				required: "Please enter a Model Name",
			},
			embed_link: {
				required: "Please enter a YouTube ID",
			},
			review_meta: {
				required: "Please enter a short description",
			},
			review_content: {
				required: "Please enter the review text content",
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

<div id="main-wrapper">
  <div class="new-review">
  	<h1>Create a New Review</h1>
	<form id="post-review" method="POST" action="process_post_review.php">
		<label for="title">Title:</label>
		<input id="title" type="text" name="title"><br />
		<label for="category">Vehicle Category:</label>
		<select id="category" name="category">
			<option value="1">Car</option>
			<option value="2">SUV</option>
			<option value="3">Truck</option>
			<option value="4">Van</option>
		</select><br />
		<label for="make">Make:</label>
		<input id="make" type="text" name="make"><br />
		<label for="model">Model:</label>
		<input id="model" type="text" name="model"><br />
		<label for="year">Year:</label>
		<select id="year" name="year">
			<option value="2017">2017</option>
			<?php $current_year = date('Y');$earliest_year=1990; foreach (range($current_year, $earliest_year) as $i) { ?>
			<option value="<?php echo$i."\"".($i==$current_year?' selected':'').">".$i; ?></option><?php echo "\n";} ?>
		</select><br />
		<label for="embed_link">YouTube ID:</label>
		<span><input id="embed_link" type="text" name="embed_link"></span><br />
		<label for="review_meta">Short Description:</label>
		<span><textarea id="review_meta" type="text" name="review_meta" form="post-review"></textarea></span><br />
		<label for="review_content">Article Text:</label>
		<span><textarea id="review_content" type="text" name="review_content" form="post-review"></textarea></span><br />
		<span><button name="review-submit"><i class="fa fa-plus-square" aria-hidden="true"></i></button></span>
	</form>
  </div> <!-- end new-review -->
</div> <!-- end main-wrapper -->

<?php include 'inc/footer.inc.php';?>
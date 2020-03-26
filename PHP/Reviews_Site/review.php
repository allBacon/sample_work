<?php #This file includes the necessary files for Single Review PHP page creation
  include 'inc/header.inc.php';
?>
    <div id="main-wrapper">
      <div id="main-content" class="single">
        <?php 

			$review_id = $_GET['review_id'];
			// echo $review_id;

      #if user submits comment, add it to the database
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (strlen($_POST['review_comment']) == 0 ) { #dont post comment if there's no user input
          echo "Problem adding a comment.";
        } else {
          $comment = $_POST['review_comment'];
          $user_id = $_SESSION['user_id'];
          $sql_insert_comment = "INSERT INTO `comment` (comment,created_time,user_id,review_id) VALUES ('$comment',CURRENT_TIMESTAMP,$user_id,$review_id)";
          @mysqli_query($dbc,$sql_insert_comment);
        } 
      }

			$sql_request_reviews = "SELECT review_id,title,youtube_embed_link,review_content,date_format(review.published_time, '%m/%d/%Y %l:%i%p') published_time,model_id,user_id,cat_id,user.first_name,user.last_name,user.email FROM review INNER JOIN user WHERE review.review_id=$review_id";

			#on display output, show posting user first & last name
			#if reviews.user_id equals 
			$reviewOutputQuery = @mysqli_query($dbc,$sql_request_reviews);
			$reviewOutputRow = @mysqli_fetch_array($reviewOutputQuery);

			$model_info = $reviewOutputRow['model_id'];
			$model_category = $reviewOutputRow['cat_id'];

			$sql_vehicle_info = "SELECT model.model_name,model.year,make.manufacturer FROM model INNER JOIN make ON model.id=model.id WHERE (model.id = $model_info) ";
			$vehicle_info_query = @mysqli_query($dbc,$sql_vehicle_info);
			$reviewVehicleRow = @mysqli_fetch_array($vehicle_info_query);
			$reviewOutputVehicleMake = $reviewVehicleRow['manufacturer'];
			$reviewOutputVehicleModel = $reviewVehicleRow['model_name'];
			$reviewOutputVehicleYear = $reviewVehicleRow['year'];
			// echo $reviewOutputVehicleMake . " " .$reviewOutputVehicleName . " " . $reviewOutputVehicleYear;
        ?>
        <div class="single-review">
        	<div class="title">
        		<h1><?php echo $reviewOutputRow['title'];?></h1>
        	</div>
        	<div class="author"><a href="mailto:<?php echo $reviewOutputRow['email'] . "\">" . $reviewOutputRow['first_name'] . " " . $reviewOutputRow['last_name'];?></a></div>
              <div class="date"><?php $dateTime = $reviewOutputRow['published_time']; echo $dateTime;?>
            </div>
        	<div class="video-lg">
        		<iframe src="https://www.youtube.com/embed/<?php echo $reviewOutputRow['youtube_embed_link'];?>" allowfullscreen></iframe>
        	</div>
        	<div class="review_content">
        		<p><?php echo $reviewOutputRow['review_content'];?></p>
        	</div>
          <div id="comments">
            <div class="comments">
              <h3>Comments:</h3>
              <?php #select and display comments for this review
                $sql_comments_query = "SELECT comment.id,date_format(comment.created_time, '%m/%d/%Y %l:%i%p'),comment.comment,comment.review_id,comment.user_id,user.id,user.first_name,user.last_name,user.email FROM comment INNER JOIN user ON comment.user_id=user.id WHERE review_id=$review_id";
                $comment_results = @mysqli_query($dbc, $sql_comments_query);
                 
                while ($comment = @mysqli_fetch_array($comment_results)) { ?>
                  <div class="author"><a href="mailto:<?php echo$comment['email'] . "\">" . $comment['first_name'] . " " . $comment['last_name'];?></a></div>
                  <div class="date"><?php $dateTime = $comment[1]; echo $dateTime;?></div>
                  <div class="description"> 
                    <p class="comment"><?php echo$comment['comment']?></p></div>
                <?php } ?>
            </div>
            <?php
              #when user is logged in, display add comment form
              if (isset($_SESSION['loggedin']) == 1) { ?>
                <form id="post_comment" method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
                  <label for="review_comment">Add Comment:</label>
                  <span><textarea id="review_comment" type="text" name="review_comment" form="post_comment"></textarea></span><br />
                  <span><button name="comment-submit"><i class="fa fa-plus-square" aria-hidden="true"></i></button></span>
                </form>
              <?php
              } else { ?>
                <h3>You must be logged in to post a comment!</h3>
              <?php } ?>
          </div>
        </div>
      </div> 

      <aside>
        <div id="top-reviews-single">
          <h3>Top Reviews</h3>
          <ul class="top-reviews-ul">
          <?php 
          #build a ul with the title/link of a review and the number of total comments for the matching review_id
            #count number of total reviews
            $sql_review_count = "SELECT review.review_id FROM review";
            $review_count_query = @mysqli_query($dbc,$sql_review_count);
            $review_count = @mysqli_num_rows($review_count_query);
            // echo $review_count;

            #select review and comment info
            $sql_ratings_query = "SELECT comment.id,comment.review_id,review.review_id,review.title FROM review INNER JOIN comment ON review.review_id=review.review_id ORDER BY comment.review_id DESC LIMIT $review_count";
            $ratings_results = @mysqli_query($dbc,$sql_ratings_query);

            #display review rank
            while ($ratings_row = @mysqli_fetch_array($ratings_results)) { ?>
              <li><a class="top_review_title" href="review.php?<?php echo"review_id=".$ratings_row['review_id']."\">"; echo$ratings_row['title'];?></a>
              <?php 
              for ($i=0; $i < $review_count; $i++) { 
                $sql_comment_count = "SELECT comment.review_id FROM comment WHERE review_id=$i ORDER BY comment.review_id DESC";
                $comment_count_query = @mysqli_query($dbc,$sql_comment_count);
                $comment_count = @mysqli_num_rows($comment_count_query);
                // echo "<span class=\"comment_rank\">".$comment_count."</span>";
              }
              echo "<div class=\"comment_rank\"><div class=\"data\">".$comment_count."</div></div>"; ?>
              </li>
            <?php } ?>
          </ul>
        </div>
      </aside>
    </div>  <!-- end of mainwrapper -->

<?php include 'inc/footer.inc.php'; ?>
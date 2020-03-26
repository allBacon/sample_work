<?php #main-content.php ?>
    <div id="main-wrapper">
      <div id="main-content">
        <?php 

          $sql_request_reviews = "SELECT review_id,title,youtube_embed_link,review_meta,review_content,date_format(review.published_time, '%m/%d/%Y %l:%i%p'),published_time,model_id,user_id,cat_id,active_post,user.first_name,user.last_name,user.email FROM review INNER JOIN user ON review.user_id=user.id ORDER BY review_id DESC LIMIT 10";
          #on display output, show posting user first & last name
          #if reviews.user_id equals 
          $reviewOutputQuery = @mysqli_query($dbc,$sql_request_reviews);
          
          while ($reviewOutputRow = @mysqli_fetch_array($reviewOutputQuery)) { 
              $active = $reviewOutputRow['active_post'];
              if ($active == 0) {
                
              } else {
                $review_id =  $reviewOutputRow['review_id'];
                $model_info = $reviewOutputRow['model_id'];
                $model_category = $reviewOutputRow['cat_id'];
                $sql_vehicle_info = "SELECT model.model_name,model.year,make.manufacturer FROM model INNER JOIN make ON model.id=model.id WHERE (model.id = $model_info)";
                $vehicle_info_query = @mysqli_query($dbc,$sql_vehicle_info);
                while ($reviewVehicleRow = @mysqli_fetch_array($vehicle_info_query)) {
                  $reviewOutputVehicleMake = $reviewVehicleRow['manufacturer'];
                  $reviewOutputVehicleModel = $reviewVehicleRow['model_name'];
                  $reviewOutputVehicleYear = $reviewVehicleRow['year'];
                  // echo $reviewOutputVehicleMake . " " .$reviewOutputVehicleName . " " . $reviewOutputVehicleYear;
                }
              ?>
          <article>
            <div class="review">
              <div class="video">
                <iframe width="400" height="225" src="https://www.youtube.com/embed/<?php echo $reviewOutputRow['youtube_embed_link'];?>" allowfullscreen></iframe>
                </div>
                <div class="meta-content">
                <div class="heading">
                  <p><a href="review.php?<?php echo"review_id=$review_id\">";
                    echo $reviewOutputRow['title'];?></a></p>
                </div>
                <div class="author"><a href="mailto:<?php echo $reviewOutputRow['email'] . "\">" . $reviewOutputRow['first_name'] . " " . $reviewOutputRow['last_name'];?></a></div>
                <div class="date"><?php $dateTime = $reviewOutputRow['published_time']; echo $dateTime;?></div>
                <div class="description">
                <p><?php echo $reviewOutputRow['review_meta'];?></p></div>
              </div>
            </div>
          </article>
          <?php }
          } ?>
      </div> 

      <aside>
        <div id="top-reviews">
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
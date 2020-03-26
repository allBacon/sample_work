<?php #This file includes the necessary files for PHP page creation
  include 'inc/header.inc.php';
 ?>
<div id="search-content">
<?php 
    $sql_search = "SELECT * FROM `review` ORDER BY review_id DESC";

    $results = mysqli_query($dbc,$sql_search) or die(mysql_error());
         
    if (mysqli_num_rows($results) > 0) {
        while($row = mysqli_fetch_array($results)) { ?> 
          <div class="heading">
            <p>
              <a href="review.php?review_id=<?php echo$row[0]."\">".$row[1];?></a>
            </p>
          </div>
          <div class="description">
            <p><?php echo substr($row[5], 0, 300);?>...</p>
          </div> <?php
        } 
    } ?>
</div> 
<?php include 'inc/footer.inc.php';?>
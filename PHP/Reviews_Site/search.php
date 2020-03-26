<?php #This file includes the necessary files for PHP page creation
  include 'inc/header.inc.php';
?>

<div id="search-content">

<?php
    if (isset($_GET['all'])) { 

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
        }
    } elseif (isset($_GET['cat'])) {
        $cat = $_GET['cat'];

        $sql_search = "SELECT * FROM `review` WHERE review.cat_id=$cat ORDER BY review_id DESC";

        $results = mysqli_query($dbc,$sql_search) or die(mysql_error());
             
        if (mysqli_num_rows($results) > 0) {
            while($row = mysqli_fetch_array($results)) { ?> 
              <div class="heading">
                <p>
                  <a href="review.php?review_id=<?php echo$row[0]."\">".$row[1];?></a>
                </p>
              </div>
              <div class="description">
                <?php echo substr($row[5], 0, 300);?>...
              </div> <?php
            } 
        } else {
            echo "<p>No results.</p>";
        }
    } elseif (isset($_GET['search_input'])) {
        $query = $_GET['search_input']; 
     
        $min_length = 2;
         
        if (strlen($query) >= $min_length) { 
            $query = htmlspecialchars($query); 

            $sql_search = "SELECT * FROM review WHERE MATCH(review_content) AGAINST('%$query%') OR (MATCH(title) AGAINST('%$query%'))";

            $results = mysqli_query($dbc,$sql_search) or die(mysql_error());
                 
            if (mysqli_num_rows($results) > 0) {
                while($row = mysqli_fetch_array($results)) { ?>
                    <div class="heading"><p><a href="review.php?review_id=<?php echo$row[0]."\">".$row[1];?></a></p></div>
                    <div class="description"><p><?php echo substr($row[5], 0, 300);?>...</p></div><?php
                }
            } else {
                echo "<p>No results.</p>";
            }
        } else {
            echo "<p>Minimum length is ".$min_length."</p>";
        }
    } else {
        ?>
        <div class="main-search">
          <form action="search.php" method="GET">
            <input type="text" id="search" name="search_input">
            <button><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
        </div>
        <?php
    }
    // mysqli_close($dbc);
?>

</div> <!-- END SEARCH CONTENT -->
<?php include 'inc/footer.inc.php';?>
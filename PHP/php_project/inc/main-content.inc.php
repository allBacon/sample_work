<?php #main-content.php ?>
    <div id="main-wrapper">
      <div id="main-content">
        <?php 
          $sql = "
            SELECT reviews.id,reviews.title,reviews.youtube_embed_link,reviews.published_time,reviews.review_content,reviews.user_id,users.username,users.first_name,users.last_name,users.email,users.date_created 
            FROM reviews 
            INNER JOIN users 
            ON reviews.user_id=users.user_id";

          $result = mysqli_query($dbc,$sql);
          $row = mysqli_fetch_array($result);



        ?>
        <article>
          <div class="review">
            <div class="video">
              <iframe width="400" height="225" src="https://www.youtube.com/embed/ghreRhjUrZU" allowfullscreen></iframe>
            </div>
            <div class="meta-content">
              <div class="heading">
                <p><a href="review.php?year=2016&make=bugatti&model=chiron">Bugatti Chiron Start-Up and Revving</a></p>
              </div>
              <div class="author">Dan Benson</div>
              <div class="date">January, 29 2016</div>
              <div class="description">
              <p>This video shows a new Bugatti Chiron starting-up and revving loudly.</p></div>
            </div>
          </div>
        </article>
        <article>
          <div class="review">
            <div class="video">
              <iframe width="400" height="225" src="https://www.youtube.com/embed/cVFkreHsTHI" allowfullscreen></iframe>
            </div>
            <div class="meta-content">
              <div class="heading">
                <p><a href="2017-audi-r8.html">2017 Audi R8 V10 Drive</a></p>
              </div>
              <div class="author">Dan Benson</div>
              <div class="date">January, 29 2016</div>
              <div class="description"><p>This video shows a new Bugatti Chiron starting-up and revving loudly.</p></div>
            </div>
          </div>
        </article>
        <article>
          <div class="review">
            <div class="video">
              <iframe width="400" height="225" src="https://www.youtube.com/embed/K6kyAeAozBs" allowfullscreen></iframe>
            </div>
            <div class="meta-content">
              <div class="heading">
                <p><a href="2016-honda-civic.html">2016 Honda Civic Review</a></p>
              </div>
              <div class="author">Dan Benson</div>
              <div class="date">January, 29 2016</div>
              <div class="description"><p>This video shows a new Bugatti Chiron starting-up and revving loudly.</p></div>
            </div>
          </div>
        </article>
      </div> 

      <aside>
        <div id="top-reviews">
          <h3>Top Reviews</h3>
          <ul class="top-reviews-ul">
            <li>2014 Ford Mustang</li>
            <li>2010 Chevrolet 1500 4x4</li>
            <li>2016 Toyota Prius</li>
            <li>2015 Chrysler 300</li>
            <li>2015 Jeep Grand Cherokee</li>
          </ul>
        </div>
      </aside>
    </div>  <!-- end of mainwrapper -->
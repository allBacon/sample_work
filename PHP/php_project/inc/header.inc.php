<?php #header.php ?>
<?php session_start(); 

include('inc/mysqli_connect.php'); 

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>New Meta Autos</title>
  <!-- The line below is for jQuery CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- SmartMenus jQuery plugin -->
  <script type="text/javascript" src="lib/jquery.smartmenus.js"></script>
  <!-- SmartMenus core CSS (required) -->
  <link href="css/css/sm-core-css.css" rel="stylesheet" type="text/css" />
  <!-- "sm-blue" menu theme (optional, you can use your own CSS, too) -->
  <link href="css/css/sm-blue/sm-blue.css" rel="stylesheet" type="text/css" />
  <link href="css/css/sm-simple/sm-simple.css" rel="stylesheet" type="text/css" /> 
  <!-- The line below is for jQuery UI -->
  <link href="jquery-ui-1.11.4/jquery-ui.css" rel="stylesheet" />
  <script src="jquery-ui-1.11.4/jquery-ui.min.js"></script>
  <link href="css/style.css" rel="stylesheet" />
</head>

<body>
  <div id="pagewrapper">
    <header>
      <div class="header-content">
        <div class="social">
          <form action="search.php" method="GET">
            <input type="text" id="header-search" name="search_input">
            <button><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
          <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a>
          <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook-square"></i></a>
          <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter-square"></i></a>
          <a href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin-square"></i></a>
        </div>
        <div class="header-login">
          <?php #if logged in then show logout link instead 
            if (isset($_SESSION['loggedin']) == 1) { ?> 
              <div class="header-logout"><a href="logout.php">Logout</a></p></div>
            <?php } else { ?>
              <div class="login"><a href="">Login</a></div>
              <div class="register"><a href="register.php">Register</a></div>
            <?php } ?>

        </div>
        <div class="header-login-form">
          <form action="process_login.php" method="POST">
            <input type="text" name="username" id="header-login-username" placeholder="Username">
            <input type="password" name="password" id="header-login-password" placeholder="Password">
            <button><i class="fa fa-sign-in" aria-hidden="true"></i></button>
          </form>
        </div>
      </div>
      <h1>New Meta Autos</h1>
      <nav>
      <!-- Mobile menu toggle button (hamburger/x icon) -->
        <input id="main-menu-state" type="checkbox" />
        <label class="main-menu-btn" for="main-menu-state">
        <span class="main-menu-btn-icon"></span>
        </label>
        <ul id="main-menu" class="sm sm-simple has-submenu">
         <li><a href="index.php" title="Recent Videos">Recent Videos</a></li>
         <li><a href="search.php" title="Vehicle Search">Vehicle Search</a>
          <ul>
            <li><a href="search.php?all=true" title="All Vehicles">All Vehicles</a></li>
            <li><a href="" title="By Type">By Type</a>
              <ul>
                <li><a href="search.php?cat=car" title="Cars">Car</a></li>
                <li><a href="search.php?cat=suv" title="SUV">SUV</a></li>
                <li><a href="search.php?cat=van" title="Van">Van</a></li>
                <li><a href="search.php?cat=truck" title="Truck">Truck</a></li>
              </ul>
            </li>
            <li><a href="search.php" title="Advanced Search">Advanced Search</a></li>
          </ul>
         </li>
         <li><a href="archive.php" title="Archive">Archive</a></li>
         <li><a href="contact.php" title="Contact">Contact</a></li>
            <?php 
              if (isset($_SESSION['loggedin']) == 1) { ?>
                <li><a href="" title="Administration">Admin</a>
                  <ul>
                    <li><a href="review_list.php" title="Review List">Review List</a></li>
                    <li><a href="car_list.php" title="Car List">Car List</a></li>
                    <li><a href="users.php" title="Users List">Users</a></li>
                    <li><a href="comments.php" title="Review List">Comment Moderation</a></li>
                    <li><a href="tags.php" title="Tags List">Tags List</a></li>
                  </ul>
                </li>
            <?php } else {} ?>
        </ul>

      </nav> 
    </header>  <!-- end of header -->
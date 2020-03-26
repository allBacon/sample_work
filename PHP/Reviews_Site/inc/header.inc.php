<?php #header.php
session_start(); 
ob_start();
include('inc/mysqli_connect.php'); 

$title = $_SERVER['PHP_SELF']; 
switch ($title) {
  case '/project/index.php':
    $title = 'New Meta Autos';
    break;
  case '/project/review.php':
    $title = 'New Meta: Review';
    break;
  case '/project/archive.php':
    $title = 'New Meta: Archives';
    break;
  case '/project/search.php':
    $title = 'New Meta: Search';
    break;
  case '/project/contact.php':
    $title = 'New Meta: Contact';
    break;
  case '/project/process_user.php':
    $title = 'New Meta: User Sign_in';
    break;
  case '/project/process_login.php':
    $title = 'New Meta: User Sign-In';
    break;
  case '/project/register.php':
    $title = 'New Meta: User Registration';
    break;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $title; ?></title>
  <!-- The line below is for jQuery CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
  <!-- SmartMenus jQuery plugin -->
  <script type="text/javascript" src="lib/jquery.smartmenus.js"></script>
  <link href="css/css/sm-core-css.css" rel="stylesheet" type="text/css" />
  <link href="css/css/sm-simple/sm-simple.css" rel="stylesheet" type="text/css" /> 
  <!-- Validate JS Forms -->
  <script src="jquery_validate/jquery.validate.min.js"></script>
  <!-- The line below is for jQuery UI -->
  <!--   <link href="jquery-ui-1.11.4/jquery-ui.css" rel="stylesheet" />
  <script src="jquery-ui-1.11.4/jquery-ui.min.js"></script> -->
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
          <?php 
          #if logged in then show logout link, otherwise display login and register links
            if (isset($_SESSION['loggedin']) == 1) { ?>
              <div class="login">Welcome <?php $username=$_SESSION['username']; echo ucwords($username); ?></div>
              <div class="register"><a href="logout.php">Logout</a></div>
            <?php } else { ?>
              <div class="login"><a href="">Sign-In</a></div>
              <div class="register"><a href="register.php">Register</a></div>
            <?php } ?>
        </div>
        <div class="header-login-form">
          <form method="POST" action="process_login.php">
            <input type="text" name="username" id="header-login-username" placeholder="Username" required>
            <input type="password" name="password" id="header-login-password" placeholder="Password" required>
            <button name="submit"><i class="fa fa-sign-in" aria-hidden="true"></i></button>
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
                <li><a href="search.php?cat=1" title="Cars">Car</a></li>
                <li><a href="search.php?cat=2" title="SUV">SUV</a></li>
                <li><a href="search.php?cat=4" title="Van">Van</a></li>
                <li><a href="search.php?cat=3" title="Truck">Truck</a></li>
              </ul>
            </li>
            <li><a href="search.php" title="Advanced Search">Advanced Search</a></li>
          </ul>
         </li>
         <li><a href="archive.php" title="Archive">Archive</a></li>
         <li><a href="contact.php" title="Contact">Contact</a></li>
            <?php 
            #when logged in as administrator, display admin menu
              if (isset($_SESSION['loggedin']) == 1 && isset($_SESSION['isAdmin']) == "true") { ?>
                <li><a href="admin.php" title="Administration">Admin</a>
                  <ul>
                    <li><a href="post_review.php" title="Post New Review">Post Review</a></li>
                    <li><a href="review_list.php?order=asc" title="Review List">Review List</a></li>
                    <li><a href="car_list.php?order=asc" title="Car List">Car List</a></li>
                    <li><a href="users.php?order=asc" title="Users List">Users</a></li>
                  </ul>
                </li>
            <?php } else {} ?>
        </ul>
      </nav> 
    </header>  <!-- end of header -->
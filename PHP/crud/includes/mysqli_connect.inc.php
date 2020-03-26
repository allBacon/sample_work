<?php
// mysql_connect.inc.php

// connect to the MySQL Database
// - host name
// - username
// - password
// - database name

// try and connect to MySQL server/database
// if you can't connect then Die
// use the mysqli_connect_error() to display the details of why the connection failed

$dbc = mysqli_connect("localhost","root","","ctec127_lab7") OR
 die('<p>Could not connect to the MySQL Server: ' . mysqli_connect_error() . '</p>');

// Inspect $dbc object
// Uncomment the 3 code lines below to display. Should only be used for debugging
// echo "<pre>";
// print_r($dbc);
// echo "</pre>";


// set the encoding
mysqli_set_charset($dbc,'utf8');

?>
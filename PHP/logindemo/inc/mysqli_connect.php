<?php

$dbc = new mysqli('localhost','root','','login_demo');

if ($dbc->connect_error) {
	$error = $dbc->connect_error;
}

$dbc->set_charset('utf8');
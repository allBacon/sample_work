<?php 

$db = new mysqli('localhost','root','','oophp');

if ($db->connect_error) {
	$error = $db->connect_error;
}

$db->set_charset('utf8');
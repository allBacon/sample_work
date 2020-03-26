<?#NYT API TOP STORIES USING PHP?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>NYT API: PHP</title>
	<link rel="stylesheet" type="text/css" href="nyt.css">
	<script src="moment.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
	<header>
		<h1>New York Times API using PHP: Top Stories</h1>
		<h2>Created by: Dan Benson 2016</h2>
	</header>
<?php
// set nyt api key
$api_key = "3c3d7b58ff01479ca9e966872ce4ad9e";
// url to the API
$url = "http://api.nytimes.com/svc/topstories/v1/home.json?api-key=" . $api_key;

// initialize curl request
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
if ($ssl){
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);	
}

// set curl result variable
$result = curl_exec($curl);
curl_close($curl);

//var_dump(json_decode($result, true));
//decode json data into string array as key value pairs
$data = json_decode($result, true);
//echo '<pre>';print_r($data);echo '</pre>';

// set iteration variable
$i=0;
?>
	<div id="container">
<?php 
// loop through results array using key value pairs
foreach ($data['results'] as $key => $value) {
	// create new article
	echo '<div class="flex">';
	
	//set article image, if none display placeholder
	echo '<img src="';
	
	if (isset($data['results'][$i]['multimedia'][0]['url'])) {
		echo $data['results'][$i]['multimedia'][0]['url'];
	} else {echo "http://placehold.it/75x75";}
	
	echo '">';
	//display title and article link (opens external page)
 	echo '<h2><a href="'.$data['results'][$i]['url'].' target="_blank">'.$data['results'][$i]['title'].'</a></h2>';
 	//display author or byline data
 	echo '<p>'.$data['results'][$i]['byline'].'</p>';
 	//display date article was published
 	//use strtotime built in php function to convert nyt api date to standard unix format
 	//then set new date by formatting the unix time format into php date custom format
 	$old_date = strtotime($data['results'][$i]['published_date']);
 	$new_date = date('l, M d Y', $old_date);
 	echo '<p>'.$new_date.'</p>';
 	//display section and abstract results
 	echo '<p>Section: '.$data['results'][$i]['section'].'</p>';
 	echo '<p>'.$data['results'][$i]['abstract'].'</p>';
 	echo '</div>';
 	// iterate through results index
 	$i++;
 }
?>
	</div>
</body>
<script type="text/javascript">

</script>
</html>
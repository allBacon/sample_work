<?php 


	require "../includes/mysqli_connect.inc.php";

	$sql = "INSERT INTO savings (name,balance) VALUES(?,?)";

	$stmt = $db->stmt_init();

        $stmt = $db->stmt_init();
        if (!$stmt->prepare($sql)) {
            $error = $stmt->error;
        } else {
        	$name = 'Dan Benson';
        	$balance = 2500.00;
            $stmt->bind_param('sd', $name, $balance);
            
            $stmt->execute();
            // $stmt->bind_result($name, $balance);
       	}

       	echo "<pre>";
       	echo $stmt->error;
       	var_dump($stmt);
       	echo "</pre>";
       	echo $db->affected_rows;

?>

<form method="GET" action="">
	
</form>
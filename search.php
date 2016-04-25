<?php

//Filename: search.php
//Authors: Joey Woodson
//Content: Search bar

	require('database.php');
	session_start();
			
	$search = $_POST['q'];
	$query = $mysqli->prepare("SELECT pick_up_location, drop_off_location, number_going, depart_time, arrive_time, return_time FROM trips WHERE pick_up_location LIKE ?");
	
	if(!$query) {
	    echo $mysqli->error;
	}
	
	$query->bind_param("s", "%".$search."%");
	$query->execute();
	$query->bind_result($pul,$dol,$ng,$dt,$at,$rt);
	while($query->fetch()) {
	    echo $pul."\t".$dol."\t".$ng."\t".$dt."\t".$at."\t".$rt."\n";
	}
	$query->close();
?>

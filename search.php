<!doctype html>
<?php

//Filename: search.php
//Authors: Joey Woodson
//Content: Search bar

	require('database.php');
	session_start();
	include('navbar.php');

	$search = $_GET['q'];
	//this isn't correct need to fix this so that it can search through the entire database not just for similar pick_up_location 
	$query = $mysqli->prepare("SELECT id, pick_up_location, drop_off_location, number_going, depart_time, arrive_time, return_time FROM trips WHERE pick_up_location LIKE ?");
	
	if(!$query) {
	    echo $mysqli->error;
	    exit;
	}
	
	$search = "%".$search."%";
	$query->bind_param("s", $search);
	$query->execute();
	//$query->fetch();
	$query->store_result();
	if($query->num_rows > 0){
		$query->bind_result($id,$pul,$dol,$ng,$dt,$at,$rt);
		while($query->fetch()) {
			echo '<div class="row"><div class="col s12 l2"></div>'
	    	// echo $pul."\t".$dol."\t".$ng."\t".$dt."\t".$at."\t".$rt."\n";
		}
		$query->close();
	} else{
		echo "<h3 class=\"center\">Sorry there weren't any matching results</h3>";
		$query->close();
	}
?>
<head>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<!--jQuery Link-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.js"></script>


		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<div class="row">
		<div class="col s12 l2">
			<p><a href="ride_details.php?details=">Pick Up Location</b></p>
		</div>
		<div class="col s12 l2">
			<p><b>Drop off Location</b></p>
		</div>
		<div class="col s12 l2">
			<p><b>Number Going</b></p>
		</div>
		<div class="col s12 l2">
			<p><b>Depart Time</b></p>
		</div>
		<div class="col s12 l2">
			<p><b>Arrive Time</b></p>
		</div>
			<div class="col s12 l2">
			<p><b>Return Time</b></p>
		</div>
	</div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>